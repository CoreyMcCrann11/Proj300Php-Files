<?php
require "Database.php";
$db = new Database();
if (isset($_POST['UserName']) && isset($_POST['EmailAdd']) && isset($_POST['Password']) && isset($_POST['PreferedMartialArt'])
&& isset($_POST['FirstName']) && isset($_POST['LastName']) && isset($_POST['AddressOne']) && isset($_POST['AddressTwo'])
&& isset($_POST['AddressThree']) && isset($_POST['PhoneNumber'])) {
    if($db->dbConnect()){
        if($db->signUp("userdetails", $_POST['UserName'], $_POST['EmailAdd'], $_POST['Password'], $_POST['PreferedMartialArt'],
        $_POST['FirstName'], $_POST['LastName'], $_POST['AddressOne'], $_POST['AddressTwo'], $_POST['AddressThree'],
        $_POST['PhoneNumber'])) {
            echo "Sign up was successful";
        }else echo "Sign up was unsuccesful";
    }else echo "Connection Failed";
}else echo "All fields must be filled";
?>