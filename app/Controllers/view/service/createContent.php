<?php include_once __DIR__ . '/../header.php'; ?>

<h1>Create Content</h1>

<?php if (isset($_GET['success'])): ?>
    <p style="color: green;">Content created successfully!</p>
<?php endif; ?>

<form action="/store-content" method="POST">
    <p>
        <label>Title:</label><br>
        <input type="text" name="title" required>
    </p>
    <p>
        <label>Details:</label><br>
        <textarea name="details" rows="5" required></textarea>
    </p>
    <p>
        <label>Type:</label><br>
        <select name="type">
            <option value="news">News</option>
            <option value="blog">Blog</option>
        </select>
    </p>
    <p>
        <label>Status:</label><br>
        <select name="status">
            <option value="1">Active</option>
            <option value="0">Inactive</option>
        </select>
    </p>
    <p>
        <button type="submit">Create</button>
    </p>
</form>

<?php include_once __DIR__ . '/../footer.php'; ?>