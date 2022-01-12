<?php require __DIR__ . '/app/autoload.php'; ?>
<?php require __DIR__ . '/views/header.php'; ?>

<article class="login-container">

    <h1>Login</h1>
    <?php if (isset($_SESSION['errors'])) : ?>
        <?php foreach ($_SESSION['errors'] as $error) : ?>
            <div>
                <?= $error; ?>
            </div>
        <?php endforeach; ?>
        <?php unset($_SESSION['errors']) ?>
    <?php endif; ?>

    <form action="app/users/login.php" method="post">

        <div>
            <label for="email">Email</label>
            <input class="form-control" type="email" name="email" id="email" placeholder="hello@wunderlist.com" required>
            <small class="form-text">Please provide your email address.</small>
        </div>

        <div>
            <label for="password">Password</label>
            <input class="form-control" type="password" name="password" id="password" required>
            <small class="form-text">Please provide your password.</small>
        </div>

        <button type="submit" class="btn btn-primary">Login</button>
    </form>
</article>
<article class="about-container">
    <h2>Why use a to-do list?</h2>
    <p>By keeping a list of things to do, you will get the easy gratification of checking things off when you’ve done them. Grouping them in lists also makes it easy to get an overview!</p>
</article>
<div class="about-image-container">
    <img class="about-image" src="/assets/images/flower.png" alt="Flower.">
</div>

<?php require __DIR__ . '/views/footer.php'; ?>
