<?php include_once __DIR__ . '/../../Controllers/view/header.php'; ?>

<h1>Register</h1>

<?php if (isset($_GET['error']) && $_GET['error'] == 1): ?>
    <p style="color: red;">All fields are required!</p>
<?php endif; ?>

<?php if (isset($_GET['error']) && $_GET['error'] == 2): ?>
    <p style="color: red;">Email already exists!</p>
<?php endif; ?>

<form action="/register" method="POST">
    <p>
        <label>Name:</label><br>
        <input type="text" name="name" required>
    </p>
    <p>
        <label>Email:</label><br>
        <input type="email" name="email" required>
    </p>
    <p>
        <label>Phone:</label><br>
        <input type="text" name="phone">
    </p>
    <p>
        <label>Password:</label><br>
        <input type="password" name="password" required>
    </p>
    <p>
        <button type="submit">Register</button>
    </p>
</form>
<p>Already have an account? <a href="/login">Login</a></p>

<?php include_once __DIR__ . '/../../Controllers/view/footer.php'; ?>