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

/* Navigation */

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
