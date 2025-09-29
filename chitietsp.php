<?php include "head.php" ?>
<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Database connection and product data retrieval
$msp = isset($_GET['masp']) ? $_GET['masp'] : '';  // Đổi từ 'id' thành 'masp'
$server = 'localhost';
$user = 'root';
$pass = '';
$database = 'webnoithat';

$conn = new mysqli($server, $user, $pass, $database);
$conn->set_charset("utf8");

// Fetch product details based on masp
$sql = "SELECT tensp, gia, chatlieu, mau, hinhthuc, mota, anh FROM sanpham WHERE masp = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $msp);
$stmt->execute();
$result = $stmt->get_result();
$product = $result->fetch_assoc();
$stmt->close();

$tentaikhoan = isset($_SESSION['username']) ? $_SESSION['username'] : null;

// Xử lý thêm vào giỏ hàng
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add_to_cart'])) {
    if (!$tentaikhoan) {
        echo "<script>alert('Bạn cần đăng nhập để sử dụng chức năng này!'); window.location='dangnhap.php';</script>";
        exit;
    }
    $soluong = max(1, intval($_POST['quantity-input'] ?? 1));
    $masp = $msp;
    $tensp = $product['tensp'] ?? '';
    $gia = $product['gia'] ?? 0;
    $anh = $product['anh'] ?? '';

    // Kiểm tra sản phẩm đã có trong giỏ chưa
    $check = $conn->prepare("SELECT soluong FROM giohang WHERE masp = ? AND tentaikhoan = ?");
    $check->bind_param("ss", $masp, $tentaikhoan);
    $check->execute();
    $check->store_result();
    if ($check->num_rows > 0) {
        // Đã có, cập nhật số lượng
        $update = $conn->prepare("UPDATE giohang SET soluong = soluong + ? WHERE masp = ? AND tentaikhoan = ?");
        $update->bind_param("iss", $soluong, $masp, $tentaikhoan);
        $update->execute();
        $update->close();
        echo "<script>alert('Cập nhật số lượng vào giỏ hàng thành công!');</script>";
    } else {
        // Thêm mới
        $insert = $conn->prepare("INSERT INTO giohang (masp, tensp, gia, soluong, tentaikhoan, anh) VALUES (?, ?, ?, ?, ?, ?)");
        $insert->bind_param("sssiss", $masp, $tensp, $gia, $soluong, $tentaikhoan, $anh);
        $insert->execute();
        $insert->close();
        echo "<script>alert('Thêm vào giỏ hàng thành công!');</script>";
    }
    $check->close();
}

// Xử lý mua ngay
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['buy_now'])) {
    if (!$tentaikhoan) {
        echo "<script>alert('Bạn cần đăng nhập để sử dụng chức năng này!'); window.location='dangnhap.php';</script>";
        exit;
    }
    $soluong = max(1, intval($_POST['quantity-input'] ?? 1));
    $masp = $msp;
    $tensp = $product['tensp'] ?? '';
    $gia = $product['gia'] ?? 0;
    $anh = $product['anh'] ?? '';

    // Thêm vào bảng đặt hàng
    $insert = $conn->prepare("INSERT INTO dathang (masp, tensp, gia, soluong, tentaikhoan, anh) VALUES (?, ?, ?, ?, ?, ?)");
    $insert->bind_param("sssiss", $masp, $tensp, $gia, $soluong, $tentaikhoan, $anh);
    $insert->execute();
    $insert->close();

    // Chuyển hướng sang trang quản lý đơn hàng
    echo "<script>alert('Đặt hàng thành công!'); window.location='dathang.php';</script>";
    exit;
}

$conn->close();
?>
<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chi tiết sản phẩm - Nội Thất Toàn Đạt</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: Arial, sans-serif;
        }

        :root {
            --primary-color: #7B4B37;
            --primary-color-light: #A67C68;
            --background-color: #e2ddcf;
        }

        body {
            background-color: var(--background-color);
        }

        .container {
            max-width: 1200px;
            margin: 40px auto;
            margin-bottom: 40px;
            padding: 20px;
            background-color: #fffaf1;
            border-radius: 12px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
        }

        .product-container {
            display: flex;
            gap: 40px;
            flex-wrap: wrap;
        }

        .product-image {
            flex: 1;
            aspect-ratio: 4 / 3;
            background: #f5f5f5;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 16px;
            overflow: hidden;
            position: relative;
        }

        .product-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            object-position: center;
            display: block;
            transition: opacity 0.3s ease;
            background: #fff;
        }

        .product-image .image-loading {
            position: absolute;
            display: none;
            font-size: 16px;
            color: #666;
        }

        .product-image img[loading="lazy"] {
            opacity: 0;
        }

        .product-image img.loaded {
            opacity: 1;
        }

        .product-info {
            flex: 1;
        }

        .product-title {
            font-size: 24px;
            margin-bottom: 10px;
            color: #000;
            font-weight: bold;
        }

        .product-price {
            color: #000;
            font-size: 32px;
            font-weight: bold;
            margin-bottom: 15px;
        }

        .discount {
            background-color: var(--primary-color-light);
            color: white;
            display: inline-block;
            padding: 4px 8px;
            border-radius: 6px;
            margin-bottom: 15px;
            font-weight: bold;
        }

        .specifications {
            margin-bottom: 15px;
        }

        .specifications h3 {
            font-size: 20px;
            margin-bottom: 10px;
            color: var(--primary-color);
        }

        .specifications table {
            width: 100%;
            border-collapse: collapse;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 0 5px rgba(0, 0, 0, 0.1);
        }

        .specifications th,
        .specifications td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }

        .specifications th {
            background-color: var(--primary-color-light);
            color: white;
        }

        .action-group {
            display: flex;
            flex-direction: column;
            gap: 10px;
            margin-top: 20px;
        }

        .quantity-cart-group {
            display: flex;
            gap: 10px;
        }

        .quantity-input {
            padding: 8px;
            border-radius: 8px;
            border: 1px solid #ccc;
            flex: 1;
        }

        .add-to-cart {
            background: none;
            border: 2px solid var(--primary-color);
            color: var(--primary-color);
            padding: 12px;
            font-size: 16px;
            cursor: pointer;
            flex: 2;
            text-align: center;
            border-radius: 8px;
        }

        .add-to-cart:hover {
            background-color: var(--primary-color-light);
            color: white;
        }

        .buy-now {
            background: var(--primary-color);
            border: none;
            color: #fff;
            padding: 12px;
            font-size: 16px;
            cursor: pointer;
            width: 100%;
            text-align: center;
            border-radius: 8px;
        }

        .buy-now:hover {
            background-color: var(--primary-color-light);
        }

        .description {
            margin-top: 40px;
        }

        .description h2 {
            margin-bottom: 20px;
            color: #000;
            font-weight: bold;
        }

        .description p {
            color: #000;
            font-weight: normal;
        }

        .error-message {
            background-color: #ffebee;
            color: #c62828;
            padding: 20px;
            border-radius: 8px;
            text-align: center;
            margin: 20px 0;
        }

        /* Responsive for mobile */
        @media (max-width: 768px) {
            .product-container {
                flex-direction: column;
            }

            .product-image {
                height: 300px;
            }
        }
    </style>
    <script>
        // Handle image loading
        document.addEventListener('DOMContentLoaded', function() {
            const img = document.querySelector('.product-image img');
            if (img) {
                if (img.complete) {
                    img.classList.add('loaded');
                } else {
                    img.addEventListener('load', function() {
                        img.classList.add('loaded');
                    });
                    img.addEventListener('error', function() {
                        img.src = 'images/fallback.jpg'; // Fallback image
                    });
                }
            }
        });
    </script>
</head>

<body>
    <div class="container">
        <?php if (!$product): ?>
            <div class="error-message">
                <h2>Sản phẩm không tồn tại</h2>
                <p>Mã sản phẩm: <?php echo htmlspecialchars($msp); ?></p>
                <p><a href="index.php">Quay lại trang chủ</a></p>
            </div>
        <?php else: ?>
            <div class="product-container">
                <div class="product-image">
                    <span class="image-loading">Đang tải...</span>
                    <img src="<?php echo htmlspecialchars($product['anh'] ?? 'images/fallback.jpg'); ?>" alt="Product Image" loading="lazy" />
                </div>
                <div class="product-info">
                    <h1 class="product-title"><?php echo htmlspecialchars($product['tensp'] ?? 'Sản phẩm không có tên'); ?></h1>

                    <div class="product-price">
                        <?php
                        $gia = isset($product['gia']) ? number_format($product['gia'], 0, ',', '.') : '0';
                        echo $gia . ' VNĐ';
                        ?>
                    </div>
                    <div class="discount">MÃ GIẢM GIÁ: 1K</div>

                    <div class="specifications">
                        <h3>THÔNG SỐ KỸ THUẬT</h3>
                        <table>
                            <tr>
                                <th>Chất liệu</th>
                                <td><?php echo htmlspecialchars($product['chatlieu'] ?? 'N/A'); ?></td>
                            </tr>
                            <tr>
                                <th>Màu sắc</th>
                                <td><?php echo htmlspecialchars($product['mau'] ?? 'N/A'); ?></td>
                            </tr>
                            <tr>
                                <th>Hình thức</th>
                                <td><?php echo htmlspecialchars($product['hinhthuc'] ?? 'N/A'); ?></td>
                            </tr>
                        </table>
                    </div>

                    <form method="post" class="action-group">
                        <div class="quantity-cart-group">
                            <input type="number" class="quantity-input" name="quantity-input" value="1" min="1">
                            <button type="submit" name="add_to_cart" class="add-to-cart">THÊM VÀO GIỎ HÀNG</button>
                        </div>
                        <button type="submit" name="buy_now" class="buy-now">MUA NGAY</button>
                    </form>
                </div>
            </div>

            <section class="description">
                <h2>MÔ TẢ SẢN PHẨM</h2>
                <p>
                    <?php echo htmlspecialchars($product['mota'] ?? 'Không có mô tả'); ?>
                </p>
            </section>
        <?php endif; ?>
    </div>
</body>

</html>