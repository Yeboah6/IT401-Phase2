<?php
session_start();

// If user is already logged in, redirect to index
if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true) {
    header("Location: index.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ShopEasy - Login</title>
    <style>
        /* Copy all the styles from register.php login-container */
        body {
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, sans-serif;
            background: linear-gradient(135deg, #0f172a 0%, #1e293b 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }

        .login-container {
            background: white;
            border-radius: 12px;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.3);
            width: 100%;
            max-width: 400px;
            overflow: hidden;
        }

        .login-header {
            background: linear-gradient(135deg, #1e40af 0%, #3b82f6 100%);
            color: white;
            padding: 40px 30px;
            text-align: center;
        }

        .logo {
            width: 60px;
            height: 60px;
            background: white;
            border-radius: 12px;
            margin: 0 auto 20px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 24px;
            font-weight: bold;
            color: #1e40af;
        }

        .login-header h1 {
            font-size: 24px;
            font-weight: 600;
            letter-spacing: 0.5px;
        }

        .login-body {
            padding: 40px 30px;
        }

        .form-group {
            margin-bottom: 24px;
        }

        .form-group label {
            display: block;
            margin-bottom: 8px;
            font-weight: 500;
            color: #334155;
            font-size: 14px;
        }

        .form-group input {
            width: 90%;
            padding: 12px 16px;
            border: 2px solid #e2e8f0;
            border-radius: 8px;
            font-size: 15px;
            transition: all 0.3s ease;
            background: #f8fafc;
        }

        .form-group input:focus {
            outline: none;
            border-color: #3b82f6;
            background: white;
        }

        .login-button {
            width: 100%;
            padding: 14px;
            background: linear-gradient(135deg, #1e40af 0%, #3b82f6 100%);
            color: white;
            border: none;
            border-radius: 8px;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .login-button:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(30, 64, 175, 0.3);
        }

        .register-link {
            text-align: center;
            margin-top: 20px;
            color: #64748b;
            font-size: 14px;
        }

        .register-link a {
            color: #3b82f6;
            text-decoration: none;
            font-weight: 500;
        }

        .register-link a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="login-container">
        <div class="login-header">
            <div class="logo">SE</div>
            <h1>SHOPEASY LOGIN</h1>
        </div>
        
        <div class="login-body">
            <?php if (isset($_GET['registered']) && $_GET['registered'] == '1'): ?>
                <div style="background: #f0fdf4; border: 2px solid #86efac; color: #166534; padding: 12px; border-radius: 8px; margin-bottom: 20px;">
                    Registration successful! Please login.
                </div>
            <?php endif; ?>
            
            <?php if (isset($_GET['error'])): ?>
                <div style="background: #fef2f2; border: 2px solid #fca5a5; color: #991b1b; padding: 12px; border-radius: 8px; margin-bottom: 20px;">
                    Invalid credentials. Please try again.
                </div>
            <?php endif; ?>
            
            <form action="process_login.php" method="POST">
                <div class="form-group">
                    <label for="email">Email</label>
                    <input 
                        type="email" 
                        id="email" 
                        name="email" 
                        placeholder="Enter your email"
                        required
                    >
                </div>

                <div class="form-group">
                    <label for="password">Password</label>
                    <input 
                        type="password" 
                        id="password" 
                        name="password" 
                        placeholder="Enter your password"
                        required
                    >
                </div>

                <button type="submit" class="login-button">
                    Login
                </button>
            </form>
            
            <div class="register-link">
                Don't have an account? <a href="index.php">Register here</a>
            </div>
        </div>
    </div>
</body>
</html>