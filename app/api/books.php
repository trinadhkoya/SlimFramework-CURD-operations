			<?php
			$app->get('/api/books/',function(){

			require_once('dbconnect.php');

			$sql="SELECT * from books order by id";
			$result=$mysqli->query($sql);
			while($row=$result->fetch_assoc()){
				$data[]=$row;
			}

		echo json_encode($data);
			});

		?>