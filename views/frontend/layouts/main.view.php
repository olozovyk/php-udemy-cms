<?php
use App\Model\PageModel;
?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="./styles/simple.css"/>
    <link rel="stylesheet" type="text/css" href="./styles/custom.css"/>
    <title>CMS Project</title>
</head>
<body>
<header>
    <h1>
        <a href="index.php">CMS Project</a>
    </h1>
    <p>A custom-made CMS system</p>
    <?php if (isset($navigation)): ?>
        <nav>
            <ul>
                <li>
                    <?php /**
                     * @var PageModel $navPage
                     * @var PageModel $page
                     * */ ?>
                    <?php foreach ($navigation as $navPage): ?>
                        <a
                                class="<?php if (isset($page?->title) && $page->title === $navPage?->title) echo 'active' ?>"
                                href="index.php?<?= http_build_query(['page' => $navPage->slug]) ?>"
                        >
                            <?= e($navPage->title) ?></a>
                    <?php endforeach; ?>
                </li>
            </ul>
        </nav>
    <?php endif; ?>
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