<?php
$servername = "localhost";
$username = "root"; // default XAMPP username is 'root'
$password = "Durga@38742"; // default XAMPP password is empty
$dbname = "formdata"; // your database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Collect and sanitize form data
    $name = htmlspecialchars($_POST['name']);
    $id = htmlspecialchars($_POST['id']);
    $year = htmlspecialchars($_POST['year']);
    $branch = htmlspecialchars($_POST['branch']);
    $email = htmlspecialchars($_POST['email']);
    $phoneNo = htmlspecialchars($_POST['PhoneNo']);
    $message = htmlspecialchars($_POST['message']);

    // Prepare and bind the SQL query to insert data
    $stmt = $conn->prepare("INSERT INTO submissions (name, id, year, branch, email, phone, message) VALUES (?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("sssssss", $name, $id, $year, $branch, $email, $phoneNo, $message);

    // Execute the query
    if ($stmt->execute()) {
        echo "Form Submitted Successfully!<br>";
        echo "Name: $name<br>";
        echo "ID: $id<br>";
        echo "Year: $year<br>";
        echo "Branch: $branch<br>";
        echo "Email: $email<br>";
        echo "Phone No: $phoneNo<br>";
        echo "Feedback: $message<br>";
    } else {
        echo "Error: " . $stmt->error;
    }

    // Close the statement and connection
    $stmt->close();
    $conn->close();
    //restart button
    echo '<br><br>';
    echo '<button onclick="window.location.href=\'RegistrationForm.html\'">Submit Another Form</button>';
} else {
    echo "<p>No form data submitted.</p>";
}
?>
