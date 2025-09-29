<?php
session_start();
    if (isset($_POST['clear_history'])) {
        $_SESSION['chat_history'] = [];
        echo json_encode(['history' => []]);
        exit;
    }
$products = [];
$conn = new mysqli('localhost', 'root', '', 'webnoithat');
$conn->set_charset("utf8");
$result = $conn->query("SELECT tensp, chatlieu,mau,hinhthuc,mota, gia FROM sanpham");
while ($row = $result->fetch_assoc()) {
    $products[] = "Tên: {$row['tensp']}, Chất liệu: {$row['chatlieu']}, Màu: {$row['mau']}, Hình thức: {$row['hinhthuc']}, Mô tả: {$row['mota']}, Giá: {$row['gia']} VNĐ";
}
$conn->close();
$productInfo = implode("\n", $products);

$response = '';
$userInput = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && !empty($_POST['userInput'])) {
    $apiKey = 'AIzaSyAmspt6g4Kav8XvA9_Dtx0_sdVPtNk0rI0';
    $prompt = "Bạn là nhân viên tư vấn bán hàng nội thất. Dưới đây là danh sách sản phẩm hiện có:\n$productInfo\nHãy chỉ trả lời các câu hỏi liên quan đến sản phẩm,
     tư vấn khách hàng dựa trên thông tin trên. Nếu câu hỏi không liên quan, hãy lịch sự từ chối.\nCâu hỏi khách hàng: " . $_POST['userInput'];
    $userInput = $_POST['userInput'];
    $url = 'https://generativelanguage.googleapis.com/v1beta/models/gemini-1.5-flash-latest:generateContent?key=' . $apiKey;

    $data = [
        'contents' => [
            [
                'parts' => [
                    ['text' => $prompt]
                ]
            ]
        ]
    ];

    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, [
        'Content-Type: application/json'
    ]);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));

    $result = curl_exec($ch);
    $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);

    if ($result === false) {
        $response = 'Lỗi khi gọi API: ' . curl_error($ch);
    } else {
        $jsonResponse = json_decode($result, true);
        if ($httpCode === 200 && isset($jsonResponse['candidates'][0]['content']['parts'][0]['text'])) {
            $response = $jsonResponse['candidates'][0]['content']['parts'][0]['text'];
        } else {
            $errorMsg = isset($jsonResponse['error']['message']) ? $jsonResponse['error']['message'] : 'Không xác định';
            $response = "Lỗi khi gọi API (HTTP $httpCode): $errorMsg";
        }
    }

    // Lưu vào session
    $_SESSION['chat_history'][] = ['role' => 'user', 'text' => $userInput];
    $_SESSION['chat_history'][] = ['role' => 'bot', 'text' => $response];

    // Trả về JSON cho JS
    echo json_encode([
        'user' => $userInput,
        'bot' => $response,
        'history' => $_SESSION['chat_history']
    ]);
    exit;

    // Xử lý xóa lịch sử chat

}
?>