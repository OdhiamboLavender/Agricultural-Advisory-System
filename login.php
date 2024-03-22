<?php
// Start session
session_start();

// Include the database connection file
include 'conn.php';

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Sanitize input to prevent SQL injection
    $email = mysqli_real_escape_string($conn, $email);
    $password = mysqli_real_escape_string($conn, $password);

    // Query to check if user exists
    $sql = "SELECT * FROM users WHERE email = '$email' AND password = '$password'";
    $result = $conn->query($sql);

    // Check if query returns a row (i.e., user exists)
    if ($result->num_rows > 0) {
        // Redirect to index.html after successful login
        header("Location: index.html");
        exit();
    } else {
        // Store error message in session
        $_SESSION['error'] = "Invalid email or password. Please try again.";
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
  <title>Login</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      margin: 0;
      padding: 0;
      background-color: #f4f4f4;
    }

    .container {
      max-width: 400px;
      margin: 100px auto; /* Center the form vertically */
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
      text-align: center;
    }

    .signup-link {
      text-align: center;
      margin-top: 10px;
    }
  </style>
</head>
<body>
  <div class="container">
    <h2>Login</h2>
    <form id="login-form" method="post" action="login.php">
      <label for="email">Email:</label>
      <input type="email" id="email" name="email" required>
      <label for="password">Password:</label>
      <input type="password" id="password" name="password" required>
      <input type="submit" value="Login">
    </form>
    <?php
      // Display error message if set
      if(isset($_SESSION['error'])) {
        echo '<p class="error-message">' . $_SESSION['error'] . '</p>';
        unset($_SESSION['error']); // Clear the error message
        echo '<script>alert("Invalid email or password. Please try again.");</script>';
      }
    ?>
    <p class="signup-link">Don't have an account? <a href="signup.php">Sign Up</a></p>
  </div>
</body>
</html>
