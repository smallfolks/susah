<?php

// Function to sanitize input
function sanitizeInput($input) {
    return htmlspecialchars(strip_tags($input));
}

// Get the requested file path
$filePath = isset($_GET['file']) ? sanitizeInput($_GET['file']) : '';

// Check if the requested file exists
if ($filePath && file_exists($filePath) && is_file($filePath)) {
    // Display the file content
    header("Content-type: text/plain");
    readfile($filePath);
    exit;
}

// Get the current directory
$directory = isset($_GET['dir']) ? sanitizeInput($_GET['dir']) : __DIR__;

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
            <?php endif; ?>
        </li>
    <?php endforeach; ?>
</ul>

</body>
</html>
