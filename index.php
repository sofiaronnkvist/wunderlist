<?php require __DIR__ . '/app/autoload.php'; ?>
<?php require __DIR__ . '/views/header.php'; ?>

<section>
    <h1><?php echo $config['title']; ?></h1>
    <p>This is the home page.</p>

    <?php if (isUserLoggedIn()) : ?>
        <p>Welcome, <?= htmlspecialchars($_SESSION['user']['username']); ?>!</p>
        <p>Here you will find all of your tasks and lists.</p>
    <?php endif; ?>
</section>
<section>
    <h2>All tasks</h2>
    <h3>Add a task</h3>
    <form action="app/tasks/store.php" method="post">
        <div class="mb-3">
            <label for="task-title">Add a title</label>
            <input class="form-control" type="task-title" name="task-title" id="task-title" placeholder="Title" required>
        </div>
        <div class="mb-3">
            <label for="task-description">Add a description</label>
            <input class="form-control" type="task-description" name="task-description" id="task-description" placeholder="Description" required>
        </div>
        <div class="mb-3">
            <label for="task-deadline">Add a due date</label>
            <input class="form-control" type="date" name="task-deadline" id="task-deadline" required>
        </div>
        <div class="mb-3">
            <label for="task-list">Choose a list (if you want to)</label>
            <select name="task-list" id="task-list">
                <option value=""></option>
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Save</button>
    </form>
</section>
<section>
    <h2>All lists</h2>
    <h3>Add a list</h3>
    <form action="app/lists/store.php" method="post">
        <div class="mb-3">
            <label for="list-title">Add a title</label>
            <input class="form-control" type="list-title" name="list-title" id="list-title" placeholder="Title" required>
        </div>
        <button type="submit" class="btn btn-primary">Save</button>
    </form>
</section>

<?php require __DIR__ . '/views/footer.php'; ?>
