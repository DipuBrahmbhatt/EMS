<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>Elegant Signup Form</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet" />
    <style>
        body {
            font-family: 'Segoe UI', sans-serif;
            margin: 0;
            padding: 0;
            display: flex;
            align-items: center;
            min-height: 100vh;
            justify-content: flex-start;
            background: linear-gradient(to right, rgba(0,0,0,0.5), rgba(0,0,0,0.1)),
                        url('signupimage.jpg') no-repeat center center;
            background-size: cover;
        }

        .form-wrapper {
            background-color: rgba(255, 255, 255, 0.95);
            padding: 40px 35px;
            border-radius: 15px;
            box-shadow: 0 8px 24px rgba(0, 0, 0, 0.2);
            width: 100%;
            max-width: 420px;
            margin-left: 50px;
            animation: fadeInUp 0.8s ease-out;
        }

        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .form-card {
            text-align: center;
        }

        h2 {
            color: #222;
            margin-bottom: 30px;
            font-size: 26px;
        }

        .input-group {
            position: relative;
            margin-bottom: 25px;
        }

        .icon {
            position: absolute;
            left: 18px;
            top: 50%;
            transform: translateY(-50%);
            color: #888;
            font-size: 16px;
        }

        input[type="text"],
        input[type="email"],
        input[type="password"],
        select {
            width: 100%;
            padding: 13px 15px 13px 45px;
            border: 1px solid #ccc;
            border-radius: 8px;
            font-size: 15px;
            box-sizing: border-box;
            transition: all 0.3s ease;
            background-color: #fff;
        }

        input:focus,
        select:focus {
            border-color: #007bff;
            box-shadow: 0 0 8px rgba(0, 123, 255, 0.4);
            background-color: #fdfdfd;
        }

        select {
            appearance: none;
            background-image: url('data:image/svg+xml;utf8,<svg fill=\'%23777\' height=\'20\' viewBox=\'0 0 24 24\' width=\'20\' xmlns=\'http://www.w3.org/2000/svg\'><path d=\'M7 10l5 5 5-5z\'/></svg>');
            background-repeat: no-repeat;
            background-position: right 12px center;
            background-size: 16px;
            padding-right: 40px;
        }

        .form-links {
            margin-bottom: 20px;
            text-align: left;
        }

        .form-links a {
            color: #007bff;
            text-decoration: none;
            font-size: 14px;
            transition: color 0.3s ease;
        }

        .form-links a:hover {
            text-decoration: underline;
            color: #0056b3;
        }

        button {
            background: linear-gradient(135deg, #007bff, #0056b3);
            color: white;
            padding: 14px 0;
            border: none;
            border-radius: 8px;
            font-size: 17px;
            font-weight: 600;
            cursor: pointer;
            width: 100%;
            transition: background 0.3s ease, transform 0.2s ease;
        }

        button:hover {
            background: linear-gradient(135deg, #0056b3, #003f8a);
            transform: translateY(-2px);
        }

        button i {
            margin-right: 8px;
        }
    </style>
</head>
<body>
    <div class="form-wrapper">
        <div class="form-card">
            <h2><i class="fas fa-user-plus"></i> Create Your Account</h2>
            <form method="POST" action="signup.php">
                <div class="input-group">
                    <i class="fas fa-user-circle icon"></i>
                    <input type="text" name="first_name" placeholder="First Name" required />
                </div>
                <div class="input-group">
                    <i class="fas fa-user-circle icon"></i>
                    <input type="text" name="last_name" placeholder="Last Name" required />
                </div>
                <div class="input-group">
                    <i class="fas fa-envelope icon"></i>
                    <input type="email" name="email" placeholder="Email Address" required />
                </div>
                <div class="input-group">
                    <i class="fas fa-user-tag icon"></i>
                    <select name="role" required>
                        <option value="" disabled selected>Select Role</option>
                        <option value="admin">Admin</option>
                        <option value="manager">Manager</option>
                        <option value="employee">Employee</option>
                        <option value="hr">HR</option>
                    </select>
                </div>
                <div class="input-group">
                    <i class="fas fa-key icon"></i>
                    <input type="password" name="password" placeholder="Password" required />
                </div>

                <div class="form-links">
                    <a href="index.html">Already have an account? Login</a>
                </div>

                <button type="submit"><i class="fas fa-right-to-bracket"></i> Sign Up</button>
            </form>
        </div>
    </div>
</body>
</html>
