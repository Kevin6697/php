<?php
    if(!isset($_SESSION['custId'])){
        session_start();
    }
    require_once 'dbConfig.php';

    function getValues($section, $field, $returnType = ""){
        return (isset($_POST[$section][$field])) 
                        ? $_POST[$section][$field]
                        :displayData($section, $returnType, $field);
    }
    function passRegistrationValues($section){
        $errors = [];
        // foreach($_POST[$section] as $key=>$value){
        //      isValid($key, $value) ?"" : array_push($errors, "<br>$key is required");
        // }
        // if(sizeof($errors) != 0){
        //     $errors = implode('', $errors);
        //     echo $errors;
        // }else{
           $data =  insertValue($_POST[$section]);
           $tableName = 'user';
           $data['custCreatedAt'] = date('y-m-d');  
           $obj = new DBConfig;
           $status = $obj->insert($data, $tableName);
           if($status == 0){
               echo "<br>Error";
           }else{
               header("Location: index.php");
           }
        // }
    }
    function insertValue($fetchedValues)
    {
        $data = [];
        foreach($fetchedValues as $key=>$value){
            switch($key){
                case 'prefix':
                    $data['custPrefix'] = $fetchedValues['prefix'];
                break;
                case 'firstname':
                    $data['custFirstName'] = $fetchedValues['firstname'];
                break;
                case 'lastname':
                    $data['custLastName'] = $fetchedValues['lastname'];
                break;
                case 'email':
                    $data['custEmail'] = $fetchedValues['email'];
                break;
                case 'number':
                    $data['custMobile'] = $fetchedValues['number'];
                break;
                case 'password':
                    $data['custPwd'] = $fetchedValues['password'];
                    $data['custPwd'] = md5($data['custPwd']);
                break;
                case 'information':
                    $data['custInformation'] =$fetchedValues['information'];
                break;
            }
            
        }
        return $data;
    }
    function isValid($key, $value){
        switch($key){
            case 'firstname' :
            case 'email' :
            case 'number' :
            case 'password' :
            case 'cnfPwd ' :
                if($value == ""){
                    echo $key."<br>";
                    return false;
                }  
            break;
            
            default:
                true;
        break;
        }
    }
    function passLoginValues($section){
           $data =  insertValue($_POST[$section]);
           $tableName = 'user'; 
           $field = ['custId'];
           $where = "custEmail ='". $data['custEmail']."' AND custPwd ='".$data['custPwd']."'";
           $obj = new DBConfig;
           $result = $obj->fetchRow($where, $field, $tableName);  
           if(mysqli_num_rows($result) <= 0){
               echo "<br>Invalid Username and password";
           }else{
               $data = mysqli_fetch_row($result);
               $_SESSION['custId'] = $data[0]; 
               header("Location: blogpost.php");
           }
    }
    function displayCategory(){
        $field ="*";
        $tableName = "category";
        $obj = new DBConfig; 
        $result = $obj->fetchAll($field,$tableName);
        return $result;
    }
    function passCategoryValues($section,$file){
        $data = prepareCategory($_POST[$section], $file);
        $data['catCreatedAt']  = date('y-m-d');
        $tableName = "category";
        $obj = new DBConfig;
           $status = $obj->insert($data, $tableName);
           if($status == 0){
               echo "<br>Error";
           }else{
               header("Location: viewCategory.php");
           }
    }
    function prepareCategory($fetchedValues, $file){
        $data = [];
        $location= "uploads/";
        $name =  $file['file']['name'] ;  
       $tmp =  $file['file']['tmp_name'] ;
        if(move_uploaded_file($tmp, $location.$name)){
            $data['catFile'] = $name;       
        }else{
            die("File cannot be uploaded");
        }
        foreach($fetchedValues as $key=>$value){
            switch($key){
                case 'title':
                    $data['catTitle'] = $fetchedValues['title'];
                break;
                case 'meta':
                    $data['catMetaTitle'] = $fetchedValues['meta'];
                break;
                case 'url':
                    $data['catUrl'] = $fetchedValues['url'];
                break;
                case 'content':
                    $data['catContent'] = $fetchedValues['content'];
                break;
                case 'parentId':
                    $data['parentCatId'] = $fetchedValues['parentId'];
                break;
            }
        }
        return $data;
    }
    function deleteCategory($catId){
        $tableName ="category";
        $where = "catId = $catId";
        $obj = new DBConfig;
           $status = $obj->delete($where, $tableName);
           if($status == 0){
               echo "<br>Error";
           }else{
               header("Location: viewCategory.php");
           }
    }
    function displayData( $section, $returnType, $field){
        if(!isset($_SESSION['dataObj'])){
            return $returnType;
        }else{
            $data = $_SESSION['dataObj'];
            switch($field){
                case 'prefix':
                    return $data['custPrefix'];
                break;
                case 'custId':
                    return $data['custId'];
                break;
                case 'firstname':
                    return $data['custFirstName'];
                break; 
                case 'lastname':
                    return $data['custLastName'];
                break; 
                case 'email':
                    return $data['custEmail'];
                break; 
                case 'number':
                    return $data['custMobile'];
                break; 
                case 'information':
                    return $data['custInformation'];
                break;   
            }
        }
    }
    function passUpdateValues($section, $id){
        $data =  insertValue($_POST[$section]);
        $tableName = 'user';
        $data['custUpdatedAt'] = date('y-m-d');  
        $where = "custId = ".$id;
        $obj = new DBConfig;
        $status = $obj->update($data, $tableName, $where);
        if($status == 0){
            echo "<br>Error";
        }else{
            header("Location: blogpost.php");
            unset($_SESSION['dataObj']);
        }
    }
    function displayBlog(){
        $field ="*";
        $tableName = "post";
        $obj = new DBConfig; 
        $result = $obj->fetchAll($field,$tableName);
        return $result;   
    }
    function passpostValues($section, $file)
    {

    }

?>