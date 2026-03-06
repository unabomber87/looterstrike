<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion Steam - LooterStrike</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        body {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            background: linear-gradient(135deg, #1a1a2e 0%, #16213e 100%);
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        .container {
            text-align: center;
            padding: 2rem;
        }
        .success-icon {
            width: 80px;
            height: 80px;
            background: linear-gradient(135deg, #00c853, #69f0ae);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 1.5rem;
            animation: pulse 1.5s ease-in-out infinite;
        }
        @keyframes pulse {
            0%, 100% { transform: scale(1); }
            50% { transform: scale(1.1); }
        }
        .success-icon svg {
            width: 40px;
            height: 40px;
            fill: white;
        }
        h1 {
            color: white;
            font-size: 1.75rem;
            margin-bottom: 0.5rem;
        }
        .message {
            color: #69f0ae;
            font-size: 1.125rem;
            margin-bottom: 2rem;
        }
        .countdown {
            font-size: 3rem;
            font-weight: bold;
            color: #F77F00;
            text-shadow: 0 0 20px rgba(247, 127, 0, 0.5);
            animation: blink 1s ease-in-out infinite;
        }
        @keyframes blink {
            0%, 100% { opacity: 1; }
            50% { opacity: 0.7; }
        }
        .footer-text {
            color: #9ca3af;
            font-size: 0.875rem;
            margin-top: 1.5rem;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="success-icon">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3">
                <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"></path>
            </svg>
        </div>
        <h1>🎉 Connexion réussie !</h1>
        <p class="message">Bienvenue agent sur LooterStrike</p>
        <div class="countdown" id="countdown">4</div>
        <p class="footer-text">Fermeture automatique...</p>
    </div>

    <script>
        let count = 4;
        const countdownEl = document.getElementById('countdown');
        
        const interval = setInterval(() => {
            count--;
            countdownEl.textContent = count;
            
            if (count <= 0) {
                clearInterval(interval);
                // Recharger la page parent si elle existe
                if (window.opener) {
                    window.opener.location.reload();
                }
                // Fermer le popup
                window.close();
            }
        }, 1000);
    </script>
</body>
</html>
