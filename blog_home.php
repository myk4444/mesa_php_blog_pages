<?php

$dsn = "mysql:host=localhost:8889;dbname=myblog";  //data source host and db name
$username = "root";
$password = "root";



// Check connection using try/catch statement

try  {
     $conn = new PDO($dsn, $username, $password);
    
     // set the PDO error mode to exception
     $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);  
    
     echo "Connection is successful<br><br>\n\r";
}

catch (PDOException $e) {
       $error_message = $e->getMessage();
    echo "An error occurred: $error_message" ;
} // end try catch


// create SQL query
$sql = "SELECT Title, Entry, data_entered FROM my_table ORDER BY data_entered DESC";

// execute the query
$result = $conn->query($sql);


// return result set using fetchAll method and foreach loop
// foreach ($array as $item)

$rows = $result->fetchAll();

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Display Blog on Page</title>
    <style>
        body {
            font-family: arial, sans-serif;
            font-size: 100%;
         }
        article {
            margin-bottom: 20px;
            width: 600px;
            padding: 10px;
        }
        
        article:nth-of-type(odd){
            background-color: aliceblue;
        }
        
        article:nth-of-type(even){
            background-color:floralwhite;  
        }        
    </style>
</head>

<body>
   <header> 
     <h1>Blog Post Archive</h1>
       <h2><a href="form.html">Enter a Post</a></h2>
   </header>
 
 <?php
   foreach($rows as $row){
    echo "<article>\n\r";
    echo "<p><b>Title:</b> " . $row['Title']        . "</p>\n\r";
    echo "<p><b>Post:</b> "  . $row['Entry']        .  "</p>\n\r";
    echo "<p><b>Date:</b> "  . $row['data_entered'] . "</p>\n\r";
    echo "</article>\n\r";
    }  
    
    $conn = null;
  ?>    

</body>
</html>
