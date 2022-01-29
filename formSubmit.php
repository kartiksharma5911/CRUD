<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <title>Hello, world!</title>
</head>

<body>

<?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $name = $_POST['name'];
        $email = $_POST['email'];
        $desc = $_POST['desc'];

       
        $servername = "localhost";
        $username = "root";
        $password = "";
        $database = "notes";

        $conn = mysqli_connect($servername, $username, $password, $database);

        if(!$conn) {
            die("Connection failed: ". mysqli_connect_error());
        }
        $sql = "INSERT INTO `contact_us` (`sno`, `name`, `email`, `concern`, `time`) VALUES (NULL, '$name', '$email', 
        '$desc', current_timestamp())";
        if(mysqli_query($conn, $sql) == true) {
            echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>Success </strong>Your entry has been submitted successfully! We will contact you as soon as possible
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>';
        } else {
            echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>Sorry </strong>We are facing some Issues            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>';
        }
    
    }
    ?>

    <div class="container mt-3">
        <h2 class=" mt-3">Contact us for your concern</h2>
        <form action="/kartik/misc/formSubmit.php" method="POST">
            <div class="mb-3">
                <label for="name" class="form-label">Name</label>
                <input type="text" name="name" class="form-control" id="name" aria-describedby="emailHelp">
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email address</label>
                <input type="email" name="email" class="form-control" id="email" aria-describedby="emailHelp">
                <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
            </div>
            <div class="mb-3">
                <label for="desc">Desription</label>
                <textarea name="desc" id=desc"" cols="30" class="form-control" rows="10"></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
            <a href="http://localhost/kartik/misc/index.php" class="btn btn-primary">Home</a>
        </form>
    </div>
    <div class="container">
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

</body>

</html>