<?php


$servername = "localhost";
$username = "root";
$password = "";
$database = "mystore";
            
//connection
$connection = new mysqli($servername,$username,$password,$database);

$first_name = "";
$last_name = "";
$email = "";
$phone = "";
$address = "";

$errorMessage = "";
$successMessage = "";

if ( $_SERVER["REQUEST_METHOD"]=='POST'){
    $first_name = $_POST["first_name"];
    $last_name = $_POST["last_name"];
    $email = $_POST["email"];
    $phone = $_POST["phone"];
    $address = $_POST["address"];

    do {
        if (empty($first_name) || empty($last_name) || empty($email) || empty($phone) || empty($address) ){
            $errorMessage = "All the fields are required";
            break;  
        }

        // add new client
        $sql = "INSERT INTO employees (first_name,last_name,email,phone,address)".
                "VALUES ('$first_name', '$last_name', '$email', '$phone', '$address')";
        $result = $connection->query($sql);

        if (!$result){
            $errorMessage = "Invalid query: " . $connection->error;
            break;
        }

        $first_name = "";
        $last_name = "";
        $email = "";
        $phone = "";
        $address = "";

        $successMessage = "Client added correctly";
        header("location: /mystore/index.php");
        exit;


    }while(false);
}

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Input Output</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>
    <div class="container my-5">
        <h2>New Client</h2>
        <?php 
        if ( !empty($errorMessage)){
            echo "
            <div class='alert alert-warning alert-dismissible fade show' role='alert'>
                <strong>$errorMessage</strong>
                <button type = 'button' class = 'btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
            
            </div>";

        }
        ?>
        <form method="post">
            <div class = "row mb-3">
                <label class = "col-sm-3 col-form-label">First Name</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="first_name" value="<?php echo $first_name; ?>">
                </div>
            </div>
            <div class = "row mb-3">
                <label class = "col-sm-3 col-form-label">Last Name</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="last_name" value="<?php echo $last_name; ?>">
                </div>
            </div>
            <div class = "row mb-3">
                <label class = "col-sm-3 col-form-label">Email</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="email" value="<?php echo $email; ?>">
                </div>
            </div>
            <div class = "row mb-3">
                <label class = "col-sm-3 col-form-label">Phone</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="phone" value="<?php echo $phone; ?>">
                </div>
            </div>
            <div class = "row mb-3">
                <label class = "col-sm-3 col-form-label">Address</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="address" value="<?php echo $address; ?>">
                </div>
            </div>
            <?php
            if (!empty($successMessage)) {
                echo "
                <div class='row mb-3'>
                    <div class='offset-sm-3 col-sm-6'>
                        <div class='alert alert-success alert-dismissible fade show' role='alert'>
                            <strong>$successMessage</strong>
                            <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                        </div>
                    </div>
                </div>";
            }
            ?>


            <div class="row mb-3">
                <div class="col-sm-6 offset-sm-3">
                    <div class="row">
                        <div class="col-sm-6 d-grid">
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                        <div class="col-sm-6 d-grid">
                            <a class="btn btn-outline-primary" href="/mystore/index.php" role="button">Cancel</a>
                        </div>
                    </div>
                </div>
            </div>

        </form>

    </div>
    
</body>
</html>