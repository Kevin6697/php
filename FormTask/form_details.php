<?php
session_start();
// session_destroy();


function getFieldValue($section, $fieldName, $returnType = ""){
    return (isset($_POST[$section][$fieldName]) ? $_POST[$section][$fieldName] : (isset($_SESSION[$section][$fieldName]) ? $_SESSION[$section][$fieldName] : $returnType));
}


function setSessionValue($sectionName){
    $validationErrors = [];
    if(isset($_POST[$sectionName])){
        foreach($_POST[$sectionName] as $key=>$value){
            isValidate($key, $value) ? "": array_push($validationErrors, "<br>Invalid $key");
        }
    }
    if(sizeof($validationErrors)  != 0 ){
        $errors =implode('', $validationErrors);
        echo $errors; 
    }else{
        return (isset($_POST[$sectionName])) ? $_SESSION[$sectionName] = $_POST[$sectionName] : "";
    }
}



function isValidate($fieldName, $value){
    switch($fieldName){
        case 'firstname':
        case 'lastname':
            return preg_match('/^[A-z]+$/', $value);
        break; 
        
        case 'phoneNumber' :
            return preg_match('/^[1-9]{1}[0-9]{9}$/', $value);     
        break;

        case 'email':
            return preg_match('/[a-zA-Z0-9._-]+\@[a-zA-Z]+\.[a-zA-Z.]{2,5}/',$value);
        break;

        case 'addr1' :
        case 'addr2' :
            return preg_match('/[A-z0-9]{1}[A-Za-z0-9\.\-\,\s]/',$value);
        break;
        
        case 'postalCode' :
            return preg_match('/^[0-9]{6}$/',$value);
       
       case 'yourself' :
            return preg_match('/[A-z]{1}[A-z0-9]/',$value);
        break;        
            
        default:
            return 1;
        break;
         
    } 
}

// echo"<pre>";
// print_r($_POST);
// echo"</pre>";

setSessionValue("account");
setSessionValue("address");
// setSessionValue("other");
echo"<pre>";
print_r($_SESSION);
echo"</pre>";


?>