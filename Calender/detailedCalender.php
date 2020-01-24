<!DOCTYPE HTML>
    <html>
        <head>
             <style>
                 td{
                     align :right;
                 }
             </style>  
        </head>
        <body>
            <form action="<?php echo $_SERVER['PHP_SELF'];?>" method="post">
                <input type=text name=year1 placeholder="Starting year" >
                <br/><br/>
                <input type=text name=year2 placeholder="Ending year">
                <br/><br/>
                <input type=submit name=calender value="Calender">
                
            </form>
        </body>
    </html>

 <?php
 
 if(isset($_POST['calender'])){
    if(empty($_POST['year1']) || empty($_POST['year2'])){
        echo "*All fields are required*";
    }
    else{
        $startingYear = $_POST['year1'];
        $endingYear = $_POST['year2'];
        calender($startingYear, $endingYear);
    }
}
function calender($year1, $year2){
    for ($i=$year1; $i <= $year2 ; $i++) { 
        for ($j=1; $j <= 12 ; $j++) { 
            $numberOfDays = date('t',mktime(0,0,0,$j,1,$i));
            echo "<table>";
            echo"<th>Monday</th>";
            echo"<th>Tuesday</th>";
            echo"<th>Wedensday</th>";
            echo"<th>Thursday</th>";
            echo"<th>Friday</th>";
            echo"<th>Saturday</th>";
            echo"<th>Sunday</th>";
            echo"<tr>";
            for ($k=1; $k <= $numberOfDays; $k++) { 
                echo"<tr>";     
                for($l=1; $l <= 7; $l++){
                    $size = date('N',mktime(0,0,0,$j,$i,$k));
                    // echo $size;
                    // if($k == $size){
                //         if($k == $numberOfDays+1){
                //             break;
                        // }
                        echo "<td>".date('D-d-m-y', mktime(0,0,0,$j,$k,$i))."</td>";
                
                //         $k++;
                    // }
                    // else{
                        echo "&nbsp";   
                        //     echo "<td></td>";
                    // }
                }
                echo"</tr>";   
                //  $k = $k-1;
                // echo"</tr>";       
            }
            echo "</table>";
        }
    }
}
 ?>   