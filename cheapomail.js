window.onload = function () {
    var b = document.getElementById("login");
    b.addEventListener("click",login);
};
function login (e) {
    var username = document.getElementById("username").value;
    var password = document.getElementById("password").value;
    var vpass = /^(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}$/;
    var vname = /^(?=.*[A-Za-z])([^\\s\\-])[A-Za-z]+$/;
    //if everything is good and its the admin 
   if(username === 'admin' && password === 'password123'){
   }
   else if ((vname.test(username) === false || vpass.test(password) === false)) {
       e.preventDefault();
        alert('Username and password do not match please try again.');
    }
}