<?php
// including the database connection file
include_once("config.php");
 
if(isset($_POST['update']))
{    
    $id = $_POST['id'];
    $title=$_POST['title'];
    $body=$_POST['body'];
    $author=$_POST['author'];    
    
    // checking empty fields
    if(empty($title) || empty($body)||empty($author)) {    
            
        // if(empty($id)) {
        //     echo "<font color='red'>id field is empty.</font><br/>";
        // }
        
        if(empty($title)) {
            echo "<font color='red'>title field is empty.</font><br/>";
        }
        
        if(empty($body)) {
            echo "<font color='red'>body field is empty.</font><br/>";
        }       
        if(empty($author)) {
            echo "<font color='red'>author field is empty.</font><br/>";
        }         
    } else {    
//PDO UPDATE方式
        // $sql = "UPDATE posts SET id=:id, title=:title, body=:body, author=:author WHERE id=:id";
        // $query = $conn->prepare($sql);
                
        // $query->bindparam(':id', $id);
        // $query->bindparam(':title', $title);
        // $query->bindparam(':body', $body);
        // $query->bindparam(':author', $author);
        // $query->execute();
        
                
        // //redirectig to the display page. In our case, it is index.php
        // header("Location: index.php");

//CURL API UPDATE方式
$data_array=[
    "id"=>    $_POST['id'],
    "title"=> $_POST['title'],
    "body"=>  $_POST['body'],
    "author"=>$_POST['author']
    ];
$data_json_en=json_encode($data_array,JSON_UNESCAPED_UNICODE);
$ch = curl_init('http://118.232.56.156/php_stuff/php_api/update.php');
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "PUT");
curl_setopt($ch, CURLOPT_POSTFIELDS,$data_json_en);
curl_setopt($ch, CURLOPT_RETURNTRANSFER,true);
curl_setopt($ch, CURLOPT_HTTPHEADER, array(
        'Content-Type: application/json',
        'Content-Length: ' . strlen($data_json_en))
);

$result = curl_exec($ch);

echo "<script>alert('更新成功!');location.href='index.php';</script>";

    }
}
?>
<?php
//getting id from url
$id = $_GET['id'];
 
//selecting data associated with this particular id
$sql = "SELECT * FROM posts WHERE id=:id";
$query = $conn->prepare($sql);
$query->execute(array(':id' => $id));
 
while($row = $query->fetch(PDO::FETCH_ASSOC))
{
    $title = $row['title'];
    $body = $row['body'];
    $author = $row['author'];
}
?>
<html>
<head>    
    <title>API_EDIT</title>
</head>
 
<body>
    <a href="index.php">Home</a>
    <br/><br/>
    
    <form name="form1" method="post" action="api_edit.php">
        <table border="0">
            <tr> 
                <td>title</td>
                <td><input type="text" name="title" value="<?php echo $title;?>"></td>
            </tr>
            <tr> 
                <td>body</td>
                <td><input type="text" name="body" value="<?php echo $body;?>"></td>
            </tr>
            <tr> 
                <td>author</td>
                <td><input type="text" name="author" value="<?php echo $author;?>"></td>
            </tr>
            <tr>
                <td><input type="hidden" name="id" value=<?php echo $_GET['id'];?>></td>
                <td><input type="submit" name="update" value="Update"></td>
            </tr>
        </table>
    </form>
</body>
</html>