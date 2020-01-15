<?php


    if (isset($_GET['id'])){

        include "../connect.php";

        $id = $conn->real_escape_string($_GET['id']);

        $sql="UPDATE order_list SET response = '1' WHERE id = '$id'"; 

	
        $q=$conn->query($sql);


        $sql1 = "SELECT order_list.order_id FROM order_list WHERE id = '$id'";

        $q1=$conn->query($sql1);
        $orderID = $q1->fetch_object()->order_id;

        $sql2 = "SELECT * FROM order_list WHERE order_id = '$orderID' AND response = '0'";
        $q2=$conn->query($sql2);

        echo($orderID);

        if (mysqli_num_rows($q2)==0) {
            $sql3 = "UPDATE orders SET status = '1' WHERE id = '$orderID'";
            $q3=$conn->query($sql3);
        };

        
        $newURL = '../orders.php';
        header('Location: '.$newURL);
        
    };

?>