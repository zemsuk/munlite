<?php include_once __DIR__ . '/../../Controllers/view/header.php'; ?>

<h1>Login</h1>

<?php if (isset($_GET['error']) && $_GET['error'] == 1): ?>
    <p style="color: red;">Invalid email or password!</p>
<?php endif; ?>

<?php if (isset($_GET['success']) && $_GET['success'] == 1): ?>
    <p style="color: green;">Registration successful! Please login.</p>
<?php endif; ?>

<form action="/login" method="POST">
    <p>
        <label>Email:</label><br>
        <input type="email" name="email" required>
    </p>
    <p>
        <label>Password:</label><br>
        <input type="password" name="password" required>
    </p>
    <p>
        <button type="submit">Login</button>
    </p>
</form>
<p>Don't have an account? <a href="/register">Register</a></p>

<?php include_once __DIR__ . '/../../Controllers/view/footer.php'; ?>