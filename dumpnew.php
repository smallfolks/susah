d<?php
// Konfigurasi database
$host = "127.0.0.1";
$user = "u963859540_siqurban";
$pass = "u963859540_siqurban";
$db   = "u963859540_siqurban";

// Nama file backup
$backup_file = "backup_" . $db . "_" . date("Ymd_His") . ".sql";

// Jalankan mysqldump lewat shell
$command = "mysqldump -h $host -u $user -p$pass $db > $backup_file";

// Eksekusi perintah
system($command, $output);

// Cek hasil
if (file_exists($backup_file)) {
    echo "Backup berhasil: <a href='$backup_file'>$backup_file</a>";
} else {
    echo "Backup gagal.";
}
?>
