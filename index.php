<?php

// Start session (optional, can be handled differently)
session_start();

// Check if user is logged in
if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true) {
  // User is logged in, display full website content
  include('website_content.php'); // Replace with your content file
} else {
  // User is not logged in, check if requested page is allowed without login
  $allowed_pages = array('home.php'); // List of allowed pages without login
  $requested_page = basename($_SERVER['SCRIPT_NAME']); // Get current page filename

  if (in_array($requested_page, $allowed_pages)) {
    // Allowed page, display it
    include($requested_page); // Replace with your content file
  } else {
    // Restricted page, redirect to login page
    header('Location: login.php');
    exit;
  }
}

?>
