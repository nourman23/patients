<?php
// include database connection file
require_once 'conFile.php';
// Code for record deletion
if (isset($_REQUEST['del'])) {
    //Get row id
    $paId = intval($_GET['del']);
    //Qyery for deletion
    $sql = "delete from patients WHERE  id=:id";
    // Prepare query for execution
    $query = $conn->prepare($sql);
    // bind the parameters
    $query->bindParam(':id', $paId, PDO::PARAM_STR);
    // Query Execution
    $query->execute();
    // Mesage after updation
    // echo "<script>alert('Record Updated successfully');</script>";
    // Code for redirection
    echo "<script>window.location.href='index.php'</script>";
}