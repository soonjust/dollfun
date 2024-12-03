<?php
include 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $title = $_POST['title'];
    $content = $_POST['content'];
    $image_path = '';
    $video_path = '';

    // 이미지 업로드 처리
    if(isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
        $target_dir = "uploads/";
        $image_path = $target_dir . basename($_FILES["image"]["name"]);
        move_uploaded_file($_FILES["image"]["tmp_name"], $image_path);
    }

    // 동영상 업로드 처리
    if(isset($_FILES['video']) && $_FILES['video']['error'] == 0) {
        $target_dir = "uploads/";
        $video_path = $target_dir . basename($_FILES["video"]["name"]);
        move_uploaded_file($_FILES["video"]["tmp_name"], $video_path);
    }

    $sql = "INSERT INTO posts (title, content, image_path, video_path) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssss", $title, $content, $image_path, $video_path);
    
    if ($stmt->execute()) {
        header("Location: index.php");
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <title>새 글 작성</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h1>새 글 작성</h1>
    <form method="post" enctype="multipart/form-data">
        <label for="title">제목:</label><br>
        <input type="text" id="title" name="title" required><br><br>
        <label for="content">내용:</label><br>
        <textarea id="content" name="content" required></textarea><br><br>
        <label for="image">이미지:</label><br>
        <input type="file" id="image" name="image" accept="image/*"><br><br>
        <label for="video">동영상:</label><br>
        <input type="file" id="video" name="video" accept="video/*"><br><br>
        <input type="submit" value="작성">
    </form>
    <a href="index.php">목록으로</a>
</body>
</html>