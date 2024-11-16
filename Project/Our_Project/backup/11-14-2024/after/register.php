<?php
// Include the database connection file
include_once("database/db.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
   
    $FirstName = trim($_POST['FirstName']);
    $LastName = trim($_POST['LastName']);
    $Email = trim($_POST['Email']);
    $Phone = trim($_POST['Phone']);
    $CountryCode = trim($_POST['CountryCode']); // Get the country code
    $Address = trim($_POST['Address']);
    $MembershipDate = date('Y-m-d');  // Automatically sets the current date as membership date
    $Permission = "borrower";  // Automatically set permission as "borrower"

    // Check if the required fields are empty
    if (empty($FirstName) || empty($LastName) || empty($Email)) {
        echo "<script>alert('First Name, Last Name and Email are required')</script>";
    } else {
        
        // Check if the email is already registered
        $stmt = $conn->prepare("SELECT * FROM users WHERE Email = ?");
        $stmt->bind_param("s", $Email); // Bind the email parameter
        $stmt->execute();
        $result = $stmt->get_result();

        // If email is found, show an error message
        if ($result->num_rows > 0) {
            echo "<script>alert('Email already exists')</script>";
        } else {
        
            // Concatenate the country code with the phone number
            $Phone = $CountryCode . $Phone;

            // If email is not found, proceed with the insertion
            $stmt = $conn->prepare("INSERT INTO users (FirstName, LastName, Email, Phone, Address, MembershipDate, Permission) VALUES (?, ?, ?, ?, ?, ?, ?)");
            $stmt->bind_param("sssssss", $FirstName, $LastName, $Email, $Phone, $Address, $MembershipDate, $Permission);

            // Execute the statement and check for success
            if ($stmt->execute()) {
                // On success, show success message and redirect to index.php
                echo "<h1 style='color: green;'>Registration successful! Redirecting to homepage...</h1>";
                echo "<script>
                        setTimeout(function() {
                            window.location.href = 'index.php';
                        }, 3000); // Redirect after 3 seconds
                      </script>";
                exit();  // Stop further execution of code
            } else {
                echo "<script>alert('Error!, Please Try Again')</script>";
            }
        }

        // Close statement
        $stmt->close();
    }
}

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Sign Up Your Account Here!</title>

    <link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Roboto:400,100,300,500">
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="assets/css/form-elements.css">
    <link rel="stylesheet" href="assets/css/style.css">

    <link rel="shortcut icon" href="assets/ico/favicon.png">
</head>

<body>

    <div class="top-content">
        <div class="inner-bg">
            <div class="container">
                <div class="row">
                    <div class="col-sm-8 col-sm-offset-2 text">
                        <h1>Sign Up Now!</h1>
                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-6 col-sm-offset-3">
                        <div class="form-box">
                            <div class="form-bottom">
                                <form role="form" action="" method="post" class="registration-form">
                                    <div class="form-group">
                                        <label class="sr-only" for="FirstName">First name</label>
                                        <input type="text" name="FirstName" placeholder="First name..." class="form-first-name form-control" id="FirstName" required>
                                    </div>
                                    <div class="form-group">
                                        <label class="sr-only" for="LastName">Last name</label>
                                        <input type="text" name="LastName" placeholder="Last name..." class="form-last-name form-control" id="LastName" required>
                                    </div>
                                    <div class="form-group">
                                        <label class="sr-only" for="Email">Email</label>
                                        <input type="email" name="Email" placeholder="Email..." class="form-email form-control" id="Email" required>
                                    </div>
                                    <div class="form-group">
                                        <label class="sr-only" for="Address">Address</label>
                                        <textarea name="Address" placeholder="Your Address" class="form-about-yourself form-control" id="Address"></textarea>
                                    </div>

                                    <div class="form-group">
                                        <label for="CountryCode">Country Code</label>
                                        <select name="CountryCode" id="CountryCode" class="form-control" onchange="updatePhoneLength()">
                                            <option value="+60">Malaysia (+60)</option>
                                            <option value="+65">Singapore (+65)</option>
                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <label class="sr-only" for="Phone">Phone</label>
                                        <input type="tel" name="Phone" placeholder="Phone number..." class="form-phone form-control" id="Phone" required maxlength="10">
                                    </div>

                                    <button type="submit" class="btn">Sign me up!</button>
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

    <script>
        // Function to update the phone number length based on the selected country code
        function updatePhoneLength() {
            var countryCode = document.getElementById('CountryCode').value;
            var phoneField = document.getElementById('Phone');

            // Set maxlength based on selected country code
            if (countryCode === "+60") { // Malaysia
                phoneField.setAttribute('maxlength', '10');
            } else if (countryCode === "+65") { // Singapore
                phoneField.setAttribute('maxlength', '8');
            }
        }

        // Call the function initially to set the correct length
        updatePhoneLength();
    </script>

</body>

</html>