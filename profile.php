<?php require __DIR__ . '/app/autoload.php'; ?>
<?php require __DIR__ . '/views/header.php'; ?>

<section>
    <h1>Profile of <?= htmlspecialchars($_SESSION['user']['username']); ?></h1>
    <div>
        <p>Username: <?= htmlspecialchars($_SESSION['user']['username']); ?></p>
        <p>Email: <?= htmlspecialchars($_SESSION['user']['email']); ?></p>
        <p>Avatar:</p>
        <img src="/uploads/<?= $_SESSION['user']['avatar']; ?>" alt="Avatar.">
    </div>
</section>
<section>
    <h2>Change account details</h2>
    <form action="app/users/profile.php" method="post">

        <div class="mb-3">
            <label for="email">Email</label>
            <input class="form-control" type="email" name="email" id="email" placeholder="hello@wunderlist.com" required>
            <small class="form-text">Type in your new email adress.</small>
        </div>

        <div class="mb-3">
            <label for="password">Password</label>
            <input class="form-control" type="password" name="password" id="password" required>
            <small class="form-text">Type in your new password.</small>
        </div>

        <button type="submit" class="btn btn-primary">Save changes</button>
    </form>
</section>
<section>
    <h2>Upload an avatar</h2>
    <form action="/app/users/avatar.php" method="post" enctype="multipart/form-data">
        <div>
            <label for="avatar">Choose a PNG image to upload</label>
            <input type="file" name="avatar" id="avatar" accept=".png" required>
        </div>

        <button type="submit">Upload</button>
    </form>
</section>

<?php require __DIR__ . '/views/footer.php'; ?>
