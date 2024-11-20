<?php
// Include the database connection file
include_once("database/db.php");

// Fetch existing genres, authors, and publishers from the database
$queryGenres = "SELECT * FROM genres ORDER BY GenreName ASC";
$queryAuthors = "SELECT * FROM authors ORDER BY FirstName, LastName ASC";
$queryPublishers = "SELECT * FROM publishers ORDER BY PublisherName ASC";

$resultGenres = mysqli_query($conn, $queryGenres);
$resultAuthors = mysqli_query($conn, $queryAuthors);
$resultPublishers = mysqli_query($conn, $queryPublishers);

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $Title = trim($_POST['Title']);
    $AuthorID = $_POST['AuthorID'];
    $GenreID = $_POST['GenreID'];
    $PublisherID = $_POST['PublisherID'];
    $PublishedYear = date("Y");  // Default current year
    $CopiesAvailable = trim($_POST['CopiesAvailable']);
    $Description = trim($_POST['Description']);
    $Image = $_FILES['Image'];

    // Validate fields
    if (empty($Title) || empty($AuthorID) || empty($GenreID) || empty($PublisherID)) {
        echo "<script>alert('Title, Author, Genre, and Publisher are required');</script>";
    } else {
        // Handle image upload
        $uploadDir = 'db_image/';
        $allowedExtensions = ['jpg', 'jpeg', 'png'];
        $fileExtension = pathinfo($Image['name'], PATHINFO_EXTENSION);
        $imagePath = $uploadDir . uniqid() . '.' . $fileExtension;

        if (!in_array(strtolower($fileExtension), $allowedExtensions)) {
            echo "<script>alert('Invalid image format. Only JPG, JPEG, PNG are allowed.');</script>";
        } elseif (move_uploaded_file($Image['tmp_name'], $imagePath)) {
            // Insert book data into the database
            $stmt = $conn->prepare("INSERT INTO books (Title, AuthorID, PublisherID, PublishedYear, GenreID, Quantity, Image, Description) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
            $stmt->bind_param("siisisss", $Title, $AuthorID, $PublisherID, $PublishedYear, $GenreID, $CopiesAvailable, $imagePath, $Description);

            if ($stmt->execute()) {
                echo "<script>alert('Book added successfully');</script>";
            } else {
                echo "<script>alert('Error: Could not add book.');</script>";
            }

            $stmt->close();
        } else {
            echo "<script>alert('Error uploading the image');</script>";
        }
    }
}
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Book</title>
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Roboto:400,100,300,500">
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="assets/css/form-elements.css">
    <link rel="stylesheet" href="assets/css/style.css">

    <link rel="shortcut icon" href="assets/ico/favicon.png">

<script>
    // Toggle visibility of new and existing fields for Author or Genre
    function toggleField(optionName, newFieldId, dropdownFieldId) {
        const option = document.querySelector(`input[name="${optionName}"]:checked`).value;
        const newField = document.getElementById(newFieldId); // New input field (div for multiple inputs)
        const dropdownField = document.getElementById(dropdownFieldId); // Dropdown field

        if (option === 'new') {
            newField.style.display = 'block';
            dropdownField.style.display = 'none';
        } else {
            newField.style.display = 'none';
            dropdownField.style.display = 'block';
        }
    }

    // Add specific handling for hiding 'Select Genre' dropdown when 'Enter new genre' is selected
    document.addEventListener('DOMContentLoaded', function() {
        const genreOption = document.querySelector('input[name="GenreOption"]');
        genreOption.addEventListener('change', function() {
            toggleField('GenreOption', 'newGenreField', 'GenreDropdown');
        });
    });

    document.addEventListener('DOMContentLoaded', function () {
            // Automatically set the current year for PublishedYear
            const publishedYearField = document.getElementById('PublishedYear');
            const currentYear = new Date().getFullYear();
            publishedYearField.value = currentYear;
        });
</script>

        <style>
            label {
                color: white; /* Set label text color to white */
            }
        </style>

</head>
<body>

<div class="top-content">
    <div class="inner-bg">
        <div class="container">
            <div class="row">
                <div class="col-sm-8 col-sm-offset-2 text">
                    <h2 class="mt-4" style="color: white;">Add a New Book</h2>
                </div>
            </div>

            <div class="row">
                <div class="col-sm-6 col-sm-offset-3">
                    <div class="form-box">
                        <div class="form-bottom">
                            <form method="POST" action="add_books.php" enctype="multipart/form-data">
                                <div class="form-group">
                                    <label for="Title">Book Title:</label>
                                    <input type="text" class="form-control" name="Title" id="Title" required>
                                </div>

                                <div class="form-group">
                                    <label for="Image">Upload Book Image:</label>
                                    <input type="file" class="form-control" name="Image" id="Image" accept=".jpg, .jpeg, .png" required>
                                </div>

                                <div class="form-group">
                                    <label for="Description">Description</label>
                                    <textarea name="Description" placeholder="Description" class="form-description form-control" id="Description"></textarea>
                                </div>

                                <div class="form-group">
                                    <label for="AuthorID">Author:</label>
                                    <select class="form-control" name="AuthorID" id="AuthorID" required>
                                        <option value="" disabled selected>Select an Author</option>
                                        <?php while ($author = mysqli_fetch_assoc($resultAuthors)) { ?>
                                            <option value="<?php echo $author['AuthorID']; ?>"><?php echo $author['FirstName'] . " " . $author['LastName']; ?></option>
                                        <?php } ?>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="Genre">Genre:</label>
                                    <select class="form-control" name="Genre" id="Genre" required>
                                        <option value="" disabled selected>Select a Genre</option>
                                        <?php while ($genre = mysqli_fetch_assoc($resultGenres)) { ?>
                                            <option value="<?php echo $genre['GenreID']; ?>"><?php echo $genre['GenreName']; ?></option>
                                        <?php } ?>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="PublisherID">Publisher:</label>
                                    <select class="form-control" name="PublisherID" id="PublisherID" required>
                                        <option value="" disabled selected>Select a Publisher</option>
                                        <?php while ($publisher = mysqli_fetch_assoc($resultPublishers)) { ?>
                                            <option value="<?php echo $publisher['PublisherID']; ?>"><?php echo $publisher['PublisherName']; ?></option>
                                        <?php } ?>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="CopiesAvailable">Copies Available:</label>
                                    <input type="number" class="form-control" name="CopiesAvailable" id="CopiesAvailable" value="1" required>
                                </div>

                                <div class="form-group">
                                        <div class="row">
                                            <div class="col-xs-6">
                                                <button type="submit" class="btn btn-primary btn-block">Add</button>
                                            </div>
                                            <div class="col-xs-6">
                                                <button type="button" class="btn btn-secondary btn-block" onclick="window.location.href='index.php'">Go Back</button>
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
