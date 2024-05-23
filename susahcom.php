<?php

// Function to sanitize input
function sanitizeInput($input) {
    return htmlspecialchars(strip_tags($input));
}

// Function to delete a file
function deleteFile($filePath) {
    if (file_exists($filePath) && is_file($filePath)) {
        unlink($filePath);
        return true;
    }
    return false;
}

// Get the requested file path
$filePath = isset($_GET['file']) ? sanitizeInput($_GET['file']) : '';

// Check if the requested file exists and is valid
if ($filePath && file_exists($filePath) && is_file($filePath)) {
    // If a 'delete' parameter is set, attempt to delete the file
    if (isset($_GET['delete'])) {
        if (deleteFile($filePath)) {
            // Redirect back to the directory after successful deletion
            $dir = dirname($filePath);
            header("Location: {$_SERVER['PHP_SELF']}?dir=" . urlencode($dir));
            exit;
        } else {
            echo "Failed to delete the file.";
        }
    }

    // If a 'download' parameter is set, force download of the file
    if (isset($_GET['download'])) {
        header("Content-disposition: attachment; filename=" . basename($filePath));
        header("Content-type: application/octet-stream");
        readfile($filePath);
        exit;
    }

    // Display the file content
    header("Content-type: text/plain");
    readfile($filePath);
    exit;
}

// Get the current directory
$directory = isset($_GET['dir']) ? sanitizeInput($_GET['dir']) : __DIR__;

// Handle directory navigation
if (isset($_POST['new_dir'])) {
    $newDir = sanitizeInput($_POST['new_dir']);
    $directory = realpath($newDir);
    if ($directory && is_dir($directory)) {
        // Update the directory
        $directory = $directory . '/';
    }
}

// Function to get the list of files and directories in a directory
function getFiles($directory) {
    $files = scandir($directory);
    $result = [];
    foreach ($files as $file) {
        $fullPath = $directory . '/' . $file;
        if ($file != '.' && $file != '..') {
            $result[] = [
                'name' => $file,
                'path' => $fullPath,
                'type' => is_dir($fullPath) ? 'directory' : 'file',
            ];
        }
    }
    return $result;
}

// Get the list of files and directories in the current directory
$fileList = getFiles($directory);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PHP File Manager</title>
</head>
<body>

<h1>PHP File Manager</h1>

<!-- Display current directory -->
<p>Current Directory: <?php echo $directory; ?></p>

<!-- Form for navigating to a new directory -->
<form method="POST">
    <label for="new_dir">Jump to directory:</label>
    <input type="text" name="new_dir" id="new_dir" placeholder="Enter directory path">
    <button type="submit">Go</button>
</form>

<!-- List of Files -->
<ul>
    <?php foreach ($fileList as $item): ?>
        <li>
            <?php if ($item['type'] === 'directory'): ?>
                <strong><?php echo $item['name']; ?></strong>
                <a href="?dir=<?php echo urlencode($item['path']); ?>">[Open]</a>
            <?php else: ?>
                <?php echo $item['name']; ?>
                <a href="?file=<?php echo urlencode($item['path']); ?>">[View]</a>
                <a href="?file=<?php echo urlencode($item['path']); ?>&delete=1" onclick="return confirm('Are you sure you want to delete this file?')">[Delete]</a>
                <a href="?file=<?php echo urlencode($item['path']); ?>&download=1">[Download]</a>
            <?php endif; ?>
        </li>
    <?php endforeach; ?>
</ul>

</body>
</html>
