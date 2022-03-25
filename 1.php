<?php

use function PHPSTORM_META\type;

$input = file_get_contents('php://input');

// $token = '5263621778:AAEMxIktCgfExbYGmmltFHgZ-FjspX5PBcY';
// file_get_contents("https://api.telegram.org/bot$token/sendMessage?chat_id=@sabzseo&text=$input");
$token = '5263621778:AAEMxIktCgfExbYGmmltFHgZ-FjspX5PBcY';
$update = json_decode($input);
$message = $update->message;
$chat_id = $message->chat->id;
$type = ($message->video->file_id) ? 0 : (($message->photo) ? 1 : 2);
// file_get_contents("https://api.telegram.org/bot$token/sendMessage?chat_id=$chat_id&text=$type");
// echo($type);
$address = '';
if ($type == 0) {
    $address = $message->video->file_id;
}else if ($type == 1){
    $temp = $message->photo;
    $address = end($temp)->file_id;
} else {
    $connection = new mysqli($servername, $username, $password, "plannera_cc");
    $connection->set_charset("utf8");
    $sqla = "SELECT * FROM sta WHERE id=1";
    file_get_contents("https://api.telegram.org/bot$token/sendMessage?chat_id=$chat_id&text=salllam");
    $result = mysqli_query($connection, $sqla);
    file_get_contents("https://api.telegram.org/bot$token/sendMessage?chat_id=$chat_id&text=salllam");
    $emparray = array();
    while($row =mysqli_fetch_assoc($result))
    {
        $emparray[] = $row;
    }
    $status = intval($emparray[0]['status']);
    file_get_contents("https://api.telegram.org/bot$token/sendMessage?chat_id=$chat_id&text=$status");
    if ($status == 0) {
        $idme = intval($message->text);
    }

}

$caption = '';
$servername = "localhost";
$username = "plannera";
$password = "I@09154946326@h";
if ($type != 2) {
    try {
        $connection = new mysqli($servername, $username, $password, "plannera_cc");
        $connection->set_charset("utf8");
        echo "Connected successfully";
        $sql = "INSERT INTO cc (type, address, caption, sent) VALUES ($type, '$address', '$caption', '0')";
        mysqli_query($connection, $sql);
        echo "successfull.";
        $sql1 = "SELECT * FROM cc";
        $result = mysqli_query($connection, $sql1) or die("Error in Selecting " . mysqli_error($connection));
        $emparray = array();
        while($row =mysqli_fetch_assoc($result))
        {
            $emparray[] = $row;
        }
        $end = end($emparray);
        $id = json_encode($end['id']);
        file_get_contents("https://api.telegram.org/bot$token/sendMessage?chat_id=$chat_id&text=$id");
    } catch(PDOException $e) {
        echo "Connection failed: " . $e->getMessage();
    }
    // $conn = null;
} else {
    if ($status == 0) {
        file_get_contents("https://api.telegram.org/bot$token/sendMessage?chat_id=$chat_id&text=salaam");
        $connection = new mysqli($servername, $username, $password, "plannera_cc");
        $connection->set_charset("utf8");
        $sql2 = "SELECT * FROM cc WHERE id=$idme";
        $result = mysqli_query($connection, $sql2) or die("Error in Selecting " . mysqli_error($connection));
        $emparray = array();
        while($row =mysqli_fetch_assoc($result))
        {
            $emparray[] = $row;
        }
        $caption = $emparray[0]['caption'];
        // file_get_contents("https://api.telegram.org/bot$token/sendMessage?chat_id=$chat_id&text=salam");
        file_get_contents("https://api.telegram.org/bot$token/sendMessage?chat_id=$chat_id&text=$caption");

        $sql5 = "UPDATE sta SET status=1 WHERE id=1";
        mysqli_query($connection, $sql5) or die("Error in updating " . mysqli_error($connection));
    } else {
        $cap = $message->text;
        $sql3 = "UPDATE cc SET caption=$cap WHERE id=$idme";
        mysqli_query($connection, $sql3) or die("Error in updating " . mysqli_error($connection));
        file_get_contents("https://api.telegram.org/bot$token/sendMessage?chat_id=$chat_id&text=$cap");
        $sql6 = "UPDATE sta SET status=0 WHERE id=1";
        mysqli_query($connection, $sql6) or die("Error in updating " . mysqli_error($connection));
    }
}
  
?>