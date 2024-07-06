<?php
session_start(); 
if (!isset($_SESSION['user_id']) || !isset($_SESSION['mobile_number'])) {
    header('Location: index.php');
    exit();
}
$host = 'localhost'; 
$db = 'branch_management'; 
$user = 'root'; 
$pass = ''; 
$charset = 'utf8mb4';

$dsn = "mysql:host=$host;dbname=$db;charset=$charset";
$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES   => false,
];

try {
    $pdo = new PDO($dsn, $user, $pass, $options);
} catch (\PDOException $e) {
    throw new \PDOException($e->getMessage(), (int)$e->getCode());
}

$stmt = $pdo->query('SELECT * FROM branches');
if ($stmt) {
    $branches = $stmt->fetchAll();
} else {
    echo "Error fetching branches: " . $pdo->errorInfo();
    die();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Branches Table</title>
    <link rel="stylesheet" href="st.css">
</head>
<body>
    <div class="container">
        <header>
            <h1>Branches Table</h1>
        </header>

        <section id="branches">
            <h2>List of Branches</h2>
            <table>
                <thead>
                    <tr>
                        <th>S. No.</th>
                        <th>User ID</th>
                        <th>Mobile Number</th>
                        <th>Branch Name</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($branches)): ?>
                        <?php $count = 1; ?>
                        <?php foreach ($branches as $branch): ?>
                            <tr>
                                <td><?php echo $count++; ?></td>
                                <td><?php echo htmlspecialchars($branch['user_id']); ?></td>
                                <td><?php echo htmlspecialchars($branch['mobile_number']); ?></td>
                                <td><?php echo htmlspecialchars($branch['branch_name']); ?></td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr><td colspan="4">No branches found.</td></tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </section>
    </div>
</body>
</html>
