<h1>Admin: Manage pages</h1>

<?php use App\Model\PageModel;

if (isset($pages)): ?>
    <table class="admin-pages-table">
        <thead>
        <tr>
            <th>ID</th>
            <th>Title</th>
        </tr>
        </thead>
        <tbody>
        <?php /** @var PageModel $page */ ?>
        <?php foreach ($pages as $page): ?>
            <tr>
                <td><?= e($page->id) ?></td>
                <td><?= e($page->title) ?></td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
<?php endif; ?>

<a href="index.php?route=admin/pages/create">Create page</a>
