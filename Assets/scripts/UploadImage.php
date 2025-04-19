<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
//define('ROOT_PATH', __DIR__);
require_once(__DIR__.'/../../Model/Query.php');

if (
    isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK &&
    isset($_POST['category']) && in_array($_POST['category'], ['image', 'slide', 'news', 'annonce'])
) {
    $category = $_POST['category'];
    $allowed = ['jpg', 'jpeg', 'png', 'webp'];
    $originalName = $_FILES['image']['name'];
    $ext = strtolower(pathinfo($originalName, PATHINFO_EXTENSION));

    if (!in_array($ext, $allowed)) {
        echo "❌ Invalid file type. Only JPG, PNG, and WEBP allowed.";
        exit;
    }

    // Format name: category_uniqid_timestamp.ext
    $uniqueName = $category . "_" . date("Ymd_His") . "_" . uniqid() . "." . $ext;
    $targetDir = __DIR__."/../img/uploads/";
    $targetPath = $targetDir . $uniqueName;

    if (!file_exists($targetDir)) {
        mkdir($targetDir, 0755, true);
    }

    if (move_uploaded_file($_FILES['image']['tmp_name'], $targetPath)) {
        $query = new Query(
            "INSERT INTO image (ImageLink) VALUES (:imagelink)",
            [
                [":imagelink", $targetPath, PDO::PARAM_STR]
            ]
        );
        $insertedId = $query->execute_query(PDO::FETCH_ASSOC);

        echo "✅ Upload successful.<br>";
        echo "📂 File: <strong>$targetPath</strong><br>";
        echo "🆔 Image ID: <strong>$insertedId</strong>";
    } else {
        echo "❌ Failed to move uploaded file.";
    }
} else {
    echo "⚠️ Please select an image and a valid category.";
    echo "<br>Debug: uploaded image :" . print_r($_FILES['image'], true);
        echo "<br>Debug: post value:" . print_r($_POST, true);
        echo "<br>Debug: file var:" . print_r($_FILES, true);
        echo "Debug: File size: " . $_FILES['image']['size'] . " bytes<br>";
        echo "Debug: Error code: " . $_FILES['image']['error'] . "<br>";
        echo "<br>Debug: image error:" . print_r($_FILES['image']['error'], true);
        echo "<br>Debug: category:" . print_r($_POST['category'] , true);
        echo "<br>Debug: category val:" . print_r(in_array($_POST['category'], ['image', 'slide', 'news', 'annonce']), true);
}
