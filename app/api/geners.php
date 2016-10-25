			<?php
			$app->get('/api/geners/',function(){

			require_once('dbconnect.php');

			$sql="SELECT * from geners order by id";

			$result=$mysqli->query($sql);

			while($row=$result->fetch_assoc()){
				$data[]=$row;
			}

			if(isset($data)){

				header('Content-Type:application/json');
				echo json_encode($data);
			}

			});

		?>