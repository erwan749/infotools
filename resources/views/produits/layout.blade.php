<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Gestion du contenu</title>
    <!-- Liens CSS Bootstrap et autres -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0-alpha/css/bootstrap.css" rel="stylesheet">
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.5.0/css/bootstrap-datepicker.css" rel="stylesheet">
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.5.0/js/bootstrap-datepicker.js"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">

    <style>
        * {
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', sans-serif;
            margin: 0;
            background-color: #f4f6f8;
            color: #333;
        }

        header {
            background: transparent;
            padding: 20px 50px;
            border-bottom: 1px solid #ddd;
            position: sticky;
            top: 0;
            z-index: 999;
        }

        header a {
            color: black;
            text-decoration: none;
            font-weight: bold;
        }

        .container {
            padding: 30px 50px;
            max-width: 1200px;
            margin: 0 auto;
        }

        h2 {
            margin-bottom: 30px;
            font-size: 28px;
        }

        .btn {
            padding: 10px 18px;
            border-radius: 6px;
            border: none;
            text-decoration: none;
            font-weight: bold;
            font-size: 14px;
            cursor: pointer;
        }

        .btn-success {
            background-color: #2e7d32;
            color: white;
        }

        .btn-primary {
            background-color: #1976d2;
            color: white;
        }

        .btn-info {
            background-color: #0288d1;
            color: white;
        }

        .btn-danger {
            background-color: #d32f2f;
            color: white;
        }

        .table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 30px;
            background-color: white;
            box-shadow: 0 0 8px rgba(0,0,0,0.05);
        }

        .table th, .table td {
            padding: 14px;
            border-bottom: 1px solid #eee;
            text-align: left;
        }

        .table th {
            background-color: #e3f2fd;
        }

        .alert {
            padding: 12px 20px;
            margin-bottom: 20px;
            background-color: #d4edda;
            border-left: 6px solid #388e3c;
            color: #2e7d32;
        }

        @media (max-width: 768px) {
            .container {
                padding: 20px;
            }

            .table th, .table td {
                font-size: 13px;
                padding: 10px;
            }

            .btn {
                margin-bottom: 6px;
                display: inline-block;
                width: 100%;
            }
        }

        /* Header spécifique à la gestion des clients */
        .admin-header {
            position: sticky;
            top: 0;
            width: 100%;
            background-color: rgba(255, 255, 255, 0.95); /* presque transparent */
            backdrop-filter: blur(6px); /* flou si dispo */
            border-bottom: 1px solid #ddd;
            padding: 12px 0;
            z-index: 1000;
        }

        .header-inner {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 30px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .page-title {
            font-size: 22px;
            font-weight: 600;
            margin: 0;
        }

        .admin-header a {
            color: #1976d2;
            font-weight: bold;
            text-decoration: none;
        }

        .admin-header a:hover {
            text-decoration: underline;
        }

        /* Formulaires */
        .form-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 30px;
        }

        .form-header h2 {
            font-size: 24px;
            font-weight: 600;
            margin: 0;
        }

        .client-form {
            background-color: #fff;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 0 10px rgba(0,0,0,0.05);
        }

        .form-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(260px, 1fr));
            gap: 20px;
        }

        .form-group {
            display: flex;
            flex-direction: column;
        }

        .form-group label {
            margin-bottom: 6px;
            font-weight: 600;
            font-size: 14px;
            color: #444;
        }

        .form-control {
            border: 1px solid #ccc;
            border-radius: 6px;
            font-size: 14px;
        }

        .form-control:focus {
            border-color: #1976d2;
            outline: none;
        }

        .error {
            color: #d32f2f;
            font-size: 13px;
            margin-top: 4px;
        }

        .form-submit {
            margin-top: 30px;
            text-align: right;
        }

        .alert-danger {
            background-color: #fdecea;
            border-left: 5px solid #f44336;
            padding: 15px;
            color: #b71c1c;
            margin-bottom: 30px;
            border-radius: 6px;
        }
    </style>
</head>
<body>
    <header class="admin-header">
        <div class="header-inner">
            <h1 class="page-title">Gestion des produit</h1>
            <a href="/dashboard"><i class="fas fa-home"></i> Accueil</a>
        </div>
    </header>

    <div class="container">
        @yield('content')
    </div>
</body>
</html>
