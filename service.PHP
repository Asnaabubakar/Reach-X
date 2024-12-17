<?php
// Include the database configuration file
require_once "config.php";

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if all fields are filled
    if (!empty($_POST['sname']) && !empty($_POST['semail']) && !empty($_POST['sphone']) && !empty($_POST['smessage'])) {
        // Validate email and phone number
        $email = $_POST['semail'];
        $phone = $_POST['sphone'];

        if (filter_var($email, FILTER_VALIDATE_EMAIL) && preg_match("/^[0-9]{10}$/", $phone)) {
            // Insert data into database
            $sname = $_POST['sname'];
            $semail = $_POST['semail'];
            $sphone = $_POST['sphone'];
            $smessage = $_POST['smessage'];

            $sql = "INSERT INTO service (sname, semail, sphone, smessage) VALUES ('$sname', '$semail', '$sphone', '$smessage')";

            if ($mysqli->query($sql) === TRUE) {
                echo '<div class="alert alert-success" role="alert">Request has been sent!</div>';
            } else {
                echo "Error: " . $sql . "<br>" . $mysqli->error;
            }
        } else {
            echo '<div class="alert alert-danger" role="alert">Invalid email or phone number!</div>';
        }
    } else {
        echo '<div class="alert alert-warning" role="alert">Please fill in all fields!</div>';
    }
}
?>

<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
    <h3>GET IN TOUCH</h3>
    <div class="form-group">
        <label for="sname">Name</label>
        <input type="text" class="form-control" id="sname" name="sname">
    </div>
    <div class="form-group">
        <label for="semail">Email</label>
        <input type="email" class="form-control" id="semail" name="semail">
    </div>
    <div class="form-group">
        <label for="sphone">Phone Number</label>
        <input type="tel" class="form-control" id="sphone" name="sphone">
    </div>
    <div class="form-group">
        <label for="smessage">Message</label>
        <textarea class="form-control" id="smessage" name="smessage" rows="3"></textarea>
    </div>
    <button type="submit" class="btn btn-primary">SEND INTEREST</button>
</form>
<button class="btn btn-secondary" onclick="location.href='website.html'">CLOSE</button>
