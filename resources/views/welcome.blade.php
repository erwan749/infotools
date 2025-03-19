<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Infotools Centre</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0-alpha/css/bootstrap.css">
    <style>
        body, html {
            height: 100%;
            margin: 0;
        }
        body {
            background: linear-gradient(135deg, #f0f0f0, #d9d9d9);
            font-family: Arial, sans-serif;
        }

        .full-height {
            height: 100vh;
        }

        .center-content {
            display: flex;
            justify-content: center;
            align-items: center;
            text-align: center;
            flex-direction: column;
        }

        .card {
            width: 100%;
            max-width: 400px;
            padding: 30px;
            border-radius: 15px;
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1), 0 4px 20px rgba(0, 0, 0, 0.2);
            background-color: white;
        }

        .btn-custom {
            margin-top: 20px;
        }

        .company-description {
            margin-top: 15px;
            font-size: 16px;
            color: #555;
        }
    </style>
</head>
<body class="full-height">
    <div class="container-fluid full-height center-content">
        <div class="card">
            <h1>Infotools</h1>
            <p class="company-description">Infotools est une entreprise spécialisée dans la vente et le développement de solutions logicielles.</p>
            <a href="/login" class="btn btn-primary btn-custom">Connexion</a>
        </div>
    </div>
</body>
</html>
