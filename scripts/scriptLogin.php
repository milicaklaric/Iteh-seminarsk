<?php 
	session_start();
	include "../connect.php";

	if(empty($_POST['name'])||empty($_POST['password'])){
		echo '<div class="alert alert-danger">Unesite ime i šifru!</div>';
	} else {
		$user=$_POST['name'];
		$psw=$_POST['password'];

		$user = $conn->real_escape_string($user); 
		$psw = $conn->real_escape_string($psw);
		$psw = md5($psw);

		$sql="SELECT * FROM users WHERE name='$user' AND password='$psw'";
		$q=$conn->query($sql);
		$line=$q->fetch_object();
		$rows = mysqli_num_rows($q);

		if($rows==0){
			echo '<div class="alert alert-danger">Username i password nisu tacni!</div>';
		} else {
			$_SESSION['userId']=$line->id;
			$_SESSION['userName']=$line->name;
			$_SESSION['userAdmin']=$line->admin;
			?>
			<script type="text/javascript">
				window.location.href = "index.php";
			</script>
			<?php
		
		}

	}
?>