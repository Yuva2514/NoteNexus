<?php
include 'config.php';
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];
$stmt = $pdo->prepare("SELECT * FROM notes WHERE user_id = :user_id");
$stmt->execute(['user_id' => $user_id]);
$notes = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html>
<head>
    <title>My Notes</title>
<link rel="stylesheet" type="text/css" href="styles.css">
</head>
<body>
    <h2>My Notes</h2>
    <a href="logout.php">Logout</a>
    <a href="index.php">Add New Note</a>
    <ul>
        <?php foreach ($notes as $note): ?>
            <li>
                <p><?php echo htmlspecialchars($note['note_text']); ?></p>
                <?php if ($note['note_image_path']): ?>
                    <img src="<?php echo $note['note_image_path']; ?>" width="100">
                <?php endif; ?>
                <?php if ($note['note_video_path']): ?>
                    <video src="<?php echo $note['note_video_path']; ?>" width="200" controls></video>
                <?php endif; ?>
                <?php if ($note['note_audio_path']): ?>
                    <audio src="<?php echo $note['note_audio_path']; ?>" controls></audio>
                <?php endif; ?>
            </li>
        <?php endforeach; ?>
    </ul>
</body>
</html>
