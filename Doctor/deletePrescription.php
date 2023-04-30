<?php
require_once("../conf/config.php");

if (isset($_GET['pdID'])) {
    $pdID = $_GET['pdID'];
    $patientID = $_GET['patientID'];

    // select the drug name and quantity from the prescribed_drugs table
    $select = "SELECT drug_name, days*quantity*frequency as Prescibed_quantity FROM prescribed_drugs WHERE pdID = '$pdID'";
    $result = mysqli_query($con, $select);
    $row = mysqli_fetch_assoc($result);
    $drugName = $row['drug_name'];
    $Prescibed_quantity = $row['Prescibed_quantity'];
    echo "Prescribed quantity ". $Prescibed_quantity. "<br>";

    mysqli_begin_transaction($con);

    try{
        $delete = "DELETE from prescribed_drugs WHERE pdID = ?;";
        $stmt = mysqli_prepare($con, $delete);
        mysqli_stmt_bind_param($stmt, "s", $pdID);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);

        //get itemID
        $itemID_query = "SELECT itemID from item WHERE item_name = '$drugName'";
        $get_itemID = mysqli_query($con,$itemID_query);
        $item_row = mysqli_fetch_assoc($get_itemID);
        $itemID = $item_row['itemID'];

        //get unit quantity
        $get_unit_quantity = "SELECT unit_quantity,badgeNo from inventory WHERE itemID = $itemID AND expiredDate >= CURDATE() ORDER BY expiredDate ASC limit 1";
        $get_unit_quantity_query = mysqli_query($con,$get_unit_quantity);
        $get_results = mysqli_fetch_assoc($get_unit_quantity_query);
        $unit_quantity = $get_results['unit_quantity'];
        $badgeNo = $get_results['badgeNo'];

        $quantity = $Prescibed_quantity/$unit_quantity;

        // update the inventory
        $update = "UPDATE inventory SET quantity = quantity + '$quantity' WHERE itemID = '$itemID' AND badgeNo = '$badgeNo';";
        mysqli_query($con, $update);
        
        //commit transaction
        mysqli_commit($con);
        header("Location: prescription.php?patientid=".$patientID);
    }
    catch(EXception $e){
        //rollback
        mysqli_rollback($con);
        echo "Error: " . $e->getMessage();
    }
}
