<?php
header("Content-Type: application/sql");
header("Content-Disposition: attachment; filename=\"backup_" . date("Ymd_His") . ".sql\"");

$mysqli = new mysqli("127.0.0.1", "u963859540_siqurban_mbrkh", "u963859540_siqurban_mbrkh", "u963859540_siqurban_mbrkh");
if ($mysqli->connect_error) die("Koneksi gagal");

$res = $mysqli->query("SHOW TABLES");
while ($row = $res->fetch_array()) {
    $table = $row[0];

    $create = $mysqli->query("SHOW CREATE TABLE `$table`")->fetch_assoc();
    echo "-- Struktur untuk $table\n";
    echo $create['Create Table'] . ";\n\n";

    $data = $mysqli->query("SELECT * FROM `$table`");
    while ($r = $data->fetch_assoc()) {
        $vals = array_map([$mysqli, 'real_escape_string'], array_values($r));
        $vals = array_map(fn($v) => "'$v'", $vals);
        echo "INSERT INTO `$table` VALUES (" . implode(",", $vals) . ");\n";
    }
    echo "\n";
}
?>
