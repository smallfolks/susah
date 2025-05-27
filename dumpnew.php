<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

$mysqli = new mysqli("127.0.0.1", "u963859540_siqurban_mbrkh", "u963859540_siqurban_mbrkh", "u963859540_siqurban_mbrkh");
if ($mysqli->connect_error) die("Koneksi gagal: " . $mysqli->connect_error);

$table = 'nama_tabelmu'; // Ganti dengan nama tabel nyata

header('Content-Type: text/csv');
header("Content-Disposition: attachment; filename=\"$table.csv\"");

$output = fopen("php://output", "w");

// Ambil kolom header
$res = $mysqli->query("SELECT * FROM `$table` LIMIT 1");
if ($res) {
    $fields = array_keys($res->fetch_assoc());
    fputcsv($output, $fields);
}

// Ambil semua data
$res = $mysqli->query("SELECT * FROM `$table`");
while ($row = $res->fetch_assoc()) {
    fputcsv($output, $row);
}

fclose($output);
exit;
