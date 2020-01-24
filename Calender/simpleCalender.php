<!DOCTYPE html>
<?php
    session_start();
    // session_destroy();
?>
    <html>
        <head>
            <title>Simple Calender</title>
            <style>
                table{
                    padding:5px;
                    text-align : center;
                    border-spacing :0px;
                    background-color : white;
                }
                div{
                    float :left;
                }
                /* table{
                    border :solid;
                } 
                img{
                    border : solid ;
                }    */
            </style>
        </head>
        <body>
            <form action="<?php echo $_SERVER['PHP_SELF'];?>" method="post" enctype="multipart/form-data">
                <input type=text name=month placeholder="month" value=<?php if(isset($_POST['month'])){echo $_POST['month'];}else if(isset($_SESSION['month'])){echo $_SESSION['month'];}?>>
                <br/><br/>
                <input type=text name=year placeholder="year" value=<?php if(isset($_POST['year'])){echo $_POST['year'];}else if(isset($_SESSION['year'])){echo $_SESSION['year'];}?>>
                <br/><br/>
                <input type=file name=image>
                <br/><br/>
                <input type=submit name=calender value="Calender">
                
            </form>
<?php
  $location = 'uploads/';
function calender($month, $year){
    $numberOfDays = date('t',mktime(0,0,0,$month,1,$year));
    echo"<br/><br/>";
    echo"<div><table>";
    echo"<th>Monday</th>";
    echo"<th>Tuesday</th>";
    echo"<th>Wedensday</th>";
    echo"<th>Thursday</th>";
    echo"<th>Friday</th>";
    echo"<th>Saturday</th>";
    echo"<th>Sunday</th>";
    for ($i=1; $i <= $numberOfDays; $i++) {
        echo"<tr>";
        for($k=1; $k <= 7; $k++){
            $size = date('N',mktime(0,0,0,$month,$i,$year));
            if($k == $size){
                if($i == $numberOfDays+1){
                    break;
                }
                echo "<td>".date(' d ',mktime(0,0,0,$month,$i,$year))."</td>";    
                $i++;
            }else{
                echo "<td></td>";
            }
         }
         $i = $i-1;
         echo "</tr>";
       }
    echo "</table></div>";
}
function fileUpload($data, $location){
    $name = $data['image']['name'];
    $allowedExtension = array('png', 'jpg', 'jpeg', 'gif');
    $extension = substr($name, strpos($name, '.')+1);
    if(!in_array($extension, $allowedExtension)){
        return false;
    }else if(move_uploaded_file($data['image']['tmp_name'], $location.$name)){
        return true;
    }else{
        return false;
    }
}
function imageDisplay($img, $location){
    echo "<img src = '".$location.$img."' height=150 width=300>";
}
if(isset($_POST['calender'])){
    if(empty($_POST['month']) || empty($_POST['year']) || empty($_FILES['image']['name'])){
        echo "*All fields are required*";      
    }
    else{
        $month = $_POST['month'];
        $year = $_POST['year'];
        calender($month, $year);
        echo"<div>";
        if(fileUpload($_FILES, $location)){
            imageDisplay($_FILES['image']['name'], $location);
            $_SESSION['imageUpload'] = $_FILES['image']['name'];
        }else{
            echo "Error Image not Uploaded or this extension is not allowed";
        }
        echo"</div>";
        $_SESSION['month'] = $month;
        $_SESSION['year'] = $year;
    }
}else if(isset($_SESSION['month']) && isset($_SESSION['year']) && isset($_SESSION['imageUpload'])){
    calender($_SESSION['month'], $_SESSION['year']);
    echo"<div>";
    imageDisplay($_SESSION['imageUpload'], $location);
    echo"</div>";    
}


?>
        </body>
    </html>