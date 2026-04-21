<?php
require_once 'includes/db.php';

ini_set('session.cookie_httponly', 1);
ini_set('session.cookie_secure', 0);
ini_set('session.cookie_samesite', 'Lax');
ini_set('session.gc_maxlifetime', 86400);
session_set_cookie_params([
    'lifetime' => 86400,
    'path' => '/',
    'domain' => '',
    'secure' => false,
    'httponly' => true,
    'samesite' => 'Lax'
]);
session_start();

if (isset($_SESSION['user_id'])) {
    header('Location: dashboard.php');
    exit;
}

$error = '';
$success = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'] ?? '';
    $email = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';
    $confirm_password = $_POST['confirm_password'] ?? '';

    if ($name && $email && $password) {
        if ($password !== $confirm_password) {
            $error = "Passwords do not match";
        } else {
            $conn = new mysqli($host, $db_user, $db_pass, $dbname);
            if (!$conn->connect_error) {
                $check = $conn->prepare("SELECT id FROM users WHERE email = ?");
                $check->bind_param("s", $email);
                $check->execute();
                $result = $check->get_result();
                
                if ($result->num_rows > 0) {
                    $error = "Email already registered";
                } else {
                    $hashed_password = password_hash($password, PASSWORD_DEFAULT);
                    $stmt = $conn->prepare("INSERT INTO users (name, email, password) VALUES (?, ?, ?)");
                    $stmt->bind_param("sss", $name, $email, $hashed_password);
                    
                    if ($stmt->execute()) {
                        header('Location: login.php?registered=1');
                        exit;
                    } else {
                        $error = "Error creating account";
                    }
                }
                $stmt->close();
                $conn->close();
            }
        }
    } else {
        $error = "Please fill in all fields";
    }
}

$google_client_id = getenv('GOOGLE_CLIENT_ID');
$google_client_secret = getenv('GOOGLE_CLIENT_SECRET');
$google_redirect_url = 'http://localhost/ourp/ai-travel-app/google-callback.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up - AI Travel Planner</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary: #546B41;
            --secondary: #99AD7A;
            --beige: #DCCCAC;
            --cream: #FFF8EC;
        }
        
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Inter', sans-serif;
        }
        
        body {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            background: linear-gradient(135deg, var(--primary) 0%, var(--secondary) 100%);
            padding: 20px;
        }
        
        .login-container {
            background: var(--cream);
            padding: 40px;
            border-radius: 16px;
            box-shadow: 0 20px 60px rgba(84, 107, 65, 0.3);
            width: 100%;
            max-width: 420px;
        }
        
        .login-header {
            text-align: center;
            margin-bottom: 32px;
        }
        
        .login-header h1 {
            font-size: 28px;
            color: var(--primary);
            margin-bottom: 8px;
        }
        
        .login-header p {
            color: #666;
        }
        
        .social-login {
            display: flex;
            flex-direction: column;
            gap: 12px;
            margin-bottom: 24px;
        }
        
        .social-btn {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 12px;
            padding: 14px;
            border: 2px solid var(--secondary);
            border-radius: 10px;
            background: white;
            font-size: 16px;
            font-weight: 500;
            cursor: pointer;
            transition: all 0.3s;
            text-decoration: none;
        }
        
        .social-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(84, 107, 65, 0.2);
            background: var(--cream);
        }
        
        .social-btn.google {
            color: var(--primary);
        }
        
        .divider {
            display: flex;
            align-items: center;
            margin: 24px 0;
        }
        
        .divider::before,
        .divider::after {
            content: '';
            flex: 1;
            height: 1px;
            background: var(--beige);
        }
        
        .divider span {
            padding: 0 16px;
            color: #666;
            font-size: 14px;
        }
        
        .form-group {
            margin-bottom: 20px;
        }
        
        .form-group label {
            display: block;
            margin-bottom: 8px;
            font-weight: 500;
            color: var(--primary);
        }
        
        .form-group input {
            width: 100%;
            padding: 14px;
            border: 2px solid var(--beige);
            border-radius: 10px;
            font-size: 16px;
            transition: border-color 0.3s;
            background: white;
        }
        
        .form-group input:focus {
            outline: none;
            border-color: var(--secondary);
        }
        
        .btn-primary {
            width: 100%;
            padding: 14px;
            background: var(--primary);
            color: white;
            border: none;
            border-radius: 10px;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            transition: background 0.3s;
        }
        
        .btn-primary:hover {
            background: #445234;
        }
        
        .signup-link {
            text-align: center;
            margin-top: 24px;
            color: #666;
        }
        
        .signup-link a {
            color: var(--primary);
            text-decoration: none;
            font-weight: 600;
        }
        
        .back-btn {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            color: var(--primary);
            text-decoration: none;
            font-weight: 500;
            margin-bottom: 20px;
            transition: color 0.3s;
        }
        
        .back-btn:hover {
            color: #445234;
        }
        
        .alert {
            padding: 12px 16px;
            border-radius: 8px;
            margin-bottom: 20px;
        }
        
        .alert-error {
            background: #fee;
            color: #c00;
        }
        
        .alert-success {
            background: #efe;
            color: #060;
        }
    </style>
</head>
<body>
    <div class="login-container">
        <a href="index.php" class="back-btn">← Back to Home</a>
        
        <div class="login-header">
            <h1>Create Account</h1>
            <p>Start planning your perfect trips</p>
        </div>
        
        <div class="social-login">
            <?php if ($google_client_id): ?>
            <a href="https://accounts.google.com/o/oauth2/auth?client_id=<?php echo $google_client_id; ?>&redirect_uri=<?php echo urlencode($google_redirect_url); ?>&response_type=code&scope=email%20profile&access_type=offline" class="social-btn google" style="width:100%;justify-content:center;">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none">
                    <path d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92c-.26 1.37-1.04 2.53-2.21 3.31v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.09z" fill="#4285f4"/>
                    <path d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.96 20.53 7.7 23 12 23z" fill="#34a853"/>
                    <path d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.07H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.93l2.85-2.22.81-.62z" fill="#fbbc05"/>
                    <path d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.96 3.47 2.18 7.07l3.66 2.84c.87-2.6 3.3-4.53 6.16-4.53z" fill="#ea4335"/>
                </svg>
                Sign up with Google
            </a>
            <?php endif; ?>
        </div>
        
        <?php if ($error): ?>
            <div class="alert alert-error"><?php echo htmlspecialchars($error); ?></div>
        <?php endif; ?>
        
        <?php if ($success): ?>
            <div class="alert alert-success"><?php echo htmlspecialchars($success); ?></div>
        <?php endif; ?>
        
        <div class="divider" style="margin:24px 0;">
            <span>or sign up with email</span>
        </div>
        
        <form method="POST">
            <div class="form-group">
                <label>Full Name</label>
                <input type="text" name="name" placeholder="Enter your name" required>
            </div>
            
            <div class="form-group">
                <label>Email</label>
                <input type="email" name="email" placeholder="Enter your email" required>
            </div>
            
            <div class="form-group">
                <label>Password</label>
                <input type="password" name="password" placeholder="Create a password" required>
            </div>
            
            <div class="form-group">
                <label>Confirm Password</label>
                <input type="password" name="confirm_password" placeholder="Confirm your password" required>
            </div>
            
            <button type="submit" class="btn-primary">Create Account</button>
        </form>
        
        <div class="signup-link">
            Already have an account? <a href="login.php">Login</a>
        </div>
    </div>
</body>
</html>