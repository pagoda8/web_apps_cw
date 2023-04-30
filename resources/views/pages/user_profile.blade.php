<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>User Profile</title>
    </head>
    <body class="antialiased">
		<h1>User Profile</h1>
		<p>User with ID: <?php echo $id; ?></p>
    </body>
</html>
