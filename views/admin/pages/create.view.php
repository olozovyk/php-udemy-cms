<h1>Create new page</h1>
<?php if (!empty($errors)): ?>
    <ul class="create-page-errors">
        <?php foreach ($errors as $error): ?>
            <li class="create-page-errors__item"><?= e($error) ?></li>
        <?php endforeach; ?>
    </ul>
<?php endif; ?>
<form method="POST" action="index.php?route=admin/pages/create">
    <label for="title">Title</label>
    <input type="text" name="title" id="title" value="<?php if (isset($_POST['title'])) echo e($_POST['title']) ?>">
    <label for="slug">Slug</label>
    <input type="text" name="slug" id="slug" value="<?php if (isset($_POST['slug'])) echo e($_POST['slug']) ?>">
    <label for="content">Content</label>
    <textarea name="content" id="content" cols="30" rows="10"><?php
        if (isset($_POST['content'])) echo e($_POST['content'])
        ?></textarea>
    <div>
        <input type="submit" value="Create page">
    </div>
</form>