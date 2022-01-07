// Checkboxes //

let checkbox = document.querySelectorAll('.checkbox');

checkbox.forEach((box) => {
  if (box.getAttribute('data-set')) {
    box.setAttribute('checked', true);
  }
});

checkbox.forEach((box) => {
  box.addEventListener('input', (event) => {
    if (event.target.checked) {
      event.preventDefault();

      const body = new FormData();

      body.append('completed', event.target.getAttribute('data-id'));

      fetch('/app/tasks/completed.php', {
        method: 'POST',
        body: body,
      });
    } else {
      event.preventDefault();

      const body = new FormData();

      body.append('completed', event.target.getAttribute('data-id'));

      fetch('/app/tasks/uncompleted.php', {
        method: 'POST',
        body: body,
      });
    }
  });
});
