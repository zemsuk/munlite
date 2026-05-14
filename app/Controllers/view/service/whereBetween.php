<?php include_once __DIR__ . '/../header.php'; ?>

<h1>WhereBetween Results</h1>
<table border="1">
    <thead>
        <tr>
            <th>ID</th>
            <th>Title</th>
            <th>Details</th>
            <th>Type</th>
            <th>Status</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($contents as $content): ?>
        <tr>
            <td><?= $content['id'] ?></td>
            <td><?= $content['title'] ?></td>
            <td><?= $content['details'] ?></td>
            <td><?= $content['type'] ?></td>
            <td><?= $content['status'] ?></td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<?php include_once __DIR__ . '/../footer.php'; ?>