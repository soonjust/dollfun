<?php
include 'config.php';

$id = $_GET['id'];
$sql = "SELECT * FROM posts WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
$post = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <title><?php echo htmlspecialchars($post['title']); ?></title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h1><?php echo htmlspecialchars($post['title']); ?></h1>
    <p>작성일: <?php echo $post['created_at']; ?></p>
    <div><?php echo nl2br(htmlspecialchars($post['content'])); ?></div>
    
    <?php if(!empty($post['image_path'])): ?>
        <img src="<?php echo $post['image_path']; ?>" alt="Uploaded Image">
    <?php endif; ?>
    
    <?php if(!empty($post['video_path'])): ?>
        <video width="320" height="240" controls>
            <source src="<?php echo $post['video_path']; ?>" type="video/mp4">
            Your browser does not support the video tag.
        </video>
    <?php endif; ?>
    
    <br><br>
    <a href="index.php">목록으로</a> |
    <a href="edit.php?id=<?php echo $post['id']; ?>">수정</a> |
    <a href="delete.php?id=<?php echo $post['id']; ?>" onclick="return confirm('정말 삭제하시겠습니까?');">삭제</a>
</body>
</html>