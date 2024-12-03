<?php
include 'config.php';

$sql = "SELECT * FROM posts ORDER BY created_at DESC";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <title>게시판</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h1>게시판</h1>
    <a href="create.php">새 글 작성</a>
    <table>
        <tr>
            <th>제목</th>
            <th>작성일</th>
            <th>액션</th>
        </tr>
        <?php while($row = $result->fetch_assoc()): ?>
        <tr>
            <td><?php echo htmlspecialchars($row['title']); ?></td>
            <td><?php echo $row['created_at']; ?></td>
            <td>
                <a href="view.php?id=<?php echo $row['id']; ?>">보기</a>
                <a href="edit.php?id=<?php echo $row['id']; ?>">수정</a>
                <a href="delete.php?id=<?php echo $row['id']; ?>" onclick="return confirm('정말 삭제하시겠습니까?');">삭제</a>
            </td>
        </tr>
        <?php endwhile; ?>
    </table>
</body>
</html>