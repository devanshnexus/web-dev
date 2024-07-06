<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "branch_management";
$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user_id = $_POST['user_id'];
    $mobile_number = $_POST['mobile_number'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];
    $branch_name = $_POST['branch_name'];
    if ($password !== $confirm_password) {
        echo "<script>alert('Passwords do not match');</script>";
    } else {
        $hashed_password = password_hash($password, PASSWORD_BCRYPT);
        $sql = "INSERT INTO branches (user_id, mobile_number, password, branch_name)
                VALUES ('$user_id', '$mobile_number', '$hashed_password', '$branch_name')";
        if ($conn->query($sql) === TRUE) {
            echo "<script>alert('Registration successful');</script>";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }
}
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Branch Panel Registration</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="container">
        <header>
            <h1>Branch Panel Registration</h1>
        </header>

        <section id="branch-registration">
            <form action="register.php" method="post">
                <label for="user_id">User ID:</label>
                <input type="text" id="user_id" name="user_id" required>
                
                <label for="mobile_number">Mobile Number:</label>
                <input type="tel" id="mobile_number" name="mobile_number" required>
                
                <label for="password">Password:</label>
                <input type="password" id="password" name="password" required>
                
                <label for="confirm_password">Confirm Password:</label>
                <input type="password" id="confirm_password" name="confirm_password" required>
                
                <label for="branch_name">Branch Name:</label>
                <input type="text" id="branch_name" name="branch_name" required>
                
                <button type="submit">Register</button>
            </form>
        </section>
    </div>
</body>
</html>
