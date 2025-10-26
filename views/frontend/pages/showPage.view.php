<?php

use App\Model\PageModel;

/**
 * @var PageModel $page
 * @var array $content
 */
?>
<div class="content-wrapper">
    <h1 class="page-title"><?= e($page->title) ?></h1>
    <?php if (count($content) > 0): ?>
        <?php foreach ($content as $paragraph): ?>
            <p class="paragraph"><?= e($paragraph) ?></p>
        <?php endforeach; ?>
    <?php endif; ?>
</div>
