<?php
include_once('database/db.php');
if (isset($_GET['transactionID'])) {
    $transactionID = $_GET['transactionID'];
    $status = $_GET['status'];

    if($status == "RETURNED"){
        $ReturnDate = "ReturnDate = '" . date('Y-m-d') . "'";
    }else{
        $ReturnDate = "ReturnDate = NULL";
    }

    $updateQuery = "UPDATE transactions SET Status = '$status',  $ReturnDate  WHERE TransactionID = '$transactionID'";

    $updateResult = mysqli_query($conn, $updateQuery);

    if ($updateResult) {
        $fetchQuery = "SELECT * FROM transactions WHERE TransactionID = '$transactionID'";
        $fetchResult = mysqli_query($conn, $fetchQuery);

        while($fetchArray =mysqli_fetch_array($fetchResult)) {
            // Return the updated status as a response
            echo "
            <td>{$fetchArray['TransactionID']}</td>
            <td>{$fetchArray['BookID']}</td>
            <td>{$fetchArray['UserID']}</td>
            <td>{$fetchArray['BorrowDate']}</td>
            <td>{$fetchArray['ReturnDate']}</td>
            <td>{$fetchArray['DueDate']}</td>
            <td>{$fetchArray['Status']}</td>
            <td>";

            if($fetchArray['Status']=="PENDING"){
                echo"<div class='row'>";
                echo"<div class='col'>";
                echo "<button class='form-control btn btn-success' onclick='updateStatus(\"{$fetchArray['TransactionID']}\", \"APPROVE\", this)'>approve</button>";
                echo"</div>";
                echo"<div class='col'>";
                echo "<button class='form-control btn btn-danger' onclick='updateStatus(\"{$fetchArray['TransactionID']}\", \"DENIED\", this)'>denied</button>";
                echo"</div>";
            }else{
                echo"<div class='row'>";
                
                if($fetchArray['Status']=="APPROVE"){
                    echo"<div class='col'>";
                    echo "<button class='form-control btn btn-primary' onclick='updateStatus(\"{$fetchArray['TransactionID']}\", \"RETURNED\", this)'>return</button>";
                    echo"</div>";
                }
                echo"<div class='col'>";
                echo "<button class='form-control btn btn-primary' onclick='updateStatus(\"{$fetchArray['TransactionID']}\", \"PENDING\", this)'>Undo</button>";
                echo"</div>";
            }
            "<td>";

        } 
    }
}
?>