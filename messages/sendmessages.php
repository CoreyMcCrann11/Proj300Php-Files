<?php
require "Database.php";
$db = new Database();
if (isset($_POST['Sendernumber']) && isset($_POST['message']) && isset($_POST['receivernumber'])) {
    if($db->dbConnect()){
        if($db->sendMessage("messages", $_POST['Sendernumber'], $_POST['message'], $_POST['receivernumber'])){
            echo "Message Sent succesfully";
        }else echo "Message not sent";
    }else echo "Connection failed";
}else echo "All fields must be filled";
?>