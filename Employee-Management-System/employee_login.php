<?php
// Database credentials
$host = "localhost";
$dbname = "user_registration";
$username = "root";
$password = "";

// Connect to database
$conn = new mysqli($host, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$loginMessage = "";

// Handle POST request
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $email = filter_var(trim($_POST['email']), FILTER_SANITIZE_EMAIL);
    $passwordInput = trim($_POST['password']);

    // Fetch user with given email and role
    $stmt = $conn->prepare("SELECT * FROM users WHERE email = ? AND role = 'employee'");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result && $result->num_rows === 1) {
        $user = $result->fetch_assoc();

        // Plain-text password comparison (⚠️ for testing only)
        if ($passwordInput === $user['password']) {
            echo "<script>alert('Login successful!'); window.location.href='dashboard.php';</script>";
            exit;
        } else {
            $loginMessage = "<div class='error'>Invalid password.</div>";
        }
    } else {
        $loginMessage = "<div class='error'>Invalid email or not authorized.</div>";
    }

    $stmt->close();
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Employee Login</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />
  <style>
    * {
      box-sizing: border-box;
      margin: 0;
      padding: 0;
    }
    body {
      height: 100vh;
      display: flex;
      justify-content: center;
      align-items: center;
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
      background: url('LoginBG.png') no-repeat center center/cover;
      background-attachment: fixed;
      color: white;
      font-size: 18px;
    }

    .login-container {
      background: rgba(255, 255, 255, 0.05);
      backdrop-filter: blur(14px);
      padding: 40px;
      border-radius: 20px;
      box-shadow: 0 0 13px white;
      width: 420px;
      max-width: 95%;
      text-align: center;
      animation: fadeIn 0.8s ease-in-out;
    }

    .login-icon {
      font-size: 50px;
      color: #fff;
      margin-bottom: 10px;
    }

    .login-form h2 {
      font-size: 30px;
      margin-bottom: 25px;
    }

    .input-group {
      position: relative;
      margin-bottom: 30px;
    }

    .input-group input {
      width: 100%;
      padding: 14px 14px 14px 45px;
      background: transparent;
      border: none;
      border-bottom: 2px solid white;
      color: white;
      font-size: 18px;
    }

    .input-group label {
      position: absolute;
      left: 45px;
      bottom: 12px;
      color: rgba(255, 255, 255, 0.8);
      font-size: 18px;
      pointer-events: none;
      transition: 0.3s ease;
    }

    .input-group input:focus + label,
    .input-group input:not(:placeholder-shown) + label {
      transform: translateY(-24px);
      font-size: 14px;
    }

    .input-icon {
      position: absolute;
      left: 12px;
      bottom: 14px;
      color: #ccc;
      font-size: 18px;
    }

    .link {
      display: flex;
      justify-content: space-between;
      margin-bottom: 20px;
    }

    .link a {
      color: #fff;
      text-decoration: none;
      transition: 0.3s;
    }

    .link a:hover {
      color: #84a1f1;
    }

    button {
      width: 100%;
      padding: 14px;
      border: none;
      border-radius: 8px;
      background: linear-gradient(45deg, #84a1f1, #4b6cb7);
      color: #000;
      font-size: 18px;
      font-weight: bold;
      cursor: pointer;
      transition: 0.3s ease;
    }

    button:hover {
      background: linear-gradient(45deg, #5f80e3, #2c4cb7);
      color: white;
      box-shadow: 0 0 15px rgba(255, 255, 255, 0.4);
    }

    .success, .error {
      margin-bottom: 20px;
      padding: 10px;
      border-radius: 8px;
    }

    .success {
      background-color: rgba(0, 128, 0, 0.2);
      border: 1px solid #0f0;
      color: #0f0;
    }

    .error {
      background-color: rgba(255, 0, 0, 0.2);
      border: 1px solid #f00;
      color: #f00;
    }

    @keyframes fadeIn {
      from {
        opacity: 0;
        transform: translateY(-30px);
      }
      to {
        opacity: 1;
        transform: translateY(0);
      }
    }

    @media screen and (max-width: 480px) {
      .login-container {
        padding: 30px 20px;
      }
      .login-form h2 {
        font-size: 24px;
      }
    }
  </style>
</head>
<body>
  <div class="login-container">
    <div class="login-icon"><i class="fas fa-user-circle"></i></div>
    <?php echo $loginMessage; ?>
    <form class="login-form" method="POST">
      <h2>Login As Employee</h2>

      <div class="input-group">
        <i class="fas fa-user input-icon"></i>
        <input type="text" id="email" name="email" required placeholder=" " />
        <label for="email">Email</label>
      </div>

      <div class="input-group">
        <i class="fas fa-lock input-icon"></i>
        <input type="password" id="password" name="password" required placeholder=" " />
        <label for="password">Password</label>
      </div>

      <div class="link">
        <a href="forgate.html">Forgot Password?</a>
        <a href="ds.php">Sign Up</a>
      </div>

      <button type="submit">Login</button>
    </form>
  </div>
</body>
</html>
