<!DOCTYPE html>
<html>
<head>
    <title>Newsletter</title>
    <style>
        /* Add your email styles here */
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f6f6f6;
        }
        .container {
            width: 100%;
            max-width: 600px;
            margin: 0 auto;
            background-color: #ffffff;
            padding: 20px;
        }
        .header {
            background-color: #007bff;
            color: #ffffff;
            padding: 10px;
            text-align: center;
        }
        .content {
            padding: 20px;
        }
        .footer {
            background-color: #f1f1f1;
            color: #333333;
            padding: 10px;
            text-align: center;
        }
    </style>
</head>
<body>
<div class="container">
    <div class="header">
        <h1>رسالة جديدة</h1>
    </div>
    <div class="content">
        <p>اهلا تيرندات</p>
        <p>لديك رسالة جديدة في تيرندات</p>
    </div>
    <div class="footer">
        <p>&copy; {{ date('Y') }} Terndatt. All rights reserved.</p>
    </div>
</div>
</body>
</html>