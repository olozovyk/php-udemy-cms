<?php if (!empty($errors)): ?>
    <ul class="login-errors">
        <?php foreach ($errors as $error): ?>
            <li class="login-errors__item"><?= $error ?></li>
        <?php endforeach; ?>
    </ul>
<?php endif; ?>
<form method="POST" action="index.php?<?= http_build_query(['route' => 'admin/login']) ?>">
    <div>
        <input type="hidden" name="_csrf" value="<?= gen_csrf_token() ?>">
        <label for="username">Username:</label>
        <input type="text" name="username" id="username" value=<?php if (isset($_POST['username'])) echo e($_POST['username'])?>>
        <label for="password">Password:</label>
        <input type="password" name="password" id="password">
    </div>
    <input type="submit" value="Submit">
</form>