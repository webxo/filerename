<?php
	/****
		*@ Ekunkoya, Eshofonie, Ajayi
		This program renames picture files in a folder.
		We actually used the php rename() function to carry this out.
		The database connection is to get the new name used
		to rename the files in the folder.

		The rename function works like this
			rename(directory.oldname, directory.newname) 
	***/
  #used to connect to the databse
  $host = "localhost";
  $db_name = "hr_";
  $username = "root";
  $password = "";

  try {
      $con = new PDO("mysql:host={$host};dbname={$db_name}", $username, $password);
      //echo "Connected";
  } catch (PDOException $e) {
    echo "Connection error: ". $e->getMessage();
  }

  $query = "SELECT recordno, idno, dept
  			FROM newpdata";
  $stmt = $con->prepare($query);
  $stmt -> execute();

  //$row = $stmt -> fetch(PDO::FETCH_ASSOC);

  $num = $stmt->rowCount();

  		//echo "<table>";
  		
  if ($num > 0) { //if starts here
		$n = 1;
			$directory = 'staff/';
			$handle = opendir($directory);  
					
				while($row=$stmt->fetch(PDO::FETCH_ASSOC))
		             {
		             	
		                extract($row);
		               
		               $stripped = str_replace('/', '', $idno);

		               if ($recordno > 0 and $recordno < 10) {
		               		$fileName = "0000000".$recordno.".jpg";
		               		rename($directory . $fileName, $directory.$stripped.".jpg");		               		
		               				               		
		               }//end if
		               if ($recordno >= 10 and $recordno < 100) {
		               		$fileName = "000000".$recordno.".jpg";
		               		rename($directory . $fileName, $directory.$stripped.".jpg");
		               		
		               }
		               if ($recordno >= 100 and $recordno < 1000) {
		               		$fileName = "00000".$recordno.".jpg";
		               		rename($directory . $fileName, $directory.$stripped.".jpg");

		               } 
		               if ($recordno >= 1000 and $recordno < 10000) {
		               		$fileName = "0000".$recordno.".jpg";
		               		rename($directory . $fileName, $directory.$stripped.".jpg");

		               }
		               		
		             }//end of while loop
                }//end of if statement for printing results into tables 
				else {
					echo "No record";
					
	}//end of if num


?>