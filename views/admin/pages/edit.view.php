<h1>Update page</h1>
<?php if (!empty($errors)): ?>
    <ul class="create-page-errors">
        <?php foreach ($errors as $error): ?>
            <li class="create-page-errors__item"><?= e($error) ?></li>
        <?php endforeach; ?>
    </ul>
<?php endif; ?>
<?php if (isset($page)): ?>
    <form method="POST"
          action="index.php?<?= http_build_query(['route' => 'admin/pages/edit', 'id' => $page['id']]) ?>">
        <input type="hidden" name="_csrf" value="<?= gen_csrf_token() ?>">
        <label for="title">Title</label>
        <input type="text" name="title" id="title" value="<?php if (!empty($page['title'])) echo e($page['title']) ?>">
        <label for="slug">Slug</label>
        <input type="text" name="slug" id="slug" value="<?php if (!empty($page['slug'])) echo e($page['slug']) ?>">
        <label for="content">Content</label>
        <textarea name="content" id="content" cols="30" rows="10"><?php
            if (!empty($page['content'])) echo e($page['content'])
            ?></textarea>
        <div>
            <input type="submit" value="Edit page">
        </div>
    </form>
<?php endif; ?>