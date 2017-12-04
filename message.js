function sendMessage(){
	var validate = /^(?=.*[A-Za-z])([^\\;])[A-Za-z\\s\\;]+$/;
	var valid = true;
	var recipient = document.getElementById('recipients');
	var recipients = recipient.value.split(',');

	var subject = document.getElementById('subject').value;

	var message = document.getElementById('body').value;
// 	var msgBody = message.value;

    if(recipients.length === 1 && recipients[0] === '' || !validate.test(recipient.value)){
		valid = false;
		recipient.setAttribute('class','error');
		if(!validate.test(recipient.value)){
			alert("Only alpha characters and character ',' are alowed (No space)");
		}
	}
	else{
		recipient.setAttribute('class','valid');
	}
	
	if(subject === ''){
		subject = 'Untitled';
	}
	
	
	
	if(msgBody === ''){
		message.setAttribute('class','error');
		valid = false;
	}
	else{
		message.setAttribute('class','valid');
	}
	
	if(valid){
		var httpRequest = new XMLHttpRequest();
		var data = 'recipient=' + recipients +'&subject=' + subject + '&message='+msgBody +'&submit=submit';
		//console.log( data );
		httpRequest.onreadystatechange = function(){
			if (httpRequest.readyState === XMLHttpRequest.DONE){
				if (httpRequest.status === 200) {
					var response = httpRequest.responseText;
					if(response === 'true'){
						$('.alert-success').show();
						$('.alert-warning').hide();
						$('.alert-danger').hide();
						recipient.value = '';
						document.getElementById('subject').value = '';
						message.value = '';
					}
					else{
						$('.alert-warning').show();
						$('.alert-success').hide();
						$('.alert-danger').hide();
					}
				}
			}
		};
		httpRequest.open('POST', 'send.php', true);
		httpRequest.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
		httpRequest.send(data);
		
	}
	else{
		$('.alert-success').hide();
		$('.alert-warning').hide();
		$('.alert-danger').show();
	}
	
	
	return false;
}


