<?php
define('DEBUG_MODE', true); // Set to false in production
if (DEBUG_MODE) {
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);
} else {
    ini_set('display_errors', 0);
    ini_set('display_startup_errors', 0);
    error_reporting(0);
}
define('PROJECT_PATH', __DIR__ . '/../../'); // Adjust the path as needed
$is_image_uploaded = false;
# Update PROJECT_PATH and related paths if the script's directory changes.
$queryFilePath = PROJECT_PATH . 'Model/Query.php';
if (file_exists($queryFilePath)) {
    require_once($queryFilePath);
} else {
    die("❌ Error: Query.php file not found. Please check the path.");
}
$category = $_POST['category'];

// Define maximum file size (e.g., 10MB)
$maxFileSize = 10 * 1024 * 1024;

if ($_FILES['image']['size'] > $maxFileSize) {
    echo "❌ File size exceeds the maximum limit of 10MB.";
    exit;
}

if (
    isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK &&
    isset($_POST['category']) && in_array($_POST['category'], ['image', 'slide', 'news', 'annonce'])
) {
    // Define allowed file extensions
    $allowed = ['jpg', 'jpeg', 'png', 'webp'];
    // Get the category and original file name from the form
    $category = $_POST['category'];
    $originalName = $_FILES['image']['name'];
    // Check if the file is an image
    $ext = strtolower(pathinfo($originalName, PATHINFO_EXTENSION));

    if (!in_array($ext, $allowed)) {
        echo "❌ Invalid file type. Only JPG, PNG, and WEBP allowed.";
        echo "Debug: File extension: $ext";
        exit;
    }

    // Format name: category_uniqid_timestamp.ext
    $uniqueName = $category . "_" . date("Ymd_His") . "_" . uniqid() . "." . $ext;
    #TODO: CHANGE IF SCRIPT EMPLACEMENT CHANGES
    $targetDir = PROJECT_PATH . "Assets/img/uploads/";
    $targetPath = $targetDir . $uniqueName;

    if (!file_exists($targetDir)) {
        if (!mkdir($targetDir, 0755, true) && !is_dir($targetDir)) {
            die("❌ Failed to create directory: $targetDir");
        }
    }

    if (!is_writable($targetDir)) {
        die("❌ Error: Directory '$targetDir' is not writable. Please check permissions.");
    }

    if (move_uploaded_file($_FILES['image']['tmp_name'], $targetPath)) {
        // Sanitize the file path to prevent SQL injection
        $sanitizedPath = filter_var($targetPath, FILTER_SANITIZE_SPECIAL_CHARS);

        $query = new Query(
            "INSERT INTO image (ImageLink) VALUES (:imagelink)",
            [
                [':imagelink', $sanitizedPath, PDO::PARAM_STR]
            ]
        );

        $insertedId = $query->execute_query(PDO::FETCH_ASSOC);

        if ($insertedId === false) {
            echo "❌ Database query failed. Please check the query and database connection.<br>";
        } else {
            echo "✅ Upload successful.<br>";
            $is_image_uploaded = true;
        }
    } else {
        $error = error_get_last();
        echo "❌ Failed to move uploaded file.<br>";
        echo "📋 Error details: " . ($error ? $error['message'] : "Unknown error") . "<br>";
        echo "🔍 Check if the target directory exists and has the correct permissions.<br>";
        echo "💾 You May Also Ensure there is enough disk space available.";
    }
}
if (defined('DEBUG_MODE') && DEBUG_MODE && !$is_image_uploaded) {
    // Removed redundant debug output for in_array validation
    echo "<br>Debug: post value:" . print_r($_POST, true);
    echo "<br>Debug: file var:" . print_r($_FILES, true);
    echo "<br>Debug: File size: " . $_FILES['image']['size'] . " bytes<br>";
    echo "<br>Debug: Error code: " . $_FILES['image']['error'] . "<br>";
    echo "<br>Debug: image error:" . print_r($_FILES['image']['error'], true);
    echo "<br>Debug: category:" . print_r($_POST['category'], true);
    echo "<br>Debug: category val:" . print_r(in_array($_POST['category'], ['image', 'slide', 'news', 'annonce']), true);
}
