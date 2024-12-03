<?php
include 'config.php';

$id = $_GET['id'];

// 파일 삭제
$sql = "SELECT image_path, video_path FROM posts WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
$post = $result->fetch_assoc();

if (!empty($post['image_path']) && file_exists($post['image_path'])) {
    unlink($post['image_path']);
}
if (!empty($post['video_path']) && file_exists($post['video_path'])) {
    unlink($post['video_path']);
}

// 게시글 삭제
$sql = "DELETE FROM posts WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id);

if ($stmt->execute()) {
    header("Location: index.php");
    exit();
} else {
    echo "Error deleting record: " . $conn->error;
}

$conn->close();
?>