<?php
session_start();

// Check if user is logged in
if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
    // Redirect to login if not logged in
    header("Location: login.php");
    exit();
}

$user_name = $_SESSION['user_name'] ?? 'User';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ShopEasy - Home</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        body {
            background-color: #f8f9fa;
            color: #333;
        }
        header {
            background-color: #2c3e50;
            color: white;
            padding: 1rem 0;
            position: sticky;
            top: 0;
            z-index: 100;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }
        .container {
            width: 90%;
            max-width: 1200px;
            margin: 0 auto;
        }
        nav {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .logo {
            font-size: 1.8rem;
            font-weight: bold;
            color: #3498db;
        }
        .nav-links {
            display: flex;
            list-style: none;
        }
        .nav-links li {
            margin-left: 2rem;
        }
        .nav-links a {
            color: white;
            text-decoration: none;
            font-weight: 500;
            transition: color 0.3s;
        }
        .nav-links a:hover {
            color: #3498db;
        }
        .hero {
            background: linear-gradient(rgba(0,0,0,0.7), rgba(0,0,0,0.7)), url('images/image6.jpg');
            background-size: cover;
            background-position: center;
            color: white;
            padding: 6rem 0;
            text-align: center;
        }
        .hero h1 {
            font-size: 3rem;
            margin-bottom: 1rem;
        }
        .hero p {
            font-size: 1.2rem;
            max-width: 700px;
            margin: 0 auto 2rem;
        }
        .btn {
            display: inline-block;
            background-color: #3498db;
            color: white;
            padding: 0.8rem 1.5rem;
            border-radius: 4px;
            text-decoration: none;
            font-weight: bold;
            transition: background-color 0.3s;
        }
        .btn:hover {
            background-color: #2980b9;
        }
        .featured-products {
            padding: 4rem 0;
        }
        .section-title {
            text-align: center;
            margin-bottom: 3rem;
            font-size: 2rem;
            color: #2c3e50;
        }
        .products-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
            gap: 2rem;
        }
        .product-card {
            background: white;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 4px 6px rgba(0,0,0,0.1);
            transition: transform 0.3s;
        }
        .product-card:hover {
            transform: translateY(-5px);
        }
        .product-img {
            width: 100%;
            height: 200px;
            object-fit: cover;
        }
        .product-info {
            padding: 1.5rem;
        }
        .product-title {
            font-size: 1.2rem;
            margin-bottom: 0.5rem;
        }
        .product-price {
            font-weight: bold;
            color: #e74c3c;
            font-size: 1.1rem;
        }
        footer {
            background-color: #2c3e50;
            color: white;
            padding: 2rem 0;
            text-align: center;
        }
        .footer-links {
            display: flex;
            justify-content: center;
            list-style: none;
            margin-bottom: 1rem;
        }
        .footer-links li {
            margin: 0 1rem;
        }
        .footer-links a {
            color: #bdc3c7;
            text-decoration: none;
        }
        .footer-links a:hover {
            color: #3498db;
        }

        /* Mobile Menu Button */
        .menu-toggle {
            display: none;
            flex-direction: column;
            cursor: pointer;
            padding: 5px;
        }
        .menu-toggle span {
            width: 25px;
            height: 3px;
            background-color: white;
            margin: 3px 0;
            transition: 0.3s;
            border-radius: 2px;
        }
        
        /* Mobile Styles */
        @media (max-width: 768px) {
            .menu-toggle {
                display: flex;
            }
            
            .nav-links {
                position: fixed;
                top: 70px;
                right: -100%;
                width: 80%;
                max-width: 300px;
                height: calc(100vh - 70px);
                background-color: #2c3e50;
                flex-direction: column;
                align-items: center;
                padding-top: 2rem;
                transition: right 0.3s ease;
                box-shadow: -5px 0 15px rgba(0,0,0,0.1);
            }
            
            .nav-links.active {
                right: 0;
            }
            
            .nav-links li {
                margin: 1.5rem 0;
            }
            
            .nav-links a {
                font-size: 1.2rem;
                padding: 0.5rem 1rem;
                display: block;
                width: 100%;
                text-align: center;
            }
            
            /* Animation for menu toggle */
            .menu-toggle.active span:nth-child(1) {
                transform: rotate(-45deg) translate(-5px, 6px);
            }
            .menu-toggle.active span:nth-child(2) {
                opacity: 0;
            }
            .menu-toggle.active span:nth-child(3) {
                transform: rotate(45deg) translate(-5px, -6px);
            }
        }

        .logout-btn {
            background: #ef4444;
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 8px;
            cursor: pointer;
            font-weight: 500;
            transition: all 0.3s ease;
        }

        .logout-btn:hover {
            background: #dc2626;
            transform: translateY(-2px);
        }

    </style>
</head>
<body>
    <header>
        <div class="container">
            <nav>
                <div class="logo">ShopEasy</div>
                <ul class="nav-links" id="navLinks">
                    <li><a href="picture.html">Products</a></li>
                    <li><a href="audio.html">Audio</a></li>
                    <li><a href="video.html">Video</a></li>
                    <li><a href="about.html">About</a></li>
                    <li>
                        <div class="user-info">
                            <form action="logout.php" method="POST">
                                <button type="submit" class="logout-btn">Logout</button>
                            </form>
                        </div>
                    </li>
                </ul>
                <div class="menu-toggle" id="menuToggle">
                    <span></span>
                    <span></span>
                    <span></span>
                </div>
            </nav>
        </div>
    </header>

    <section class="hero">
        <div class="container">
            <h1>Welcome, <strong><?php echo htmlspecialchars($user_name); ?></strong> <br> to <br> ShopEasy</h1>
            <p>Your one-stop destination for all your shopping needs. Discover amazing products at unbeatable prices.</p>
            <a href="picture.html" class="btn">Shop Now</a>
        </div>
    </section>

    <section class="featured-products">
        <div class="container">
            <h2 class="section-title">Featured Products</h2>
            <div class="products-grid">
                <div class="product-card">
                    <img src="images/image17.jpg" alt="Wireless Headphones" class="product-img">
                    <div class="product-info">
                        <h3 class="product-title">Premium Wireless Headphones</h3>
                        <p class="product-price">$129.99</p>
                    </div>
                </div>
                <div class="product-card">
                    <img src="images/image12.jpg" alt="Smart Watch" class="product-img">
                    <div class="product-info">
                        <h3 class="product-title">Portable Bluetooth Speaker</h3>
                        <p class="product-price">$199.99</p>
                    </div>
                </div>
                <div class="product-card">
                    <img src="images/image1.jpg" alt="Bluetooth Speaker" class="product-img">
                    <div class="product-info">
                        <h3 class="product-title">Bluetooth Speaker</h3>
                        <p class="product-price">$79.99</p>
                    </div>
                </div>
                <div class="product-card">
                    <img src="images/Sonic.jpg" alt="Running Shoes" class="product-img">
                    <div class="product-info">
                        <h3 class="product-title">Portable Bluetooth Earpod</h3>
                        <p class="product-price">$89.99</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <footer>
        <div class="container">
            <p>&copy; 2025 ShopEasy. All rights reserved.</p>
        </div>
    </footer>

    <script>
        // Mobile menu functionality
        const menuToggle = document.getElementById('menuToggle');
        const navLinks = document.getElementById('navLinks');
        
        menuToggle.addEventListener('click', () => {
            navLinks.classList.toggle('active');
            menuToggle.classList.toggle('active');
        });
        
        // Close menu when clicking on a link
        const navItems = document.querySelectorAll('.nav-links a');
        navItems.forEach(item => {
            item.addEventListener('click', () => {
                navLinks.classList.remove('active');
                menuToggle.classList.remove('active');
            });
        });
        
        // Close menu when clicking outside
        document.addEventListener('click', (event) => {
            const isClickInsideNav = navLinks.contains(event.target);
            const isClickOnToggle = menuToggle.contains(event.target);
            
            if (!isClickInsideNav && !isClickOnToggle && navLinks.classList.contains('active')) {
                navLinks.classList.remove('active');
                menuToggle.classList.remove('active');
            }
        });
    </script>
</body>
</html>