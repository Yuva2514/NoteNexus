<?php
include 'config.php';
session_start();

if (!isset($_SESSION['user_id']) || !isset($_GET['note_id'])) {
    header("Location: login.php");
    exit();
}

$note_id = $_GET['note_id'];
$stmt = $pdo->prepare("SELECT * FROM notes WHERE id = :note_id");
$stmt->execute(['note_id' => $note_id]);
$note = $stmt->fetch();

if (!$note) {
    die("Note not found.");
}

$note_title = urlencode($note['note_title']);
$note_content = urlencode($note['note_content']);
$note_file_path = urlencode($note['note_file_path']);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Share Note</title>
</head>
<body>
    <h2>Share Note: <?php echo htmlspecialchars($note['note_title']); ?></h2>
    <p><?php echo htmlspecialchars($note['note_content']); ?></p>
    
    <h3>Share via:</h3>
    <a href="https://api.whatsapp.com/send?text=Title:%20<?php echo $note_title; ?>%0AContent:%20<?php echo $note_content; ?>%0AFile:%20<?php echo $note_file_path; ?>" target="_blank">WhatsApp</a>
    <a href="mailto:?subject=Check%20this%20note&body=Title:%20<?php echo $note_title; ?>%0AContent:%20<?php echo $note_content; ?>%0AFile:%20<?php echo $note_file_path; ?>">Email</a>
    
    <a href="index.php">Back to Notes</a>
</body>
</html>
