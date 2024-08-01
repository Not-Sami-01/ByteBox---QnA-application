
let LoginPassword = $('#loginPassword');
// console.log(LoginPassword);
$('#showLoginPassword').on('change', (event) => {
    if (event.target.checked) {
        LoginPassword.type = 'text'
    } else {
        LoginPassword.type = 'password'
    }
})

let SignupPassword = $('#signupPassword');
let SignupPassword2 = $('#signupConfirmPassword');
$('#showSignupPassword').on('change', (event) => {
    console.log('Event called')
    if (event.target.checked) {
        SignupPassword.type = 'text'
        SignupPassword2.type = 'text'
    } else {
        SignupPassword.type = 'password'
        SignupPassword2.type = 'password'
    }
})


// new Show password
$('.showPassword').on('change',(event)=>{
    if (event.target.checked) {
        $('.password').type = 'text';
    } else {
        $('.password').type = 'password';
    }
})