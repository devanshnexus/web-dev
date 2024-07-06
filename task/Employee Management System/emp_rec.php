<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "employee_management";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$limit = 10;
if (isset($_GET["page"])) {
    $page = $_GET["page"];
} else {
    $page = 1;
}
$start_from = ($page - 1) * $limit;

if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $conn->query("DELETE FROM employees WHERE id=$id");
    echo "<script>alert('Employee record deleted successfully');</script>";
    header("Location: emp_rec.php");
    exit();
}

$sql = "SELECT * FROM employees LIMIT $start_from, $limit";
$result = $conn->query($sql);

$total_records_query = "SELECT COUNT(*) FROM employees";
$total_records_result = $conn->query($total_records_query);
$total_records = $total_records_result->fetch_array()[0];
$total_pages = ceil($total_records / $limit);

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Employee Records</title>
    <link rel="stylesheet" href="st.css">
</head>
<body>
    <div class="container">
        <header>
            <h1>Employee Records</h1>
        </header>
        <section id="employee-records">
            <h2>Employee Records</h2>
            <table id="employee-table">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Mobile Number</th>
                        <th>Address</th>
                        <th>Salary</th>
                        <th>Date of Joining</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($row = $result->fetch_assoc()): ?>
                    <tr>
                        <td><?php echo $row['name']; ?></td>
                        <td><?php echo $row['mobile']; ?></td>
                        <td><?php echo $row['address']; ?></td>
                        <td><?php echo $row['salary']; ?></td>
                        <td><?php echo $row['date_of_joining']; ?></td>
                        <td>
                            <a href="edit.php?id=<?php echo $row['id']; ?>">Edit</a>
                            <a href="?delete=<?php echo $row['id']; ?>" onclick="return confirm('Are you sure you want to delete this record?')">Delete</a>
                        </td>
                    </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>

            <div id="pagination">
                <?php for ($i = 1; $i <= $total_pages; $i++): ?>
                    <a href="index.php?page=<?php echo $i; ?>" <?php if ($i == $page) echo 'class="active"'; ?>><?php echo $i; ?></a>
                <?php endfor; ?>
            </div>
        </section>
    </div>
</body>
</html>
