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
                <input type=text name=year1 placeholder="Starting year" value=<?php if(isset($_POST['year1'])){echo $_POST['year1'];}?> >
                <br/><br/>
                <input type=text name=year2 placeholder="Ending year" value=<?php if(isset($_POST['year2'])){echo $_POST['year2'];}?>>
                <br/><br/>
                <input type=submit name=calender value="Calender">
                
            </form>
        </body>
    </html>

 <?php
 
 if(isset($_POST['calender'])){
    if(empty($_POST['year1']) || empty($_POST['year2'])){
        echo "*All fields are required*";
    }else if($_POST['year1'] > $_POST['year2']){
        echo "Enter Valid Years";
    }
    else{
        $startingYear = $_POST['year1'];
        $endingYear = $_POST['year2'];
        calender($startingYear, $endingYear);
    }
}
function calender($year1, $year2){
    for ($i=$year1; $i <= $year2 ; $i++) { 
        echo "<h1>$i</h1>";
        for ($j=1; $j <= 12 ; $j++) { 
            echo "<h2>".date('F', mktime(0,0,0,$j,1,$i))."</h2>";
            $numberOfDays = date('t',mktime(0,0,0,$j,1,$i));
            echo "<table border=0 cellpadding=2>";
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
                    $size = date('N',mktime(0,0,0,$j,$k,$i));
                    if($l == $size){
                        if($k == $numberOfDays+1){
                            break;
                        }
                        echo "<td align=center>".date('d', mktime(0,0,0,$j,$k,$i))."</td>";
                        $k++;
                    }
                    else{
                        echo "<td></td>";
                    }
                }
                $k = $k-1;
                echo"</tr>";       
            }
            echo "</table><br/>";
        }
    }
}
 ?>   