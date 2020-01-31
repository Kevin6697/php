<?php
if(isset($_POST['fileUpload'])){
    if(!empty($_FILES['image']['name'])){
        $allowedExtension = array('png', 'jpg', 'jpeg', 'gif');
        $name = $_FILES['image']['name'];
        $size = $_FILES['image']['size'];
        $tmpName = $_FILES['image']['tmp_name'];
        $maxFileSize =100000;
        $extension = substr($name, strpos($name, '.')+1);
        if(in_array($extension, $allowedExtension) && $size <= $maxFileSize){
            $location = 'files/';
            $destination = $location.$name;
            if(move_uploaded_file($tmpName,$destination )){
                echo "File Uploaded";
            }else{
                echo "Error while Uploading";
            }
        }else{
            echo "This type of file is not allowed or excceded from the  max size ";   
        }
    }else{
        echo "Select File for Upload";
    }
}

?>
<!DOCTYPE HTML>
    <html>
        <head></head>
        <body>
            <form action="<?php echo $_SERVER['PHP_SELF'];?>" enctype='multipart/form-data' method="post">
                <input type=file name=image >
                <br/><br/>
                  <input type=submit name=fileUpload value="Upload">             
            </form>
        </body>
    </html>
