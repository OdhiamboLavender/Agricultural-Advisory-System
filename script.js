// script.js
let isAuthenticated = false;

function signIn() {
    const username = document.getElementById('username').value;
    const password = document.getElementById('password').value;

    // Fake server-side check for simplicity
    if (username === 'user' && password === 'password') {
        isAuthenticated = true;
        showContent('main-content');
    } else {
        alert('Invalid credentials. Please try again.');
    }
}

function showContent(contentId) {
    if (isAuthenticated || contentId === 'Log_in') {
        document.querySelectorAll('section').forEach(section => {
            section.style.display = 'none';
        });

        const selectedContent = document.getElementById(contentId);
        if (selectedContent) {
            selectedContent.style.display = 'block';
        }
    } else {
        alert('Please sign in to access this content.');
        document.getElementById('get-started-link').click(); // Simulate a click on the "Get Started" link to show the sign-in form
    }
}
// Get the button element
const button = document.getElementById("yourButtonId");

// Get the section element
const section = document.getElementById("log_in");

// Function to show the section
function showSection() {
  section.style.display = "block";
}

// Function to hide the section
function hideSection() {
  section.style.display = "none";
}

// Add click event listener to the button
button.addEventListener("click", function() {
  if (section.style.display === "none") {
    showSection();
  } else {
    hideSection();
  }
});

function showContent(contentId) {
    // 1. Get all content sections and hide them initially:
    const contentSections = document.querySelectorAll(".content-section");
    contentSections.forEach((section) => section.classList.add("hidden"));
  
    // 2. Get the target content section based on the provided ID:
    const targetSection = document.getElementById(contentId);
  
    // 3. Handle non-existent content sections gracefully:
    if (!targetSection) {
      console.error(`Content section with ID "${contentId}" not found.`);
      return;
    }
  
    // 4. Reveal only the target content section:
    targetSection.classList.remove("hidden");
  }
  
  // 5. Optionally, add click event listeners for non-navigational links:
  const nonNavLinks = document.querySelectorAll(".navbar a[href='#']");
  nonNavLinks.forEach((link) => {
    link.addEventListener("click", function (event) {
      event.preventDefault(); // Prevent default anchor link behavior
      const contentId = link.getAttribute("data-content-id"); // Assuming links have data-content-id attribute
      if (contentId) {
        showContent(contentId);
      }
    });
  });
  
  // 6. (Optional) Trigger the initial content display based on hash in URL:
  const initialHash = window.location.hash.substring(1); // Remove leading '#'
  if (initialHash) {
    showContent(initialHash);
  }
  
  // Function to validate the login form
  function validateForm(event) {
    const userType = document.getElementById("userType").value;
    const userName = document.getElementById("userName").value;
    const password = document.getElementById("password").value;
    const errorElement = document.getElementById("error");
  
    if (userType === "" || userName === "" || password === "") {
      errorElement.innerHTML = "All fields are required";
      event.preventDefault();
    } else {
      // Optional: Add additional login logic here (e.g., checking credentials)
      form.submit(); // Assuming successful validation without server-side verification
    }
  }
  
  // Attach the validateForm function to the form's onsubmit event
  document.getElementById("loginForm").onsubmit = function () {
    return validateForm();
  };

// Function to recommend a crop based on input parameters
function recommendCrop(location, rainfall, soilType, temperature, soilPH) {
    let defaultCrop = '';
    // Add logic here to recommend crops based on the input parameters
    // This is just a placeholder function; you need to customize it based on your criteria
    // For example:
    if (soilType === 'Sandy') {
        defaultCrop = 'Carrots';
        if (soilPH >= 6.0 && soilPH <= 7.0 && temperature >= 15 && temperature <= 25 && rainfall >= 50 && rainfall <= 100) {
            return 'Carrots';
        } else if (soilPH >= 5.0 && soilPH <= 7.0 && temperature >= 18 && temperature <= 32 && rainfall >= 50 && rainfall <= 100) {
            return 'Maize';
        } else if (soilPH >= 5.8 && soilPH <= 6.5 && temperature >= 15 && temperature <= 25 && rainfall >= 25 && rainfall <= 50) {
            return 'Cabbage';
        } else if (soilPH >= 5.5 && soilPH <= 6.5 && temperature>=15&&temperature <= 20 && rainfall >= 50 && rainfall <= 100) {
            return 'Potatoes';
        } else if (soilPH >= 6.0 && soilPH <= 7.5 && temperature >= 21 && temperature <= 29 && rainfall >= 25 && rainfall <= 50) {
            return 'Peppers';
        } else if (soilPH >= 5.8 && soilPH <= 6.5 && temperature >= 21 && temperature <= 27 && rainfall >= 50 && rainfall <= 75) {
            return 'Tomatoes';
        } 
    } else if (soilType === 'Silty') {
        defaultCrop = 'Wheat';
        // Add conditions for Silty soil type
        if (soilPH >= 6.0 && soilPH <= 7.5 && temperature >= 15 && temperature <= 25 && rainfall >= 350 && rainfall <= 450) {
            return 'Wheat';
        } else if (soilPH >= 6.0 && soilPH <= 7.0 && temperature >= 15 && temperature <= 20 && rainfall >= 300 && rainfall <= 500) {
            return 'Oats';
        } else if (soilPH >= 6.0 && soilPH <= 7.5 && temperature >= 15 && temperature <= 25 && rainfall >= 400 && rainfall <= 600) {
            return 'Barley';
        } else if (soilPH >= 6.0 && soilPH <= 7.0 && temperature>= 15 && temperature <= 20 && rainfall >= 500 && rainfall <= 750) {
            return 'Spinach';
        } else if (soilPH >= 6.0 && soilPH <= 7.0 && temperature >= 15 && temperature <= 20 && rainfall >= 500 && rainfall <= 750) {
            return 'Lattuce';
        }
} else if (soilType === 'Alluvial') {
    defaultCrop = 'Maize';
    // Add conditions for Silty soil type
    if (soilPH >= 6.0 && soilPH <= 7.5 && temperature >= 15 && temperature <= 24  && rainfall >= 15 && rainfall <= 25 ) {
        return 'Wheat';
    } else if (soilPH >= 5.5 && soilPH <= 7.0 && temperature >= 20 && temperature <= 30 && rainfall >= 1000 && rainfall <= 2500 ) {
        return 'Sugarcane';
    } else if (soilPH >= 5.5 && soilPH <= 7.0 && temperature >= 20 && temperature <= 30 && rainfall >= 500 && rainfall <= 1000 ) {
        return 'Cotton';
    } else if (soilPH >= 6.0 && soilPH <= 7.0 && temperature>= 20 && temperature <= 30 && rainfall >= 500 && rainfall <= 1000 ) {
        return 'Soybeans';
    } else if (soilPH >= 5.0 && soilPH <= 7.0 && temperature >= 20 && temperature <= 35 && rainfall >= 1000 && rainfall <= 2500 ) {
        return 'Rice';
    } else if (soilPH >= 6.0 && soilPH <= 7.0 && temperature >= 15 && temperature <= 25 && rainfall >= 450 && rainfall <= 750 ) {
        return 'Carrot';
    } else if (soilPH >= 6.0 && soilPH <= 7.0 && temperature >= 15 && temperature <= 25 && rainfall >= 450 && rainfall <= 750 ) {
        return 'Radishes';
    } else if (soilPH >= 6.0 && soilPH <= 7.0 && temperature >= 15 && temperature <= 25 && rainfall >= 450 &&rainfall <= 750 ) {
        return 'Spinach';
    } else if (soilPH >= 5.0 && soilPH <= 7.0 && temperature >= 18 && temperature <= 32 && rainfall >= 450 && rainfall <= 750 ) {
        return 'Maize';
    }
} else if (soilType === 'Clay') {
    defaultCrop = 'Cabbage';
    // Add conditions for Silty soil type
    if (soilPH >= 5.8 && soilPH <= 6.5 && temperature >= 15 && temperature <= 20 && rainfall>= 500 && rainfall <= 800 ) {
        return 'Cabbage';
    } else if (soilPH >= 6.0 && soilPH <= 7.0 && temperature >= 13 && temperature <= 18 && rainfall>= 25 && rainfall <= 50 ) {
        return 'Peas';
    } else if (soilPH >= 5.8 && soilPH <= 6.5 && temperature >= 18 && temperature <= 24 && rainfall >= 25 && rainfall <= 50 ) {
        return 'Broccoil';
    } else if (soilPH >= 5.8 && soilPH <= 6.5 && temperature>= 18 && temperature <= 24 && rainfall >= 15 && rainfall <= 24 ) {
        return 'Cauliflower';
    } else if (soilPH >= 5.8 && soilPH <= 6.5 && temperature >= 15 && temperature <= 20 && rainfall >= 25 && rainfall<= 50 ) {
        return 'Lattuce';
    }
} else if (soilType === 'Loam') {
    defaultCrop = 'Maize';
    // Add conditions for Silty soil type
    if (soilPH >= 6.0 && soilPH <= 7.5 && temperature >= 18 && temperature <= 32 && rainfall >= 75 && rainfall <= 125 ) {
        return 'Beans';
    } else if (soilPH >= 5.8 && soilPH <= 6.5 && temperature >= 18 && temperature <= 24 && rainfall >= 50 && rainfall <= 75 ) {
        return 'Tomatoes';
    } else if (soilPH >= 6.0 && soilPH <= 7.5 && temperature >= 21 && temperature <= 32 && rainfall >= 75 && rainfall <= 100 ) {
        return 'Squash';
    } else if (soilPH >= 5.0 && soilPH <= 6.5 && temperature>= 21 && temperature <= 27 && rainfall >=  50 && rainfall <= 100 ) {
        return 'Strawberies';
    } else if (soilPH >= 6.0 && soilPH <= 7.0 && temperature >= 10 && temperature <= 20 && rainfall >= 50 && rainfall <= 100 ) {
        return 'Beets';
    } else if (soilPH >= 6.0 && soilPH <= 7.0 && temperature >= 21 && temperature <= 32 && rainfall >= 75 && rainfall <= 125 ) {
        return 'Cucumbers';
    } else if (soilPH >= 6.0 && soilPH <= 7.0 && temperature >= 18 && temperature <= 24 && rainfall >= 75 && rainfall<= 125 ) {
        return 'Pampkin';
    } else if (soilPH >= 6.0 && soilPH <= 7.0 && temperature >= 21 && temperature <= 32 && rainfall >= 75 && rainfall <= 127 ) {
        return 'Melon';
    } else if (soilPH >= 6.0 && soilPH <= 7.0 && temperature >= 18 && temperature <= 32 && rainfall >= 75 && rainfall <= 125 ) {
        return 'Maize';
}
else if (soilType === 'Sandy' && soilPH >= 5.0 && soilPH <= 7.0 && rainfall >= 450 && rainfall <= 700 && temperature >= 18 && temperature <= 32  ) {
    return 'Maize (Corn)';
} else if (soilType === 'Silty' && soilPH >= 6.0 && soilPH <= 7.0 && rainfall >= 400 && rainfall <= 600 && temperature >= 15 && temperature <= 24 ) {
    return 'Wheat';
} else if (soilType === 'Alluvial' && soilPH >= 5.0 && soilPH <= 7.0 && rainfall >= 1000 && rainfall <= 2500 && temperature >= 20 && temperature <= 35 ) {
    return 'Rice';
} else if (soilType === 'Alluvial' && soilPH >= 6.0 && soilPH <= 7.5 && rainfall >= 500 && rainfall <= 1000 && temperature >= 20 && temperature <= 30 ) {
    return 'Soybeans';
} else if (soilType === 'Sandy' && soilPH >= 5.5 && soilPH <= 6.5 && rainfall >= 50 && rainfall <= 100 && temperature >= 15 && temperature <= 20 ) {
    return 'Potatoes';
} else if (soilType === 'Silty' && soilPH >= 6.0 && soilPH <= 7.5 && rainfall >= 400 && rainfall <= 600 && temperature >= 15 && temperature <= 25 ) {
    return 'Barley';
} else if (soilType === 'Loam' && soilPH >= 5.5 && soilPH <= 7.5 && rainfall >= 75 && rainfall <= 125 && temperature >= 18 && temperature <= 32 ) {
    return 'Sorghum';
} else if (soilType === 'Loam' && soilPH >= 6.0 && soilPH <= 7.5 && rainfall >= 100 && rainfall <= 300 && temperature >= 18 && temperature <= 32 ) {
    return 'Sunflower';
} else if (soilType === 'Alluvial' && soilPH >= 5.5 && soilPH <= 7.0 && rainfall >= 500 && rainfall <= 1000 && temperature >= 18 && temperature <= 32 ) {
    return 'Cotton';
} else if (soilType === 'Alluvial' && soilPH >= 5.5 && soilPH <= 7.0 && rainfall >= 1000 && rainfall <= 2500 && temperature >= 18 && temperature <= 32 ) {
    return 'Sugarcane';
} else if (soilType === 'Sandy' && soilPH >= 5.0 && soilPH <= 7.0 && rainfall >= 200 && rainfall <= 400 && temperature >= 18 && temperature <= 32 ) {
    return 'Millet';
} else if (soilType === 'Silty' && soilPH >= 6.0 && soilPH <= 7.0 && rainfall >= 400 && rainfall <= 600 && temperature >= 15 && temperature <= 20 ) {
    return 'Oats';
} else if (soilType === 'Loam' && soilPH >= 5.0 && soilPH <= 7.0 && rainfall >= 75 && rainfall <= 150 && temperature >= 13 && temperature <= 20 ) {
    return 'Rye';
} else if (soilType === 'Alluvial' && soilPH >= 5.0 && soilPH <= 6.5 && rainfall >= 1000 && rainfall <= 1500 && temperature >= 20 && temperature <= 32 ) {
    return 'Cassava';
} else if (soilType === 'Sandy' && soilPH >= 5.5 && soilPH <= 6.5 && rainfall >= 300 && rainfall <= 800 && temperature >= 18 && temperature <= 32 ) {
    return 'Lentils';
} else if (soilType === 'Sandy' && soilPH >= 6.0 && soilPH <= 7.0 && rainfall >= 200 && rainfall <= 600 && temperature >= 14 && temperature <= 25 ) {
    return 'Peanuts (Groundnuts)';
} else if (soilType === 'Silty' && soilPH >= 6.0 && soilPH <= 7.5 && rainfall >= 200 && rainfall <= 600 && temperature >= 18 && temperature <= 32 ) {
    return 'Chickpeas (Garbanzo Beans)';
} else if (soilType === 'Alluvial' && soilPH >= 6.0 && soilPH <= 7.5 && rainfall >= 300 && rainfall <= 600 && temperature >= 17 && temperature <= 29 ) {
    return 'Alfalfa';
} else if (soilType === 'Silty' && soilPH >= 5.5 && soilPH <= 7.5 && rainfall >= 300 && rainfall <= 600 && temperature >= 18 && temperature <= 32 ) {
    return 'Canola (Rapeseed)';
} else if (soilType === 'Alluvial' && soilPH >= 5.5 && soilPH <= 6.5 && rainfall >= 1000 && rainfall <= 1500 && temperature >= 20 && temperature <= 30 ) {
    return 'Taro';
    // Add conditions for other soil types
    // Continue with similar conditions for other soil types and crops
}else{
    // Return a default message if no matching crop found
    return defaultCrop;
    
 }
}
    // Add your recommendation logic here
}

// Function to submit the recommendation form
function submitForm() {
    // Retrieve form values
    const location = document.getElementById("location").value;
    const rainfall = parseFloat(document.getElementById("rainfall").value);
    const soilType = document.getElementById("soil-type").value;
    const temperature = document.getElementById("temperature").value;
    const soilPH = parseFloat(document.getElementById("soil-ph").value);
  
    // Perform crop recommendation
    const recommendedCrop = recommendCrop(location, rainfall, soilType, temperature, soilPH);
    // Display recommendation
    displayRecommendation(recommendedCrop);
  }
  
  // Function to display recommendation
  function displayRecommendation(crop) {
    // Display the recommended crop to the user
    document.getElementById("recommendation").textContent = `Recommended crop: ${crop}`;
  }
  
  // Optionally, you can add JavaScript logic specific to the carousel, such as controlling slide behavior.
  // Example: Auto-play the carousel every 3 seconds
  $('.carousel').carousel({
    interval: 3000
  });
  const form = document.getElementById("login-form-js");
const errorMessage = document.getElementById("error-message");

form.addEventListener("submit", function(event) {
  event.preventDefault(); // Prevent default form submission

  // Client-side validation (optional)
  // You can add basic validation here, like checking if username and password are filled

  // Send AJAX request to login.php
  const xhr = new XMLHttpRequest();
  xhr.open("POST", form.action, true);
  xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

  xhr.onload = function() {
    if (xhr.status === 200) {
      const response = JSON.parse(xhr.responseText);
      if (response.success) {
        // Login successful, redirect or handle session
        window.location.href = "welcome.php";
      } else {
        errorMessage.textContent = response.message;
      }
    } else {
      errorMessage.textContent = "An error occurred. Please try again.";
    }
  };

  const formData = new FormData(form);
  xhr.send(formData);
});
 
