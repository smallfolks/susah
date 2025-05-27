<?php
$mysqli = new mysqli("localhost", "u963859540_siqurban_mbrkh", "u963859540_siqurban_mbrkh", "u963859540_siqurban_mbrkh");
$dir = "backup/";
if (!is_dir($dir)) mkdir($dir);

$filename = $dir . "backup_" . date("Ymd_His") . ".sql";
$content = "";
$res = $mysqli->query("SHOW TABLES");
while ($r = $res->fetch_array()) {
    $table = $r[0];
    $res2 = $mysqli->query("SHOW CREATE TABLE `$table`");
    $row2 = $res2->fetch_assoc();
    $content .= "-- Tabel $table\n" . $row2['Create Table'] . ";\n\n";

    $res3 = $mysqli->query("SELECT * FROM `$table`");
    while ($row3 = $res3->fetch_assoc()) {
        $vals = array_map([$mysqli, 'real_escape_string'], array_values($row3));
        $vals = array_map(fn($v) => "'$v'", $vals);
        $content .= "INSERT INTO `$table` VALUES (" . implode(",", $vals) . ");\n";
    }
    $content .= "\n\n";
}
file_put_contents($filename, $content);
echo "Backup selesai: <a href='$filename'>$filename</a>";
?>
