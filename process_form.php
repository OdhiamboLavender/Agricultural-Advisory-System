<?php

// Database connection details (replace with your actual credentials)
$servername ="localhost";
$username = "root";
$password = "";
$dbname = "crop_recommendation_db";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

// Function to store user data
function storeUserData($rainfall, $soil_type, $temperature, $soil_ph) {
  global $conn;

  $sql = "INSERT INTO user_input (rainfall, soil_type, temperature, soil_ph) VALUES (?, ?, ?, ?)";
  $stmt = $conn->prepare($sql);
  $stmt->bind_param("isdd", $rainfall, $soil_type, $temperature, $soil_ph);

  if ($stmt->execute()) {
    $user_id = $conn->insert_id;
    return $user_id;
  } else {
    echo "Error: " . $stmt->error;
    return false;
  }
}

// Function to retrieve suitable crops based on user data
function getSuitableCrops($user_id) {
  global $conn;

  $sql = "SELECT crops.name 
          FROM crops 
          WHERE crops.soil_type = (SELECT soil_type FROM user_input WHERE id = ?) 
          AND crops.soil_ph_min <= (SELECT soil_ph FROM user_input WHERE id = ?) 
          AND crops.soil_ph_max >= (SELECT soil_ph FROM user_input WHERE id = ?) 
          AND crops.temp_min <= (SELECT temperature FROM user_input WHERE id = ?) 
          AND crops.temp_max >= (SELECT temperature FROM user_input WHERE id = ?) 
          AND crops.rainfall_min <= (SELECT rainfall FROM user_input WHERE id = ?) 
          AND crops.rainfall_max >= (SELECT rainfall FROM user_input WHERE id = ?)";
  $stmt = $conn->prepare($sql);
  $stmt->bind_param("iiiiiii", $user_id, $user_id, $user_id, $user_id, $user_id, $user_id, $user_id);
  
  $stmt->execute();
  $result = $stmt->get_result();

  $crops = [];
  if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
      $crops[] = $row['name'];
    }
  }

  $stmt->close();
  return $crops;
}

// Function to determine recommended crop based on inputs
function recommendCrop($soil_type, $soilPH, $rainfall, $temperature) {
    // Add logic to determine the recommended crop based on inputs
    // For example:
    if ($soilType === 'Sandy' && $soil_ph >= 5.0 && $soil_ph <= 7.0 && $temperature >= 18 && $temperature <= 32 && $rainfall >= 300 && $rainfall <= 600) {
        return 'Maize';
    } elseif ($soilType === 'Sandy' && $soilPH >= 5.8 && $soilPH <= 6.5 && $temperature >= 15 && $temperature <= 25 && $rainfall >= 50 && $rainfall <= 100) {
        return 'Cabbage';
    } elseif ($soilType === 'Sandy' && $soilPH >= 5.5 && $soilPH <= 6.5 && $temperature >= 15 && $temperature <= 20 && $rainfall >= 25 && $rainfall <= 50) {
        return 'Potatoes';
    } elseif ($soilType === 'Sandy' && $soilPH >= 6.0 && $soilPH <= 7.5 && $temperature >= 21 && $temperature <= 29 && $rainfall >= 50 && $rainfall <= 100) {
        return 'Peppers';
    } elseif ($soilType === 'Sandy' && $soilPH >= 5.8 && $soilPH <= 6.5 && $temperature >= 21 && $temperature <= 27 && $rainfall >= 25 && $rainfall <= 50) {
        return 'Tomatoes';
    } elseif ($soilType === 'Silty' && $soilPH >= 6.0 && $soilPH <= 7.5 && $temperature >= 15 && $temperature <= 24 && $rainfall >= 50 && $rainfall <= 75) {
        return 'Wheat';
    } elseif ($soilType === 'Silty' && $soilPH >= 6.0 && $soilPH <= 7.5 && $temperature>= 15 && $temperature <= 25 && $rainfall >= 350 && $rainfall <= 450) {
        return 'Barley';
    } elseif ($soilType === 'Silty' && $soilPH >= 6.0 && $soilPH <= 7.0 && $temperature >= 15 && $temperature <= 25 && $rainfall >= 400 && $rainfall <= 600) {
        return 'Spinach';
    } elseif ($soilType === 'clay' && $soilPH >= 5.8 && $soilPH <= 6.5 && $temperature >= 15 && $temperature <= 20 && $rainfall >= 500 && $rainfall <= 750) {
        return 'Cabbage';
    } elseif ($soilType === 'clay' && $soilPH >= 6.0 && $soilPH <= 7.0 && $temperature >= 13 && $temperature <= 18 && $rainfall >= 500 && $rainfall <= 800) {
        return 'Peas';
    } elseif ($soilType === 'clay' && $soilPH >= 5.8 && $soilPH <= 6.5 && $temperature >= 15 && $temperature <= 25 && $rainfall >= 25 && $rainfall <= 50) {
        return 'Broccoli';
    } elseif ($soilType === 'clay' && $soilPH >= 5.8 && $soilPH <= 6.5 && $temperature >= 18 && $temperature<= 24 && $rainfall >= 25 && $rainfall <= 50) {
        return 'Cauliflower';
    } elseif ($soilType === 'loam' && $soilPH >= 6.0 && $soilPH <= 7.0 && $temperature >= 18 &&$temperature<= 32 && $rainfall >= 15 && $rainfall <= 24) {
        return 'Corn';
    } elseif ($soilType === 'loam' && $soilPH >= 6.0 && $soilPH <= 7.0 && $temperature >= 18 && $temperature <= 24 && $rainfall >= 300 && $rainfall <= 600) {
        return 'Beans';
    } elseif ($soilType === 'loam' && $soilPH >= 5.8 && $soilPH <= 7.0 && $temperature >= 18 && $temperature <= 32 && $rainfall >= 75 && $rainfall <= 125) {
        return 'Maize';
    } elseif ($soilType === 'loam' && $soilPH >= 5.8 && $soilPH <= 6.5 && $temperature >= 21 && $temperature <= 27 && $rainfall >= 75 && $rainfall <= 125) {
        return 'Tomatoes';
    } elseif ($soilType === 'loam' && $soilPH >= 6.0 && $soilPH <= 7.0 && $temperature >= 21 && $temperature <= 32 && $rainfall >= 50 && $rainfall <= 75) {
        return 'Squash';
    } elseif ($soilType === 'loam' && $soilPH >= 5.0 && $soilPH <= 6.5 && $temperature >= 15 && $temperature <= 25 && $rainfall >= 75 && $rainfall <= 100) {
        return 'Strawberries';
    } elseif ($soilType === 'loam' && $soilPH >= 6.0 && $soilPH <= 7.0 && $temperature >= 10 && $temperature <= 20 && $rainfall >= 50 && $rainfall <= 100) {
        return 'Beets';
    } elseif ($soilType === 'loam' && $soilPH >= 6.0 && $soilPH <= 7.0 && $temperature >= 21 && $temperature <= 32 && $rainfall >= 50 && $rainfall <= 100) {
        return 'Cucumbers';
    } elseif ($soilType === 'loam' && $soilPH >= 6.0 && $soilPH <= 7.0 && $temperature >= 15 && $temperature <= 32 && $rainfall >= 75 && $rainfall <= 125) {
        return 'Melons';
    } elseif ($soilType === 'loam' && $soilPH >= 6.0 && $soilPH <= 7.0 && $temperature >= 18 && $temperature <= 24 && $rainfall >= 75 && $rainfall <= 125) {
        return 'Pumpkin';
    } elseif ($soilType === 'alluvial' && $soilPH >= 5.0 && $soilPH <= 7.0 && $rainfall >= 20 && $temperature <= 35 && $rainfall >= 500 && $rainfall <= 1000) {
        return 'Rice';
    } elseif ($soilType === 'alluvial' && $soilPH >= 6.0 && $soilPH <= 7.5 && $temperature >= 15 && $temperature <= 24 && $rainfall >= 500 && $rainfall <= 100) {
        return 'Wheat';
    } elseif ($soilType === 'alluvial' && $soilPH >= 5.5 && $soilPH <= 7.0 && $temperature >= 20 && $temperature <= 30 && $rainfall >= 300 && $rainfall <= 600) {
        return 'Sugarcane';
    } elseif ($soilType === 'Alluvial' && $soilPH >= 5.5 && $soilPH <= 7 && $temperature >= 20 && $temperature <= 30 && $rainfall >= 200 && $rainfall <= 400) {
        return 'Cotton';
    } elseif ($soilType === 'Alluvial' && $soilPH >= 6 && $soilPH <= 7 && $temperature >= 20 && $temperature <= 30 && $rainfall >= 300 && $rainfall <= 600) {
        return 'Soybeans';
    } elseif ($soilType === 'Alluvial' && $soilPH >= 6 && $soilPH <= 7 && $temperature >= 15 && $temperature <= 25 && $rainfall >= 300 && $rainfall <= 700) {
        return 'Carrots';
    } elseif ($soilType === 'Alluvial' && $soilPH >= 6 && $soilPH <= 7 && $temperature >= 15 && $temperature <= 25 && $rainfall >= 300 && $rainfall <= 600) {
        return 'Spinach';
    } elseif ($soilType === 'Alluvial' && $soilPH >= 6 && $soilPH <= 7 && $temperature >= 15 && $temperature <= 25 && $rainfall >=450 && $rainfall <= 600) {
        return 'Radishes';
    } elseif ($soilType === 'Alluvial' && $soilPH >= 5 && $soilPH <= 7 &&$temperature >= 18 && $temperature <= 32 && $rainfall >= 300 && $rainfall <= 600) {
        return 'Maize';
    } elseif ($soilType === 'Silty' && $soilPH >= 6 && $soilPH <= 7 && $temperature >= 15 && $temperature <= 20 && $rainfall >= 300 && $rainfall <= 600) {
        return 'Oats';
    } elseif ($soilType === 'Sandy' && $soilPH >= 5.0 && $soilPH <= 7.0 && $rainfall >= 450 && $rainfall <= 700&& $temperature >= 18 && $temperature <= 32 ) {
        return 'Maize (Corn)';
    } else if ($soilType === 'Silty' && $soilPH >= 6.0 && $soilPH <= 7.0 && $rainfall >= 400 && $rainfall <= 600 && $temperature >= 15 && $temperature <= 24 ) {
        return 'Wheat';
    } else if ($soilType === 'Alluvial' && $soilPH >= 5.0 && $soilPH <= 7.0 && $rainfall >= 1000 && $rainfall <= 2500 && $temperature >= 20 && $temperature <= 35 ) {
        return 'Rice';
    } else if ($soilType === 'Alluvial' && $soilPH >= 6.0 && $soilPH <= 7.5 && $rainfall >= 500 && $rainfall <= 1000 && $temperature >= 20 && $temperature <= 30 ) {
        return 'Soybeans';
    } else if ($soilType === 'Sandy' && $soilPH >= 5.5 && $soilPH <= 6.5 && $rainfall >= 50 && $rainfall <= 100 && $temperature >= 15 && $temperature <= 20) {
        return 'Potatoes';
    } else if ($soilType === 'Silty' && $soilPH >= 6.0 && $soilPH <= 7.5 && $rainfall >= 400 && $rainfall <= 600 && $temperature >= 15 && $temperature <= 25) {
        return 'Barley';
    } else if ($soilType === 'Loam' && $soilPH >= 5.5 && $soilPH <= 7.5 && $rainfall >= 75 && $rainfall <= 125 && $temperature >= 18 && $temperature <= 32 ) {
        return 'Sorghum';
    } else if ($soilType === 'Loam' && $soilPH >= 6.0 && $soilPH <= 7.5 && $rainfall >= 100 && $rainfall <= 300 && $temperature >= 18 && $temperature <= 32 ) {
        return 'Sunflower';
    } else if ($soilType === 'Alluvial' && $soilPH >= 5.5 && $soilPH <= 7.0 && $rainfall >= 500 && $rainfall <= 1000 && $temperature >= 18 && $temperature <= 32 ) {
        return 'Cotton';
    } else if ($soilType === 'Alluvial' && $soilPH >= 5.5 && $soilPH <= 7.0 && $rainfall >= 1000 && $rainfall <= 2500 && $temperature >= 18 && $temperature <= 32 ) {
        return 'Sugarcane';
    } else if ($soilType === 'Sandy' && $soilPH >= 5.0 && $soilPH <= 7.0 && $rainfall >= 200 && $rainfall <= 400 && $temperature >= 18 && $temperature <= 32 ) {
        return 'Millet';
    } else if ($soilType === 'Silty' && $soilPH >= 6.0 && $soilPH <= 7.0 && $rainfall >= 400 && $rainfall <= 600 && $temperature >= 15 && $temperature <= 20) {
        return 'Oats';
    } else if ($soilType === 'Loam' && $soilPH >= 5.0 && $soilPH <= 7.0 && $rainfall >= 75 && $rainfall <= 150 && $temperature >= 13 && $temperature <= 20) {
        return 'Rye';
    } else if ($soilType === 'Alluvial' && $soilPH >= 5.0 && $soilPH <= 6.5 && $rainfall >= 1000 && $rainfall <= 1500 && $$temperature >= 20 && $temperature <= 32 ) {
        return 'Cassava';
    } else if ($soilType === 'Sandy' && $soilPH >= 5.5 && $soilPH <= 6.5 && $rainfall >= 300 && $rainfall <= 800 && $temperature >= 18 && $temperature <= 32 ) {
        return 'Lentils';
    } else if ($soilType === 'Sandy' && $soilPH >= 6.0 && $soil_ph  <= 7.0 && $rainfall >= 200 && $rainfall <= 600 && $temperature >= 14 && $temperature <= 25) {
        return 'Peanuts (Groundnuts)';
    } else if ($soilType === 'Silty' && $soilPH >= 6.0 && $soil_ph  <= 7.5 && $rainfall >= 200 && $rainfall <= 600 && $temperature >= 18 && $temperature <= 32 ) {
        return 'Chickpeas (Garbanzo Beans)';
    } else if($soilType === 'Alluvial' &&$soil_ph  >= 6.0 && $soil_ph  <= 7.5 && $rainfall >= 300 && $rainfall <= 600 && $temperature >= 17 && $temperature <= 29) {
        return 'Alfalfa';
    } else if ($soilType === 'Silty' &&$soil_ph  >= 5.5 && $soil_ph  <= 7.5 && $rainfall >= 300 && $rainfall <= 600 && $temperature >= 18 && $temperature <= 32) {
        return 'Canola (Rapeseed)';
    } else if ($soilType === 'Alluvial' && $soil_ph  >= 5.5 && $soil_ph  <= 6.5 && $rainfall >= 1000 && $rainfall <= 1500 && $temperature >= 20 && $temperature <= 30) {
        return 'Taro';
    } else {
        return 'No specific recommendation';
    }
}

?>