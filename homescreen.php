<?php
function cleanData ($info) {
    $info = trim($info);
    $info = stripslashes($info);
    $info = htmlspecialchars($info);
    return $info;
}

$view = $_POST['view'];
if (isset($view)){
echo "<table id='table' style='border: solid 4px black;
    width: 800px;
    text-align: left;
    position: absolute;
    left: 300px;
    top: 100px;
    background-image: url(https://belsebuub.com/wp-content/uploads/2011/04/sun-over-mountains-good-1080533_40231058_cropsquare.jpg);
    background-repeat: no-repeat;
    background-size: cover;
    background-position: center;
'>";
 echo "<tr><th>Subject</th><th>Message</th><th>Firstname</th><th>Lastname</th><th>Date Sent</th></tr>";
}
 else{
 echo "<table id='table' style='border: solid 4px black;
    width: 800px;
    text-align: left;
    position: absolute;
    left: 300px;
    top: 100px;
    background-image: url(https://belsebuub.com/wp-content/uploads/2011/04/sun-over-mountains-good-1080533_40231058_cropsquare.jpg);
    background-repeat: no-repeat;
    background-size: cover;
    background-position: center;
'>";
 echo "<tr><th>Subject</th><th>Message</th></tr>";
}

class TableRows extends RecursiveIteratorIterator { 
    function __construct($it) { 
        parent::__construct($it, self::LEAVES_ONLY); 
    }

    function current() {
        return "<td style='width: 150px; border: 1px solid black;'><strong id='unread'>" . parent::current(). "</strong></td>";
    }

    function beginChildren() { 
        echo "<tr>"; 
    } 

    function endChildren() { 
        echo "</tr>" . "\n";
    } 
} 
session_start();
echo $sesuname;
$logout = $_POST['logout'];
if (isset($logout)){
    header("refresh:0; url= https://info2180-project-3-aquaricky3.c9users.io/cheapomail.html");
    session_destroy();
}
$host = getenv('IP');
$username = getenv('C9_USER');
$password = '';
$dbname = 'cheapomail';
$receipient = cleanData($_POST['receipient']);
$subject = cleanData($_POST["subject"]);
$body = cleanData($_POST["body"]);
$sender = cleanData($_SESSION['uname']);

try 
{
 $conn = new PDO('mysql:host=' . $host . ';dbname=' . $dbname, $username, $password);
 $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
 $vempty = '/^[A-za-z0-9]+/';
 
 
 $stmt = $conn->query("SELECT id FROM users WHERE username = '$sender'");
 $f = $stmt->fetch();
 $result5 = $f['id'];
      
 if (isset($view)){
 $stmt = $conn->prepare("SELECT subject, body, firstname, lastname, date_sent FROM Messages JOIN users ON users.id = Messages.sender_id WHERE receipient_ids = '$result5'");
 $stmt->execute();
$result = $stmt->setFetchMode(PDO::FETCH_ASSOC); 
    foreach(new TableRows(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) { 
        echo $v;
    }
}
else{
$stmt = $conn->prepare("SELECT subject, body FROM Messages JOIN users ON users.id = Messages.sender_id WHERE receipient_ids = '$result5'");
 $stmt->execute();
$result = $stmt->setFetchMode(PDO::FETCH_ASSOC); 
    foreach(new TableRows(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) { 
        echo $v;
    }
}
 
 if (preg_match_all($vempty,$receipient) && preg_match_all($vempty,$subject) && preg_match_all($vempty,$body)) {
      $stmt = $conn->query("SELECT id FROM users WHERE username = '$receipient'");
      $f = $stmt->fetch();
      $result1 = $f['id'];
      
    $sql = "INSERT INTO Messages (receipient_ids, sender_id, subject, body) VALUES ('$result1', '$result5', '$subject', '$body')";
    $conn->exec($sql);
    echo "Message sent successfully";
 }
 
 
 
}
 catch(PDOException $e)
    {
    echo $sql . "<br>" . $e->getMessage();
    }
$conn = null;
?>
<html>
    <head>
        <link rel="stylesheet" type="text/css" href="homescreen.css">
        <script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>
		<script src="homescreen.js" type="text/javascript"></script>
    </head>
<body>
		<h1>CHEAPOMAIL</h1>
         <br/>
         <br/>
        
		<div id="controls">
			<form action="homescreen.php" method="post">
 			<button id="compose" name = "compose" >Compose</button>
			<br/><br/>
			<button id="logout" name = "logout">Logout</button>
			<br/><br/>
			<button id="view" name = "view">View Messages</button>
			</form>
			<br/><br/><br/><br/>
        </div>
        <div id = letter>
            <h3>Compose your message here.</h3>
            <br/><br/>
            <form action="homescreen.php" method="post">
        	<label for="receipient">Receipient:</label>
			<input id="receipient" type="text" name="receipient" />
			<br/><br/><br/><br/>
			<p id = 'rreq'></p>

			<label for="subject">Subject:</label>
			<input id="subject" type="text" name="subject" />
			<br/><br/><br/><br/>
			<p id = 'sreq'></p>

			<label for="body">Body:</label>
			<input id="body" type="text" name="body" />
			<br/><br/><br/><br/>
			<p id = 'breq'></p>
			
			<button id="send" name = "send" >Send</button>
			<br/><br/>
            </form>
		</div>

	</body>
</html>