<?php include_once __DIR__ . '/../header.php'; ?>

<h1>Pagination (Page <?= $page ?>)</h1>
<table border="1">
    <thead>
        <tr>
            <th>ID</th>
            <th>Title</th>
            <th>Type</th>
            <th>Status</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($contents as $content): ?>
        <tr>
            <td><?= $content['id'] ?></td>
            <td><?= $content['title'] ?></td>
            <td><?= $content['type'] ?></td>
            <td><?= $content['status'] ?></td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<p>
    <?php if ($page > 1): ?>
        <a href="/pagination?page=<?= $page - 1 ?>"><button>Previous</button></a>
    <?php endif; ?>
    <a href="/pagination?page=<?= $page + 1 ?>"><button>Next</button></a>
</p>

<?php include_once __DIR__ . '/../footer.php'; ?>