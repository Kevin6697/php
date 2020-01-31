<?php
session_start();
// session_destroy();
require_once 'commonOperations.php';


function getFieldValue($section, $fieldName, $returnType = ""){
    return (isset($_POST[$section][$fieldName]))
                ? $_POST[$section][$fieldName] 
                : displayDataForUpdate($section, $fieldName, $returnType);
}
function passValues($sectionName, $custId = 0){
    if(isset(($_POST[$sectionName])) && $sectionName == "account"){
        return insertValues($_POST[$sectionName], "account", $custId);
     }if(isset(($_POST[$sectionName])) && $sectionName == "address"){
        return insertValues($_POST[$sectionName], "address", $custId);
     }if(isset($_POST[$sectionName]) && $sectionName =="other"){
        return insertValues($_POST[$sectionName], "other", $custId);
     }
}

function passValuesForUpdate($sectionName, $custId){
    if(isset(($_POST[$sectionName])) && $sectionName == "account"){
        return updateValues($_POST[$sectionName], "account", $custId);
     }if(isset(($_POST[$sectionName])) && $sectionName == "address"){
        return updateValues($_POST[$sectionName], "address", $custId);
     }if(isset($_POST[$sectionName]) && $sectionName =="other"){
        return updateValues($_POST[$sectionName], "other", $custId);
     }
}

function register(){
    $custId = passValues("account", 0);
    if($custId != 0){
        if(passValues("address", $custId) != 0){
            if(passValues("other", $custId)){
                echo "<script>alert('Inserted');
                    window.location.href='form.php';
                </script>";
            }else{
                echo "Error";
            }
        }else{
            echo "Error";
        }
    }else{
        echo "Error";
    }
}


if(isset($_POST['submit'])){
    register();
}
if(isset($_POST['deleteButton'])){
   $status = deleteData($_POST['custId']);
   echo "<script>alert('Deleted');
                    window.location.href='form.php';
        </script>";
}
function edit($custId){
    echo $custId;
    if(passValuesForUpdate("account", $custId)!= 0){
        if(passValuesForUpdate("address", $custId) != 0){
            if(passValuesForUpdate("other", $custId)){
                echo "<script>alert('Updated');
                    window.location.href='form.php';
                </script>";
                unset($_SESSION['dataCustomerForUpdate']);
                unset($_SESSION['id']);
            }else{
                echo "Error";
            }
        }else{
            echo "Error";
        }
    }else{
        echo "Error";
    }
}


if(isset($_POST['edit'])){
   edit($_POST['custId']);
}

if(isset($_POST['deleteButton'])){
   $status = deleteData($_POST['custId']);
   echo "Data deleted successfully";
}

if(isset($_GET['id'])) {
   $dataCustomerForUpdate =  getDataForUpdate($_GET['id']);
   $_SESSION['dataCustomerForUpdate'] = mysqli_fetch_assoc($dataCustomerForUpdate);
    $_SESSION['id'] = $_GET['id'];
} 
function displayDataForUpdate($sectionName, $fieldName, $returnType){
    if(!isset($_SESSION['dataCustomerForUpdate'])){
        return $returnType;
    }else if(isset($_SESSION['dataCustomerForUpdate'])){
        $data = $_SESSION['dataCustomerForUpdate'];
        switch ($fieldName){
            case 'prefix' :
                return $data['custPrefix'];
            break;
            case 'firstname':
                return $data['custFirstName'];
            break;
            case 'lastname' :
                return $data['custLastName'];
            break;
            case 'dob';
                return $data['custDOB'];
            break;
            case 'phoneNumber':
                return $data['custNumber'];
            break;
            case 'email':
                return $data['custEmail'];
            break;
            case 'pwd':
                return $data['custPassword'];
            break;
            case 'add1':
                return $data['cust_addAdd1'];
            break;
            case 'add2':
                return $data['cust_addAdd2'];
            break;
            case 'company':
                return $data['cust_addCompany'];
            break;
            case 'city':
                return $data['cust_addCity'];
            break;
            case 'state':
                return $data['cust_addState'];
            break;
            case 'country':
                return $data['cust_addCountry'];
            break;
            case 'postalCode':
                return $data['cust_addPostal'];
            break;
        }
    }
    if($sectionName == "other"){
          $otherDataForUpdate =  displayOthersForUpdate($_SESSION['id'],$fieldName);
          $data = mysqli_fetch_Assoc($otherDataForUpdate);
        if($data['cust_add_infoFieldKey'] == 'touch' || $data['cust_add_infoFieldKey'] == 'hobbies'){
                $data['cust_add_infoValue'] = explode(',',$data['cust_add_infoValue']);
            }
          return $data['cust_add_infoValue'];
    }else{
         $returnType;
     }
}

?>