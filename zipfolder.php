<?php
// Set error reporting
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Path folder yang ingin di-zip (ubah sesuai kebutuhan)
$folderPath = "/home/u954020974/domains/"; // Ganti dengan path folder Anda
$zipFileName = "Business.zip"; // Nama file ZIP yang dihasilkan

// Fungsi untuk menambahkan folder ke file ZIP
function addFolderToZip($folderPath, $zip, $parentFolder = "") {
    $items = scandir($folderPath);

    foreach ($items as $item) {
        if ($item === "." || $item === "..") {
            continue;
        }

        $fullPath = $folderPath . DIRECTORY_SEPARATOR . $item;
        $relativePath = $parentFolder . $item;

        if (is_dir($fullPath)) {
            // Jika folder, tambahkan ke ZIP dan proses rekursif
            $zip->addEmptyDir($relativePath . "/");
            addFolderToZip($fullPath, $zip, $relativePath . "/");
        } else {
            // Jika file, tambahkan ke ZIP
            $zip->addFile($fullPath, $relativePath);
        }
    }
}

// Validasi folder
if (!is_dir($folderPath)) {
    die("Path '$folderPath' bukan direktori yang valid.");
}

// Buat file ZIP
$zip = new ZipArchive();
if ($zip->open($zipFileName, ZipArchive::CREATE | ZipArchive::OVERWRITE) !== true) {
    die("Gagal membuat file ZIP.");
}

// Tambahkan folder ke file ZIP
addFolderToZip($folderPath, $zip);

// Tutup file ZIP
$zip->close();

// Berikan file ZIP untuk diunduh
header('Content-Type: application/zip');
header('Content-Disposition: attachment; filename="' . basename($zipFileName) . '"');
header('Content-Length: ' . filesize($zipFileName));

// Baca file ZIP dan kirim ke browser
readfile($zipFileName);

// Hapus file ZIP setelah diunduh
unlink($zipFileName);
?>
