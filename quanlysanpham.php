<?php include "head.php" ?>
<?php
$conn = new mysqli("localhost", "root", "", "webnoithat");
$conn->set_charset("utf8");
if ($conn->connect_error) die("Kết nối thất bại: " . $conn->connect_error);

$msg = "";

// thêm
if (isset($_POST['them'])) {
    $masp=$_POST['masp']; 
    $maloai=$_POST['maloai']; 
    $tensp=$_POST['tensp'];
    $chatlieu=$_POST['chatlieu']; 
    $mau=$_POST['mau']; 
    $hinhthuc=$_POST['hinhthuc'];
    $mota=$_POST['mota']; 
    $gia=$_POST['gia']; 
    $anh=$_POST['anh'];

    $sql="INSERT INTO sanpham(masp,maloai,tensp,chatlieu,mau,hinhthuc,mota,gia,anh) 
          VALUES('$masp','$maloai','$tensp','$chatlieu','$mau','$hinhthuc','$mota','$gia','$anh')";
    $msg = $conn->query($sql) ? "✅ Thêm thành công" : "❌ Lỗi: ".$conn->error;
}

// cập nhật
if (isset($_POST['capnhat'])) {
    $id=$_POST['masp'];
    $sql="UPDATE sanpham SET 
            maloai='{$_POST['maloai']}', tensp='{$_POST['tensp']}',
            chatlieu='{$_POST['chatlieu']}', mau='{$_POST['mau']}',
            hinhthuc='{$_POST['hinhthuc']}', mota='{$_POST['mota']}',
            gia='{$_POST['gia']}', anh='{$_POST['anh']}'
          WHERE masp='$id'";
    $msg = $conn->query($sql) ? "✅ Cập nhật thành công" : "❌ Lỗi: ".$conn->error;
}

// xóa
if (isset($_GET['xoa'])) {
    $id=$_GET['xoa'];
    $conn->query("DELETE FROM sanpham WHERE masp='$id'");
    $msg="🗑️ Đã xóa sản phẩm";
}

$products=$conn->query("SELECT * FROM sanpham ORDER BY masp DESC");
?>
<!DOCTYPE html>
<html lang="vi">
<head>
  <meta charset="UTF-8">
  <title>Quản lý sản phẩm</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <script>
    function previewImage() {
      let url=document.getElementById("anh").value;
      let img=document.getElementById("imgPreview");
      img.src=url; img.style.display=url? "block":"none";
    }
  </script>
</head>
<body class="bg-gray-100">
  <div class="max-w-6xl mx-auto py-8">
    <h1 class="text-3xl font-bold mb-6 text-center">Quản lý sản phẩm</h1>
    
    <!-- Form thêm -->
    <div class="bg-white shadow p-6 rounded-lg mb-8">
      <h2 class="text-xl font-bold mb-4">Thêm sản phẩm</h2>
      <form method="post" class="grid grid-cols-1 md:grid-cols-2 gap-4">
        <input name="masp" placeholder="Mã SP" class="border p-2">
        <input name="maloai" placeholder="Mã Loại" class="border p-2">
        <input name="tensp" placeholder="Tên SP" class="border p-2 md:col-span-2">
        <input name="chatlieu" placeholder="Chất liệu" class="border p-2">
        <input name="mau" placeholder="Màu" class="border p-2">
        <input name="hinhthuc" placeholder="Hình thức" class="border p-2 md:col-span-2">
        <textarea name="mota" placeholder="Mô tả" class="border p-2 md:col-span-2"></textarea>
        <input name="gia" placeholder="Giá" class="border p-2">
        <input id="anh" name="anh" placeholder="Link ảnh" oninput="previewImage()" class="border p-2 md:col-span-2">
        <img id="imgPreview" class="max-h-40 hidden md:col-span-2">
        <button type="submit" name="them" class="bg-blue-600 text-white px-4 py-2 rounded md:col-span-2">Thêm</button>
      </form>
    </div>

    <!-- Thông báo -->
    <?php if($msg): ?><p class="text-center mb-6 font-semibold"><?= $msg ?></p><?php endif; ?>

    <!-- Danh sách sản phẩm -->
    <h2 class="text-xl font-bold mb-4">Danh sách sản phẩm</h2>
  <div class="max-w-6xl mx-auto p-4 bg-white border rounded-lg shadow overflow-auto">
  <table class="w-full text-gray-700">
    <thead class="bg-gray-200 uppercase text-gray-600 text-xs font-semibold">
      <tr>
        <th class="p-2 text-left border-b">Mã</th>
        <th class="p-2 text-left border-b">Tên</th>
        <th class="p-2 text-right border-b">Giá</th>
        <th class="p-2 text-center border-b">Ảnh</th>
        <th class="p-2 text-center border-b">Hành động</th>
      </tr>
    </thead>
    <tbody>
      <?php while($row=$products->fetch_assoc()): ?>
      <tr class="hover:bg-gray-50">
        <td class="p-2 border-b"><?= $row['masp'] ?></td>
        <td class="p-2 text-xs truncate max-w-xs border-b"><?= $row['tensp'] ?></td>
        <td class="p-2 text-right text-xs border-b"><?= number_format($row['gia'],0,',','.') ?> đ</td>
        <td class="p-2 text-center border-b"><img src="<?= $row['anh'] ?>" class="h-24 mx-auto"></td>
        <td class="p-2 text-center border-b">
          <form method="post" class="flex flex-col gap-1 mb-1">
            <input type="hidden" name="masp" value="<?= $row['masp'] ?>">
            <input type="text" name="maloai" value="<?= $row['maloai'] ?>" class="border p-1 text-sm" placeholder="Mã loại">
            <input type="text" name="tensp" value="<?= $row['tensp'] ?>" class="border p-1 text-sm" placeholder="Tên SP">
            <input type="text" name="chatlieu" value="<?= $row['chatlieu'] ?>" class="border p-1 text-sm" placeholder="Chất liệu">
            <input type="text" name="mau" value="<?= $row['mau'] ?>" class="border p-1 text-sm" placeholder="Màu">
            <input type="text" name="hinhthuc" value="<?= $row['hinhthuc'] ?>" class="border p-1 text-sm" placeholder="Hình thức">
            <textarea name="mota" class="border p-1 text-sm" placeholder="Mô tả"><?= $row['mota'] ?></textarea>
            <input type="text" name="gia" value="<?= $row['gia'] ?>" class="border p-1 text-sm" placeholder="Giá">
            <input type="text" name="anh" value="<?= $row['anh'] ?>" class="border p-1 text-sm" placeholder="Link ảnh">
            <div class="flex gap-2 mt-1 justify-center">
              <button name="capnhat" class="bg-green-500 text-white px-2 py-1 rounded text-sm">Sửa</button>
              <a href="?xoa=<?= $row['masp'] ?>" onclick="return confirm('Xóa sản phẩm này?')" 
                 class="bg-red-500 text-white px-2 py-1 rounded text-sm">Xóa</a>
            </div>
          </form>
        </td>
      </tr>
      <?php endwhile; ?>
    </tbody>
  </table>
</div>



  </div>
</body>
</html>
