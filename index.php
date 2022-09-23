<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <link rel="stylesheet" href="style.css">
    <title>Document</title>
</head>

<body>

    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h3>Pateients views </h3>
                <hr />
                <a href="create.php"><button class="btn btn-primary"> Insert Record</button></a>
                <div class="table-responsive">
                    <table id="mytable" class="table table-bordred table-striped">
                        <thead>
                            <th>#</th>
                            <th>Name</th>
                            <th>Age</th>
                            <th>Address</th>
                        </thead>
                        <tbody>
                            <?php
                            require_once 'conFile.php';
                            $sql = "SELECT * from Patients";
                            //Prepare the query:
                            $query = $conn->prepare($sql);
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

                            <tr>
                                <td><?php echo htmlentities($cnt); ?></td>
                                <td><?php echo htmlentities($result->Name); ?></td>
                                <td><?php echo htmlentities($result->Age); ?></td>
                                <td><?php echo htmlentities($result->Address); ?></td>
                                <td><a href="update.php?id=<?php echo htmlentities($result->id); ?>"><button
                                            class="btn btn-primary btn-xs">
                                            <span>
                                                <ion-icon name="create-outline"></ion-icon>
                                            </span></button></a></td>
                                <td><a href="delete.php?del=<?php echo htmlentities($result->id); ?>"><button
                                            class="btn btn-danger btn-xs"
                                            onClick="return confirm('Do you really want to delete');">
                                            <span>
                                                <ion-icon name="trash-outline"></ion-icon>
                                            </span></button></a></td>
                            </tr>


                            <?php
                                    // for serial number increment
                                    $cnt++;
                                }
                            } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">

    </script>
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>

</body>

</html>