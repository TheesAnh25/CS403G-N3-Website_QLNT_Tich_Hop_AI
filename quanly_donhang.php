<?php include "head.php"; ?>
<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Kiểm tra quyền admin
if (!isset($_SESSION['username']) || $_SESSION['role'] !== 'admin') {
    header("Location: dangnhap.php");
    exit;
}

$conn = new mysqli('localhost', 'root', '', 'webnoithat');
$conn->set_charset("utf8");

// Xử lý duyệt/hủy đơn
if (isset($_GET['action']) && isset($_GET['id'])) {
    $id = intval($_GET['id']);
    if ($_GET['action'] === 'duyet') {
        $conn->query("UPDATE dathang SET trangthai='Đã duyệt' WHERE id=$id");
    } elseif ($_GET['action'] === 'huy') {
        $conn->query("UPDATE dathang SET trangthai='Đã hủy' WHERE id=$id");
    }
    header("Location: quanly_donhang.php");
    exit;
}

// Lấy tất cả đơn hàng
$result = $conn->query("SELECT * FROM dathang ORDER BY ngaydat DESC");
?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quản lý đơn hàng</title>
    <style>
        body { margin:0; padding:0; font-family:Arial,sans-serif; background:#fefaf0; min-height:100vh; }
        h2 { color:#7a5a00; margin:20px 0; font-size:2rem; text-align:center; }
        table { width:90%; max-width:1200px; border-collapse:collapse; background:#fffdf5;
                box-shadow:0 4px 8px rgba(0,0,0,0.05); margin:20px auto; }
        th, td { padding:12px; text-align:center; border:1px solid #e0d6c3; }
        th { background:#e5c07b; color:#4b3c00; font-weight:bold; }
        tr:nth-child(even){ background:#f9f5e8; }
        tr:hover{ background:#f1ecdc; }
        img { max-width:80px; border-radius:5px; }
        a.btn { padding:6px 12px; border-radius:4px; text-decoration:none; font-weight:bold; }
        a.duyet { background:#4CAF50; color:white; }
        a.huy { background:#f44336; color:white; }
    </style>
</head>
<body>
    <h2>Quản lý đơn hàng</h2>
    <table>
        <tr>
            <th>ID</th>
            <th>Mã SP</th>
            <th>Tên SP</th>
            <th>Giá</th>
            <th>Số lượng</th>
            <th>Tài khoản</th>
            <th>Ảnh</th>
            <th>Ngày đặt</th>
            <th>Trạng thái</th>
            <th>Hành động</th>
        </tr>
        <?php while($row = $result->fetch_assoc()): ?>
        <tr>
            <td><?= $row['id'] ?></td>
            <td><?= htmlspecialchars($row['masp']) ?></td>
            <td><?= htmlspecialchars($row['tensp']) ?></td>
            <td><?= number_format($row['gia'], 0, ',', '.') ?> VNĐ</td>
            <td><?= $row['soluong'] ?></td>
            <td><?= htmlspecialchars($row['tentaikhoan']) ?></td>
            <td><img src="<?= htmlspecialchars($row['anh']) ?>"></td>
            <td><?= $row['ngaydat'] ?></td>
            <td><?= $row['trangthai'] ?></td>
            <td>
                <?php if ($row['trangthai']=='Chờ xác nhận'): ?>
                    <a class="btn duyet" href="?action=duyet&id=<?= $row['id'] ?>">Duyệt</a>
                    <a class="btn huy" href="?action=huy&id=<?= $row['id'] ?>">Hủy</a>
                <?php else: ?>
                    <?= $row['trangthai'] ?>
                <?php endif; ?>
            </td>
        </tr>
        <?php endwhile; ?>
    </table>
</body>
</html>
