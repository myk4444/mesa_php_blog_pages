<?php

// initialize variable
$msg = "";

// retrieve form values
if($_SERVER['REQUEST_METHOD'] == 'POST') { // make sure this file is only served from the form by using $_SERVER['REQUEST_METHOD'] to check it. 
    
    $title = htmlspecialchars(trim($_POST["blogtitle"]));
    $title = addslashes($title);

    $entry = htmlspecialchars(trim($_POST["blogentry"]));
    $entry = addslashes($entry);

}

else {
    exit("There is a problem");
}

$dsn = "mysql:host=localhost:8889;dbname=myblog"; //data source host and db name
$username = "root";
$password = "root";


// Check connection AND INSERT using try/catch atatement

try {
    $conn = new PDO($dsn, $username, $password);

    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    echo "Connection is successful<br><br>\n\r";

    // create SQL query
    $sql = "INSERT INTO my_table (Title, Entry, data_entered) VALUES ('$title', '$entry', NOW())"; // added data_entered & now()

    // execute the statement - we do not use 'query()' because no records are returned
     $conn->exec($sql);
     echo "The record was sucessfully entered";
     $msg = "Thank you for submitting a blog post! You may see your entry <a href='blog_home.php'>Here</a>.";
}

catch (PDOException $e) {
    $error_message = $e->getMessage();
    echo "An error occurred: $error_message" ; // My undertanding. Not for users. It will help you to find your errors.
} // end try catch

$conn = null;

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blog Post Results</title>
</head>
<body>

    <header>
        <h1> Blog Post Results</h1>
    </header>
    <p><?php echo $msg ?></p>
    
</body>
</html>