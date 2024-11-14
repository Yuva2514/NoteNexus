<?php
include 'config.php';
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $note_title = $_POST['note_title'];
    $note_content = $_POST['note_content'];
    $file_path = null;

    // Handle file upload
    if (isset($_FILES['note_file']) && $_FILES['note_file']['error'] == UPLOAD_ERR_OK) {
        $target_dir = "uploads/";
        $file_path = $target_dir . basename($_FILES['note_file']['name']);
        move_uploaded_file($_FILES['note_file']['tmp_name'], $file_path);
    }

    $stmt = $pdo->prepare("INSERT INTO notes (user_id, note_title, note_content, note_file_path) VALUES (:user_id, :note_title, :note_content, :note_file_path)");
    $stmt->execute([
        'user_id' => $_SESSION['user_id'],
        'note_title' => $note_title,
        'note_content' => $note_content,
        'note_file_path' => $file_path
    ]);

    header("Location: index.php");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Upload Note</title>
    <link rel="stylesheet" type="text/css" href="styles.css">
</head>
<body>
    <h2>Upload Note</h2>
    <form action="upload.php" method="POST" enctype="multipart/form-data">
        <label for="note_title">Title:</label>
        <input type="text" name="note_title" required>
        <label for="note_content">Content:</label>
        <textarea name="note_content" required></textarea>
        <label for="note_file">Upload File:</label>
        <input type="file" name="note_file" accept=".txt,.jpg,.mp3,.mp4" required>
        <button type="submit">Save Note</button>
    </form>
</body>
</html>
