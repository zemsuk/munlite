<?php include_once __DIR__ . '/../header.php'; ?>

<h1>Users</h1>
<table border="1">
    <thead>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Email</th>
            <th>Phone</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($users as $user): ?>
            <tr>
                <td><?= $user['id'] ?></td>
                <td><?= $user['title'] ?></td>
                <td><?= $user['details'] ?></td>
                <td><?= $user['type'] ?></td>
                <td>
                    <a href="/edit-content?id=<?= $user['id'] ?>"><button>Edit</button></a>
                    <a href="/delete-content?id=<?= $user['id'] ?>"
                        onclick="return confirm('Are you sure?')"><button>Delete</button></a>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<?php include_once __DIR__ . '/../footer.php'; ?>