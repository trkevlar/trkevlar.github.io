<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Collect form data
    $username = htmlspecialchars($_POST['username']);
    $age = (int)$_POST['age'];
    $password = htmlspecialchars($_POST['password']);
    
    // Handle file upload
    if (isset($_FILES['file'])) {
        $file = $_FILES['file'];
        $uploadDir = 'uploads/';
        $uploadFile = $uploadDir . date('Y-m-d H.i.s') . '.' . pathinfo($file['name'], PATHINFO_EXTENSION);

        // Check file size (max 2MB)
        if ($file['size'] > 2000000) {
            echo "File is too large. Maximum size is 2MB.";
            exit;
        }

        // Upload file
        if (move_uploaded_file($file['tmp_name'], $uploadFile)) {
            echo "File uploaded successfully!<br>";
        } else {
            echo "File upload failed.<br>";
        }
    }

    // Display submitted data
    echo "<h2>Form Data Submitted:</h2>";
    echo "Username: $username<br>";
    echo "Age: $age<br>";
    echo "Password: $password<br>";
    echo "Uploaded file: " . basename($uploadFile);
} else {
    echo "Invalid request method!";
}
?>
