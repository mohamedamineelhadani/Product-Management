<?php
require_once __DIR__."/config/config.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome to Product Management</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, sans-serif;
            background: #2c3e50;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }

        .card {
            background: white;
            border-radius: 5px;
            padding: 20px;
            max-width: 500px;
            width: 100%;
            box-shadow: 0 20px 60px rgba(0,0,0,0.3);
            text-align: center;
            animation: fadeIn 0.8s ease-out;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .title {
            color: #333;
            font-size: 2.5em;
            margin-bottom: 20px;
            font-weight: 600;
        }

        .description {
            color: #666;
            font-size: 1.1em;
            line-height: 1.6;
            margin-bottom: 30px;
        }


        .start-link {
            display: inline-block;
            background: #2c3e50;
            color: white;
            text-decoration: none;
            padding: 15px 40px;
            border-radius: 0px;
            font-size: 1.2em;
            font-weight: 500;
            transition: all 0.3s ease;
        }

        .start-link:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px #2c3e50;
        }

        .start-link:active {
            transform: translateY(0);
        }

        @media (max-width: 480px) {
            .card {
                padding: 30px 20px;
            }
            
            .title {
                font-size: 2em;
            }
            
            .features {
                gap: 10px;
            }
        }
    </style>
</head>
<body>
    <div class="card">
        <h1 class="title">
            Product Management
        </h1>
        <p class="description">
            Streamline your product workflow, track inventory, and manage your catalog 
            with our intuitive product management system. Everything you need in one place.
        </p>        
        <a href="<?= BASE_URL ?>" class="start-link">Get started →</a>
    </div>
</body>
</html>