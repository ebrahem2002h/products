<?php
include 'includes/db_connect.php';
include 'includes/header.php';

if (!isset($_SESSION['user_id']) || $_SESSION['role'] != 'admin') {
    header('Location: index.php');
    exit;
}

if (isset($_GET['delete'])) {
    $id = mysqli_real_escape_string($conn, $_GET['delete']);
    if ($id != $_SESSION['user_id']) {
        mysqli_query($conn, "DELETE FROM users WHERE id = $id");
    }
    header('Location: users.php');
    exit;
}

$query = "SELECT * FROM users";
$result = mysqli_query($conn, $query);
?>

<h2>إدارة المستخدمين</h2>
<table>
    <tr>
        <th>المعرف</th>
        <th>اسم المستخدم</th>
        <th>البريد الإلكتروني</th>
        <th>الدور</th>
        <th>إجراءات</th>
    </tr>
    <?php while ($row = mysqli_fetch_assoc($result)) { ?>
        <tr>
            <td><?php echo $row['id']; ?></td>
            <td><?php echo htmlspecialchars($row['username']); ?></td>
            <td><?php echo htmlspecialchars($row['email']); ?></td>
            <td><?php echo $row['role'] == 'admin' ? 'إداري' : 'مستخدم'; ?></td>
            <td>
                <?php if ($row['id'] != $_SESSION['user_id']) { ?>
                    <a href="users.php?delete=<?php echo $row['id']; ?>" onclick="return confirm('هل أنت متأكد؟')">حذف</a>
                <?php } ?>
            </td>
        </tr>
    <?php } ?>
</table>

<?php include 'includes/footer.php'; ?>