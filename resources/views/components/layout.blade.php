<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laravel 12 - Invibe</title>
    <style>
        body { background-color: #f3f3f3; font-family: Arial, sans-serif; margin:0; padding:0;}
        .container { max-width: 960px; margin: 0 auto; padding: 20px;}
    </style>
</head>
<body>
    <x-navbar/>
    <div class="container">
        {{ $slot }}
    </div>
</body>
</html>