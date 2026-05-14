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
</style>
<h3 class="brand">
    <?php echo APP_NAME; ?>
</h3>
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
<hr>