<?php
session_start();

// DB config
$conn = new mysqli("localhost", "root", "", "user_registration");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$loginMessage = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);

    $stmt = $conn->prepare("SELECT * FROM users WHERE email = ? AND role = 'admin'");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result && $result->num_rows === 1) {
        $user = $result->fetch_assoc();
        // Comparing the plain text password
        if ($password === $user['password']) {
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['role'] = $user['role'];
            echo "<script>alert('Admin login successful!'); window.location.href='admin_dashboard.php';</script>";
            exit;
        } else {
            $loginMessage = "<div class='error'>Invalid password.</div>";
        }
    } else {
        $loginMessage = "<div class='error'>Invalid email or not authorized as Admin.</div>";
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
  <title>Admin Login</title>
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

    .error {
      background-color: rgba(255, 0, 0, 0.2);
      border: 1px solid #f00;
      color: #f00;
      margin-bottom: 20px;
      padding: 10px;
      border-radius: 8px;
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
      <h2>Login As Admin</h2>
      <div class="input-group">
        <i class="fas fa-user input-icon"></i>
        <input type="email" id="email" name="email" required />
        <label for="email">Email</label>
      </div>
      <div class="input-group">
        <i class="fas fa-lock input-icon"></i>
        <input type="password" id="password" name="password" required />
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
