<?php include "head.php" ?>
<?php
// Kết nối MySQL
$servername = "localhost";
$username   = "root";
$password   = "";
$dbname     = "webnoithat";

$conn = new mysqli($servername, $username, $password, $dbname);
$conn->set_charset("utf8");

// Kiểm tra kết nối
if ($conn->connect_error) {
    die("Kết nối thất bại: " . $conn->connect_error);
}

// Truy vấn dữ liệu
$sql = "SELECT masp, tensp, chatlieu, mau, hinhthuc, mota, gia, anh FROM sanpham WHERE masp IS NOT NULL";
$result = $conn->query($sql);
?>
<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com?plugins=forms,typography"></script>
    <title>Sản phẩm</title>
    <style>
        body {
            background-color: #e5e0d8;
        }
    </style>
</head>

<body>
    <section class="p-8">
        <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mt-4">
            <?php if ($result && $result->num_rows > 0): ?>
                <?php while ($row = $result->fetch_assoc()): ?>
                    <?php
                    // Xử lý tên sản phẩm
                    $tensp = $row['tensp'] ?? 'Sản phẩm chưa có tên';
                    if (stripos($tensp, "INSERT INTO") !== false) {
                        $tensp = "Tên sản phẩm lỗi";
                    }

                    // Xử lý giá
                    $gia = $row['gia'] ?? '0';
                    $gia = preg_replace('/[^0-9]/', '', $gia);
                    $gia = (int)$gia;

                    // Xử lý ảnh
                    $anh = $row['anh'] ?? '';

                    if (empty($anh) || stripos($anh, "INSERT INTO") !== false) {
                        $duongdan = "no-image.png";
                    } elseif (preg_match('/^https?:\/\//', $anh)) {
                        $duongdan = $anh;
                    } else {
                        $duongdan = "anh/" . $anh;
                    }
                    ?>
                    <div class="border border-gray-300 p-4 rounded bg-white">
                        <img src="<?php echo htmlspecialchars($duongdan); ?>"
                            alt="Ảnh sản phẩm"
                            class="w-full h-40 object-cover rounded mb-2">
                        <h3 class="font-semibold mb-1"><?php echo htmlspecialchars($tensp); ?></h3>
                        <p class="text-red-600 font-bold mb-2">
                            <?php echo number_format($gia, 0, ',', '.'); ?> VND
                        </p>

                        <a href="chitietsp.php?masp=<?php echo urlencode($row['masp']); ?>">
                            <div class="bg-orange-600 text-white hover:bg-orange-500 p-2 rounded text-center" style="background-color:#CD853F">
                                Đặt hàng
                            </div>
                        </a>
                    </div>
                <?php endwhile; ?>
            <?php else: ?>
                <p>Không có sản phẩm nào.</p>
            <?php endif; ?>
        </div>
    </section>
</body>

</html>
<?php $conn->close(); ?>