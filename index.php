<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "notes";
$insert = false;
$delete = false;
$update = false;

// Create connection
$conn = mysqli_connect($servername, $username, $password, $database);

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

if (isset($_GET['delete'])) {
    $delete = true;
    $sno = $_GET["delete"];
    // Sql query to be executed
    $sql = "DELETE FROM `notes` WHERE `notes`.`sno` = $sno";
    $result = mysqli_query($conn, $sql);
    if ($result) {
        $update = true;
        header('refresh:1.3, url=http://localhost/kartik/misc/index.php');
    } else {
        echo "We could not update the record successfully";
    }
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['snoEdit'])) {
        // Update the record
        $sno = $_POST["snoEdit"];
        $title = $_POST["titleEdit"];
        $description = $_POST["descEdit"];

        // Sql query to be executed
        $sql = "UPDATE `notes` SET `title` = '$title' , `description` = '$description' WHERE `notes`.`sno` = $sno";
        $result = mysqli_query($conn, $sql);
        if ($result) {
            $update = true;
            header('refresh:1.3, url=http://localhost/kartik/misc/index.php');
        } else {
            echo "We could not update the record successfully";
            header('refresh:1.3, url=http://localhost/kartik/misc/index.php');
        }
    } else {
        $title = $_POST['title'];
        $description = $_POST['desc'];
        $sql = "INSERT INTO `notes` (`title`, `description`) VALUES ('$title', '$description');";
        $result = mysqli_query($conn, $sql);
        if ($result) {
            $insert = true;
            header('refresh:1.3, url=http://localhost/kartik/misc/index.php');
        } else {
            echo "Fail" . mysqli_error($conn);
        }
    }
}
?>


<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="//cdn.datatables.net/1.11.4/css/jquery.dataTables.min.css">

    <title>Hello, world!</title>
</head>

<body>
    <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editModalLabel">Edit this Note</h5>
                    <button type="button" class="btn" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">X</span>
                    </button>
                </div>
                <form action="/kartik/misc/index.php" method="POST">
                    <div class="modal-body">
                        <input type="hidden" name="snoEdit" id="snoEdit">
                        <div class="form-group">
                            <label for="title">Note Title</label>
                            <input type="text" class="form-control" id="titleEdit" name="titleEdit" aria-describedby="emailHelp">
                        </div>

                        <div class="form-group">
                            <label for="desc">Note Description</label>
                            <textarea class="form-control" id="descEdit" name="descEdit" rows="3"></textarea>
                        </div>
                    </div>
                    <div class="modal-footer d-block mr-auto">
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">Notes</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active" style="cursor: pointer;" aria-current="page" href="/kartik/misc/index.php">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" style="cursor: pointer;" href="#">About</a>
                    </li>
                    < <li class="nav-item">
                        <a class="nav-link" style="cursor: pointer;" href="http://localhost/kartik/misc/formSubmit.php">Contact Us</a>
                        </li>
                </ul>
                <form class="d-flex">
                    <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                    <button class="btn btn-outline-success" type="submit">Search</button>
                </form>
            </div>
        </div>
    </nav>

    <?php
    if ($insert == true) {
        echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>Inserted Successfully</strong> Your note has been inserted successfully<button type="button" class="btn-close"
        data-bs-dismiss="alert" aria-label="Close"></button></div>';
    } else if ($delete == true) {
        echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>Deleted Successfully</strong> Your note has been deleted successfully<button type="button" class="btn-close"
        data-bs-dismiss="alert" aria-label="Close"></button></div>';
    } else if ($update == true) {
        echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>Update Successfully</strong> Your note has been Updated successfully<button type="button" class="btn-close"
        data-bs-dismiss="alert" aria-label="Close"></button></div>';
    }
    ?>

    <div class="container my-4">
        <form action="/kartik/misc/index.php" method="post">
            <div class="mb-3">
                <label for="title" class="form-label"><strong>Title</strong></label>
                <input type="text" class="form-control" name="title" id="title" aria-describedby="emailHelp">
            </div>
            <div class="mb-3">
                <label for="desc" class="form-label"><strong>Note Description</strong> </label>
                <textarea class="form-control" id="desc" name="desc" rows="3"></textarea>
            </div>
            <button id="submit" type="submit" class="btn btn-primary">Add Note</button>

        </form>
    </div>

    <div class="container my-4"></div>

    <div class="container">
        <table class="table" id="myTable">
            <thead>
                <tr>
                    <th scope="col">S.no</th>
                    <th scope="col">Title</th>
                    <th scope="col">Description</th>
                    <th scope="col">Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $sql = "SELECT * FROM notes";
                $result = mysqli_query($conn, $sql);
                $sno = 0;
                if (mysqli_num_rows($result) > 0) {
                    // output data of each row
                    while ($row = mysqli_fetch_assoc($result)) {
                        $sno += 1;
                        echo " <tr>
                        <th scope='row'>" . $sno . "</th>
                        <td>" . $row['title'] . "</td>
                        <td>" . $row['description'] . "</td>
                        <td> <button class='edit btn btn-sm btn-primary' id=" . $row['sno'] . ">Edit</button> 
                        <button class='delete btn btn-sm btn-primary' id=d" . $row['sno'] . ">Delete</button>  </td>
                      </tr>";
                    }
                } else {
                    echo "No Data is present";
                }
                ?>
            </tbody>
        </table>
    </div>
    <hr>

    <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <script src="//cdn.datatables.net/1.11.4/js/jquery.dataTables.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#myTable').DataTable();
        });
    </script>
    <script>
        edits = document.querySelectorAll(".edit");
        Array.from(edits).forEach((element) => {
            element.addEventListener("click", function(e) {
                let tar = e.target.parentNode.parentNode;
                let td = tar.querySelectorAll("td");
                let title = td[0].innerHTML;
                let desc = td[1].innerHTML;
                titleEdit.value = title;
                snoEdit.value = e.target.id;
                descEdit.value = desc;
                console.log(e.target.id);
                $('#editModal').modal('toggle');
            });
        });

        delets = document.querySelectorAll(".delete");
        Array.from(delets).forEach((element) => {
            element.addEventListener("click", function(e) {
                let tar = e.target.parentNode.parentNode;
                let td = tar.querySelectorAll("td");
                let title = td[0].innerHTML;
                sno = e.target.id.substr(1);
                if (confirm("Do you really want to delete " + title)) {
                    window.location = `/kartik/misc/index.php?delete=${sno}`;
                }
            });
        });
    </script>
</body>

</html>
<!-- window.location.href = 'http://localhost/kartik/misc/index.php'; -->