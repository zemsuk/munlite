<?php include_once __DIR__ . '/../header.php'; ?>

<h1>Aggregate Functions</h1>
<table border="1">
    <tr>
        <th>Function</th>
        <th>Result</th>
    </tr>
    <tr>
        <td>Total Users (count)</td>
        <td><?= $data['totalUsers'] ?></td>
    </tr>
    <tr>
        <td>Total Content (count)</td>
        <td><?= $data['totalContent'] ?></td>
    </tr>
    <tr>
        <td>Max ID (content)</td>
        <td><?= $data['maxId'] ?></td>
    </tr>
    <tr>
        <td>Min ID (content)</td>
        <td><?= $data['minId'] ?></td>
    </tr>
    <tr>
        <td>Avg ID (content)</td>
        <td><?= $data['avgId'] ?></td>
    </tr>
</table>

<?php include_once __DIR__ . '/../footer.php'; ?>