<?php
    session_start();
    $host = getenv('IP');
    $username = getenv('C9_USER');
    $password = '';
    $dbname = 'cheapomail';
    $sender = $_SESSION['id'];
	$recipients = $_POST['recipient'];
    
    
    if(isset($_POST['send']) && $_SERVER['REQUEST_METHOD'] == 'POST'){
        try{
            $connection = new PDO("mysql:host=$host;dbname=$dbname",$username,$password);
            $connection->exec("set names utf8");
            $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
            $subject = filter_input(INPUT_POST, 'subject', FILTER_SANITIZE_SPECIAL_CHARS);
    	    $message = filter_input(INPUT_POST, 'message', FILTER_SANITIZE_SPECIAL_CHARS);
            $recipients = explode(',',$recipients);
    		foreach ($recipients as $recipient) {
    		    $qry="SELECT id FROM users WHERE username=:recipient";
    			$stmt = $connection -> prepare($qry);
    			$stmt->bindParam("recipient", $recipient,PDO::PARAM_STR);
    			$stmt->execute();
    			$recipient_id = $stmt->fetch(PDO::FETCH_OBJ) -> id;
    		
    			$insert_qry = "INSERT INTO Messages (recipient_ids, sender_id, subject, body) VALUES('$recipient_id','$sender','$subject','$message')";
    			$insert_qry = $connection -> prepare($insert_qry);
    			$insert_qry->execute();
		}
		echo 'true';
	}
	catch (PDOException $e) {
		echo 'Connection failed: ' . $e->getMessage();
	}
	
}
else{
    header("Location: homescreen.php");
}

    // function sanitize($data){
    //     $data = trim(htmlspecialchars(strip_tags($data));
    //     return $data;
    // }

?>