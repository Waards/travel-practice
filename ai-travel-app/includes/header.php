<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AI Travel Planner - Plan Your Perfect Trip with AI</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        :root {
            --primary: #546B41;
            --primary-dark: #435934;
            --secondary: #99AD7A;
            --accent: #DCCCAC;
            --dark: #2D3A28;
            --gray: #6B7280;
            --light: #FFF8EC;
            --white: #FFFFFF;
        }

        body {
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, sans-serif;
            color: var(--dark);
            line-height: 1.6;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 24px;
        }

        .navbar-custom {
            padding: 20px 0;
            background: var(--white);
            position: fixed;
            width: 100%;
            top: 0;
            z-index: 100;
            box-shadow: 0 1px 3px rgba(0,0,0,0.05);
        }

        .navbar-custom .container {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .logo {
            font-size: 24px;
            font-weight: 700;
            color: var(--primary);
        }

        .nav-links {
            display: flex;
            gap: 32px;
            list-style: none;
        }

        .nav-links a {
            text-decoration: none;
            color: var(--gray);
            font-weight: 500;
            transition: color 0.2s;
        }

        .nav-links a:hover {
            color: var(--dark);
        }

        .btn {
            padding: 12px 24px;
            border-radius: 8px;
            font-weight: 600;
            cursor: pointer;
            border: none;
            transition: all 0.2s;
        }

        .btn-primary {
            background: var(--primary);
            color: var(--white);
        }

        .btn-primary:hover {
            background: var(--primary-dark);
        }

        .btn-secondary {
            background: transparent;
            color: var(--dark);
            border: 2px solid var(--dark);
        }

        .btn-secondary:hover {
            background: var(--dark);
            color: var(--white);
        }

        .hero {
            padding: 160px 0 100px;
            background: linear-gradient(135deg, #FEFCE8 0%, #FEF3C7 100%);
        }

        .hero .container {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 60px;
            align-items: center;
        }

        .hero-content h1 {
            font-size: 56px;
            font-weight: 800;
            line-height: 1.1;
            margin-bottom: 24px;
            color: var(--dark);
        }

        .hero-content p {
            font-size: 20px;
            color: var(--gray);
            margin-bottom: 32px;
        }

        .hero-buttons {
            display: flex;
            gap: 16px;
        }

        .hero-mock {
            background: var(--white);
            border-radius: 16px;
            box-shadow: 0 25px 50px rgba(0,0,0,0.15);
            padding: 24px;
            min-height: 400px;
        }

        .mock-header {
            display: flex;
            gap: 12px;
            margin-bottom: 20px;
        }

        .mock-dot {
            width: 12px;
            height: 12px;
            border-radius: 50%;
            background: #E5E7EB;
        }

        .mock-dot.red { background: #EF4444; }
        .mock-dot.yellow { background: #F59E0B; }
        .mock-dot.green { background: #10B981; }

        .mock-card {
            background: #F3F4F6;
            border-radius: 12px;
            padding: 16px;
            margin-bottom: 12px;
        }

        .mock-card h4 {
            font-size: 14px;
            margin-bottom: 8px;
            color: var(--dark);
        }

        .mock-card p {
            font-size: 12px;
            color: var(--gray);
        }

        .mock-list {
            display: flex;
            flex-direction: column;
            gap: 8px;
        }

        .mock-item {
            display: flex;
            align-items: center;
            gap: 8px;
            font-size: 12px;
            color: var(--gray);
        }

        .mock-checkbox {
            width: 14px;
            height: 14px;
            border: 2px solid var(--primary);
            border-radius: 4px;
        }

        .features {
            padding: 100px 0;
            background: var(--white);
        }

        .section-title {
            text-align: center;
            font-size: 40px;
            font-weight: 700;
            margin-bottom: 16px;
        }

        .section-subtitle {
            text-align: center;
            font-size: 18px;
            color: var(--gray);
            margin-bottom: 60px;
        }

        .features-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 32px;
        }

        .feature-card {
            padding: 32px;
            border-radius: 16px;
            background: var(--light);
            text-align: center;
            transition: transform 0.2s;
        }

        .feature-card:hover {
            transform: translateY(-4px);
        }

        .feature-icon {
            width: 64px;
            height: 64px;
            background: var(--primary);
            border-radius: 16px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 20px;
            font-size: 28px;
        }

        .feature-card h3 {
            font-size: 18px;
            font-weight: 600;
            margin-bottom: 12px;
        }

        .feature-card p {
            font-size: 14px;
            color: var(--gray);
        }

        .how-it-works {
            padding: 100px 0;
            background: var(--light);
        }

        .steps {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 40px;
        }

        .step {
            text-align: center;
            position: relative;
            transition: transform 0.3s;
        }

        .step:hover {
            transform: scale(1.05);
        }

        .step-number {
            width: 48px;
            height: 48px;
            background: var(--primary);
            color: var(--white);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 20px;
            font-weight: 700;
            margin: 0 auto 20px;
        }

        .step-icon {
            font-size: 32px;
            margin-bottom: 12px;
        }

        .step h3 {
            font-size: 18px;
            font-weight: 600;
            margin-bottom: 12px;
        }

        .step p {
            font-size: 14px;
            color: var(--gray);
        }

        .preview {
            padding: 100px 0;
            background: #F3F4F6;
            color: var(--dark);
        }

        .preview .section-title {
            color: var(--dark);
        }

        .preview .section-subtitle {
            color: #6B7280;
        }

        .dashboard {
            background: var(--white);
            border-radius: 16px;
            overflow: hidden;
            box-shadow: 0 25px 50px rgba(0,0,0,0.3);
        }

        .dashboard-header {
            background: #F3F4F6;
            padding: 16px 24px;
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .dashboard-content {
            display: grid;
            grid-template-columns: 1fr 1fr;
        }

        .dashboard-left {
            padding: 24px;
            border-right: 1px solid #E5E7EB;
        }

        .day-card {
            background: #F9FAFB;
            border-radius: 12px;
            padding: 20px;
            margin-bottom: 16px;
        }

        .day-card h4 {
            font-size: 14px;
            font-weight: 600;
            color: #2D3A28;
            margin-bottom: 12px;
        }

        .day-item {
            display: flex;
            gap: 12px;
            padding: 8px 0;
            border-bottom: 1px solid #E5E7EB;
            font-size: 14px;
            color: #2D3A28;
        }

        .day-item:last-child {
            border-bottom: none;
        }

        .day-time {
            color: #6B7280;
            min-width: 60px;
        }

        .dashboard-right {
            padding: 24px;
        }

        .budget-card, .checklist-card {
            background: #F9FAFB;
            border-radius: 12px;
            padding: 20px;
            margin-bottom: 16px;
        }

        .budget-card h4, .checklist-card h4 {
            font-size: 14px;
            font-weight: 600;
            color: #2D3A28;
            margin-bottom: 12px;
        }

        .budget-item {
            display: flex;
            justify-content: space-between;
            padding: 8px 0;
            font-size: 14px;
            border-bottom: 1px solid #E5E7EB;
        }

        .budget-item:last-child {
            border-bottom: none;
            font-weight: 600;
        }

        .checklist-item {
            display: flex;
            align-items: center;
            gap: 8px;
            font-size: 14px;
            padding: 8px 0;
        }

        .checkbox {
            width: 18px;
            height: 18px;
            border: 2px solid var(--primary);
            border-radius: 4px;
        }

        .value-prop {
            padding: 100px 0;
            background: var(--white);
        }

        .value-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 32px;
        }

        .value-item {
            text-align: center;
        }

        .value-icon {
            width: 80px;
            height: 80px;
            background: #ECFDF5;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 20px;
            font-size: 32px;
        }

        .value-item h3 {
            font-size: 18px;
            font-weight: 600;
            margin-bottom: 12px;
        }

        .value-item p {
            font-size: 14px;
            color: var(--gray);
        }

        .cta {
            padding: 100px 0;
            background: linear-gradient(135deg, var(--primary) 0%, var(--primary-dark) 100%);
            text-align: center;
        }

        .cta h2 {
            font-size: 40px;
            font-weight: 700;
            color: var(--white);
            margin-bottom: 24px;
        }

        .cta .btn {
            background: var(--white);
            color: var(--primary);
            padding: 16px 32px;
            font-size: 18px;
        }

        .cta .btn:hover {
            background: var(--light);
        }

        .footer-custom {
            padding: 60px 0 30px;
            background: var(--dark);
            color: var(--white);
        }

        .footer-grid {
            display: grid;
            grid-template-columns: 2fr 1fr 1fr 1fr;
            gap: 40px;
            margin-bottom: 40px;
        }

        .footer-brand h3 {
            font-size: 20px;
            font-weight: 700;
            margin-bottom: 12px;
            color: var(--primary);
        }

        .footer-brand p {
            font-size: 14px;
            color: #9CA3AF;
        }

        .footer-column h4 {
            font-size: 14px;
            font-weight: 600;
            margin-bottom: 16px;
        }

        .footer-column ul {
            list-style: none;
        }

        .footer-column li {
            margin-bottom: 8px;
        }

        .footer-column a {
            color: #9CA3AF;
            text-decoration: none;
            font-size: 14px;
        }

        .footer-column a:hover {
            color: var(--white);
        }

        .footer-bottom {
            padding-top: 30px;
            border-top: 1px solid #374151;
            text-align: center;
            font-size: 14px;
            color: #9CA3AF;
        }

        @media (max-width: 768px) {
            .hero .container {
                grid-template-columns: 1fr;
            }

            .hero-content h1 {
                font-size: 40px;
            }

            .features-grid, .steps, .value-grid {
                grid-template-columns: 1fr;
            }

            .dashboard-content {
                grid-template-columns: 1fr;
            }

            .dashboard-left {
                border-right: none;
                border-bottom: 1px solid #E5E7EB;
            }

            .nav-links {
                display: none;
            }

            .footer-grid {
                grid-template-columns: 1fr;
            }
        }

        .modal {
            display: none;
            position: fixed;
            z-index: 1000;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0,0,0,0.5);
        }

        .modal-content {
            background-color: var(--white);
            margin: 10% auto;
            padding: 40px;
            border-radius: 16px;
            width: 90%;
            max-width: 400px;
            position: relative;
        }

        .close {
            position: absolute;
            right: 20px;
            top: 20px;
            font-size: 28px;
            font-weight: bold;
            color: var(--gray);
            cursor: pointer;
        }

        .close:hover {
            color: var(--dark);
        }

        .modal-tabs {
            display: flex;
            margin-bottom: 30px;
            border-bottom: 2px solid #E5E7EB;
        }

        .tab-btn {
            flex: 1;
            padding: 12px;
            background: none;
            border: none;
            font-size: 16px;
            font-weight: 600;
            color: var(--gray);
            cursor: pointer;
            transition: all 0.2s;
        }

        .tab-btn.active {
            color: var(--primary);
            border-bottom: 2px solid var(--primary);
            margin-bottom: -2px;
        }

        .social-btn {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 12px;
            width: 100%;
            padding: 14px;
            border: 2px solid #E5E7EB;
            border-radius: 8px;
            background: white;
            font-size: 15px;
            font-weight: 500;
            cursor: pointer;
            transition: all 0.3s;
            text-decoration: none;
            margin-bottom: 20px;
        }

        .social-btn:hover {
            background: #f9fafb;
            border-color: #d1d5db;
            transform: translateY(-1px);
            box-shadow: 0 4px 12px rgba(0,0,0,0.1);
        }

        .social-divider {
            display: flex;
            align-items: center;
            margin: 20px 0;
            color: #9CA3AF;
            font-size: 14px;
        }

        .social-divider::before,
        .social-divider::after {
            content: '';
            flex: 1;
            height: 1px;
            background: #E5E7EB;
        }

        .social-divider span {
            padding: 0 16px;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-group label {
            display: block;
            margin-bottom: 8px;
            font-weight: 500;
            color: var(--dark);
        }

        .form-group input {
            width: 100%;
            padding: 12px 16px;
            border: 2px solid #E5E7EB;
            border-radius: 8px;
            font-size: 14px;
            transition: border-color 0.2s;
        }

        .form-group input:focus {
            outline: none;
            border-color: var(--primary);
        }

        .btn-full {
            width: 100%;
        }

        .modal-footer-text {
            text-align: center;
            margin-top: 20px;
            font-size: 14px;
            color: var(--gray);
        }

        .modal-footer-text a {
            color: var(--primary);
            text-decoration: none;
            font-weight: 500;
        }

        .modal-footer-text a:hover {
            text-decoration: underline;
        }

        .trip-form {
            display: flex;
            flex-direction: column;
            gap: 20px;
        }

        .trip-form .form-group {
            margin-bottom: 0;
        }

        .trip-form select {
            width: 100%;
            padding: 12px 16px;
            border: 2px solid #E5E7EB;
            border-radius: 8px;
            font-size: 14px;
            background: var(--white);
            cursor: pointer;
        }

        .trip-form select:focus {
            outline: none;
            border-color: var(--primary);
        }

        .form-row {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 16px;
        }

        .loading-spinner {
            display: none;
            text-align: center;
            padding: 40px 0;
        }

        .spinner {
            width: 50px;
            height: 50px;
            border: 4px solid #E5E7EB;
            border-top: 4px solid var(--primary);
            border-radius: 50%;
            animation: spin 1s linear infinite;
            margin: 0 auto 20px;
        }

        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }

        .results-section {
            display: none;
        }

        .results-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 24px;
            margin-top: 40px;
        }

        .result-card {
            background: var(--white);
            border-radius: 12px;
            padding: 24px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.08);
        }

        .result-card h3 {
            font-size: 18px;
            font-weight: 600;
            margin-bottom: 16px;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .itinerary-day {
            margin-bottom: 20px;
        }

        .itinerary-day h4 {
            font-size: 14px;
            font-weight: 600;
            color: var(--primary);
            margin-bottom: 12px;
        }

        .itinerary-item {
            display: flex;
            gap: 12px;
            padding: 8px 0;
            font-size: 14px;
            border-bottom: 1px solid #E5E7EB;
        }

        .itinerary-item:last-child {
            border-bottom: none;
        }

        .itinerary-time {
            color: var(--gray);
            min-width: 60px;
        }

        .budget-breakdown .budget-item {
            display: flex;
            justify-content: space-between;
            padding: 10px 0;
            font-size: 14px;
            border-bottom: 1px solid #E5E7EB;
        }

        .budget-breakdown .budget-item:last-child {
            border-bottom: none;
            font-weight: 600;
            color: var(--primary);
        }

        .places-list {
            display: flex;
            flex-direction: column;
            gap: 12px;
        }

        .place-item {
            display: flex;
            align-items: center;
            gap: 8px;
            font-size: 14px;
        }

        .place-item .icon {
            width: 24px;
            height: 24px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 12px;
        }

        .place-item .icon.approved {
            background: #DCFCE7;
            color: #16A34A;
        }

        .place-item .icon.warning {
            background: #FEE2E2;
            color: #DC2626;
        }

        .checklist-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 12px;
        }

        .checklist-item-new {
            display: flex;
            align-items: center;
            gap: 8px;
            font-size: 14px;
            padding: 8px;
            background: var(--light);
            border-radius: 8px;
        }

        .checklist-item-new input[type="checkbox"] {
            width: 18px;
            height: 18px;
            cursor: pointer;
        }

        @media (max-width: 768px) {
            .results-grid {
                grid-template-columns: 1fr;
            }

            .form-row {
                grid-template-columns: 1fr;
            }

            .checklist-grid {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>
<body>
    <nav class="navbar-custom">
        <div class="container">
            <div class="logo">AI Travel Planner</div>
            <ul class="nav-links">
                <li><a href="#features">Features</a></li>
                <li><a href="#how-it-works">How It Works</a></li>
                <li><a href="#preview">Preview</a></li>
                <li><a href="#contact">Contact</a></li>
            </ul>
            <button class="btn btn-primary" onclick="openModal('loginModal')">Login</button>
        </div>
    </nav>

    <div id="loginModal" class="modal">
        <div class="modal-content">
            <span class="close" onclick="closeModal('loginModal')">&times;</span>
            <div class="modal-tabs">
                <button class="tab-btn active" onclick="switchTab('login')">Login</button>
                <button class="tab-btn" onclick="switchTab('signup')">Sign Up</button>
            </div>
            
            <div id="loginTab" class="tab-content">
                <a href="https://accounts.google.com/o/oauth2/v2/auth?client_id=<?php echo getenv('GOOGLE_CLIENT_ID'); ?>&redirect_uri=<?php echo urlencode('http://localhost/ourp/ai-travel-app/google-callback.php'); ?>&response_type=code&scope=email%20profile&access_type=offline" class="social-btn google-btn">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none"><path d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92c-.26 1.37-1.04 2.53-2.21 3.31v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.09z" fill="#4285f4"/><path d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.96 20.53 7.7 23 12 23z" fill="#34a853"/><path d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.07H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.93l2.85-2.22.81-.62z" fill="#fbbc05"/><path d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.96 3.47 2.18 7.07l3.66 2.84c.87-2.6 3.3-4.53 6.16-4.53z" fill="#ea4335"/></svg>
                    Continue with Google
                </a>
                <div class="social-divider"><span>or</span></div>
                <form action="login.php" method="POST">
                    <div class="form-group">
                        <label>Email</label>
                        <input type="email" name="email" placeholder="Enter your email" required>
                    </div>
                    <div class="form-group">
                        <label>Password</label>
                        <input type="password" name="password" placeholder="Enter your password" required>
                    </div>
                    <button type="submit" class="btn btn-primary btn-full">Login</button>
                </form>
                <p class="modal-footer-text">Don't have an account? <a href="#" onclick="switchTab('signup')">Sign up</a></p>
            </div>
            
            <div id="signupTab" class="tab-content" style="display:none;">
                <a href="https://accounts.google.com/o/oauth2/v2/auth?client_id=<?php echo getenv('GOOGLE_CLIENT_ID'); ?>&redirect_uri=<?php echo urlencode('http://localhost/ourp/ai-travel-app/google-callback.php'); ?>&response_type=code&scope=email%20profile&access_type=offline" class="social-btn google-btn">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none"><path d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92c-.26 1.37-1.04 2.53-2.21 3.31v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.09z" fill="#4285f4"/><path d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.96 20.53 7.7 23 12 23z" fill="#34a853"/><path d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.07H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.93l2.85-2.22.81-.62z" fill="#fbbc05"/><path d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.96 3.47 2.18 7.07l3.66 2.84c.87-2.6 3.3-4.53 6.16-4.53z" fill="#ea4335"/></svg>
                    Sign up with Google
                </a>
                <div class="social-divider"><span>or</span></div>
                <form action="signup.php" method="POST">
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
                    <button type="submit" class="btn btn-primary btn-full">Sign Up</button>
                </form>
                <p class="modal-footer-text">Already have an account? <a href="#" onclick="switchTab('login')">Login</a></p>
            </div>
        </div>
    </div>

    <div id="tripModal" class="modal">
        <div class="modal-content" style="max-width: 500px;">
            <span class="close" onclick="closeModal('tripModal')">&times;</span>
            <h2 style="text-align: center; margin-bottom: 24px; font-size: 24px;">Plan Your Trip</h2>
            
            <form id="tripForm" class="trip-form">
                <div class="form-group">
                    <label>🌍 Destination</label>
                    <input type="text" id="destination" placeholder="e.g., Paris, France" required>
                </div>
                
                <div class="form-row">
                    <div class="form-group">
                        <label>📅 Start Date</label>
                        <input type="date" id="startDate" required>
                    </div>
                    <div class="form-group">
                        <label>📅 End Date</label>
                        <input type="date" id="endDate" required>
                    </div>
                </div>
                
                <div class="form-group">
                    <label>💰 Budget ($)</label>
                    <input type="number" id="budget" placeholder="Enter your budget" required>
                </div>
                
                <div class="form-group">
                    <label>🎒 Travel Style</label>
                    <select id="travelStyle" required>
                        <option value="">Select a style</option>
                        <option value="luxury">Luxury</option>
                        <option value="adventure">Adventure</option>
                        <option value="relax">Relax</option>
                        <option value="budget">Budget</option>
                        <option value="cultural">Cultural</option>
                    </select>
                </div>
                
                <button type="submit" class="btn btn-primary btn-full">Generate My Trip Plan</button>
            </form>
            
            <div id="loadingSpinner" class="loading-spinner">
                <div class="spinner"></div>
                <p>Generating your AI travel plan...</p>
            </div>
            
            <div id="resultsSection" class="results-section">
                <h2 style="text-align: center; margin-bottom: 24px; font-size: 24px;">🗺️ Your Trip Itinerary</h2>
                <div class="results-grid">
                    <div class="result-card">
                        <h3>📅 Itinerary</h3>
                        <div id="itineraryContent"></div>
                    </div>
                    
                    <div class="result-card">
                        <h3>💰 Budget Breakdown</h3>
                        <div id="budgetContent" class="budget-breakdown"></div>
                    </div>
                    
                    <div class="result-card">
                        <h3>✅ Hidden Gems</h3>
                        <div id="hiddenGems" class="places-list"></div>
                    </div>
                    
                    <div class="result-card">
                        <h3>❌ Overrated Spots</h3>
                        <div id="overratedSpots" class="places-list"></div>
                    </div>
                </div>
                
                <div class="result-card" style="margin-top: 24px;">
                    <h3>📋 Packing Checklist</h3>
                    <div id="checklistContent" class="checklist-grid"></div>
                </div>
                
                <button class="btn btn-primary" style="margin-top: 24px; width: 100%;" onclick="closeModal('tripModal'); resetTripForm();">Plan Another Trip</button>
            </div>
        </div>
    </div>

    <script>
        function openModal(modalId) {
            document.getElementById(modalId).style.display = 'block';
        }

        function closeModal(modalId) {
            document.getElementById(modalId).style.display = 'none';
        }

        function switchTab(tab) {
            const loginTab = document.getElementById('loginTab');
            const signupTab = document.getElementById('signupTab');
            const loginBtn = document.querySelector('.tab-btn:nth-child(1)');
            const signupBtn = document.querySelector('.tab-btn:nth-child(2)');

            if (tab === 'login') {
                loginTab.style.display = 'block';
                signupTab.style.display = 'none';
                loginBtn.classList.add('active');
                signupBtn.classList.remove('active');
            } else {
                loginTab.style.display = 'none';
                signupTab.style.display = 'block';
                loginBtn.classList.remove('active');
                signupBtn.classList.add('active');
            }
        }

        window.onclick = function(event) {
            if (event.target.classList.contains('modal')) {
                event.target.style.display = 'none';
            }
        }

        document.getElementById('tripForm').addEventListener('submit', function(e) {
            e.preventDefault();
            
            const destination = document.getElementById('destination').value;
            const budget = parseInt(document.getElementById('budget').value);
            const travelStyle = document.getElementById('travelStyle').value;
            const startDate = new Date(document.getElementById('startDate').value);
            const endDate = new Date(document.getElementById('endDate').value);
            
            const days = Math.ceil((endDate - startDate) / (1000 * 60 * 60 * 24));
            
            document.getElementById('tripForm').style.display = 'none';
            document.getElementById('loadingSpinner').style.display = 'block';
            
            setTimeout(function() {
                generateResults(destination, budget, travelStyle, days);
            }, 2000);
        });

        function generateResults(destination, budget, travelStyle, days) {
            document.getElementById('loadingSpinner').style.display = 'none';
            document.getElementById('resultsSection').style.display = 'block';
            
            const itineraryEl = document.getElementById('itineraryContent');
            const budgetEl = document.getElementById('budgetContent');
            const hiddenGemsEl = document.getElementById('hiddenGems');
            const overratedEl = document.getElementById('overratedSpots');
            const checklistEl = document.getElementById('checklistContent');
            
            let itineraryHTML = '';
            const activities = {
                luxury: ['Fine dining', 'Spa treatment', 'Luxury shopping', 'Wine tasting'],
                adventure: ['Hiking', 'Rock climbing', 'Kayaking', 'Zip lining'],
                relax: ['Beach walk', 'Sunset cruise', 'Massage', 'Reading time'],
                budget: ['Free walking tour', 'Street food', 'Public parks', 'Free museums'],
                cultural: ['Museums', 'Historical sites', 'Local markets', 'Traditional performances']
            };
            
            const styleActivities = activities[travelStyle] || activities.cultural;
            
            for (let i = 1; i <= Math.min(days, 5); i++) {
                itineraryHTML += `
                    <div class="itinerary-day">
                        <h4>Day ${i}</h4>
                        <div class="itinerary-item">
                            <span class="itinerary-time">9:00 AM</span>
                            <span>${styleActivities[0]} - ${destination}</span>
                        </div>
                        <div class="itinerary-item">
                            <span class="itinerary-time">12:00 PM</span>
                            <span>Local Lunch</span>
                        </div>
                        <div class="itinerary-item">
                            <span class="itinerary-time">3:00 PM</span>
                            <span>${styleActivities[1]}</span>
                        </div>
                        <div class="itinerary-item">
                            <span class="itinerary-time">7:00 PM</span>
                            <span>Dinner & Evening</span>
                        </div>
                    </div>
                `;
            }
            itineraryEl.innerHTML = itineraryHTML;
            
            const hotelBudget = Math.round(budget * 0.35);
            const foodBudget = Math.round(budget * 0.25);
            const transportBudget = Math.round(budget * 0.20);
            const activitiesBudget = Math.round(budget * 0.20);
            
            budgetEl.innerHTML = `
                <div class="budget-item"><span>🏨 Accommodation</span><span>$${hotelBudget}</span></div>
                <div class="budget-item"><span>🍽️ Food & Dining</span><span>$${foodBudget}</span></div>
                <div class="budget-item"><span>🚗 Transport</span><span>$${transportBudget}</span></div>
                <div class="budget-item"><span>🎫 Activities</span><span>$${activitiesBudget}</span></div>
                <div class="budget-item"><span>💵 Total</span><span>$${budget}</span></div>
            `;
            
            hiddenGemsEl.innerHTML = `
                <div class="place-item"><span class="icon approved">✓</span> Hidden local cafe</div>
                <div class="place-item"><span class="icon approved">✓</span> Secret viewpoint</div>
                <div class="place-item"><span class="icon approved">✓</span> Local market</div>
                <div class="place-item"><span class="icon approved">✓</span> Neighborhood art</div>
            `;
            
            overratedEl.innerHTML = `
                <div class="place-item"><span class="icon warning">✗</span> Tourist trap restaurant</div>
                <div class="place-item"><span class="icon warning">✗</span> Overcrowded landmark</div>
                <div class="place-item"><span class="icon warning">✗</span> Gift shop area</div>
            `;
            
            const checklistItems = [
                'Flight tickets', 'Hotel confirmation', 'Passport/ID', 'Travel insurance',
                'Phone charger', 'Comfortable shoes', 'Camera', 'Local currency',
                'Travel adapter', 'Medications', 'Sunglasses', 'Day bag'
            ];
            
            let checklistHTML = '';
            checklistItems.forEach(item => {
                checklistHTML += `
                    <label class="checklist-item-new">
                        <input type="checkbox">
                        <span>${item}</span>
                    </label>
                `;
            });
            checklistEl.innerHTML = checklistHTML;
        }

        function resetTripForm() {
            document.getElementById('tripForm').reset();
            document.getElementById('tripForm').style.display = 'flex';
            document.getElementById('resultsSection').style.display = 'none';
        }
    </script>
</body>
</html>