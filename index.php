<?php
//including the database connection file
include_once("config.php");
 
//fetching data in descending order (lastest entry first)
$result = $conn->query("SELECT * FROM posts ORDER BY id ASC");
?>
 
<html>
<head>    
    <title>PDO CRUD基礎</title>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</head>
 
<body>
 <a class="btn btn-primary" data-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample" onclick="location.href='add.html'">
新增文章
  </a><br><br>


    <table width='80%' border=0>
 
    <tr bgcolor='#CCCCCC'>
        <td>編號</td>
        <td>標題</td>
        <td>內容</td>
        <td>作者</td>
    </tr>
    <?php     
    // while($row = $result->fetch(PDO::FETCH_ASSOC)) {         
    //     echo "<tr>";
    //     echo "<td>".$row['id']."</td>";
    //     echo "<td>".$row['title']."</td>";
    //     echo "<td>".$row['body']."</td>";  
    //     echo "<td>".$row['author']."</td>";  
    //     echo "<td><a href=\"api_edit.php?id=$row[id]\">Edit</a> | <a href=\"api_delete.php?id=$row[id]\" onClick=\"return confirm('確定要刪除檔案嗎?')\">Delete</a></td>";        
    // }
//CURL API QUERRY方式
$data_array=[
    "id"=>    $_POST['id'],
    "title"=> $_POST['title'],
    "body"=>  $_POST['body'],
    "author"=>$_POST['author']
    ];

$url='http://118.232.56.156/php_stuff/php_api/read.php';
//  Initiate curl
$ch = curl_init();
// Will return the response, if false it print the response
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
// Set the url
curl_setopt($ch, CURLOPT_URL,$url);
// Execute
$result=curl_exec($ch);
// Closing
curl_close($ch);
// Will dump a beauty json :3
$row=json_decode($result, true);
// $result = curl_exec($ch);

foreach ($row as $value) {         
        echo "<tr>";
        echo "<td>".$value['id']."</td>";
        echo "<td>".$value['title']."</td>";
        echo "<td>".$value['body']."</td>";  
        echo "<td>".$value['author']."</td>";  
        echo "<td><a href=\"api_edit.php?id=$value[id]\">Edit</a> | <a href=\"api_delete.php?id=$value[id]\" onClick=\"return confirm('確定要刪除檔案嗎?')\">Delete</a></td>";        
    }    
    ?>
    </table>


</body>
</html>