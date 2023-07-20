<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Input Output</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
</head>
<body styles="margin: 50px;">
    <h1>List of Employees</h1>
    <div class="container my-5">
        <h2></h2>
        <a class='btn btn-primary btn-sm' href='/mystore/create.php' role="button">New Client</a></br>
    </div>
    
    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Last Name</th>
                <th>Email</th>
                <th>Phone</th>
                <th>Address</th>
                <th>Action</th>
                
            </tr>
        </thead>

        <tbody>
            <?php
            $servername = "localhost";
            $username = "root";
            $password = "";
            $database = "mystore";
            
            //connection
            $connection = new mysqli($servername,$username,$password,$database);

            //Chech connection
            if ($connection->connect_error){
                die("connection failed: " . $connection->connect_error);
            }

            // read

            $sql = "SELECT * FROM employees";
            $result = $connection->query($sql);

            //error

            if (!$result){
                die("Invalid Query: " . $connection->error);
            }

            //read data from each row
            while($row= $result->fetch_assoc()){
                echo "<tr>
                    <td> $row[id]</td>
                    <td>$row[first_name]</td>
                    <td>$row[last_name]</td>
                    <td>$row[email]</td>
                    <td>$row[phone]</td>
                    <td>$row[address]</td>
                    <td>
                        <a class='btn btn-primary btn-sm' href='/mystore/edit.php?id=$row[id]'>Update</a>
                        <a class='btn btn-primary btn-sm' href='/mystore/delete.php?id=$row[id]'>Delete</a>
                    </td>

                </tr>";

            }

            ?>
        </tbody>
    </table>
</body>
</html>