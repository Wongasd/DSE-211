<?php
include_once("database/db.php");



if(isset($_POST['submit'])){

   $_POST['s'];
    // Check if the author already exists
    $qry = "SELECT * FROM authors WHERE FirstName = '$FirstName' AND LastName = '$LastName'";
    $result = mysqli_query($conn, $qry);
    $rows = mysqli_num_rows($result);

    if ($rows == 1) {
        echo "<script>alert('That person is already in the database');</script>";
    } else {
        // Validate and upload image
        if (move_uploaded_file($ImageTemp, $ImagePath)) {
            $query = "INSERT INTO authors (FirstName, LastName, Image, Description) 
                      VALUES ('$FirstName', '$LastName', '$ImagePath', '$Description')";
            if ($sql = mysqli_query($conn, $query)) {
                echo "<script>window.location.href='index.php';alert('Author created successfully');</script>";
            } else {
                echo "<script>alert('Error, Please Try Again');</script>";
            }
        } else {
            echo "<script>alert('Image upload failed. Please try again.');</script>";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Add Author</title>

    <link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Roboto:400,100,300,500">
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="assets/css/form-elements.css">
    <link rel="stylesheet" href="assets/css/style.css">

    <link rel="shortcut icon" href="assets/ico/favicon.png">

    <style>
        label {
            color: white;
        }
    </style>
</head>

<body>

    <div class="top-content">
        <div class="inner-bg">
            <div class="container">
                <div class="row">
                    <div class="col-sm-8 col-sm-offset-2 text">
                        <h1>Borrow</h1>
                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-6 col-sm-offset-3">
                        <div class="form-box">
                            <div class="form-bottom">
                                <form role="form" action="borrow.php" method="POST" enctype="multipart/form-data" class="registration-form">

                                    <div class="form-group">
                                        <label for="fromDate">from date:</label>
                                        <input type="datetime-local" id="fromDate" name="birthdaytime" class="form-control">
                                    </div>
                                    
                                    <div class="form-group">
                                        <label for="dueDate">due date</label>
                                        <input type="datetime-local" id="toDate" name="toDate" class="form-control">
                                    </div>

                                    <div class="form-group">
                                        <label for="Description">Description:</label>
                                        <textarea name="Description" placeholder="Short description about the author..." class="form-control" id="Description" rows="4" required></textarea>
                                    </div>

                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-xs-6">
                                                <button type="submit" name= "submit"class="btn btn-primary btn-block">Create</button>
                                            </div>
                                            <div class="col-xs-6">
                                                <button type="button" class="btn btn-secondary btn-block" onclick="window.location.href='borrow_list.php'">Go Back</button>
                                            </div>
                                        </div>
                                    </div>

                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="assets/js/jquery-1.11.1.min.js"></script>
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
    <script src="assets/js/jquery.backstretch.min.js"></script>
    <script src="assets/js/scripts.js"></script>

</body>

</html>

