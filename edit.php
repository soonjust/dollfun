<?php
include 'config.php';

$id = $_GET['id'];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $title = $_POST['title'];
    $content = $_POST['content'];
    
    $sql = "UPDATE posts SET title = ?, content = ? WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssi", $title, $content, $id);
    
    if ($stmt->execute()) {
        header("Location: view.php?id=$id");
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
} else {
    $sql = "SELECT * FROM posts WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $post = $result->fetch_assoc();
}
?>

<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <title>글 수정</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h1>글 수정</h1>
    <form method="post">
        <label for="title">제목:</label><br>
        <input type="text" id="title" name="title" value="<?php echo htmlspecialchars($post['title']); ?>" required><br><br>
        <label for="content">내용:</label><br>
        <textarea id="content" name="content" required><?php echo htmlspecialchars($post['content']); ?></textarea><br><br>
        <input type="submit" value="수정">
    </form>
    <a href="index.php">목록으로</a>
</body>
</html>