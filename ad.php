<?php
session_start();

// Logout jika pengguna menekan tombol logout
if (isset($_GET['logout'])) {
    session_destroy();
    header("Location: ".$_SERVER['PHP_SELF']);
    exit;
}

// Proses form koneksi ke database
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['connect'])) {
    $_SESSION['host'] = $_POST['host'];
    $_SESSION['username'] = $_POST['username'];
    $_SESSION['password'] = $_POST['password'];
    $_SESSION['database'] = $_POST['database'];
}

// Cek apakah ada detail koneksi di session
if (isset($_SESSION['host'], $_SESSION['username'], $_SESSION['database'])) {
    // Sambungkan ke database MySQL
    $conn = new mysqli($_SESSION['host'], $_SESSION['username'], $_SESSION['password'], $_SESSION['database']);

    // Cek koneksi
    if ($conn->connect_error) {
        die('Connection failed: ' . $conn->connect_error);
    }
} else {
    // Tampilkan form koneksi jika belum terhubung
    ?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>MySQL Manager - Connect</title>
        <style>
            body { font-family: Arial, sans-serif; margin: 20px; }
            form { max-width: 400px; margin: 0 auto; }
            label, input { display: block; width: 100%; margin-top: 10px; }
            input[type="submit"] { margin-top: 20px; }
        </style>
    </head>
    <body>
        <h1>Connect to MySQL Database</h1>
        <form method="POST">
            <label for="host">Host:</label>
            <input type="text" name="host" id="host" required>
            
            <label for="username">Username:</label>
            <input type="text" name="username" id="username" required>
            
            <label for="password">Password:</label>
            <input type="password" name="password" id="password">
            
            <label for="database">Database:</label>
            <input type="text" name="database" id="database" required>
            
            <input type="submit" name="connect" value="Connect">
        </form>
    </body>
    </html>
    <?php
    exit;
}

// Fetch table names
$tables = [];
$result = $conn->query("SHOW TABLES");
while ($row = $result->fetch_row()) {
    $tables[] = $row[0];
}

// Fungsi untuk menampilkan dump database
if (isset($_GET['dump'])) {
    header('Content-Type: application/sql');
    header('Content-Disposition: attachment; filename="' . $_SESSION['database'] . '_dump.sql"');

    foreach ($tables as $table) {
        $createTable = $conn->query("SHOW CREATE TABLE `$table`")->fetch_row()[1];
        echo "$createTable;\n\n";

        $rows = $conn->query("SELECT * FROM `$table`");
        while ($row = $rows->fetch_assoc()) {
            $values = array_map([$conn, 'real_escape_string'], array_values($row));
            echo "INSERT INTO `$table` VALUES ('" . implode("', '", $values) . "');\n";
        }
        echo "\n\n";
    }
    exit;
}

// Proses eksekusi query jika disediakan
$queryResult = null;
if (isset($_POST['query']) && !empty($_POST['query'])) {
    $query = $_POST['query'];
    $queryResult = $conn->query($query);
    if (!$queryResult) {
        $error = $conn->error;
    }
}

// Proses insert data
if (isset($_POST['insert']) && isset($_POST['table']) && isset($_POST['data'])) {
    $table = $_POST['table'];
    $columns = implode(", ", array_keys($_POST['data']));
    $values = implode("', '", array_map([$conn, 'real_escape_string'], array_values($_POST['data'])));
    $insertQuery = "INSERT INTO `$table` ($columns) VALUES ('$values')";
    $conn->query($insertQuery);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>MySQL Manager</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 20px; }
        textarea { width: 100%; height: 100px; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        table, th, td { border: 1px solid black; padding: 8px; }
        th { background-color: #f2f2f2; }
    </style>
</head>
<body>

<h1>MySQL Manager</h1>
<p><a href="?logout=true">Logout</a> | <a href="?dump=true">Download Database Dump</a></p>

<!-- Form SQL Query -->
<form method="POST">
    <label for="query">SQL Query:</label><br>
    <textarea name="query" id="query"><?php echo isset($query) ? htmlspecialchars($query) : ''; ?></textarea><br>
    <input type="submit" value="Execute">
</form>

<?php if (isset($queryResult)) : ?>
    <h2>Query Result:</h2>
    <?php if ($queryResult === true) : ?>
        <p>Query executed successfully.</p>
    <?php elseif ($queryResult === false) : ?>
        <p style="color: red;">Error: <?php echo $error; ?></p>
    <?php else : ?>
        <table>
            <thead>
                <tr>
                    <?php foreach ($queryResult->fetch_fields() as $field) : ?>
                        <th><?php echo htmlspecialchars($field->name); ?></th>
                    <?php endforeach; ?>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = $queryResult->fetch_assoc()) : ?>
                    <tr>
                        <?php foreach ($row as $value) : ?>
                            <td><?php echo htmlspecialchars($value); ?></td>
                        <?php endforeach; ?>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    <?php endif; ?>
<?php endif; ?>

<h2>Select Table to View or Insert Data</h2>
<form method="GET">
    <label for="table">Choose a Table:</label>
    <select name="table" id="table" onchange="this.form.submit()">
        <option value="">-- Select Table --</option>
        <?php foreach ($tables as $table) : ?>
            <option value="<?php echo htmlspecialchars($table); ?>" <?php if (isset($_GET['table']) && $_GET['table'] == $table) echo 'selected'; ?>>
                <?php echo htmlspecialchars($table); ?>
            </option>
        <?php endforeach; ?>
    </select>
</form>

<?php if (isset($_GET['table'])) : ?>
    <h2>Data in Table '<?php echo htmlspecialchars($_GET['table']); ?>'</h2>
    <?php
    $selectedTable = $_GET['table'];
    $result = $conn->query("SELECT * FROM `$selectedTable`");
    ?>
    <table>
        <thead>
            <tr>
                <?php foreach ($result->fetch_fields() as $field) : ?>
                    <th><?php echo htmlspecialchars($field->name); ?></th>
                <?php endforeach; ?>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = $result->fetch_assoc()) : ?>
                <tr>
                    <?php foreach ($row as $value) : ?>
                        <td><?php echo htmlspecialchars($value); ?></td>
                    <?php endforeach; ?>
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>

    <h2>Insert Data into '<?php echo htmlspecialchars($selectedTable); ?>'</h2>
    <form method="POST">
        <?php
        $columns = $conn->query("SHOW COLUMNS FROM `$selectedTable`");
        while ($column = $columns->fetch_assoc()) :
        ?>
            <label for="data[<?php echo $column['Field']; ?>]"><?php echo $column['Field']; ?>:</label>
            <input type="text" name="data[<?php echo $column['Field']; ?>]" id="data[<?php echo $column['Field']; ?>]">
        <?php endwhile; ?>
        <input type="hidden" name="table" value="<?php echo htmlspecialchars($selectedTable); ?>">
        <input type="submit" name="insert" value="Insert Data">
    </form>
<?php endif; ?>

</body>
</html>

<?php
// Close connection
$conn->close();
?>
