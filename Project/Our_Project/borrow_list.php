<?php 
include_once('database/db.php');

if ($_SESSION['Permission'] == 'user') {
    $where = " where t.UserID = '$_SESSION[UserID]'";
}else{
    $where ="";
}

$sql= "select t.*,concat(FirstName, LastName) as FullName, b.Title from transactions as t left join users as u on t.UserID = u.UserID left join books as b on b.BookID = t.BookID".$where;
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
        
        <div class=" mt-2">
            <table class="table table-striped table-bordered table-hover ">
                <thead class="table-dark">
                    <th>transaction id</th>
                    <th>book title</th>
                    <th>borrower name</th>
                    <th>borrow date</th>
                    <th>return date</th>
                    <th>due date</th>
                    <th>status</th>
                    <th>borrow quantity</th>
                    <?php if ($_SESSION['Permission'] !== 'user') { ?>
                    <th>action</th>
                    <?php } ?>
                </thead>
                <tbody>
                <?php while($fetch= mysqli_fetch_array($qry)){?>
                    <tr id="row-<?=$fetch['TransactionID']?>">
                        <td><?=$fetch['TransactionID']?></td>
                        <td><?=$fetch['Title']?></td>
                        <td><?=$fetch['FullName']?></td>
                        <td><?=$fetch['BorrowDate']?></td>
                        <td><?=$fetch['ReturnDate']?></td>
                        <td><?=$fetch['DueDate']?></td>
                        <td><?=$fetch['Status']?></td>
                        <td><?=$fetch['Quantity']?></td>
                        <?php if ($_SESSION['Permission'] !== 'user') { ?>
                            <td>
                                <?php if($fetch['Status'] == 'PENDING'){ ?>
                                    <div class='row'>
                                        <div class='col'>
                                            <button class="form-control btn btn-success" onclick="updateStatus(<?=$fetch['TransactionID']?>, 'APPROVE',this)">Approve</button>
                                        </div> 
                                        <div class='col'>
                                            <button class="form-control btn btn-danger" onclick="updateStatus(<?=$fetch['TransactionID']?>, 'DENIED',this)">Denied</button>
                                        </div>
                                    </div>
                                <?php }else{ ?>
                                    <div class='row'>
                                    <?php if($fetch['Status'] == 'APPROVE'){ ?>
                                        <div class='col'>
                                            <button class="form-control btn btn-primary" onclick="updateStatus(<?=$fetch['TransactionID']?>, 'RETURNED',this)">Return</button>
                                        </div>
                                    <?php } ?>
                                    <?php if($fetch['Status'] !== 'RETURNED'){ ?>
                                    <div class='col'>
                                        <button class="form-control btn btn-danger" onclick="updateStatus(<?=$fetch['TransactionID']?>, 'PENDING',this)">Undo</button>
                                    </div>
                                    <?php } ?>
                                    </div>
                                <?php } ?>
                            </td>
                        <?php } ?>
                    </tr>
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
<script>
    function updateStatus(transactionID, approvalStatus ,button) {

        if(approvalStatus == "RETURNED"){
            $extraMsg = " ,you can not undo the changes";
        }else{
            $extraMsg = "";
        }

        $msg = "are you sure you want to change this borrow status to "+ approvalStatus + $extraMsg;
        if (confirm($msg) == true) {
            const xhttp = new XMLHttpRequest();

            xhttp.onreadystatechange = function () {
                if (this.readyState == 4 && this.status == 200) {
                    // Update the specific row's status
                    document.getElementById("row-" + transactionID).innerHTML = this.responseText;
                }
            };

            xhttp.open("GET", `ajax.php?transactionID=${transactionID}&status=${approvalStatus}`, true);
            xhttp.send();
        }
    }
</script>
