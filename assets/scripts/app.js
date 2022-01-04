// Checkboxes //

let checkbox = document.querySelectorAll('.checkbox');

checkbox.forEach((box) => {
  box.addEventListener('change', (event) => {
    if (event.target.checked) {
      event.preventDefault();

      const completed = new FormData(box);

      fetch('/app/tasks/completed.php', {
        method: 'POST',
        body: completed,
      });
    } else {
      event.preventDefault();

      const uncompleted = new FormData(box);

      fetch('/app/tasks/uncompleted.php', {
        method: 'POST',
        body: uncompleted,
      });
    }
  });
});
