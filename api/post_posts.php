<?php
header('Content-Type: application/json');
require_once 'koneksi.php';

$response = ['status' => false, 'data' => null, 'message' => ''];

try {
    $data = json_decode(file_get_contents('php://input'), true);
    
    if (!isset($data['title']) || !isset($data['content']) || !isset($data['slug'])) {
        throw new Exception('Required fields are missing');
    }

    $uid = uniqid();
    $title = $data['title'];
    $content = $data['content'];
    $slug = $data['slug'];
    $category_id = $data['category_id'] ?? null;
    $thumbnail = $data['thumbnail'] ?? null;
    $tags = $data['tags'] ?? [];

    $stmt = $conn->prepare("INSERT INTO posts (uid, title, content, slug, category_id, thumbnail) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssssss", $uid, $title, $content, $slug, $category_id, $thumbnail);
    
    if ($stmt->execute()) {
        $post_id = $conn->insert_id;
        
        // Insert tags
        if (!empty($tags)) {
            $tag_stmt = $conn->prepare("INSERT INTO post_tags (post_id, tag_id) VALUES (?, ?)");
            foreach ($tags as $tag_id) {
                $tag_stmt->bind_param("ii", $post_id, $tag_id);
                $tag_stmt->execute();
            }
            $tag_stmt->close();
        }
        
        $response['status'] = true;
        $response['message'] = 'Post created successfully';
        $response['data'] = ['id' => $post_id, 'uid' => $uid];
    }
    
    $stmt->close();
} catch(Exception $e) {
    $response['message'] = $e->getMessage();
}

echo json_encode($response);
$conn->close();
