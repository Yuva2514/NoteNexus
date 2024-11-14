<?php
include 'config.php';
session_start();

// Assuming you're receiving the note details via POST
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $note_title = $_POST['note_title'];
    $note_content = $_POST['note_content'];
    
    // Check if an image is uploaded
    $note_image_path = null; // Default value if no image is uploaded
    if (isset($_FILES['note_image']) && $_FILES['note_image']['error'] == UPLOAD_ERR_OK) {
        $target_dir = "uploads/";
        $note_image_path = $target_dir . basename($_FILES['note_image']['name']);
        
        // Move the uploaded file to the target directory
        if (move_uploaded_file($_FILES['note_image']['tmp_name'], $note_image_path)) {
            // File uploaded successfully
        } else {
            // Handle error
            echo "Error uploading file.";
        }
    }

    // Prepare and execute the insert statement
    $stmt = $pdo->prepare("INSERT INTO notes (user_id, note_title, note_content, note_image_path) VALUES (:user_id, :note_title, :note_content, :note_image_path)");
    
    $stmt->execute([
        'user_id' => $_SESSION['user_id'], // Assuming user_id is stored in session
        'note_title' => $note_title,
        'note_content' => $note_content,
        'note_image_path' => $note_image_path // This can be null if no image is uploaded
    ]);

    echo "Note saved successfully.";
}
?>
