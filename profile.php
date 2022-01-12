<?php require __DIR__ . '/app/autoload.php'; ?>
<?php require __DIR__ . '/views/header.php'; ?>

<section class="profile-header">
    <h1>Profile of <?= htmlspecialchars($_SESSION['user']['username']); ?></h1>
    <p>Username: <?= htmlspecialchars($_SESSION['user']['username']); ?></p>
    <p>Email: <?= htmlspecialchars($_SESSION['user']['email']); ?></p>
    <p>Avatar:</p>
    <?php if ($_SESSION['user']['avatar'] != null) : ?>
        <div class="avatar-container">
            <img class="avatar-image" src="/uploads/<?= $_SESSION['user']['avatar']; ?>" alt="Avatar.">
        </div>
    <?php else : ?>
        <div class="avatar-container">
            <img class="avatar-image" src="/uploads/placeholder.png" alt="Placeholder avatar image.">
        </div>
    <?php endif; ?>
</section>
<section class="profile-change">
    <h2>Change account details</h2>
    <?php if (isset($_SESSION['errors'])) : ?>
        <?php foreach ($_SESSION['errors'] as $error) : ?>
            <div>
                <?= $error; ?>
            </div>
        <?php endforeach; ?>
        <?php unset($_SESSION['errors']) ?>
    <?php endif; ?>
    <div class="change-avatar">
        <h3>Choose an avatar</h3>
        <form action=" /app/users/avatar.php" method="post" enctype="multipart/form-data">
            <div>
                <label for="avatar">Choose a PNG image to upload</label>
                <input type="file" name="avatar" id="avatar" accept=".png" required>
            </div>
            <button type="submit">Upload</button>
        </form>
    </div>
    <div class="change-user">
        <form action="app/users/profile.php" method="post">
            <div class="mb-3">
                <label for="email">Email:</label>
                <input class="form-control" type="email" name="email" id="email" placeholder="hello@wunderlist.com" required>
                <small class="form-text">Type in your new email adress.</small>
            </div>
            <div class="mb-3">
                <label for="password">Password:</label>
                <input class="form-control" type="password" name="password" id="password" required>
                <small class="form-text">Type in your new password.</small>
            </div>
            <button type="submit" class="btn btn-primary">Save changes</button>
        </form>
    </div>
    <div class="delete-user">
        <h3>Delete your account</h3>
        <p>If you delete your account, all of your information will be deleted along with lists and tasks.</p>
        <form action="/app/users/delete.php" method="post">
            <button name="delete-user" type="submit" class="btn btn-primary">Delete</button>
        </form>
    </div>
</section>

<?php require __DIR__ . '/views/footer.php'; ?>
