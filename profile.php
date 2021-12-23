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
