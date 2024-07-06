<?php
    $server = 'localhost:3306';
    $username = 'root';
    $password = '';
    $database = 'todo_list';
    $conn = mysqli_connect($server,$username,$password,$database);
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    // creating an item
    if (isset($_POST['add'])) {
        $item = $_POST['item'];
        if (!empty($item)) {
            $query = "INSERT INTO todo (name) VALUES ('$item')";
            if(mysqli_query($conn,$query)){
                echo '
                <center>
                    <div class = "alert alert-success" role= "alert">
                        Item added successfully!
                    </div>
                </center>
            ';
            }else {
                echo mysqli_error($conn);
            };
        }
    }
    // Checking for action parameter
    if (isset($_GET['action'])){
        $itemid = $_GET['item'];
        if ($_GET['action'] == 'done') {
            $query = "UPDATE todo SET status = 1 WHERE id = '$itemid'";
            if(mysqli_query($conn,$query)){
                echo '
                <center>
                    <div class = "alert alert-info" role= "alert">
                        Item marked as done!
                    </div>
                </center>
            ';
            }else {
                echo mysqli_error($conn);
            };
        }elseif ($_GET['action']=='delete') {
            $query = "DELETE FROM todo WHERE id = '$itemid'";
            if(mysqli_query($conn,$query)){
                echo '
                <center>
                    <div class = "alert alert-danger" role= "alert">
                        Item deleted successfully!
                    </div>
                </center>
            ';
        }else {
            echo mysqli_error($conn);
        };
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Todo List Application</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <style>
        .done{
            text-decoration: line-through;
        }
    </style>
</head>
<body>
    <main>
        
        <div class= "container pt-5">
            <div class= "row">
                <div class = "col-sm-12 col-md-3"></div>
                <div class = "col-sm-12 col-md-6">
                    <div class = "card">
                        <div class = "card header">
                            <p> Todo List</p>
                        </div>
                        <form method="post" action = "<?= $_SERVER['PHP_SELF']?>">
                            <div class = "mb-3">
                                <input type="text" class="form-control" name= "item" placeholder="Add a todo task">
                            </div>
                            <br>
                            <input type = "submit" class="btn-btn-dark" name = "add" value = "Add item">
                        </form>
                        <div class = "mt-5 mb-5">
                            <?php
                                $query = "SELECT * FROM todo";
                                $result = mysqli_query($conn,$query);
                                if($result->num_rows>0){
                                    while ($row = $result->fetch_assoc()) {
                                        $done = $row['status'] == 1?"done":"";
                                        echo '<div class="row mt-4">
                                            <div class= "col-sm-12 col-md-1"><h5>'.$row['id'].'</h5></div>
                                            <div class= "col-sm-12 col-md-6"><h5 class = "'.$done.'">'.$row['name'].'</h5></div>
                                            <div class= "col-sm-12 col-md-5">
                                                <a href="?action=done&item='.$row['id'].'" class = "btn btn-outline-dark">Mark as done</a>
                                                <a href="?action=delete&item='.$row['id'].'" class = "btn btn-outline-danger">Delete</a>
                                            </div>
                                        </div>';
                                    }
                                }else{
                                    echo '
                                    <center>
                                        <img src="folder.png" width="50px" alt="Empty List"><br><span>Your list is Empty.</span>
                                    </center>
                                    ';
                                }
                            ?>
                        </div>
                    </div>
                <div>
            </div>
        </div>
    </main>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.0/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
    <script>
        $(document).ready(function(){
            $(".alert").fadeTo(5000,500).slideUp(500,function(){
                $(".alert").slideUp(500);
            });
        })
    </script>
</body>
</html>