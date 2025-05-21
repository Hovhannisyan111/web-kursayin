<?php
if (session_status() === PHP_SESSION_NONE) session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Luxury Stays</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root {
            --primary-color: #2a3f54;
            --secondary-color: #f8b400;
        }

        body {
            background-color: #f4f4f4;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            padding-top: 80px;
        }

        .navbar-custom {
            background-color: var(--primary-color) !important;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        .hero-section {
            background:
                linear-gradient(rgba(0, 0, 0, 0.6), rgba(0, 0, 0, 0.6)),
                url('https://source.unsplash.com/random/1920x1080/?luxury-hotel') center/cover no-repeat;
            height: 70vh;
            margin-top: -80px;
            padding-top: 80px;
            color: white;
        }

        .hotel-name {
            color: #ffffff;
            text-shadow: 2px 2px 6px rgba(0, 0, 0, 0.8);
            font-size: 3.5rem;
            font-weight: 700;
            letter-spacing: -1px;
        }

        .room-card,
        .booking-card {
            transition: transform 0.3s, box-shadow 0.3s;
            border: none !important;
            border-radius: 15px !important;
        }

        .room-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
        }

        .btn-custom {
            background-color: var(--secondary-color);
            color: white;
            border-radius: 25px;
            transition: all 0.3s;
        }

        .btn-custom:hover {
            background-color: #e6a200;
            transform: scale(1.05);
        }

        .content-padding {
            padding: 40px 0;
        }

        .booking-detail {
            background: #f8f9fa;
            padding: 8px 12px;
            border-radius: 8px;
        }
    </style>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark navbar-custom fixed-top">
    <div class="container">
        <a class="navbar-brand" href="index.php">
            <img src="https://cdn-icons-png.flaticon.com/512/1179/1179235.png" width="40" height="40" class="d-inline-block align-top" alt="">
            Luxury Stays
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <?php if (isset($_SESSION['user_id'])): ?>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">
                            <i class="fas fa-user me-1"></i><?= $_SESSION['username'] ?>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end">
                            <li><a class="dropdown-item" href="my_bookings.php"><i class="fas fa-calendar-alt me-2"></i>My Bookings</a></li>
                            <li><a class="dropdown-item" href="index.php"><i class="fas fa-home me-2"></i>Home</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li><a class="dropdown-item" href="logout.php"><i class="fas fa-sign-out-alt me-2"></i>Logout</a></li>
                        </ul>
                    </li>
                <?php else: ?>
                    <li class="nav-item"><a class="nav-link" href="register.php"><i class="fas fa-user-plus me-1"></i>Register</a></li>
                    <li class="nav-item"><a class="nav-link" href="login.php"><i class="fas fa-sign-in-alt me-1"></i>Login</a></li>
                <?php endif; ?>
            </ul>
        </div>
    </div>
</nav>

<div class="hero-section">
    <div class="container text-center d-flex align-items-center justify-content-center h-100">
        <div>
            <h1 class="hotel-name display-3 fw-bold mb-3">Luxury Stays</h1>
            <p class="lead fs-4">Experience World-Class Hospitality</p>
        </div>
    </div>
</div>
<main class="container content-padding">

