<?php include_once __DIR__ . '/../header.php'; ?>

<h1>Edit Content</h1>

<form action="/update-content" method="POST">
    <input type="hidden" name="id" value="<?= $content['id'] ?>">
    <p>
        <label>Title:</label><br>
        <input type="text" name="title" value="<?= $content['title'] ?? '' ?>" required>
    </p>
    <p>
        <label>Details:</label><br>
        <textarea name="details" rows="5" required><?= $content['details'] ?? '' ?></textarea>
    </p>
    <p>
        <label>Type:</label><br>
        <select name="type">
            <option value="news" <?= ($content['type'] ?? '') === 'news' ? 'selected' : '' ?>>News</option>
            <option value="blog" <?= ($content['type'] ?? '') === 'blog' ? 'selected' : '' ?>>Blog</option>
        </select>
    </p>
    <p>
        <label>Status:</label><br>
        <select name="status">
            <option value="1" <?= ($content['status'] ?? '') == 1 ? 'selected' : '' ?>>Active</option>
            <option value="0" <?= ($content['status'] ?? '') == 0 ? 'selected' : '' ?>>Inactive</option>
        </select>
    </p>
    <p>
        <button type="submit">Update</button>
        <a href="/"><button type="button">Cancel</button></a>
    </p>
</form>

<?php include_once __DIR__ . '/../footer.php'; ?>