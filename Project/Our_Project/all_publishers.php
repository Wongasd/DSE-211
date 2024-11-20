<?php
// Include the database connection file
include_once("database/db.php");

// Fetch publishers from the database (including image)
$queryPublishers = "SELECT PublisherID, PublisherName, Address, Phone, Image 
                    FROM publishers 
                    ORDER BY PublisherName ASC";
$resultPublishers = mysqli_query($conn, $queryPublishers);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>All Publishers</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="format-detection" content="telephone=no">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="author" content="">
    <meta name="keywords" content="">
    <meta name="description" content="">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="style.css">
    <link rel="stylesheet" type="text/css" href="css/normalize.css">
    <link rel="stylesheet" type="text/css" href="icomoon/icomoon.css">
    <link rel="stylesheet" type="text/css" href="css/vendor.css">
    <link rel="stylesheet" type="text/css" href="style.css">
</head>

<body>
    <?php include 'header.php'; ?> <!-- Include the header -->

    <div class="container mt-5">
        <h2 class="section-title">All Publishers</h2>
        <div class="row">
            <?php while ($publisher = mysqli_fetch_assoc($resultPublishers)): ?>
                <div class="col-md-4">
                    <div class="card mb-3">
                        <div class="card-body">
                            <!-- Check if the publisher has an image -->
                            <img src="<?php echo !empty($publisher['Image']) ? '' . htmlspecialchars($publisher['Image']) : 'db_image/default.jpg'; ?>" 
                                 alt="<?php echo htmlspecialchars($publisher['PublisherName']); ?>" 
                                 class="card-img-top" style="max-height: 200px; object-fit: cover;">

                            <h5 class="card-title"><?php echo htmlspecialchars($publisher['PublisherName']); ?></h5>
                            <p class="card-text">Address: <?php echo htmlspecialchars($publisher['Address']); ?></p>
                            <p class="card-text">Phone: <?php echo htmlspecialchars($publisher['Phone']); ?></p>
                        </div>
                    </div>
                </div>
            <?php endwhile; ?>
        </div>
    </div>

    <?php include 'footer.php'; ?> <!-- Include the footer -->
    
</body>
</html>
<?php
// Include the database connection file
include_once("database/db.php");

// Fetch publishers from the database (including image)
$queryPublishers = "SELECT PublisherID, PublisherName, Address, Phone, Image 
                    FROM publishers 
                    ORDER BY PublisherName ASC";
$resultPublishers = mysqli_query($conn, $queryPublishers);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>All Publishers</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="format-detection" content="telephone=no">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="author" content="">
    <meta name="keywords" content="">
    <meta name="description" content="">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="style.css">
    <link rel="stylesheet" type="text/css" href="css/normalize.css">
    <link rel="stylesheet" type="text/css" href="icomoon/icomoon.css">
    <link rel="stylesheet" type="text/css" href="css/vendor.css">
    <link rel="stylesheet" type="text/css" href="style.css">
</head>

<body>
    <?php include 'header.php'; ?> <!-- Include the header -->

    <div class="container mt-5">
        <h2 class="section-title">All Publishers</h2>
        <div class="row">
            <?php while ($publisher = mysqli_fetch_assoc($resultPublishers)): ?>
                <div class="col-md-4">
                    <div class="card mb-3">
                        <div class="card-body">
                            <!-- Check if the publisher has an image -->
                            <img src="<?php echo !empty($publisher['Image']) ? '' . htmlspecialchars($publisher['Image']) : 'db_image/default.jpg'; ?>" 
                                 alt="<?php echo htmlspecialchars($publisher['PublisherName']); ?>" 
                                 class="card-img-top" style="max-height: 200px; object-fit: cover;">

                            <h5 class="card-title"><?php echo htmlspecialchars($publisher['PublisherName']); ?></h5>
                            <p class="card-text">Address: <?php echo htmlspecialchars($publisher['Address']); ?></p>
                            <p class="card-text">Phone: <?php echo htmlspecialchars($publisher['Phone']); ?></p>
                        </div>
                    </div>
                </div>
            <?php endwhile; ?>
        </div>
    </div>

    <?php include 'footer.php'; ?> <!-- Include the footer -->
    
</body>
</html>
