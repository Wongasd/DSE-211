<?php 
include_once('database/db.php');
$sql= "select * from transactions";
$qry = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html lang="en">

<head>
	<title>BookSaw - Free Book Store HTML CSS Template</title>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">

	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet"
		integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">

</head>

<body>
    <div class="container mt-5">
        <button class="btn btn-danger" onclick="window.location.href='index.php'">back</button>
        <button class="btn btn-primary" onclick="window.location.href='borrow.php'">add new borrower</button>
        <div class=" mt-2">
            <table class="table table-striped table-bordered table-hover ">
                <thead class="table-dark">
                    <th>transaction id</th>
                    <th>book id</th>
                    <th>user id</th>
                    <th>borrow date</th>
                    <th>return date</th>
                    <th>due date</th>
                    <th>action</th>
                </thead>
                <tbody>
                <?php while($fetch= mysqli_fetch_array($qry)){?>
                    <td><?=$fetch['TransactionID']?></td>
                    <td><?=$fetch['BookId']?></td>
                    <td><?=$fetch['UserId']?></td>
                    <td><?=$fetch['BorrowDate']?></td>
                    <td><?=$fetch['ReturnDate']?></td>
                    <td><?=$fetch['DueDate']?></td>
                    <td><button class="form-control btn"></button></td>
                    <?php }?>
                </tbody>
            </table>
        </div>
    </div>
    
    <script src="assets/js/jquery-1.11.1.min.js"></script>
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
    <script src="assets/js/jquery.backstretch.min.js"></script>
    <script src="assets/js/scripts.js"></script>

</body>

</html>

