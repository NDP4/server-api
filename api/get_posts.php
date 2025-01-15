<?php
header('Content-Type: application/json');
require_once 'koneksi.php';

$response = ['status' => false, 'data' => [], 'message' => ''];

try {
    $query = "SELECT p.*, c.name as category_name, 
              GROUP_CONCAT(t.name) as tags
              FROM posts p 
              LEFT JOIN categories c ON p.category_id = c.id
              LEFT JOIN post_tags pt ON p.id = pt.post_id
              LEFT JOIN tags t ON pt.tag_id = t.id
              GROUP BY p.id";
    
    $result = $conn->query($query);
    
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            $row['tags'] = $row['tags'] ? explode(',', $row['tags']) : [];
            $response['data'][] = $row;
        }
        $response['status'] = true;
        $response['message'] = 'Data retrieved successfully';
    } else {
        $response['message'] = 'No posts found';
    }
} catch(Exception $e) {
    $response['message'] = $e->getMessage();
}

echo json_encode($response);
$conn->close();
