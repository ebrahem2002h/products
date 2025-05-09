<?php
include 'includes/db_connect.php';
include 'includes/header.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = trim($_POST['username']);
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);
    $confirm_password = trim($_POST['confirm_password']);
    $role = 'user'; 

    if (empty($username) || empty($email) || empty($password) || empty($confirm_password)) {
        echo "<p class='text-danger text-center'>يرجى ملء جميع الحقول.</p>";
    } elseif ($password !== $confirm_password) {
        echo "<p class='text-danger text-center'>كلمات المرور غير متطابقة.</p>";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "<p class='text-danger text-center'>البريد الإلكتروني غير صالح.</p>";
    } else {
        $query = "SELECT * FROM users WHERE username = ? OR email = ?";
        $stmt = mysqli_prepare($conn, $query);
        mysqli_stmt_bind_param($stmt, 'ss', $username, $email);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);

        if (mysqli_num_rows($result) > 0) {
            echo "<p class='text-danger text-center'>اسم المستخدم أو البريد الإلكتروني موجود بالفعل. يرجى اختيار قيم أخرى.</p>";
        } else {
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);
            $query = "INSERT INTO users (username, email, password, role) VALUES (?, ?, ?, ?)";
            $stmt = mysqli_prepare($conn, $query);
            mysqli_stmt_bind_param($stmt, 'ssss', $username, $email, $hashed_password, $role);

            if (mysqli_stmt_execute($stmt)) {
                echo "<p class='text-success text-center'>تم إنشاء الحساب بنجاح! يمكنك <a href='login.php' class='text-warning'>تسجيل الدخول</a> الآن.</p>";
            } else {
                echo "<p class='text-danger text-center'>خطأ أثناء إنشاء الحساب: " . mysqli_error($conn) . "</p>";
            }
        }
        mysqli_stmt_close($stmt);
    }
}

mysqli_close($conn);
?>

<section class="register-section">
    <h2 class="text-center mb-4 fw-bold display-5 text-warning">إنشاء حساب جديد</h2>
    <div class="row justify-content-center">
        <div class="col-md-6 col-lg-4">
            <form method="post" class="needs-validation p-4 rounded shadow" novalidate>
                <div class="mb-3">
                    <label for="username" class="form-label text-warning">اسم المستخدم:</label>
                    <input type="text" class="form-control" id="username" name="username" required>
                    <div class="invalid-feedback">يرجى إدخال اسم المستخدم.</div>
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label text-warning">البريد الإلكتروني:</label>
                    <input type="email" class="form-control" id="email" name="email" required>
                    <div class="invalid-feedback">يرجى إدخال بريد إلكتروني صالح.</div>
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label text-warning">كلمة المرور:</label>
                    <input type="password" class="form-control" id="password" name="password" required>
                    <div class="invalid-feedback">يرجى إدخال كلمة المرور.</div>
                </div>
                <div class="mb-3">
                    <label for="confirm_password" class="form-label text-warning">تأكيد كلمة المرور:</label>
                    <input type="password" class="form-control" id="confirm_password" name="confirm_password" required>
                    <div class="invalid-feedback">يرجى تأكيد كلمة المرور.</div>
                </div>
                <button type="submit" class="btn btn-primary w-100">إنشاء الحساب</button>
            </form>
        </div>
    </div>
</section>

<script>
    (() => {
        'use strict';
        const forms = document.querySelectorAll('.needs-validation');
        Array.from(forms).forEach(form => {
            form.addEventListener('submit', event => {
                if (!form.checkValidity()) {
                    event.preventDefault();
                    event.stopPropagation();
                }
                form.classList.add('was-validated');
            }, false);
        });
    })();
</script>

<?php include 'includes/footer.php'; ?>