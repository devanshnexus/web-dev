<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "employee_management";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql_total_employees = "SELECT COUNT(*) AS total FROM employees";
$sql_max_salary = "SELECT MAX(salary) AS max_salary FROM employees";
$sql_min_salary = "SELECT MIN(salary) AS min_salary FROM employees";

$total_employees_result = $conn->query($sql_total_employees);
$max_salary_result = $conn->query($sql_max_salary);
$min_salary_result = $conn->query($sql_min_salary);

$total_employees = $total_employees_result->fetch_assoc()['total'];
$max_salary = $max_salary_result->fetch_assoc()['max_salary'];
$min_salary = $min_salary_result->fetch_assoc()['min_salary'];

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Employee Statistics</title>
    <link rel="stylesheet" href="s.css">
</head>
<body>
    <div class="container">
        <header>
            <h1>Employee Statistics</h1>
        </header>

        <section id="statistics">
            <h2>Branch Statistics</h2>
            <div class="stat">
                <span>Total Number of Employees:</span>
                <span><?php echo $total_employees; ?></span>
            </div>
            <div class="stat">
                <span>Maximum Salary:</span>
                <span><?php echo $max_salary; ?></span>
            </div>
            <div class="stat">
                <span>Minimum Salary:</span>
                <span><?php echo $min_salary; ?></span>
            </div>
        </section>
    </div>
</body>
</html>
