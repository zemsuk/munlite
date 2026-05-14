<?php ?>
<style>
    ul {
        list-style: none;
        margin: 0;
        padding: 0;
        display: inline-block;
    }

    ul li {
        display: inline-block;
        border: 1px solid;
        padding: 10px;
    }

    .brand {
        display: inline-block;
        border: 1px solid;
        padding: 10px;
        border-radius: 5px;
        background-color: aquamarine;
    }

    .auth-links {
        float: right;
    }
</style>
<h3 class="brand">
    <?php echo APP_NAME; ?>
</h3>
<div class="auth-links">
    <?php if (isset($_SESSION['user_id'])): ?>
        <span>Welcome, <?= $_SESSION['user_name'] ?></span>
        <a href="/dashboard"><button>Dashboard</button></a>
        <a href="/logout"><button>Logout</button></a>
    <?php else: ?>
        <a href="/login"><button>Login</button></a>
        <a href="/register"><button>Register</button></a>
    <?php endif; ?>
</div>
<ul>
    <li><a href="/">Home</a></li>
    <li><a href="/about">About</a></li>
    <li><a href="/service">Service</a></li>
    <li><a href="/where-in">whereIn</a></li>
    <li><a href="/where-between">whereBetween</a></li>
    <li><a href="/create-content">Create Content</a></li>
    <li><a href="/group-by">GroupBy</a></li>
    <li><a href="/pagination">Pagination</a></li>
    <li><a href="/join">Join</a></li>
    <li><a href="/aggregate">Aggregate</a></li>
</ul>
<hr style="clear: both;">