<?php
// Include config file
require_once 'config.php';

// Define variables and initialize with empty values
$name = $email = $phone = $address = $message = "";
$name_err = $email_err = $phone_err = $address_err = $message_err = "";

// Processing form data when form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate name
    if (empty(trim($_POST["name"]))) {
        $name_err = "Please enter your name.";
    } else {
        $name = trim($_POST["name"]);
    }

    // Validate email
    if (empty(trim($_POST["email"]))) {
        $email_err = "Please enter your email.";
    } else {
        $email = trim($_POST["email"]);
    }

    // Validate phone
    if (empty(trim($_POST["phone"]))) {
        $phone_err = "Please enter your phone number.";
    } else {
        $phone = trim($_POST["phone"]);
    }

    // Validate address
    if (empty(trim($_POST["address"]))) {
        $address_err = "Please enter your address.";
    } else {
        $address = trim($_POST["address"]);
    }

    // Validate message
    if (empty(trim($_POST["message"]))) {
        $message_err = "Please enter your message.";
    } else {
        $message = trim($_POST["message"]);
    }

    // Check input errors before inserting into database
    if (empty($name_err) && empty($email_err) && empty($phone_err) && empty($address_err) && empty($message_err)) {
        // Prepare an insert statement
        $sql = "INSERT INTO contact (name, email, phone, address, message) VALUES (?, ?, ?, ?, ?)";

        if ($stmt = $mysqli->prepare($sql)) {
            // Bind variables to the prepared statement as parameters
            $stmt->bind_param("sssss", $param_name, $param_email, $param_phone, $param_address, $param_message);

            // Set parameters
            $param_name = $name;
            $param_email = $email;
            $param_phone = $phone;
            $param_address = $address;
            $param_message = $message;

            // Attempt to execute the prepared statement
            if ($stmt->execute()) {
                // Redirect to success page
                header("location: contact.html");
                exit();
            } else {
                echo "Something went wrong. Please try again later.";
            }

            // Close statement
            $stmt->close();
        }
    }

    // Close connection
    $mysqli->close();
}
?>
