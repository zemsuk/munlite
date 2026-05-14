<?php include_once __DIR__ . '/../header.php'; ?>

<h1>GroupBy Results</h1>
<table border="1">
    <thead>
        <tr>
            <th>Type</th>
            <th>Total</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($contents as $content): ?>
        <tr>
            <td><?= $content['type'] ?></td>
            <td><?= $content['total'] ?></td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<?php include_once __DIR__ . '/../footer.php'; ?>