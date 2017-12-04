window.onload = function () {
    var b = document.getElementById("add");
    b.addEventListener("click",add);
};
function add (e) {
    var firstname = document.getElementById('firstname').value;
    var lastname = document.getElementById('lastname').value;
    var username = document.getElementById("username").value;
    var password = document.getElementById("password").value;
    var vpass = /^(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}$/;
    var vname = /^(?=.*[A-Za-z])([^\\s\\-])[A-Za-z]+$/;
     
    if (vname.test(firstname) === false) {
        e.preventDefault();
        document.getElementById('freq').innerHTML = '<strong>Firstname cannot be empty and must start with a capital letter.<strong>';
    }
    if (vname.test(lastname) === false) {
        e.preventDefault();
        document.getElementById('lreq').innerHTML = '<strong>Lastname cannot be empty and must start with a capital letter.<strong>';
    }
    if (vname.test(username) === false) {
        e.preventDefault();
        document.getElementById('ureq').innerHTML = '<strong>Username cannot be empty.<strong>';
    }
    if (vpass.test(password) === false && password.length < 8) {
        e.preventDefault();
        document.getElementById('preq').innerHTML = '<strong>Password must be at least 8 characters long.<strong>';
    }
    if (vpass.test(password) === false && password.length >= 8) {
        e.preventDefault();
        document.getElementById('preq').innerHTML = '<strong>Password must contain at least one capital letter and digit.<strong>';
    }
    var httpRequest = new XMLHttpRequest();
	
	httpRequest.onreadystatechange = function(){
		if (httpRequest.readyState === XMLHttpRequest.DONE){
			if (httpRequest.status === 200) {
				var responseText = httpRequest.responseText;
				if(responseText == 'true'){
					window.location = 'https://info2180-project-3-aquaricky3.c9users.io/useradd.php';
				}
				else {
					if(responseText === 'false'){
						$('.alert-danger').show(1000);
						var timer = setInterval(function(){
							$('.alert-danger').hide(1000);
						},5000);
					}
				}
			}
		}
	};
	httpRequest.open(type, url, true);
	httpRequest.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	httpRequest.send(data);
}