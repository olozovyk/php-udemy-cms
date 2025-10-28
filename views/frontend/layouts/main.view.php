<?php
use App\Model\PageModel;
?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles/style.css">
    <title>CMS Project</title>
    <script src="scripts/script.js" defer></script>
</head>
<body>
<header class="header">
    <div class="container">
        <div class="header__bar">
            <div class="logo">
                <h1 class="logo__title"><a class="logo__link" href="index.php">CMS Project</a></h1>
                <p class="logo__description">A custom-made CMS system</p>
            </div>
            <button class="burger" aria-label="Toggle menu">
                <svg
                        class="burger__icon"
                        width="24"
                        height="24"
                        viewBox="0 0 24 24"
                        xmlns="http://www.w3.org/2000/svg"
                >
                    <path
                            class="burger__path"
                            d="M3 12h18M3 6h18M3 18h18"
                            stroke="currentColor"
                            stroke-width="2"
                            stroke-linecap="round"
                    />
                </svg>
                <svg
                        class="burger__icon burger__icon--close"
                        width="24"
                        height="24"
                        viewBox="0 0 24 24"
                        xmlns="http://www.w3.org/2000/svg"
                >
                    <path
                            class="burger__path"
                            d="M18 6L6 18M6 6l12 12"
                            stroke="currentColor"
                            stroke-width="2"
                            stroke-linecap="round"
                    />
                </svg>
            </button>
            <?php if (isset($navigation)): ?>
                <nav class="nav">
                    <ul class="nav__list">
                        <?php /**
                         * @var PageModel $navPage
                         * @var PageModel $page
                         * */ ?>
                        <?php foreach ($navigation as $navPage): ?>
                            <li class="nav__item">
                                <a
                                        class="nav__link <?php if (isset($page?->title) && $page->title === $navPage?->title) echo 'active' ?>"
                                        href="index.php?<?= http_build_query(['page' => $navPage->slug]) ?>"
                                >
                                    <?= e($navPage->title) ?></a>
                            </li>
                        <?php endforeach; ?>

                    </ul>
                </nav>
            <?php endif; ?>
        </div>
    </div>
</header>
<main class="main">
    <div class="container">
        <?php if (isset($contents)): ?>
            <?php echo $contents; ?>
        <?php endif; ?>
    </div>
</main>
<footer class="footer">
    <div class="container">
        <p class="footer__message">
        © 2025 Some Awesome Company. All rights reserved.
        </p>
    </div>
</footer>
</body>
</html>