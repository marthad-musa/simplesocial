// alert('Successful');
// console.log('Navbar works');

/* --------------- Modal --------------- */
const myModal = document.getElementById('myModal');
const myInput = document.getElementById('myInput');

myModal.addEventListener('shown.bs.modal', () => {
  myInput.focus()
})
/* -------------- ./Modal -------------- */


/* --------------- Logout Code --------------- */
// $logout = document.getElementById('navLogout');
// $logout.addEventListener('shown.bs.modal', () => {
//   alert('Logged out Successfully !');
// })
/* -------------- ./Logout Code -------------- */