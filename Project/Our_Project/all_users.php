<?php
// Include the database connection file
include_once("database/db.php");

// Fetch users from the database
$queryUsers = "SELECT BorrowerID, CONCAT(FirstName, ' ', LastName) AS FullName, Email, Phone, MembershipDate 
               FROM borrowers 
               ORDER BY FullName ASC";
$resultUsers = mysqli_query($conn, $queryUsers);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>All Users</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="style.css">
</head>

<body>
    <?php include 'header.php'; ?> <!-- Include the header -->

    <div class="container mt-5">
        <h2 class="section-title">All Users</h2>
        <div class="row">
            <?php while ($user = mysqli_fetch_assoc($resultUsers)): ?>
                <div class="col-md-4">
                    <div class="card mb-3">
                        <div class="card-body">
                            <h5 class="card-title"><?php echo htmlspecialchars($user['FullName']); ?></h5>
                            <p class="card-text">Email: <?php echo htmlspecialchars($user['Email']); ?></p>
                            <p class="card-text">Phone: <?php echo htmlspecialchars($user['Phone']); ?></p>
                            <p class="card-text">Joined on: <?php echo htmlspecialchars($user['MembershipDate']); ?></p>
                        </div>
                    </div>
                </div>
            <?php endwhile; ?>
        </div>
    </div>

    <?php include 'footer.php'; ?> <!-- Include the footer -->
</body>
</html>
