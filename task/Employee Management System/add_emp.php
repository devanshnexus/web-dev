<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "employee_management";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$alertMessage = '';

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['add_employee'])) {
    $name = $_POST['name'];
    $mobile = $_POST['mobile'];
    $address = $_POST['address'];
    $salary = $_POST['salary'];
    $date_of_joining = $_POST['date_of_joining'];

    $sql = "INSERT INTO employees (name, mobile, address, salary, date_of_joining) VALUES ('$name', '$mobile', '$address', '$salary', '$date_of_joining')";

    if ($conn->query($sql) === TRUE) {
        $alertMessage = '
            <center>
                <div class="alert alert-success" role="alert">
                    New employee added successfully!
                </div>
            </center>
        ';
    } else {
        $alertMessage = '
            <center>
                <div class="alert alert-danger" role="alert">
                    Error: ' . $sql . '<br>' . $conn->error . '
                </div>
            </center>
        ';
    }
}

$employees = [];
$sql = "SELECT * FROM employees";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $employees[] = $row;
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Employee Management System</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="container">
        <header>
            <h1>Employee Management System</h1>
        </header>

        <section id="employee-management">
            <h2>Employee Data Management</h2>

            <?php echo $alertMessage; ?>

            <div id="add-employee">
                <h3>Add New Employee</h3>
                <form action="" method="POST">
                    <label for="name">Name:</label>
                    <input type="text" id="name" name="name" required>
                    
                    <label for="mobile">Mobile Number:</label>
                    <input type="tel" id="mobile" name="mobile" required>
                    
                    <label for="address">Address:</label>
                    <input type="text" id="address" name="address" required>
                    
                    <label for="salary">Salary:</label>
                    <input type="number" id="salary" name="salary" required>
                    
                    <label for="date_of_joining">Date of Joining:</label>
                    <input type="date" id="date_of_joining" name="date_of_joining" required>
                    
                    <button type="submit" name="add_employee" class="btn btn-primary">Add Employee</button>
                </form>
            </div>
        </section>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.0/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
    <script>
        $(document).ready(function(){
            $(".alert").fadeTo(5000, 500).slideUp(500, function(){
                $(this).remove();
            });
        });
    </script>
</body>
</html>
