<html>
<head>
    <title>Add Data</title>
    <meta http-equiv='Content-Type' content='text/html; charset=utf-8' /> 
</head>
 
<body>
<?php
//including the database connection file
include_once("config.php");
 header("Content-Type:text/html; charset=utf-8");
if(isset($_POST['Submit'])) {    

$title=$_POST['title'];
$body=$_POST['body'];
$author=$_POST['author'];



    // checking empty fields
    if( empty($title) || empty($body) || empty($author)) {
                
        if(empty($title)) {
            echo "<font color='red'>title field is empty.</font><br/>";
        }
        
        if(empty($body)) {
            echo "<font color='red'>body field is empty.</font><br/>";
        }
        if(empty($author)) {
            echo "<font color='red'>author field is empty.</font><br/>";
        }
        //link to the previous page
        echo "<br/><a href='javascript:self.history.back();'>Go Back</a>";
    } else { 

//透過CURL Post json to database
$data_array=[
    "title"=> $_POST['title'],
    "body"=>  $_POST['body'],
    "author"=>$_POST['author']
    ];
$data_json_en=json_encode($data_array,JSON_UNESCAPED_UNICODE);
$ch = curl_init('http://118.232.56.156/php_stuff/php_api/insert.php');
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
curl_setopt($ch, CURLOPT_POSTFIELDS,$data_json_en);
curl_setopt($ch, CURLOPT_RETURNTRANSFER,true);
curl_setopt($ch, CURLOPT_HTTPHEADER, array(
        'Content-Type: application/json',
        'Content-Length: ' . strlen($data_json_en))
);

$result = curl_exec($ch);

echo "<script>alert('上傳成功!');location.href='index.php';</script>";



       //  // if all the fields are filled (not empty) 
            
       //  //insert data to database        
  
       //  $sql = "INSERT INTO user( name, sex, address) VALUES( :name , :sex , :address)";
       //  $query = $conn->prepare($sql);
                
  
       //  $query->bindparam(':name', $name);
       //  $query->bindparam(':sex', $sex);
       //  $query->bindparam(':address', $address);
       //  $query->execute();
        
       //  // Alternative to above bindparam and execute
       //  // $query->execute(array(':name' => $name, ':email' => $email, ':age' => $age));
        
       //  // //display success message
       // echo "<script>alert('上傳成功!');location.href='index.php';</script>"; 
    }
}
?>
</body>
</html>