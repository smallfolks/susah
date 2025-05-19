<?php
// Tingkatkan batas waktu eksekusi dan memori
set_time_limit(0); // Tidak ada batasan waktu eksekusi
ini_set('memory_limit', '512M'); // Atur batas memori menjadi 512M atau lebih sesuai kebutuhan

// Folder yang akan di-zip
$folderToZip = '/home/u366562226/domains/acnoo.com/public_html//pospro/Modules/Business';

// Nama file zip
$zipFileName = 'Business.zip';

// Buat objek ZipArchive baru
$zip = new ZipArchive();

// Buka file zip untuk penulisan
if ($zip->open($zipFileName, ZipArchive::CREATE | ZipArchive::OVERWRITE) === TRUE) {
    // Tambahkan file secara rekursif ke dalam zip file
    $files = new RecursiveIteratorIterator(
        new RecursiveDirectoryIterator($folderToZip),
        RecursiveIteratorIterator::LEAVES_ONLY
    );

    foreach ($files as $name => $file) {
        // Lewatkan direktori (akan ditambahkan secara otomatis)
        if (!$file->isDir()) {
            // Dapatkan path asli dan relatif dari file saat ini
            $filePath = $file->getRealPath();
            $relativePath = substr($filePath, strlen($folderToZip) + 1);

            // Tambahkan file saat ini ke arsip zip
            if (!$zip->addFile($filePath, $relativePath)) {
                echo "Gagal menambahkan file: $filePath\n";
            }
        }
    }

    // Tutup arsip zip untuk menyelesaikannya
    $zip->close();

    echo "File zip '$zipFileName' berhasil dibuat.";
} else {
    echo "Gagal membuat file zip.";
}
?>
