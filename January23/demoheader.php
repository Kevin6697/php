<?php 
  ob_start();
  echo "Hello";

 // header("Location: timestamp.php");
// header( "refresh:5;url=timestamp.php" );


// header('Content-Disposition: attachment; filename="downloaded.pdf"');
// header('Content-Type: application/pdf');
// header("Location: demo.php",TRUE,404);
// header("Location: errorPage.php");
echo "World";

// header("location: timestamp.php");
// echo "Already sent";
// header("location: wordCensor.php");
ob_end_flush();



?>