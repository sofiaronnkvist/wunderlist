<?php require __DIR__ . '/app/autoload.php'; ?>
<?php require __DIR__ . '/views/header.php'; ?>

<article>
    <h1>Login</h1>

    <form action="app/users/login.php" method="post">
        <div class="mb-3">
            <label for="username">Username</label>
            <input class="form-control" type="username" name="username" id="username" placeholder="Wunderlist" required>
            <small class="form-text">Please provide your username.</small>
        </div>

        <div class="mb-3">
            <label for="email">Email</label>
            <input class="form-control" type="email" name="email" id="email" placeholder="hello@wunderlist.com" required>
            <small class="form-text">Please provide your email address.</small>
        </div>

        <div class="mb-3">
            <label for="password">Password</label>
            <input class="form-control" type="password" name="password" id="password" required>
            <small class="form-text">Please provide your password.</small>
        </div>

        <button type="submit" class="btn btn-primary">Login</button>
    </form>
</article>

<article>
    <h1>Or register</h1>

    <form action="app/users/register.php" method="post">
        <div class="mb-3">
            <label for="username">Username</label>
            <input class="form-control" type="username" name="username" id="username" placeholder="Wunderlist" required>
            <small class="form-text">Please pick a username.</small>
        </div>

        <div class="mb-3">
            <label for="email">Email</label>
            <input class="form-control" type="email" name="email" id="email" placeholder="hello@wunderlist.com" required>
            <small class="form-text">Please provide your email address.</small>
        </div>

        <div class="mb-3">
            <label for="password">Password</label>
            <input class="form-control" type="password" name="password" id="password" required>
            <small class="form-text">Please choose a password.</small>
        </div>

        <button type="submit" class="btn btn-primary">Register</button>
    </form>
</article>

<?php require __DIR__ . '/views/footer.php'; ?>
