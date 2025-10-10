<?php

use App\Model\PageModel;
/** @var PageModel $page */

?><h1><?= e($page->title) ?></h1>
<p><?= nl2br(e($page->content)) ?></p>
