<!DOCTYPE html>
<html>
<head>
    <title>Tracking Update</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 40px;
        }
        .email-wrapper {
            background-color: #ffffff;
            max-width: 600px;
            margin: auto;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0,0,0,0.05);
        }
        .header {
            text-align: center;
            margin-bottom: 20px;
        }
        .header h2 {
            color: #10b981;
            margin: 0;
        }
        .message {
            font-size: 16px;
            color: #333333;
            line-height: 1.6;
        }
        .btn {
            display: inline-block;
            margin-top: 30px;
            padding: 12px 24px;
            background-color: #10b981;
            color: white;
            text-decoration: none;
            border-radius: 6px;
            font-weight: bold;
            transition: background-color 0.3s ease;
        }
        .btn:hover {
            background-color: #059669;
        }
        .footer {
            margin-top: 40px;
            text-align: center;
            font-size: 12px;
            color: #888;
        }
    </style>
</head>
<body>
    <div class="email-wrapper">
        <div class="header">
            <h2>📦 Tracking Update</h2>
        </div>

        <div class="message">
            <p>{{ $msg }}</p>
        </div>

        <div style="text-align: center;">
            <a href="http://localhost/ClickKart/public/Click_Kard.com" class="btn">Visit Our Website</a>
        </div>

        <div class="footer">
            &copy; {{ date('Y') }} Click_Kard. All rights reserved.
        </div>
    </div>
</body>
</html>
