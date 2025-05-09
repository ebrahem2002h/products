<?php
session_start();
$currency = "ل.س";
?>
<!DOCTYPE html>
<html lang="ar">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>متجر منتجات</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="includes/style.css">
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@400;600;700&display=swap" rel="stylesheet">
</head>

<body>
    <header>
        <nav class="navbar navbar-expand-lg navbar-dark bg-gradient"
            style="background: linear-gradient(90deg, #2c3e50, #4ca1af);">
            <div class="container">
                <a class="navbar-brand fw-bold fs-4" href="index.php">متجر منتجات </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                    aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse justify-content-center" id="navbarNav">
                    <ul class="navbar-nav">
                        <li class="nav-item"><a class="nav-link" href="index.php">الرئيسية</a></li>
                        <li class="nav-item"><a class="nav-link" href="products.php">المنتجات</a></li>
                        <?php if (isset($_SESSION['user_id'])) { ?>
                            <li class="nav-item"><a class="nav-link" href="logout.php">تسجيل الخروج</a></li>
                            <?php if ($_SESSION['role'] == 'admin') { ?>
                                <li class="nav-item"><a class="nav-link" href="users.php">إدارة المستخدمين</a></li>
                            <?php } ?>
                        <?php } else { ?>
                            <li class="nav-item"><a class="nav-link" href="login.php">تسجيل الدخول</a></li>
                            <li class="nav-item"><a class="nav-link" href="register.php">إنشاء حساب</a></li>
                        <?php } ?>
                    </ul>
                </div>
            </div>
        </nav>
    </header>
    <main class="container py-5">