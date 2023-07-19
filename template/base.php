<?php

use App\Session;

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="asserts/css/index.css">
    <script src="asserts/js/index.js" type="module" defer></script>
</head>
<body>
    <header>
        <nav>
            <a href="/">home</a>
            <?php if(!Session::keyExist("user")): ?>
                <a href="/create">creer un compte</a>
            <?php endif ?>
        </nav>
    </header>
    <?= $body; ?>
</body>
</html>