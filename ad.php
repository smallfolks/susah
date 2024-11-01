<?php
// Check if form is submitted with database connection details
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['connect'])) {
    // Retrieve connection details from the form
    $host = $_POST['host'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $database = $_POST['database'];

    // Connect to MySQL database
    $conn = new mysqli($host, $username, $password, $database);

    // Check connection
    if ($conn->connect_error) {
        die('Connection failed: ' . $conn->connect_error);
    }
} else {
    // Display connection form if no connection details are provided
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

// Execute SQL query if provided
$queryResult = null;
if (isset($_POST['query']) && !empty($_POST['query'])) {
    $query = $_POST['query'];
    $queryResult = $conn->query($query);
    if (!$queryResult) {
        $error = $conn->error;
    }
}

// Fetch table names
$tables = [];
$result = $conn->query("SHOW TABLES");
while ($row = $result->fetch_row()) {
    $tables[] = $row[0];
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>MySQL Manager</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 20px; }
        textarea { width: 100%; height: 150px; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        table, th, td { border: 1px solid black; padding: 8px; }
        th { background-color: #f2f2f2; }
    </style>
</head>
<body>

<h1>Simple MySQL Manager</h1>

<!-- Form for SQL query input -->
<form method="POST">
    <label for="query">SQL Query:</label><br>
    <textarea name="query" id="query"><?php echo isset($query) ? htmlspecialchars($query) : ''; ?></textarea><br>
    <input type="submit" value="Execute">
</form>

<!-- Display results of SQL query -->
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

<!-- Display list of tables -->
<h2>Tables in Database '<?php echo htmlspecialchars($database); ?>':</h2>
<ul>
    <?php foreach ($tables as $table) : ?>
        <li><?php echo htmlspecialchars($table); ?></li>
    <?php endforeach; ?>
</ul>

</body>
</html>

<?php
// Close connection
$conn->close();
?>
