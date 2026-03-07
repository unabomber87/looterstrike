<?php

namespace App\Services;

use DOMDocument;
use DOMXPath;

class RssService
{
    /**
     * Liste des flux RSS à récupérer
     */
    protected array $feeds = [
        "IGN"      => "https://feeds.ign.com/ign/games-all",
        "GameSpot" => "https://www.gamespot.com/feeds/mashup/",
        "PC Gamer" => "https://www.pcgamer.com/rss/",
        "Polygon"  => "https://www.polygon.com/rss/index.xml",
        "Kotaku"   => "https://kotaku.com/rss"
    ];

    /**
     * Mots-clés clickbait à filtrer
     */
    protected array $blacklist = [
        "shocking", "crazy", "you won't believe", "insane", "epic fail",
        "this one trick", "amazing secret", "incredible hack"
    ];

    /**
     * Nombre d'articles par source
     */
    protected int $limitPerSource = 20;

    /**
     * Nombre final d'articles à retourner
     */
    protected int $finalLimit = 10;

    /**
     * Timeout pour les requêtes cURL (secondes)
     */
    protected int $timeout = 10;

    /**
     * Récupère tous les articles depuis tous les flux RSS
     */
    public function fetchAll(): array
    {
        $allArticles = [];

        foreach ($this->feeds as $source => $url) {
            $raw = $this->fetchFeed($url);
            if (!$raw) {
                continue;
            }

            $articles = $this->parseFeed($raw, $this->limitPerSource, $source);
            $allArticles = array_merge($allArticles, $articles);
        }

        // Tri par date décroissante
        usort($allArticles, function ($a, $b) {
            return strtotime($b['date']) - strtotime($a['date']);
        });

        // Limite finale
        return array_slice($allArticles, 0, $this->finalLimit);
    }

    /**
     * Récupère un flux RSS via cURL
     */
    protected function fetchFeed(string $url): ?string
    {
        $ch = curl_init($url);
        curl_setopt_array($ch, [
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_SSL_VERIFYPEER => false,
            CURLOPT_TIMEOUT        => $this->timeout,
            CURLOPT_HTTPHEADER => [
                "Accept: text/xml, application/xml, application/rss+xml, */*;q=0.8"
            ],
            CURLOPT_USERAGENT => "Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36"
        ]);

        $data = curl_exec($ch);
        $error = curl_error($ch);
        curl_close($ch);

        if ($error || !$data) {
            return null;
        }

        return $data;
    }

    /**
     * Parse un flux RSS et retourne les articles
     */
    protected function parseFeed(string $xmlString, int $limit = 20, string $sourceName = ""): array
    {
        libxml_use_internal_errors(true);

        $doc = new DOMDocument();
        @$doc->loadXML($xmlString);

        $xpath = new DOMXPath($doc);
        $xpath->registerNamespace("content", "http://purl.org/rss/1.0/modules/content/");
        $xpath->registerNamespace("media",   "http://search.yahoo.com/mrss/");
        $xpath->registerNamespace("dc",      "http://purl.org/dc/elements/1.1/");
        $xpath->registerNamespace("atom",    "http://www.w3.org/2005/Atom");

        $items = $xpath->query("//item | //entry");
        $articles = [];

        for ($i = 0; $i < $items->length && $i < $limit; $i++) {
            $item = $items->item($i);

            $title   = $xpath->evaluate("string(title)", $item);
            $link    = $xpath->evaluate("string(link)", $item);
            if (!$link) {
                $link = $xpath->evaluate("string(id)", $item);
            }
            $pubDate = $xpath->evaluate("string(pubDate | updated | published)", $item);
            $content = $xpath->evaluate("string(content:encoded)", $item);
            $description = $xpath->evaluate("string(description)", $item);
            $author  = $xpath->evaluate("string(dc:creator)", $item);

            // Cascade d'extraction d'image
            $image = $this->extractImage($xpath, $item, $content, $link);

            // Fallback auteur
            if (!$author) {
                $author = $sourceName;
            }

            // Skip si titre vide, lien vide ou clickbait
            if (!$title || !$link || $this->isClickbait($title)) {
                continue;
            }

            $articles[] = [
                "title"   => $title,
                "link"    => $link,
                "date"    => date("Y-m-d H:i", strtotime($pubDate)),
                "image"   => $image,
                "content" => $content ?: $description,
                "author"  => $author,
                "source"  => $sourceName
            ];
        }

        return $articles;
    }

    /**
     * Extrait l'image depuis un item RSS (cascade de fallbacks)
     */
    protected function extractImage(DOMXPath $xpath, $item, ?string $content, ?string $link): ?string
    {
        // 1. media:content
        $image = $xpath->evaluate("string(media:content/@url)", $item);

        // 2. media:thumbnail
        if (!$image) {
            $image = $xpath->evaluate("string(media:thumbnail/@url)", $item);
        }

        // 3. media:group > media:content
        if (!$image) {
            $image = $xpath->evaluate("string(media:group/media:content/@url)", $item);
        }

        // 4. enclosure
        if (!$image) {
            $encType = $xpath->evaluate("string(enclosure/@type)", $item);
            if (strpos($encType, 'image') !== false) {
                $image = $xpath->evaluate("string(enclosure/@url)", $item);
            }
        }

        // 5. Première img dans content:encoded
        if (!$image && $content) {
            $image = $this->extractFirstImage($content);
        }

        // 6. Première img dans description
        if (!$image && $content) {
            $image = $this->extractFirstImage($content);
        }

        // 7. og:image scrapé depuis la page
        if (!$image && $link) {
            $image = $this->extractOgImage($link);
        }

        return $image ?: null;
    }

    /**
     * Extrait la première image depuis du HTML
     */
    protected function extractFirstImage(?string $html): ?string
    {
        if (!$html) {
            return null;
        }

        $doc = new DOMDocument();
        @$doc->loadHTML($html);

        $tags = $doc->getElementsByTagName('img');
        if ($tags->length > 0) {
            $src = $tags->item(0)->getAttribute('src');
            // Ignorer les images de tracking
            if ($src && !preg_match('/(\d+x\d+|pixel|tracker|blank|spacer)/i', $src)) {
                return $src;
            }
        }

        return null;
    }

    /**
     * Extrait og:image depuis une page web
     */
    protected function extractOgImage(string $articleUrl): ?string
    {
        $ch = curl_init($articleUrl);
        curl_setopt_array($ch, [
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_SSL_VERIFYPEER => false,
            CURLOPT_TIMEOUT        => 5,
            CURLOPT_USERAGENT      => "Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36",
            CURLOPT_RANGE          => "0-20000",
        ]);

        $html = curl_exec($ch);
        curl_close($ch);

        if (!$html) {
            return null;
        }

        // og:image
        if (preg_match('/<meta[^>]+property=["\']og:image["\'][^>]+content=["\'](https?:\/\/[^"\']+)["\']/', $html, $m)) {
            return $m[1];
        }

        // twitter:image fallback
        if (preg_match('/<meta[^>]+name=["\']twitter:image["\'][^>]+content=["\'](https?:\/\/[^"\']+)["\']/', $html, $m)) {
            return $m[1];
        }

        return null;
    }

    /**
     * Vérifie si un titre est du clickbait
     */
    protected function isClickbait(string $title): bool
    {
        $titleLower = strtolower($title);
        foreach ($this->blacklist as $word) {
            if (strpos($titleLower, $word) !== false) {
                return true;
            }
        }
        return false;
    }

    /**
     * Modifie les flux RSS à récupérer
     */
    public function setFeeds(array $feeds): self
    {
        $this->feeds = $feeds;
        return $this;
    }

    /**
     * Modifie la limite finale d'articles
     */
    public function setFinalLimit(int $limit): self
    {
        $this->finalLimit = $limit;
        return $this;
    }
}
