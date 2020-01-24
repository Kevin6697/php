<?php
    session_start();
    // session_destroy();
?>
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
                <input type=text name=month placeholder="month" value=<?php if(isset($_POST['month'])){echo $_POST['month'];}else if(isset($_SESSION['month'])){echo $_SESSION['month'];}?>>
                <br/><br/>
                <input type=text name=year placeholder="year" value=<?php if(isset($_POST['year'])){echo $_POST['year'];}else if(isset($_SESSION['year'])){echo $_SESSION['year'];}?>>
                <br/><br/>
                <input type=submit name=calender value="Calender">
                
            </form>
        </body>
    </html>
<?php

function calender($month, $year){
    $numberOfDays = date('t',mktime(0,0,0,$month,1,$year));
    echo"<table border=0 cellpadding=5>";
    echo"<th>Monday</th>";
    echo"<th>Tuesday</th>";
    echo"<th>Wedensday</th>";
    echo"<th>Thursday</th>";
    echo"<th>Friday</th>";
    echo"<th>Saturday</th>";
    echo"<th>Sunday</th>";
    for ($i=1; $i <= $numberOfDays; $i++) {
        // for ($j=1; $j <= 1 ; $j++) { 
        echo"<tr>";
        for($k=1; $k <= 7; $k++){
            $size = date('N',mktime(0,0,0,$month,$i,$year));
            if($k == $size){
                if($i == $numberOfDays+1){
                    break;
                }
                echo "<td align=center>".date(' d ',mktime(0,0,0,$month,$i,$year))."</td>";    
                $i++;
            }else{
                echo "<td></td>";
            }
         }
         $i = $i-1;
         echo "</tr>";
       }
    //    if($flag == 1){
    // break;
    // }
    // }
    echo "</table>";
}

if(isset($_POST['calender'])){
    if(empty($_POST['month']) || empty($_POST['year'])){
        echo "*All fields are required*";
    }
    else{
        $month = $_POST['month'];
        $year = $_POST['year'];
        calender($month, $year);
        $_SESSION['month'] = $month;
        $_SESSION['year'] = $year;
    }
}else if(isset($_SESSION['month']) && isset($_SESSION['year'])){
    calender($_SESSION['month'], $_SESSION['year']);
}


?>