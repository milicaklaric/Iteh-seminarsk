<?php
    if (isset($_POST['processedList'])){

		include "connect.php";

		$sql="SELECT products.product, orders.address, products.price, order_list.id, users.name, users.surname, order_list.quantity, order_list.order_id 
			FROM products 
				JOIN order_list ON order_list.product_id = products.id 
				JOIN orders ON order_list.order_id = orders.id 
				JOIN users ON orders.user_id = users.id 
					WHERE order_list.response = 0"; 

		
        if ($q=$conn->query($sql)) {
			
			$array = array();
			while($line=$q->fetch_object()) {
				$array[] = $line;
			}
		
			echo json_encode($array);
	    	return false;

        } else {
			$array = array("Neuspesno povezivanje na bazu");
			echo json_encode($array);
	    	return false;
    	}
	}
	
	if (isset($_POST['notProcessedList'])){

		include "connect.php";

		$sql="SELECT products.product, orders.address, products.price, order_list.id, users.name, users.surname, order_list.quantity, order_list.order_id 
			FROM products 
				JOIN order_list ON order_list.product_id = products.id 
				JOIN orders ON order_list.order_id = orders.id 
				JOIN users ON orders.user_id = users.id 
					WHERE order_list.response = 1";  

		
        if ($q=$conn->query($sql)) {
			
			$array = array();
			while($line=$q->fetch_object()) {
				$array[] = $line;
			}
		
			echo json_encode($array);
	    	return false;

        } else {
			$array = array("Neuspesno povezivanje na bazu");
			echo json_encode($array);
	    	return false;
    	}
    }

?>