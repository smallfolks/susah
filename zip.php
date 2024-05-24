<?php
// Define the folder to be zipped
$folderToZip = '../../../../curve-pos';

// Define the name for the zip file
$zipFileName = 'curve.zip';

// Create a new ZipArchive object
$zip = new ZipArchive();

// Open the zip file for writing
if ($zip->open($zipFileName, ZipArchive::CREATE | ZipArchive::OVERWRITE) === TRUE) {
    // Add files recursively to the zip file
    $files = new RecursiveIteratorIterator(
        new RecursiveDirectoryIterator($folderToZip),
        RecursiveIteratorIterator::LEAVES_ONLY
    );

    foreach ($files as $name => $file) {
        if (!$file->isDir()) {
            $filePath = $file->getRealPath();
            $relativePath = substr($filePath, strlen($folderToZip) + 1);

            // Add file to the zip
            $zip->addFile($filePath, $relativePath);
        }
    }

    // Close zip
    $zip->close();

    echo "Zip file '$zipFileName' created successfully.";
} else {
    echo "Failed to create zip file.";
}
?>
