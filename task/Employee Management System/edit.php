<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "employee_management";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$success_message = "";

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "SELECT * FROM employees WHERE id=$id";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        $employee = $result->fetch_assoc();
    } else {
        die("Employee not found");
    }
} else {
    die("Invalid request");
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $mobile = $_POST['mobile'];
    $address = $_POST['address'];
    $salary = $_POST['salary'];
    $date_of_joining = $_POST['date_of_joining'];

    $sql = "UPDATE employees SET name='$name', mobile='$mobile', address='$address', salary='$salary', date_of_joining='$date_of_joining' WHERE id=$id";

    if ($conn->query($sql) === TRUE) {
        $success_message = "Employee details edited successfully!";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Employee</title>
    <link rel="stylesheet" href="styles.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container">
        <header>
            <h1>Edit Employee</h1>
        </header>

        <section id="edit-employee">
            <?php if (!empty($success_message)): ?>
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <?php echo $success_message; ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            <?php endif; ?>
            
            <form action="" method="POST">
                <label for="name">Name:</label>
                <input type="text" id="name" name="name" value="<?php echo $employee['name']; ?>" required>

                <label for="mobile">Mobile Number:</label>
                <input type="tel" id="mobile" name="mobile" value="<?php echo $employee['mobile']; ?>" required>

                <label for="address">Address:</label>
                <input type="text" id="address" name="address" value="<?php echo $employee['address']; ?>" required>

                <label for="salary">Salary:</label>
                <input type="number" id="salary" name="salary" value="<?php echo $employee['salary']; ?>" required>

                <label for="date_of_joining">Date of Joining:</label>
                <input type="date" id="date_of_joining" name="date_of_joining" value="<?php echo $employee['date_of_joining']; ?>" required>

                <button type="submit">Update Employee</button>
            </form>
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
