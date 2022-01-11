<nav class="navbar">
    <a class="nav-logo" href="/index.php">W</a>
    <ul class="nav-menu">
        <li class="nav-item">
            <a class="nav-link <?php echo $_SERVER['SCRIPT_NAME'] === '/index.php' ? 'active' : ''; ?>" href="/index.php">Home</a>
        </li>

        <li class="nav-item">
            <a class="nav-link <?php echo $_SERVER['SCRIPT_NAME'] === '/about.php' ? 'active' : ''; ?>" href="/about.php">About</a>
        </li>

        <?php if (isUserLoggedIn()) : ?>
            <li class="nav-item">
                <a class="nav-link" href="/profile.php">Profile</a>
            </li>
        <?php endif; ?>

        <li class="nav-item">
            <?php if (isUserLoggedIn()) : ?>
                <a class="nav-link" href="/app/users/logout.php">Logout</a>
            <?php else : ?>
                <a class="nav-link <?php echo $_SERVER['SCRIPT_NAME'] === '/login.php' ? 'active' : ''; ?>" href="login.php">Login</a>
            <?php endif; ?>
        </li>
        <?php if (!isset($_SESSION['user'])) : ?>
            <li class="nav-item">
                <a class="nav-link" href="/register.php">Register</a>
            </li>
        <?php endif; ?>
    </ul>
    <div class="hamburger">
        <span class="bar"></span>
        <span class="bar"></span>
        <span class="bar"></span>
    </div>
</nav>
