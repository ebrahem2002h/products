<?php
include 'includes/db_connect.php';
include 'includes/header.php';

if (!isset($_SESSION['user_id']) && false) {
    header('Location: login.php');
    exit;
}

$query = "SELECT * FROM products";
$result = mysqli_query($conn, $query);

if (!$result) {
    echo "<p class='text-danger text-center'>خطأ في جلب المنتجات: " . mysqli_error($conn) . "</p>";
    include 'includes/footer.php';
    exit;
}
?>

<section class="products-section">
    <h2 class="text-center mb-5 fw-bold display-5 text-white">المنتجات المتوفرة</h2>
    <div class="row row-cols-1 row-cols-md-3 row-cols-lg-4 g-4">
        <?php if (mysqli_num_rows($result) > 0) { ?>
            <?php while ($row = mysqli_fetch_assoc($result)) { ?>
                <div class="col">
                    <div class="card product-card h-100 text-center">
                        <?php
                        $image_path = htmlspecialchars(trim($row['image']));
                        if (!empty($image_path)) {
                            echo "<img src='$image_path' alt='" . htmlspecialchars($row['name']) . "' class='card-img-top' onerror=\"this.onerror=null;this.src='images/placeholder.jpg';this.alt='لا توجد صورة';this.style='height:200px; line-height:200px; text-align:center; font-size:16px; color:#888;';\">";
                        } else {
                            echo "<div style='height:200px; line-height:200px; text-align:center; font-size:16px; color:#888; background: #f5f5f5;'>لا توجد صورة</div>";
                        }
                        ?>
                        <div class="card-body d-flex flex-column">
                            <h3 class="card-title"><?php echo htmlspecialchars($row['name']); ?></h3>
                            <p class="card-text description"><?php echo htmlspecialchars($row['description']); ?></p>
                            <p class="card-text price">السعر: <?php echo htmlspecialchars($row['price']); ?>
                                <?php echo $currency; ?>
                            </p>
                            <a href="product.php?id=<?php echo htmlspecialchars($row['id']); ?>"
                                class="btn btn-primary mt-auto">عرض التفاصيل</a>
                        </div>
                    </div>
                </div>
            <?php } ?>
        <?php } else { ?>
            <p class="text-center text-white">لا توجد منتجات متاحة حاليًا.</p>
        <?php } ?>
    </div>
</section>

<?php
mysqli_close($conn);
include 'includes/footer.php';
?>