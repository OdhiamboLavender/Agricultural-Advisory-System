<?php
// Include the database connection file
include 'conn.php';

// Process form data
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $firstName = $_POST['firstname'];
    $lastName = $_POST['lastname'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Check if the email address already exists in the database
    $check_email = "SELECT * FROM users WHERE email='$email'";
    $result = $conn->query($check_email);

    if ($result->num_rows > 0) {
        // Display an error message if the email address already exists
        echo "<p class='error-message'>Email address already exists. Please use a different email address.</p>";
    } else {
        // Add your SQL query to insert data into the database
        $sql = "INSERT INTO users (firstname, lastname, email, password) VALUES ('$firstName', '$lastName', '$email', '$password')";

        // Check if the query was successful
        if ($conn->query($sql) === TRUE) {
            // Redirect to a different page after successful signup
            header("Location: index.html");
            exit(); // Stop further execution
        } else {
            // Display an error message if the query fails
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }
}

// Close the database connection
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Sign Up</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      margin: 0;
      padding: 0;
      background-color: #f4f4f4;
    }

    .container {
      max-width: 400px;
      margin: 20px auto;
      padding: 20px;
      background-color: #fff;
      border-radius: 8px;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }

    h2 {
      text-align: center;
      margin-bottom: 20px;
    }

    label {
      display: block;
      margin-bottom: 5px;
      font-weight: bold;
    }

    input[type="text"],
    input[type="email"],
    input[type="password"] {
      width: 100%;
      padding: 8px;
      margin-bottom: 15px;
      border: 1px solid #ccc;
      border-radius: 4px;
      box-sizing: border-box;
    }

    input[type="submit"] {
      width: 100%;
      padding: 10px;
      border: none;
      border-radius: 4px;
      background-color: #4caf50;
      color: #fff;
      cursor: pointer;
      transition: background-color 0.3s;
    }

    input[type="submit"]:hover {
      background-color: #45a049;
    }

    .error-message {
      color: red;
      margin-top: 10px;
    }
  </style>
</head>
<body>
<div class="container">
    <h2>Sign Up</h2>
    <form id="signup-form" method="post" action="signup.php">
      <label for="firstname">First Name:</label>
      <input type="text" id="firstname" name="firstname" required>
      <label for="lastname">Last Name:</label>
      <input type="text" id="lastname" name="lastname" required>
      <label for="email">Email:</label>
      <input type="email" id="email" name="email" required>
      <label for="password">Password:</label>
      <input type="password" id="password" name="password" required>
      <input type="submit" value="Sign Up">
    </form>
    <p class="error-message" id="error-message"></p>
  </div>
</body>
</html>
