<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet">
    <script src="http://code.jquery.com/jquery-1.11.1.min.js"></script>
    <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="style.css">

</head>

<body>


    <div class="container ">
        <div class="row ">
            <div class="col-md-12">
                <h3>Add a patient </h3>
                <hr />
            </div>
        </div>
        <form name="insertrecord" method="post" class="insertF">

            <!-- <div class="row">
                <div class="col-md-4"><b> Name</b>
                    <input type="text" name="name" class="form-control" required>
                </div>
            </div> -->
            <div class="row">
                <div class="col-md-4">
                    <input type="text" name="name" class="form-control" placeholder="Name" required>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4">
                    <input type="number" name="age" class="form-control" placeholder="Age" required>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4">
                    <input type="text" name="address" class="form-control" placeholder="Address" required>
                </div>
            </div>
            <div class="row" style="margin-top:1%">
                <div class="col-md-8">
                    <input class="btn" type="submit" name="insert" value="ADD">
                </div>
            </div>
        </form>
    </div>
    </div>


    <?php
    require_once 'conFile.php';
    if (isset($_POST['insert'])) {



        // $name = $_POST['name'];
        $name = $_POST['name'];
        $age = $_POST['age'];
        $address = $_POST['address'];

        $data = [
            // ':name' => $name,
            ':n' => $name,
            ':ag' =>  $age,
            ':adrs' => $address,
        ];
        // Insert
        $insert = "INSERT INTO `patients` (`Name`, `Age`, `Address`) VALUES (:n , :ag , :adrs)";

        $insert_run = $conn->prepare($insert);

        $insert_run->execute($data);
        if ($insert_run) {
            echo "Inserted Successfully";
            // header('Refresh: 0');
        } else {

            echo "Not Inserted";
        }

        $lastInsertId = $conn->lastInsertId();
        if ($lastInsertId) {
            // Message for successfull insertion
            // echo "<script>alert('Record inserted successfully');</script>";
            echo "<script>window.location.href='index.php'</script>";
        } else {
            // Message for unsuccessfull insertion
            echo "<script>alert('Something went wrong. Please try again');</script>";
            echo "<script>window.location.href='index.php'</script>";
        }
    }
    ?>

</body>

</html>