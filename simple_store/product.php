<?php
include 'includes/db_connect.php';
include 'includes/header.php';

if (isset($_GET['id'])) {
    $id = mysqli_real_escape_string($conn, $_GET['id']);
    $query = "SELECT * FROM products WHERE id = $id";
    $result = mysqli_query($conn, $query);
    if (mysqli_num_rows($result) > 0) {
        $product = mysqli_fetch_assoc($result);
    } else {
        echo "<p class='error'>المنتج غير موجود</p>";
        include 'includes/footer.php';
        exit;
    }
} else {
    header('Location: index.php');
    exit;
}
?>

<h2><?php echo htmlspecialchars($product['name']); ?></h2>
<?php if ($product['image'] && file_exists($product['image'])) { ?>
    <img src="<?php echo $product['image']; ?>" alt="<?php echo htmlspecialchars($product['name']); ?>">
<?php } else { ?>
    <p>لا توجد صورة</p>
<?php } ?>
<p><?php echo htmlspecialchars($product['description']); ?></p>
<p>السعر: <?php echo $product['price']; ?> ل.س</p>
<a href="index.php">العودة إلى الرئيسية</a>

<?php include 'includes/footer.php'; ?>