<?php

namespace App\Console\Commands;

use App\Services\RssFetcherService;
use Illuminate\Console\Command;

class FetchRssCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:fetch-rss';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Récupère les articles RSS depuis les flux configurés et les stocke en cache';

    /**
     * Execute the console command.
     */
    public function handle(): int
    {
        $this->info('Démarrage de la récupération des articles RSS...');
        
        try {
            $rssFetcher = new RssFetcherService();
            $count = $rssFetcher->fetch();
            
            $this->info("Terminé : {$count} article(s) inséré(s) ou mis à jour.");
            
            return Command::SUCCESS;
        } catch (\Exception $e) {
            $this->error("Erreur lors de la récupération RSS : " . $e->getMessage());
            
            return Command::FAILURE;
        }
    }
}
