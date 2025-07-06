// function validateForm() {
//   const email = document.getElementById('email');
//   const password = document.getElementById('password');
//   const confirm = document.getElementById('confirm');

//   const emailPattern = /^[^ ]+@[^ ]+\.[a-z]{2,3}$/;
//   if (!emailPattern.test(email.value)) {
//     alert("Please enter a valid email.");
//     // return false;
//   }

//   if (password.value.length > 6) {
//     alert("Password must be more than 6.");
//     // return false;
//   }
// }

// Logout confirmation
function confirmLogout() {
  const result = confirm("Are you sure you want to logout?");
  if (result) {
    // Redirect or handle logout (you can replace with logout.php)
    window.location.href = "login.php";
  }
}
