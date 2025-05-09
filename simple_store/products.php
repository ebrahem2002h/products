<?php
include 'includes/db_connect.php';
include 'includes/header.php';

session_start(); 
if (!isset($_SESSION['user_id']) || (isset($_SESSION['role']) && $_SESSION['role'] != 'admin')) {
    header('Location: login.php');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = trim($_POST['name']);
    $price = floatval($_POST['price']);
    $description = trim($_POST['description']);
    $image_path = '';

    if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
        $target_dir = "images/";
        $image_name = basename($_FILES['image']['name']);
        $target_file = $target_dir . $image_name;

        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
        $allowed_types = ['jpg', 'jpeg', 'png', 'gif'];
        if (in_array($imageFileType, $allowed_types)) {
            if (move_uploaded_file($_FILES['image']['tmp_name'], $target_file)) {
                $image_path = $target_file;
            } else {
                echo "<p class='text-danger'>فشل في رفع الصورة.</p>";
            }
        } else {
            echo "<p class='text-danger'>الملف ليس صورة (الأنواع المسموح بها: jpg, jpeg, png, gif).</p>";
        }
    }

    if (!empty($name) && $price > 0) {
        $query = "INSERT INTO products (name, price, image, description) VALUES (?, ?, ?, ?)";
        $stmt = mysqli_prepare($conn, $query);
        mysqli_stmt_bind_param($stmt, 'sdss', $name, $price, $image_path, $description);
        if (mysqli_stmt_execute($stmt)) {
            echo "<p class='text-success'>تم إضافة المنتج بنجاح!</p>";
        } else {
            echo "<p class='text-danger'>خطأ أثناء إضافة المنتج: " . mysqli_error($conn) . "</p>";
        }
        mysqli_stmt_close($stmt);
    } else {
        echo "<p class='text-danger'>يرجى إدخال اسم وسعر صالحين.</p>";
    }
}

$query = "SELECT * FROM products";
$result = mysqli_query($conn, $query);
?>

<h2 class="text-center mb-4">إدارة المنتجات</h2>

<form method="post" enctype="multipart/form-data" class="needs-validation" novalidate>
    <div class="mb-3">
        <label for="name" class="form-label">اسم المنتج:</label>
        <input type="text" class="form-control" id="name" name="name" required>
        <div class="invalid-feedback">يرجى إدخال اسم المنتج.</div>
    </div>
    <div class="mb-3">
        <label for="price" class="form-label">السعر (<?php echo $currency; ?>):</label>
        <input type="number" class="form-control" id="price" name="price" step="0.01" required>
        <div class="invalid-feedback">يرجى إدخال سعر صالح.</div>
    </div>
    <div class="mb-3">
        <label for="description" class="form-label">وصف المنتج:</label>
        <textarea class="form-control" id="description" name="description" rows="4" required></textarea>
        <div class="invalid-feedback">يرجى إدخال وصف المنتج.</div>
    </div>
    <div class="mb-3">
        <label for="image" class="form-label">صورة المنتج:</label>
        <input type="file" class="form-control" id="image" name="image" accept="image/*">
    </div>
    <button type="submit" class="btn btn-primary">إضافة المنتج</button>
</form>

<h3 class="text-center mt-5">المنتجات الحالية</h3>
<?php if (mysqli_num_rows($result) > 0) { ?>
    <div class="table-responsive">
        <table class="table table-hover table-striped">
            <thead>
                <tr>
                    <th>المعرف</th>
                    <th>الاسم</th>
                    <th>السعر</th>
                    <th>الوصف</th>
                    <th>الصورة</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = mysqli_fetch_assoc($result)) { ?>
                    <tr>
                        <td><?php echo htmlspecialchars($row['id']); ?></td>
                        <td><?php echo htmlspecialchars($row['name']); ?></td>
                        <td><?php echo htmlspecialchars($row['price']); ?>         <?php echo $currency; ?></td>
                        <td><?php echo htmlspecialchars($row['description']); ?></td>
                        <td>
                            <?php if (!empty($row['image'])) { ?>
                                <img src="<?php echo htmlspecialchars($row['image']); ?>"
                                    alt="<?php echo htmlspecialchars($row['name']); ?>" style="max-width: 50px; height: auto;">
                            <?php } else { ?>
                                لا توجد صورة
                            <?php } ?>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
<?php } else { ?>
    <p class="text-center">لا توجد منتجات حاليًا.</p>
<?php } ?>

<?php
mysqli_close($conn);
include 'includes/footer.php';
?>