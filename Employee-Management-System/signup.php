<?php
$host = "localhost";     // Database host
$dbname = "user_registration";  // Your DB name
$username = "root";      // DB username
$password = "";          // DB password (set it if needed)

// Create DB connection
$conn = new mysqli($host, $username, $password, $dbname);

// Check DB connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check for POST request
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Collect and sanitize user input
    $firstName = htmlspecialchars(trim($_POST["first_name"]));
    $lastName = htmlspecialchars(trim($_POST["last_name"]));
    $email = filter_var(trim($_POST["email"]), FILTER_SANITIZE_EMAIL);
    $role = htmlspecialchars($_POST["role"]);
    $password = $_POST["password"]; // Storing plain text password (not recommended)
    
    // Hash the password before storing it
    $hashedPassword = password_hash($password, PASSWORD_BCRYPT);

    // Use a single query to check for email existence and insert user in case of no duplicate
    $stmt = $conn->prepare("SELECT id FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        // Email already exists, trigger popup with error message
        echo "<script>
                alert('Email already exists. Please use a different one.');
                window.location.href='ds.php'; // Redirect back to the signup page
              </script>";
    } else {
        // Prepare SQL insert statement
        $insertStmt = $conn->prepare("INSERT INTO users (first_name, last_name, email, role, password) VALUES (?, ?, ?, ?, ?)");
        $insertStmt->bind_param("sssss", $firstName, $lastName, $email, $role, $hashedPassword);

        if ($insertStmt->execute()) {
            // Success, show success message and redirect to login
            echo "<script>
                    alert('Signup Successful!');
                    window.location.href='index.html'; // Redirect to the login page after successful signup
                  </script>";
        } else {
            // Error handling
            echo "<script>
                    alert('Error: " . $conn->error . "');
                    window.location.href='ds.php'; // Redirect back to the signup page in case of error
                  </script>";
        }

        // Close the insert statement after execution
        $insertStmt->close();
    }

    // Close the select statement after use
    $stmt->close();
}

// Close database connection
$conn->close();
?>
