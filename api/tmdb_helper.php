<?php
// 1. Định nghĩa API Key và URL gốc
define('TMDB_API_KEY', '31467640e90c18ee16fab8bf8993dd38');
define('TMDB_BASE_URL', 'https://api.themoviedb.org/3/');

/**
 * Hàm gọi API TMDB tổng quát sử dụng cURL
 */
function getMovieData($endpoint, $page = 1, $additionalParams = []) {
    $defaultParams = [
        'api_key'  => TMDB_API_KEY,
        'language' => 'vi-VN',
        'page'     => $page 
    ];
    
    $allParams = array_merge($defaultParams, $additionalParams);
    $queryString = http_build_query($allParams);
    $fullUrl = TMDB_BASE_URL . $endpoint . '?' . $queryString;

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $fullUrl);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_TIMEOUT, 15);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false); 

    $response = curl_exec($ch);
    curl_close($ch);

    return json_decode($response, true);
}

/**
 * Hàm lấy mã video YouTube
 */
function getMovieVideos($movieId) {
    $endpoint = "movie/" . $movieId . "/videos";
    
    // Gọi hàm getMovieData thay vì callApi để lấy video đa ngôn ngữ
    $data = getMovieData($endpoint, 1, [
        'include_video_language' => 'vi,en,null' 
    ]);
    
    if (isset($data['results']) && !empty($data['results'])) {
        $videos = $data['results'];

        // Ưu tiên Trailer tiếng Việt
        foreach ($videos as $video) {
            if ($video['iso_639_1'] === 'vi' && $video['type'] === 'Trailer' && $video['site'] === 'YouTube') {
                return $video['key'];
            }
        }

        // Ưu tiên Trailer tiếng Anh/Gốc
        foreach ($videos as $video) {
            if ($video['type'] === 'Trailer' && $video['site'] === 'YouTube') {
                return $video['key'];
            }
        }

        // Lấy đại video YouTube đầu tiên nếu không tìm thấy trailer
        foreach ($videos as $video) {
            if ($video['site'] === 'YouTube') {
                return $video['key'];
            }
        }
    }
    
    return null;
}
?>