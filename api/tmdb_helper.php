<?php

// Định nghĩa API Key của bạn tại đây
define('TMDB_API_KEY', '31467640e90c18ee16fab8bf8993dd38');
define('TMDB_BASE_URL', 'https://api.themoviedb.org/3/');





/**
 * Hàm gọi API TMDB sử dụng cURL
 */
function getMovieData($endpoint, $page = 1,$additionalParams = []) {
    // 1. Chuẩn bị tham số mặc định (luôn có API Key và tiếng Việt)
    $defaultParams = [
        'api_key' => TMDB_API_KEY,
        'language' => 'vi-VN',
        'page' => $page 
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
/**
 * Hàm lấy mã trailer YouTube từ TMDB
 */
function getMovieVideos($movieId) {
    $endpoint = "movie/" . $movieId . "/videos";
    // Thử lấy video tiếng Việt trước
    $data = getMovieData($endpoint, 1, ['language' => 'vi-VN']);
    
    // Nếu tiếng Việt không có video, thử lấy tiếng Anh (nguồn video dồi dào nhất)
    if (!isset($data['results']) || empty($data['results'])) {
        $data = getMovieData($endpoint, 1, ['language' => 'en-US']);
    }

    if (isset($data['results']) && !empty($data['results'])) {
        // Ưu tiên 1: Tìm đúng "Trailer" trên "YouTube"
        foreach ($data['results'] as $video) {
            if ($video['site'] === 'YouTube' && $video['type'] === 'Trailer') {
                return $video['key'];
            }
        }
        // Ưu tiên 2: Nếu không có Trailer, lấy đại video đầu tiên (Teaser, Clip...)
        foreach ($data['results'] as $video) {
            if ($video['site'] === 'YouTube') {
                return $video['key'];
            }
        }
    }
    return null; // Trường hợp cực hiếm: Phim không có bất cứ clip nào
}
?>