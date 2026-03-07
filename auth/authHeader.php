<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?></title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        body {
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
            background: #2c3e50;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }
        .error{
            margin:10px 0;
            padding: 10px;
            background-color:rgba(216, 25, 25, 0.91);
            color:white;
            font-size: 15px;
            font-weight: 500;
        }
        .login-container {
            background: white;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            padding: 30px;
            width: 100%;
            max-width: 380px;
        }
        h2 {
            text-align: center;
            color: #333;
            margin-bottom: 24px;
            font-size: 24px;
            font-weight: 500;
        }
        .input-group {
            position: relative;
            margin-bottom: 20px;
        }
        input {
            width: 100%;
            padding: 12px 16px;
            border: 1px solid #ddd;
            border-radius: 6px;
            font-size: 15px;
            transition: border-color 0.2s;
            outline: none;
        }
        input:focus {
            border-color: #2c3e50;
        }
        .input-icon {
            position: absolute;
            left: 14px;
            top: 50%;
            transform: translateY(-50%);
            color: #666;
            font-size: 18px;
        }
        label {
            color: #666;
            font-size: 14px;
        }

        .remember-me{
            display: flex;
            align-content: center;
            justify-content: center;
            margin-bottom: 15px;
            gap: 10px;

        }
        .remember-me input{
            width: auto;
            transform: scale(1.5);
        }

        button {
            width: 100%;
            padding: 12px;
            background: #2c3e50;
            color: white;
            border: none;
            border-radius: 6px;
            font-size: 16px;
            font-weight: 500;
            cursor: pointer;
            transition: background 0.2s;
        }
        button:hover {
            background: #0056b3;
        }

        .links{
            width: 100%;
            padding:10px;
            text-align:center;
        }

        .links a{
            color:#2c3e50;
        }


        @media (max-width: 480px) {
            .login-container {
                padding: 24px 20px;
                margin: 10px;
            }
        }
    </style>
</head>
<body>
    <div class="login-container">
        <h2><?= $title ?></h2>