<?php
session_start();

function validateLogin($userId, $mobile) {
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

    $stmt = $pdo->prepare('SELECT * FROM branches WHERE user_id = :user_id AND mobile_number = :mobile_number');
    $stmt->execute(['user_id' => $userId, 'mobile_number' => $mobile]);
    $user = $stmt->fetch();

    if ($user) {
        $_SESSION['user_id'] = $user['user_id'];
        $_SESSION['mobile_number'] = $user['mobile_number'];
        return true;
    } else {
        return false;
    }
}

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['login-submit'])) {
    $userId = $_POST['login-user-id'];
    $mobile = $_POST['login-mobile'];

    if (validateLogin($userId, $mobile)) {
        header('Location: branches.php');
        exit();
    } else {
        $errorMessage = "Invalid User ID or Mobile Number.";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Branch Panel Login</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="container">
        <header>
            <h1>Branch Panel Login</h1>
        </header>

        <section id="branch-login">
            <h2>Login Form</h2>
            <form id="login-form" method="POST" action="index.php">
                <label for="login-user-id">User ID:</label>
                <input type="text" id="login-user-id" name="login-user-id" required>
                
                <label for="login-mobile">Mobile Number:</label>
                <input type="tel" id="login-mobile" name="login-mobile" required>
                
                <button type="submit" name="login-submit">Login</button>
            </form>
            <?php if (isset($errorMessage)): ?>
                <p><?php echo $errorMessage; ?></p>
            <?php endif; ?>
        </section>
    </div>
</body>
</html>
