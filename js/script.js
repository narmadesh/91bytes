//show hide password
const togglePassword = document.querySelector('.toggle-password');
const password = document.querySelector('input[name="password"]');

togglePassword.addEventListener('click', function (e) {
  // toggle the type attribute
  const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
  password.setAttribute('type', type);
  // toggle the eye slash icon
  this.classList.toggle('fa-eye-slash');
});

//signup form submit
const form = document.querySelector('#signup-form');
form.addEventListener('submit', function(e) {
  e.preventDefault();
  const button = document.querySelector('button[type="submit"]');
  button.innerHTML = 'Processing';
  button.setAttribute('disabled',true);
  var xhttp = new XMLHttpRequest();
  xhttp.onload = function() {
    var resp = JSON.parse(this.response);
    button.innerHTML = 'SIGN UP';
    button.setAttribute('disabled',false);
    if (resp.status == 'error') {
      var error = document.querySelector('.error-msg');
      error.style.display = 'block';
      error.innerHTML = resp.message;
      setTimeout(function(){
        error.style.display = 'none'
      },5000)
    }
    else
    {
      var success = document.querySelector('.success-msg');
      success.style.display = 'block';
      success.innerHTML = resp.message;
      setTimeout(function(){
        success.style.display = 'none'
      },5000)
    }
  };
  xhttp.open("POST", "signup.php", true);
  xhttp.send(new FormData(form));
})
