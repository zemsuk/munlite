<?php include_once __DIR__ . '/../../Controllers/view/header.php'; ?>

<h1>Dashboard</h1>

<table border="1">
    <tr>
        <th>Field</th>
        <th>Value</th>
    </tr>
    <tr>
        <td>ID</td>
        <td><?= $user['id'] ?></td>
    </tr>
    <tr>
        <td>Name</td>
        <td><?= $user['name'] ?></td>
    </tr>
    <tr>
        <td>Email</td>
        <td><?= $user['email'] ?></td>
    </tr>
    <tr>
        <td>Phone</td>
        <td><?= $user['phone'] ?? 'N/A' ?></td>
    </tr>
    <tr>
        <td>Status</td>
        <td><?= $user['status'] == 1 ? 'Active' : 'Inactive' ?></td>
    </tr>
</table>

<p><a href="/">Back to Home</a></p>

<?php include_once __DIR__ . '/../../Controllers/view/footer.php'; ?>