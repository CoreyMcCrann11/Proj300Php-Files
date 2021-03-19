<?php
require "Database.php";
$db = new Database();
if (isset($_POST['UserName']) && isset($_POST['Password'])) {
    if ($db->dbConnect()){
        if ($db->logIn("userdetails", $_POST['UserName'], $_POST['Password'])) {
            echo "Sign up Success";
        }else echo "Login Successful";
    }else echo "Database connection failed";
}else echo "All fields are required";
?>