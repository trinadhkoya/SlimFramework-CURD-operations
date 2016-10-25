			<?php

			//dispalying all the recods named books 

			$app->get('/api/books/',function(){

			require_once('dbconnect.php');

			$sql="SELECT * from books order by id";

			$result=$mysqli->query($sql);

			while($row=$result->fetch_assoc()){
				$data[]=$row;
			}

			if(isset($data)){

				header('Content-Type:application/json');
				echo json_encode($data);
			}

			});

			//display a single row 
		$app->get('/api/books/{id}',function($request,$response,$args){

			require_once('dbconnect.php');

			$book_id=$request->getAttribute('id');

			$sql="SELECT * from books WHERE id=$book_id";

			$result=$mysqli->query($sql);

			while($row=$result->fetch_assoc()){
				$data[]=$row;
			}

			if(isset($data)){

				header('Content-Type:application/json');
				echo json_encode($data);
			}

			});

			

			//now it comes,to insert data/create/update .POST in terms of Technical 
			//for now,i am working with create a new record

			$app->post('/api/books/',function($request){


					require_once('dbconnect.php');
					$sql="INSERT INTO `books` (`book_name`, `book_author`, `amazon_url`) VALUES (?,?,?)"; 

					$statement=$mysqli->prepare($sql);
					$statement->bind_param("sss",$bookName,$bookAuthor,$amazonUrl);

	                $bookName=$request->getParsedBody()['book_name'];
					$bookAuthor=$request->getParsedBody()['book_author'];
					$amazonUrl =$request->getParsedBody()['amazon_url'];

					

					$statement->execute();

			});


			//it's time to update ,do the same
			//assume my url is www.example.com/api/books/2

			$app->put('/api/books/{id}',function($request){

				require_once('dbconnect.php');
				$book_id=$request->getAttribute('id');

				$sql="UPDATE `books` SET `book_name` = ?, `book_author` = ?, `amazon_url` = ? WHERE `books`.`id` = $book_id"; 

					$statement=$mysqli->prepare($sql);
					$statement->bind_param("sss",$bookName,$bookAuthor,$amazonUrl);

					$bookName=$request->getParsedBody()['book_name'];
					$bookAuthor=$request->getParsedBody()['book_author'];
					$amazonUrl =$request->getParsedBody()['amazon_url'];

					$statement->execute();


			});


			//now it's time up .The final one and the most of the people liked it too
			//that is delete
			//www.example.com/api/books/1

		$app->delete('/api/books/{id}',function($request){

				require_once('dbconnect.php');
				$book_id=$request->getAttribute('id');

				
				$sql="DELETE FROM `books` WHERE `books`.`id` = $book_id";


					$statement=$mysqli->prepare($sql);
					$statement->bind_param("sss",$bookName,$bookAuthor,$amazonUrl);

					$bookName=$request->getParsedBody()['book_name'];
					$bookAuthor=$request->getParsedBody()['book_author'];
					$amazonUrl =$request->getParsedBody()['amazon_url'];

					$statement->execute();


			});

		

		?>