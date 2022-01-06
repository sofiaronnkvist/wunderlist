// Checkboxes //

let checkbox = document.querySelectorAll('.checkbox');

// const checkedBox = () => {
//   checkbox.checked = true;
// };

checkbox.forEach((box) => {
  box.addEventListener('input', (event) => {
    if (event.target.checked) {
      event.preventDefault();

      console.log('Hello', event.target.getAttribute('data-id'));

      const body = new FormData();

      body.append('completed', event.target.getAttribute('data-id'));

      fetch('/app/tasks/completed.php', {
        method: 'POST',
        body: body,
      }).then((response) => console.log(response));
      // .then((response) => response.json())
      // .then((data) => {
      //   if (data.error) {
      //     console.error(data.error);
      //   } else {
      //     checkedBox();
      //   }
      // });
    }
    // else {
    //   event.preventDefault();

    //   console.log('Bye');

    //   const uncompleted = new FormData(box);

    //   fetch('/app/tasks/uncompleted.php', {
    //     method: 'POST',
    //     body: uncompleted,
    //   })
    //   .then((response) => response.json())
    //   .then((data) => {
    //     if (data.error) {
    //       console.error(data.error);
    //     } else {
    //       console.log('Placeholder');
    //     }
    //   });
    // }
  });
});
