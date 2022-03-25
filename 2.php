<head>
  <meta charset="UTF-8">
</head>

<?php
$servername = "localhost";
$username = "plannera";
$password = "I@09154946326@h";
try {
    $connection = mysqli_connect($servername, $username, $password, "plannera_cc") or die("Error " . mysqli_error($connection));
    $connection->set_charset("utf8");
    $sql = "SELECT * FROM cc WHERE sent=0";
    $result = mysqli_query($connection, $sql) or die("Error in Selecting " . mysqli_error($connection));
    // echo "salam";
   
    $emparray = array();
    while($row =mysqli_fetch_assoc($result))
    {
        $emparray[] = $row;
    }
    // echo json_encode($emparray);
    $json = json_encode($emparray[0]);
    // echo $json;
    $id = $emparray[0]['id'];
    $type = $emparray[0]['type'];
    $address = $emparray[0]['address'];
    // echo $address;
    $caption = $emparray[0]['caption'];

    $sql1 = "UPDATE cc SET sent=1 WHERE id=$id";
    mysqli_query($connection, $sql1) or die("Error in updating " . mysqli_error($connection));

    // echo $caption;
} catch(PDOException $e) {
    echo "Error: " . $e->getMessage();
}
$conn = null;
$token = '5263621778:AAEMxIktCgfExbYGmmltFHgZ-FjspX5PBcY';
if ($type == 0) {
    file_get_contents("https://api.telegram.org/bot$token/sendVideo?chat_id=@Cancer_Content&video=$address&caption=$caption%0A@Cancer_Content");
    // echo "salamaa";
} else {
    file_get_contents("https://api.telegram.org/bot$token/sendPhoto?chat_id=@Cancer_Content&photo=$address&caption=$caption%0A@Cancer_Content");
}
// file_get_contents("https://api.telegram.org/bot$token/sendMessage?chat_id=@sabzseo&text=$result");
?>