<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="http://code.jquery.com/jquery-1.11.1.min.js"></script>
    <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>

    <link rel="stylesheet" href="style.css">

    <title>Document</title>
</head>

<body>



    <?php
    require_once 'conFile.php';
    // Get the userid
    $pId = intval($_GET['id']);
    $sql = "SELECT * from patients where id=:id";
    //Prepare the query:
    $query = $conn->prepare($sql);
    //Bind the parameters
    $query->bindParam(':id', $pId, PDO::PARAM_STR);
    //Execute the query:
    $query->execute();
    //Assign the data which you pulled from the database (in the preceding step) to a variable.
    $results = $query->fetchAll(PDO::FETCH_OBJ);
    // For serial number initialization
    $cnt = 1;
    if ($query->rowCount() > 0) {
        //In case that the query returned at least one record, we can echo the records within a foreach loop:
        foreach ($results as $result) {
    ?>
    <form name="insertrecord" method="post" class="updateF">
        <div class="row">
            <div class="col-md-4"><label class="upLabel">Name </label>
                <input type="text" name="name" value="<?php echo htmlentities($result->Name); ?>" class="form-control"
                    required>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4"><label class="upLabel">Age</label>
                <input type="number" name="age" value="<?php echo htmlentities($result->Age); ?>" class="form-control"
                    required>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4"><label class="upLabel">Address</label>
                <input type="text" name="address" value="<?php echo htmlentities($result->Address); ?>"
                    class="form-control" maxlength="10" required>
            </div>
        </div>
        <?php }
    } ?>
        <div class="row" style="margin-top:1%">
            <div class="col-md-8">
                <input type="submit" name="update" value="Update" class="btn">
            </div>
        </div>
    </form>


    <?php
            // include database connection file
            require_once 'conFile.php';
            if (isset($_POST['update'])) {
                // Get the userid
                $pId = intval($_GET['id']);
                // Poted Values
                $name = $_POST['name'];
                $age = $_POST['age'];
                $address = $_POST['address'];
                // Query for Updation

                $data = [
                    //     // ':name' => $name,
                    ':pId' =>  $pId,
                    ':name' => $name,
                    ':ag' =>  $age,
                    ':adrs' => $address,
                ];
                $update = "UPDATE `patients` SET `Name` =:name , `Age` =:ag , `Address` =:adrs WHERE `patients`.`id` = :pId;";
                //Prepare Query for Execution
                $update_run = $conn->prepare($update);
                // Query Execution
                $update_run->execute($data);
                // Mesage after updation
                // echo "<script>alert('Record Updated successfully');</script>";
                // Code for redirection
                echo "<script>window.location.href='index.php'</script>";
            }
            ?>

</body>

</html>