<?php
//including the database connection file
include("config.php");
//PDO DEL方式
// //getting id of the data from url
// $id = $_GET['id'];
 
// //deleting the row from table
// $sql = "DELETE FROM posts WHERE id=:id";
// $query = $conn->prepare($sql);
// $query->execute(array(':id' => $id));
 

 //CURL API DEL方式
$data_array=[
    "id"=>    $_GET['id']
    ];
$data_json_en=json_encode($data_array,JSON_UNESCAPED_UNICODE);
$ch = curl_init('http://118.232.56.156/php_stuff/php_api/delete.php');
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "DELETE");
curl_setopt($ch, CURLOPT_POSTFIELDS,$data_json_en);
curl_setopt($ch, CURLOPT_RETURNTRANSFER,true);
curl_setopt($ch, CURLOPT_HTTPHEADER, array(
        'Content-Type: application/json',
        'Content-Length: ' . strlen($data_json_en))
);

$result = curl_exec($ch);

// echo "<script>alert('刪除成功!');location.href='index.php';</script>";
//redirecting to the display page (index.php in our case)
header("Location:index.php");
?>