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

if (isset($_GET['code'])) {
    $google_client_id = getenv('GOOGLE_CLIENT_ID');
    $google_client_secret = getenv('GOOGLE_CLIENT_SECRET');
    $google_redirect_url = 'http://localhost/ourp/ai-travel-app/google-callback.php';
    
    $code = $_GET['code'];
    $url = 'https://oauth2.googleapis.com/token';
    $post_data = [
        'client_id' => $google_client_id,
        'client_secret' => $google_client_secret,
        'code' => $code,
        'grant_type' => 'authorization_code',
        'redirect_uri' => $google_redirect_url
    ];
    
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($post_data));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    $response = curl_exec($ch);
    curl_close($ch);
    
    $token_data = json_decode($response, true);
    
    if (isset($token_data['access_token'])) {
        $user_info_url = 'https://www.googleapis.com/oauth2/v2/userinfo?access_token=' . $token_data['access_token'];
        
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $user_info_url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $user_info = curl_exec($ch);
        curl_close($ch);
        
        $user = json_decode($user_info, true);
        
        if (isset($user['email'])) {
            $conn = new mysqli($host, $db_user, $db_pass, $dbname);
            
            $stmt = $conn->prepare("SELECT id FROM users WHERE email = ?");
            $stmt->bind_param("s", $user['email']);
            $stmt->execute();
            $result = $stmt->get_result();
            
            if ($row = $result->fetch_assoc()) {
                $_SESSION['user_id'] = $row['id'];
                $_SESSION['user_name'] = $user['name'] ?? 'User';
            } else {
                $name = $user['name'] ?? $user['email'];
                $google_id = $user['id'];
                $password = password_hash(uniqid(), PASSWORD_DEFAULT);
                
                $stmt = $conn->prepare("INSERT INTO users (name, email, password, google_id) VALUES (?, ?, ?, ?)");
                $stmt->bind_param("ssss", $name, $user['email'], $password, $google_id);
                $stmt->execute();
                $_SESSION['user_id'] = $stmt->insert_id;
            }
            
            $stmt->close();
            $conn->close();
            
            header('Location: dashboard.php');
            exit;
        }
    }
}

header('Location: login.php?error=google_auth_failed');
exit;