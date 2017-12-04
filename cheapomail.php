<?php
function cleanData ($info) {
    $info = trim($info);
    $info = stripslashes($info);
    $info = htmlspecialchars($info);
    return $info;
}
    
session_start();
$host = getenv('IP');
$username = getenv('C9_USER');
$password = '';
$dbname = 'cheapomail';
$uname = cleanData($_POST["username"]);
$pword = password_hash(cleanData($_POST["password"]), PASSWORD_DEFAULT);
$secret = cleanData($_POST["password"]);
$sesuname = $_SESSION['uname'] = cleanData($_POST["username"]);
$adminpword =  password_hash('password123', PASSWORD_DEFAULT);

try 
{
 $conn = new PDO('mysql:host=' . $host . ';dbname=' . $dbname, $username, $password);
 $conn->exec("set names utf8");
 $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


 $set = "UPDATE users SET password = '$adminpword' WHERE id = 1";
 $conn->exec($set);
 $vpass = '/^(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}$/';
 $vname = '/^(?=.*[A-Za-z])([^\\s\\-])[A-Za-z]+$/';

 if (preg_match_all($vname,$uname) && preg_match_all($vpass,$secret)) {

 $stmt = $conn->query("SELECT username, password FROM users WHERE username = '$uname'");
 $f = $stmt->fetch();
 $result1 = $f['username'];
 $result2 = $f['password'];
 if ( $result1 === $uname && password_verify($secret, $pword)) {
     header("refresh:0; url= https://info2180-project-3-aquaricky3.c9users.io/homescreen.php");
 }
     
 }
  if (preg_match_all($vname,$uname) && !preg_match_all($vpass,$secret) && $uname === 'admin' && $secret === 'password123') {
      header("refresh:0; url= https://info2180-project-3-aquaricky3.c9users.io/useradd.html");
    }
}
 catch(PDOException $e)
    {
    echo $sql . "<br>" . $e->getMessage();
    }
$conn = null;
?>