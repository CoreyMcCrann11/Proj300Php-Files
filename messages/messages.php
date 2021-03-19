<?php
    $servername = "localhost";
    $username = "root";
    $password = "";
    $database = "logininformation";

    $conn = new mysqli($servername, $username, $password, $database);

    if($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $messages = array();

    $sql = "SELECT Sendernumber, message, receivernumber FROM messages;";

    $stmt = $conn->prepare($sql);

    $stmt->execute();

    $stmt->bind_result($Sendernumber, $message, $receivernumber);

    while($stmt->fetch()){
        $temp = [
            'Sendernumber' => $Sendernumber,
            'message' => $message,
            'receivernumber' => $receivernumber
        ];

        array_push($messages, $temp);
    }

    echo json_encode($messages);
?>
