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

// Navigation //

const hamburger = document.querySelector('.hamburger');
const navMenu = document.querySelector('.nav-menu');

hamburger.addEventListener('click', mobileMenu);

function mobileMenu() {
  hamburger.classList.toggle('active');
  navMenu.classList.toggle('active');
}

const navLink = document.querySelectorAll('.nav-link');

navLink.forEach((n) => n.addEventListener('click', closeMenu));

function closeMenu() {
  hamburger.classList.remove('active');
  navMenu.classList.remove('active');
}

// Unfold tasks //

const unfoldButton = document.querySelectorAll('.task-button');
const taskUnfold = document.querySelectorAll('.task-unfold');

unfoldButton.forEach((button) => {
  button.addEventListener('click', () => {
    taskUnfold.forEach((task) => {
      if (button.getAttribute('data-id') === task.getAttribute('data-id')) {
        task.classList.toggle('closed');
      }
    });
  });
});

// Unfold today's tasks //

const unfoldTodayButton = document.querySelectorAll('.task-button-today');
const taskTodayUnfold = document.querySelectorAll('.task-unfold-today');

unfoldTodayButton.forEach((button) => {
  button.addEventListener('click', () => {
    taskTodayUnfold.forEach((task) => {
      if (button.getAttribute('data-id') === task.getAttribute('data-id')) {
        task.classList.toggle('closed');
      }
    });
  });
});

// Unfold tasks in lists //

const unfoldTaskInListButton = document.querySelectorAll('.task-button-list');
const taskInListUnfold = document.querySelectorAll('.task-list-unfold');

unfoldTaskInListButton.forEach((button) => {
  button.addEventListener('click', () => {
    taskInListUnfold.forEach((task) => {
      if (button.getAttribute('data-id') === task.getAttribute('data-id')) {
        task.classList.toggle('closed');
      }
    });
  });
});

// Unfold lists //

const listButton = document.querySelectorAll('.list-button');
const listUnfold = document.querySelectorAll('.list-unfold');

listButton.forEach((button) => {
  button.addEventListener('click', () => {
    listUnfold.forEach((list) => {
      if (button.getAttribute('data-id') === list.getAttribute('data-id')) {
        list.classList.toggle('closed');
      }
    });
  });
});

// Edit all tasks //

const editTaskButton = document.querySelectorAll('.edit-task-button');
const editTaskUnfold = document.querySelectorAll('.edit-task');

editTaskButton.forEach((button) => {
  button.addEventListener('click', () => {
    editTaskUnfold.forEach((task) => {
      if (button.getAttribute('data-id') === task.getAttribute('data-id')) {
        task.classList.toggle('closed');
      }
    });
  });
});

// Edit tasks today //

const editTaskTodayButton = document.querySelectorAll('.edit-today-button');
const editTaskTodayUnfold = document.querySelectorAll('.task-edit-today');

editTaskTodayButton.forEach((button) => {
  button.addEventListener('click', () => {
    editTaskTodayUnfold.forEach((task) => {
      if (button.getAttribute('data-id') === task.getAttribute('data-id')) {
        task.classList.toggle('closed');
      }
    });
  });
});

// Edit task in list //

const editTaskListButton = document.querySelectorAll('.edit-task-in-list');
const editTaskListUnfold = document.querySelectorAll('.task-edit-in-list');

editTaskListButton.forEach((button) => {
  button.addEventListener('click', () => {
    editTaskListUnfold.forEach((task) => {
      if (button.getAttribute('data-id') === task.getAttribute('data-id')) {
        task.classList.toggle('closed');
      }
    });
  });
});

// Edit list //

const editListButton = document.querySelectorAll('.edit-list-button');
const editListUnfold = document.querySelectorAll('.edit-list');

editListButton.forEach((button) => {
  button.addEventListener('click', () => {
    editListUnfold.forEach((list) => {
      if (button.getAttribute('data-id') === list.getAttribute('data-id')) {
        list.classList.toggle('closed');
      }
    });
  });
});
