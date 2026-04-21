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
    $facebook_app_id = getenv('FACEBOOK_APP_ID');
    $facebook_app_secret = getenv('FACEBOOK_APP_SECRET');
    $facebook_redirect_url = 'http://localhost/ourp/ai-travel-app/facebook-callback.php';
    
    $code = $_GET['code'];
    $url = 'https://graph.facebook.com/v18.0/oauth/access_token';
    $post_data = [
        'client_id' => $facebook_app_id,
        'client_secret' => $facebook_app_secret,
        'code' => $code,
        'redirect_uri' => $facebook_redirect_url
    ];
    
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url . '?' . http_build_query($post_data));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    $response = curl_exec($ch);
    curl_close($ch);
    
    $token_data = json_decode($response, true);
    
    if (isset($token_data['access_token'])) {
        $user_info_url = 'https://graph.facebook.com/v18.0/me?fields=id,name,email&access_token=' . $token_data['access_token'];
        
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
            } else {
                $name = $user['name'];
                $facebook_id = $user['id'];
                $password = password_hash(uniqid(), PASSWORD_DEFAULT);
                
                $stmt = $conn->prepare("INSERT INTO users (name, email, password, facebook_id) VALUES (?, ?, ?, ?)");
                $stmt->bind_param("ssss", $name, $user['email'], $password, $facebook_id);
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

header('Location: login.php?error=facebook_auth_failed');
exit;