
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<link rel="stylesheet" type="text/css" href="message.css"/>
		<script type="text/javascript" src = "message.js"></script>
	</head>



        <form action="" method="POST" onsubmit="return sendMessage()" >
        	<fieldset>
        		<div class="send">
        			<label class="control" for="recipients">Recipient(s):</label>
        			<input type="text" name="recipients" id="recipients" class="form-control" placeholder="Enter each receipient seperated by a colon" autocomplete="false" />
        			<br/></br>
        		</div>
        		<div class="send">
        			<label class="control" for="subject">Subject:</label>
        			<input type="text" name="subject" id="subject" class="form-control" placeholder="Subject" autocomplete="false" />
        			<br/><br/>
        		</div>
        		<div class="send">
        			<label class="control" for="body">Message:</label>
        			<textarea class="textarea control" id="body" name="msgBody" wrap="on" cols="40" rows="5" placeholder="Enter message here" autocomplete="false"></textarea><br />
        		</div>
        		<button type="submit" class="btn" id="click">Send</button><br/>
        		
        	</fieldset>
        </form>
  
