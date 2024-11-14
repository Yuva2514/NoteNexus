<?php
include 'config.php';
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

if (isset($_GET['id'])) {
    $noteId = $_GET['id'];

    // Prepare the SQL statement to delete the note
    $stmt = $pdo->prepare("DELETE FROM notes WHERE id = :id AND user_id = :user_id");
    $stmt->execute(['id' => $noteId, 'user_id' => $_SESSION['user_id']]);

    // Redirect back to the notes page after deletion
    header("Location: index.php");
    exit();
} else {
    // Handle the case where no ID is provided
    header("Location: index.php");
    exit();
}
?>
