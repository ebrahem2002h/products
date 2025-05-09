<?php
include 'includes/db_connect.php';
include 'includes/header.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username_or_email = trim($_POST['username_or_email']);
    $password = trim($_POST['password']);

    $query = "SELECT * FROM users WHERE username = ? OR email = ?";
    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, 'ss', $username_or_email, $username_or_email);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    if ($row = mysqli_fetch_assoc($result)) {
        if (password_verify($password, $row['password'])) {
            if ($row['role'] != 'admin') {
                echo "<p class='text-danger text-center'>صلاحيات غير كافية. يرجى استخدام حساب مدير.</p>";
            } else {
                session_start();
                $_SESSION['user_id'] = $row['id'];
                $_SESSION['username'] = $row['username'];
                $_SESSION['role'] = $row['role'];
                header('Location: index.php');
                exit;
            }
        } else {
            echo "<p class='text-danger text-center'>كلمة المرور غير صحيحة.</p>";
        }
    } else {
        echo "<p class='text-danger text-center'>المستخدم أو البريد الإلكتروني غير موجود.</p>";
    }
    mysqli_stmt_close($stmt);
}

mysqli_close($conn);
?>

<h2 class="text-center mb-4 fw-bold display-5 text-warning">تسجيل الدخول</h2>
<div class="row justify-content-center">
    <div class="col-md-6 col-lg-4">
        <form method="post" class="needs-validation p-4 rounded shadow" novalidate>
            <div class="mb-3">
                <label for="username_or_email" class="form-label text-warning">اسم المستخدم أو البريد
                    الإلكتروني:</label>
                <input type="text" class="form-control" id="username_or_email" name="username_or_email" required>
                <div class="invalid-feedback">يرجى إدخال اسم المستخدم أو البريد الإلكتروني.</div>
            </div>
        
            <div class="mb-3">
                <label for="password" class="form-label text-warning">كلمة المرور:</label>
                <input type="password" class="form-control" id="password" name="password" required>
                <div class="invalid-feedback">يرجى إدخال كلمة المرور.</div>
            </div>
            <button type="submit" class="btn btn-primary w-100">تسجيل الدخول</button>
        </form>
    </div>
</div>

<?php include 'includes/footer.php'; ?>