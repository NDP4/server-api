<?php
header('Content-Type: application/json');
require_once 'koneksi.php';

$response = ['status' => false, 'data' => null, 'message' => ''];

try {
    $data = json_decode(file_get_contents('php://input'), true);
    
    if (!isset($data['id'])) {
        throw new Exception('Post ID is required');
    }

    $updates = [];
    $params = [];
    $types = '';

    if (isset($data['title'])) {
        $updates[] = 'title = ?';
        $params[] = $data['title'];
        $types .= 's';
    }
    if (isset($data['content'])) {
        $updates[] = 'content = ?';
        $params[] = $data['content'];
        $types .= 's';
    }
    if (isset($data['slug'])) {
        $updates[] = 'slug = ?';
        $params[] = $data['slug'];
        $types .= 's';
    }
    if (isset($data['category_id'])) {
        $updates[] = 'category_id = ?';
        $params[] = $data['category_id'];
        $types .= 'i';
    }
    if (isset($data['thumbnail'])) {
        $updates[] = 'thumbnail = ?';
        $params[] = $data['thumbnail'];
        $types .= 's';
    }

    if (!empty($updates)) {
        $query = "UPDATE posts SET " . implode(', ', $updates) . " WHERE id = ?";
        $stmt = $conn->prepare($query);
        
        $params[] = $data['id'];
        $types .= 'i';
        
        $stmt->bind_param($types, ...$params);
        
        if ($stmt->execute()) {
            // Update tags if provided
            if (isset($data['tags'])) {
                $conn->query("DELETE FROM post_tags WHERE post_id = {$data['id']}");
                
                if (!empty($data['tags'])) {
                    $tag_stmt = $conn->prepare("INSERT INTO post_tags (post_id, tag_id) VALUES (?, ?)");
                    foreach ($data['tags'] as $tag_id) {
                        $tag_stmt->bind_param("ii", $data['id'], $tag_id);
                        $tag_stmt->execute();
                    }
                    $tag_stmt->close();
                }
            }
            
            $response['status'] = true;
            $response['message'] = 'Post updated successfully';
        }
        $stmt->close();
    }
} catch(Exception $e) {
    $response['message'] = $e->getMessage();
}

echo json_encode($response);
$conn->close();
