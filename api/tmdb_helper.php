<?php
// Định nghĩa API Key của bạn tại đây
define('TMDB_API_KEY', '31467640e90c18ee16fab8bf8993dd38');
define('TMDB_BASE_URL', 'https://api.themoviedb.org/3/');

/**
 * Hàm gọi API TMDB sử dụng cURL
 */
function getMovieData($endpoint, $additionalParams = []) {
    // 1. Chuẩn bị tham số mặc định (luôn có API Key và tiếng Việt)
    $defaultParams = [
        'api_key' => TMDB_API_KEY,
        'language' => 'vi-VN'
    ];
    
    // Gộp tham số mặc định với tham số người dùng truyền vào 
    $allParams = array_merge($defaultParams, $additionalParams);
    
    // Tạo chuỗi query: ?api_key=xxx&language=vi-VN&...
    $queryString = http_build_query($allParams);
    $fullUrl = TMDB_BASE_URL . $endpoint . '?' . $queryString;

    // 2. Khởi tạo cURL
    $ch = curl_init();

    // 3. Thiết lập các tùy chọn (Options)
    curl_setopt($ch, CURLOPT_URL, $fullUrl);              // URL cần gọi
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);       // Trả kết quả về biến, không in ra màn hình
    curl_setopt($ch, CURLOPT_TIMEOUT, 10);                // Hủy request nếu quá 10 giây (tránh treo server)
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);      // Quan trọng: Bỏ qua lỗi SSL nếu chạy trên localhost

    // 4. Thực thi và lấy kết quả
    $response = curl_exec($ch);

    // 5. Kiểm tra lỗi kỹ thuật (nếu có)
    if (curl_errno($ch)) {
        $error_msg = curl_error($ch);
        curl_close($ch);
        return ["error" => "Lỗi kết nối: $error_msg"];
    }

    // 6. Đóng cURL
    curl_close($ch);

    // 7. Chuyển đổi JSON sang mảng PHP và trả về
    return json_decode($response, true);
}

?>