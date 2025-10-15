<?php
use App\Model\PageModel;
?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="./styles/simple.css"/>
    <link rel="stylesheet" type="text/css" href="./styles/custom.css"/>
    <link rel="stylesheet" type="text/css" href="./styles/admin.css"/>
    <title>CMS: Admin</title>
</head>
<body>
<header>
    <h1>
        <a href="index.php?route=admin/pages">CMS Project</a>
    </h1>
    <p>An admin area</p>
</header>
<main>
    <?php if (isset($contents)): ?>
        <?php echo $contents; ?>
    <?php endif; ?>
</main>
<footer>
    <p></p>
</footer>
</body>
</html>