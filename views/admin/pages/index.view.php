<h1>Admin: Manage pages</h1>
<?php use App\Model\PageModel;

if (isset($pages)): ?>
    <table class="admin-pages-table">
        <thead>
        <tr>
            <th>ID</th>
            <th>Title</th>
            <th>Action</th>
        </tr>
        </thead>
        <tbody>
        <?php /** @var PageModel $page */ ?>
        <?php foreach ($pages as $page): ?>
            <tr>
                <td><?= e($page->id) ?></td>
                <td><?= e($page->title) ?></td>
                <td>
                    <div class="actions">
                        <a href="index.php?<?= http_build_query(['route' => 'admin/pages/edit', 'id' => $page->id]) ?>">Edit</a>
                        <form class="create-form" method="POST"
                              action="index.php?route=admin/pages/delete">
                            <input type="hidden" name="_method" value="DELETE">
                            <input type="hidden" name="id" value=<?= $page->id ?>>
                            <input class="create-form__button-link button-link" type="submit" value="Delete">
                        </form>
                    </div>
                </td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
<?php endif; ?>

<a href="index.php?route=admin/pages/create">Create page</a>
