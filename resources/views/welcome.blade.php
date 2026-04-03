<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Notes API</title>
    <style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: Arial, sans-serif;
            background: #f3f4f6;
            color: #111827;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }

        .card {
            width: 100%;
            max-width: 700px;
            background: #ffffff;
            border-radius: 18px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.08);
            padding: 40px 30px;
            text-align: center;
        }

        h1 {
            font-size: 36px;
            margin-bottom: 12px;
            color: #4f46e5;
        }

        p {
            font-size: 17px;
            line-height: 1.7;
            color: #4b5563;
            margin-bottom: 24px;
        }

        .features {
            text-align: left;
            margin: 25px 0;
            padding: 0;
            list-style: none;
        }

        .features li {
            background: #f9fafb;
            margin-bottom: 10px;
            padding: 12px 14px;
            border-radius: 10px;
            border-left: 4px solid #4f46e5;
        }

        .buttons {
            margin-top: 28px;
            display: flex;
            gap: 12px;
            justify-content: center;
            flex-wrap: wrap;
        }

        .buttons a {
            text-decoration: none;
            background: #4f46e5;
            color: white;
            padding: 12px 20px;
            border-radius: 10px;
            font-weight: bold;
            transition: 0.2s ease;
        }

        .buttons a:hover {
            background: #4338ca;
        }

        .footer {
            margin-top: 24px;
            font-size: 14px;
            color: #6b7280;
        }
    </style>
</head>
<body>
    <div class="card">
        <h1>Notes API</h1>
        <p>
            This project is a simple REST API built with Laravel.
            It includes authentication, notes CRUD operations, filtering,
            mark-as-complete feature, and Swagger documentation.
        </p>

        <ul class="features">
            <li>User Register / Login</li>
            <li>Create, List, Update, Delete Notes</li>
            <li>Mark Note as Completed</li>
            <li>Filter Completed / Pending Notes</li>
            <li>Swagger API Documentation</li>
        </ul>

        <div class="buttons">
            <a href="/api/documentation">Swagger Docs</a>
            <a href="/api/notes">API Endpoint</a>
        </div>

        <div class="footer">
            Laravel REST API Project
        </div>
    </div>
</body>
</html>