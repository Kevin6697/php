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
                case 'catId':
                    return $data['catId'];
                break;  
                case 'title':
                    return $data['catTitle'];
                break;
                case 'content':
                    return $data['catContent'];
                break;
                case 'url':
                    return $data['catUrl'];
                break;
                case 'meta':
                    return $data['catMetaTitle'];
                break;
                case 'parentId':
                    return $data['parentCatId'];
                break;
                case 'postId':
                    return $data['postId'];
                break;
                case 'postTitle':
                    return $data['postTitle'];
                break;
                case 'postContent':
                    return $data['postContent'];
                break;
                case 'postURL':
                    return $data['postUrl'];
                break;
                case 'postPublish':
                    return $data['postPublishedAt'];
                break;
                // case 'postCategoryId':
                //     return $data['catId'];
                // break;

            }
        }
    }
    function passRegistrationValues($section){
        $errors = [];
        foreach($_POST[$section] as $key=>$value){
            $tmp = Validate($key, $value);
            if($tmp != "") {
                array_push($errors, $tmp);
            }    
        }
        if(sizeof($errors) != 0){
            $errors = implode('<br/>', $errors);
            echo $errors;
        }else{
           $data =  insertValue($_POST[$section]);
           $tableName = 'user';
           $data['custCreatedAt'] = date('y-m-d');
           $field = 'custId';
           $where = "custEmail = '".$data['custEmail']."'";  
           $obj = new DBConfig;
           if($obj->isUnique($tableName,$field, $where)){
            echo "Email Already Exists";
           }else{
                $status = $obj->insert($data, $tableName);
                if($status == 0){
                    echo "<br>Error";
                }else{
                    header("Location: index.php");
                }
           }
        }
    }
    function Validate($key, $value){
        $errors = [];
        switch($key){
            case 'firstname' :
                if($value == ""){
                    return ucfirst($key)." required ";
                }else if(preg_match('/^[A-z]+$/', $value) == false){
                    return ucfirst($key)." invalid";
                }
            break;

            case 'lastname' :
                if($value == ""){
                    return ucfirst($key)." required ";
                }else if(preg_match('/^[A-z]+$/', $value) == false){
                    return ucfirst($key)." invalid";
                }
            break; 

            case 'email' :
                if($value == ""){
                    return ucfirst($key)." required ";
                }else if(preg_match('/[a-zA-Z0-9._-]+\@[a-zA-Z]+\.[a-zA-Z.]{2,5}/', $value) == false){
                    return ucfirst($key)." invalid";
                }
            break; 

            case 'number' :
                if($value == ""){
                    return ucfirst($key)." required ";
                }else if(preg_match('/^[1-9]{1}[0-9]{9}$/', $value) == false){
                    return ucfirst($key)." invalid";
                }
            break;
            
            case 'password' :
                if($value == ""){
                    return ucfirst($key)." required ";
                }
            break;
            
            case 'cnfPwd' :
                if($value == ""){
                    return "Confrim Password required ";
                }else if($_POST['register']['password'] != $value){
                    return "Password and Confirm Password Doesn't Match";
                }            
            break;
            
        }
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
    function passLoginValues($section){
           $data =  insertValue($_POST[$section]);
           $tableName = ['user']; 
           $field = ['custId'];
           $where = "custEmail ='". $data['custEmail']."' AND custPwd ='".$data['custPwd']."'";
           $obj = new DBConfig;
           $result = $obj->fetchRow($where, $field, $tableName);  
           if(mysqli_num_rows($result) <= 0){
               echo "<br>Invalid Username and password";
           }else{
               $data = mysqli_fetch_row($result);
               $_SESSION['custId'] = $data[0];
               $tableName = 'user';
               $lastLogin['custLastLogin'] = date('y-m-d');  
               $where = "custId = ".$data[0];
               $status = $obj->update($lastLogin, $tableName, $where);
                header("Location: blogpost.php");
           }
    }
    function passUpdateValues($section, $id){
        $data =  insertValue($_POST[$section]);
        $tableName = 'user';
        $field = 'custId';
        $where="custEmail = '".$data['custEmail']."' and custId !=$id";
        $data['custUpdatedAt'] = date('y-m-d');  
        $obj = new DBConfig;
        if($obj->isUnique($tableName,$field, $where)){
            echo "Email Already Exists";
        }else{    
            $where = "custId = ".$id; 
            $status = $obj->update($data, $tableName, $where);
            if($status == 0){
                echo "<br>Error";
            }else{
                header("Location: blogpost.php");
                unset($_SESSION['dataObj']);
            }
        }   
    }
    function displayCategory(){
        $field ="*";
        $tableName = ["category"];
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
    function passUpdateCategory($section, $id){
        $data =  prepareCategory($_POST[$section],$_FILES, $status ="update");
        $tableName = 'category';
        $data['catUpdatedAt'] = date('y-m-d');  
        $where = "catId = ".$_POST[$section]['catId'];   
        $obj = new DBConfig;
        $status = $obj->update($data, $tableName, $where);
        if($status == 0){
            echo "<br>Error";
        }else{
            header("Location: viewCategory.php");
            unset($_SESSION['dataObj']);
        }
    }
    function prepareCategory($fetchedValues, $file, $status = "insert"){
        $data = [];
        $location= "uploads/";
        $name =  $file['file']['name'] ;  
        $tmp =  $file['file']['tmp_name'] ;
        if(move_uploaded_file($tmp, $location.$name)){
            $data['catFile'] = $name;       
        }else{
            if($status == "insert"){
                die("File cannot be uploaded");
            }else{
                echo "File cannot be uploaded";
            }
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
                   if($fetchedValues['parentId'] == ""){
                    unset($fetchedValues['parentId']);
                //    }else if($fetchedValues['parentId'] == "0"){
                    // $data['parentCatId'] = NULL;
                   }else{
                    $data['parentCatId'] = $fetchedValues['parentId'];
                   }
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
    function deletePost($postId){
        $tableName ="post";
        $where = "postId = $postId";
        $obj = new DBConfig;
           $status = $obj->delete($where, $tableName);
           if($status == 0){
               echo "<br>Error";
           }else{
               header("Location: blogpost.php");
           }
    }
 
    function displayBlog(){
        $field ="*";
        $tableName = ["post"];
        $where = "post.custId = ". $_SESSION['custId'];
        $obj = new DBConfig; 
        $result = $obj->fetchAll($field,$tableName, $where);
        return $result;   
    }
    function passpostValues($section, $file)
    {
        $data =  preparePost($_POST[$section],$file);
        $tableName = 'post';
        $data['postCreatedAt'] = date('y-m-d');  
        $data['custId'] = $_SESSION['custId'];
        $obj = new DBConfig;
        $id = $obj->insert($data, $tableName);
        $status = 0;
        if($id == 0){
            echo "<br>Error";
        }else{
           foreach($_POST[$section] as $key){
                if(is_array($key)){
                    foreach($key as $value){
                        $tableName = 'post_category';
                        $dataId['postId'] = $id;
                        $dataId['categoryId'] = $value; 
                        $status = $obj->insert($dataId, $tableName);
                    }
                }
           } 
            if($status == 0){
                echo "Error";
            }else{
                header("Location: blogpost.php");
            }
        }
    }
    function preparePost($fetchedValues, $file, $status="insert"){
        $data = [];
        $location= "uploads/";
        $name =  $file['file']['name'] ;  
       $tmp =  $file['file']['tmp_name'] ;
        if(move_uploaded_file($tmp, $location.$name)){
            $data['postImage'] = $name;       
        }else{
            if($status == "insert"){
                die("File cannot be uploaded");
            }else{
                echo "File cannot be uploaded";
            }
        }
        foreach($fetchedValues as $key=>$value){
            switch($key){
                case 'postTitle':
                    $data['postTitle'] = $fetchedValues['postTitle'];
                break;
                case 'postContent':
                    $data['postContent'] = $fetchedValues['postContent'];
                break;
                case 'postURL':
                    $data['postUrl'] = $fetchedValues['postURL'];
                break;
                case 'postPublish':
                    $data['postPublishedAt'] = $fetchedValues['postPublish'];
                break;
            }
          
        }
        return $data;
    }
    function displayCategoryPost($id){
        $field ="c.catTitle";
        $tableName = ["post_category pc ", "category c "];
        $where = "pc.postId = $id AND pc.categoryId = c.catId ";
        $obj = new DBConfig; 
        $result = $obj->fetchAll($field,$tableName, $where);
        return $result;   
    }   
    function passUpdatePostBlog($section, $id){
        $data =  preparePost($_POST[$section],$_FILES, $status ="update");
        $tableName = 'post';
        $data['postUpdatedAt'] = date('y-m-d');  
        $where = "postId = ".$id;   
        $obj = new DBConfig;
        $status = $obj->update($data, $tableName, $where);
        if($status == 1){   
            if(isset($_POST[$section]['postCategoryId'])){
                $tableName ="post_category";
                $where = "postId = $id";
                $obj->delete($where, $tableName);
                foreach($_POST[$section] as $key){
                    if(is_array($key)){
                        foreach($key as $value){
                            $dataId['postId'] = $id;
                            $dataId['categoryId'] = $value; 
                            $status = $obj->insert($dataId, $tableName);
                        }
                    }
               }
            }
            header("Location: blogpost.php");    
        }else{
            echo "Error";
        }
    }

?>