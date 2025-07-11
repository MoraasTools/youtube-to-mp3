<?php
header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['url'])) {
  $youtubeUrl = trim($_POST['url']);
  if (filter_var($youtubeUrl, FILTER_VALIDATE_URL)) {
    $apiUrl = "https://youtube-mp36.p.rapidapi.com/dl?url=" . urlencode($youtubeUrl);
    $headers = [
      "X-RapidAPI-Key: b3882af6d1msh7ddd40505c58988p1e88a3jsn6f9a1aa9326f",
      "X-RapidAPI-Host: youtube-mp36.p.rapidapi.com"
    ];

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $apiUrl);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    $response = curl_exec($ch);
    curl_close($ch);

    $data = json_decode($response, true);
    if (isset($data['link'])) {
      echo json_encode(['success' => true, 'downloadUrl' => $data['link']]);
    } else {
      echo json_encode(['success' => false, 'error' => 'API response error.']);
    }
  } else {
    echo json_encode(['success' => false, 'error' => 'Invalid YouTube URL.']);
  }
} else {
  echo json_encode(['success' => false, 'error' => 'Invalid request.']);
}
?>
