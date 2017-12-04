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
$firstname = cleanData($_POST['firstname']);
$lastname = cleanData($_POST["lastname"]);
$uname = cleanData($_POST["username"]);
$pword = password_hash(cleanData($_POST["password"]), PASSWORD_DEFAULT);

try 
{
 $conn = new PDO('mysql:host=' . $host . ';dbname=' . $dbname, $username, $password);
 $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $vpass = '/^(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}$/';
    $vname = '/^(?=.*[A-Za-z])([^\\s\\-])[A-Za-z]+$/';
    
 if (preg_match_all($vname,$firstname) && preg_match_all($vname,$lastname) && preg_match_all($vname,$uname) && preg_match_all($vpass,$pword) && (strlen($pword) >= 8)) {
    $sql = "INSERT INTO users (firstname, lastname, username, password) VALUES ('$firstname', '$lastname', '$uname', '$pword')";
    $conn->exec($sql);
    print "New record created successfully";
    header("refresh:3; url= https://info2180-project-3-aquaricky3.c9users.io/useradd.html");
 }
}
 catch(PDOException $e)
    {
    echo $sql . "<br>" . $e->getMessage();
    }
$conn = null;
?>