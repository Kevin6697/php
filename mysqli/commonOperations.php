<?php

require_once 'dbConfig.php';

function insertValues($fetchedValues, $section, $custId){
        $dbConfigObj = new DBConfig();
        switch($section){
            case "account":
                // $fields = ['custPrefix','custFirstName', 'custLastName', 'custDOB', 'custNumber', 'custEmail', 'custPassword'];
                // $values = [$fetchedValues['prefix'],$fetchedValues['firstname'], $fetchedValues['lastname'],$fetchedValues['dob'],$fetchedValues['phoneNumber'], $fetchedValues['email'], md5($fetchedValues['pwd'])];
                //$data = array_combine($fields, $values);
                $tableName = 'customer';
                $data = prepareAccount($fetchedValues);
                $status =  $dbConfigObj->insert($data, $tableName);    
            break;

            case "address" :
                // $fields = ['custId', 'cust_addAdd1', 'cust_addAdd2', 'cust_addCompany', 'cust_addCity', 'cust_addState', 'cust_addCountry', 'cust_addPostal'];
                // $values = [$custId, $fetchedValues['add1'], $fetchedValues['add2'],$fetchedValues['company'],$fetchedValues['city'], $fetchedValues['state'],$fetchedValues['country'], $fetchedValues['postalCode']];
                //$data = array_combine($fields, $values);
                $tableName = 'customer_address';
                $data = prepareAddrress($fetchedValues);
                $data['custId'] = $custId;
                $status =  $dbConfigObj->insert($data, $tableName);    
            break;

            case "other" :
                foreach($fetchedValues as $key=>$value){
                    if(is_array($value)){
                        $fetchedValues[$key] = implode(",",$value); 
                    }
                }
                $data=[];
                $tableName = 'customer_additional_info';
                foreach($fetchedValues as $key=>$value){
                    $data = prepareAdditional($key, $value);
                    $data['custId'] = $custId;
                    $status =  $dbConfigObj->insert($data, $tableName);    
                }
             break;
        }
    return $status;
}

function updateValues($fetchedValues, $section, $custId){
    $dbConfigObj = new DBConfig();
     switch($section){
        case "account":
            // $fields = ['custPrefix','custFirstName', 'custLastName', 'custDOB', 'custNumber', 'custEmail', 'custPassword'];
            // $values = [$fetchedValues['prefix'],$fetchedValues['firstname'], $fetchedValues['lastname'],$fetchedValues['dob'],$fetchedValues['phoneNumber'], $fetchedValues['email'], md5($fetchedValues['pwd'])];
            //$data = array_combine($fields, $values);
            $tableName = 'customer';
            $where = "custId =". $custId;
            $data = prepareAccount($fetchedValues);
            $status =  $dbConfigObj->update($data, $tableName, $custId, $where);    
        break;

        case "address" :
            // $fields = ['custId', 'cust_addAdd1', 'cust_addAdd2', 'cust_addCompany', 'cust_addCity', 'cust_addState', 'cust_addCountry', 'cust_addPostal'];
            // $values = [$custId, $fetchedValues['add1'], $fetchedValues['add2'],$fetchedValues['company'],$fetchedValues['city'], $fetchedValues['state'],$fetchedValues['country'], $fetchedValues['postalCode']];
            //$data = array_combine($fields, $values);
            $tableName = 'customer_address';
            $where = "custId =". $custId;
            $data = prepareAddrress($fetchedValues);
            $status =  $dbConfigObj->update($data, $tableName, $custId, $where);    
        break;

        case "other" :
            foreach($fetchedValues as $key=>$value){
                if(is_array($value)){
                    $fetchedValues[$key] = implode(",",$value); 
                }
            }
            $data=[];
            $tableName = 'customer_additional_info';
            foreach($fetchedValues as $key=>$value){
                $data = prepareAdditional($key, $value);
                $where = "custId =" .$custId." and  cust_add_infoFieldKey= '".$key."'";
                $status =  $dbConfigObj->update($data, $tableName, $custId, $where);    
            }
         break;
    }
return $status;
}

function prepareAccount($fetchedValues){
    $data = [];
    foreach ($fetchedValues as $key=>$value){
        switch($key){
            case "prefix" :
                $data['custPrefix'] = $value;
            break;

            case "firstname" :
                $data['custFirstName'] = $value;
            break;
            
            case "lastname" :
                $data['custLastName'] = $value;
            break;

            case "dob" :
                $data['custDOB'] = $value;
            break;

            case "phoneNumber" :
                $data['custNumber'] = $value;
            break;

            case "email" :
                $data['custEmail'] = $value;
            break;

            case "pwd" :
                $data['custPassword'] = $value;
            break;
        }
    }
    return $data;
}

function prepareAddrress($fetchedValues){
    $data = [];
    foreach ($fetchedValues as $key=>$value){
        switch($key){
            case "add1" :
                $data['cust_addAdd1'] = $value;
            break;

            case "add2" :
                $data['cust_addAdd2'] = $value;
            break;
            
            case "company" :
                $data['cust_addCompany'] = $value;
            break;

            case "city" :
                $data['cust_addCity'] = $value;
            break;

            case "state" :
                $data['cust_addState'] = $value;
            break;

            case "country" :
                $data['cust_addCountry'] = $value;
            break;

            case "postalCode" :
                $data['cust_addPostal'] = $value;
            break;
        }
    }
    return $data;
}
function prepareAdditional($key, $value){
    $data = [];
   $data['cust_add_infoFieldKey'] = $key;
   $data['cust_add_infoValue']  = $value;
    return $data;
}

function displayData(){
     $query = "
            select
                    C.custId, 
                    C.custFirstName,
                    C.custLastName,
                    C.custDOB,
                    CA.cust_addAdd1,
                    HOBBIES.cust_add_infoValue hobbies,
                    TOUCH.cust_add_infoValue touch
            FROM
                customer C 
            LEFT JOIN 
                customer_address CA
            ON
                C.custId = CA.custId
            LEFT JOIN 
                customer_additional_info HOBBIES
            ON
                C.custId = hobbies.custId
            AND
                hobbies.cust_add_infoFieldKey = 'hobbies'	
           LEFT JOIN 
                customer_additional_info touch
            ON 
                C.custId = touch.custId    
            AND
                touch.cust_add_infoFieldKey = 'touch'    
                ";
    $dbConfigObj = new DBConfig();
    $custData = $dbConfigObj->fetchAll($query);
    return $custData;
}

function deleteData($custId){
    $where = "custId = $custId";
    $table = 'customer';
    $dbConfigObj = new DBConfig();
    $status = $dbConfigObj->delete($table,  $where);
    return $status;
}
function getDataForUpdate($id){
    $query = "
    select
           *
    FROM
        customer C 
    LEFT JOIN 
        customer_address CA
    ON
        C.custId = CA.custId
    WHERE
        C.custId =$id    
  ";
    $dbConfigObj = new DBConfig();
    $custData = $dbConfigObj->fetchAll($query);
    return $custData;
}
function displayOthersForUpdate($id, $fieldName){
     $query = "
    select
           *
    FROM
        customer C 
    LEFT JOIN 
        customer_additional_info CO
    ON
        C.custId = CO.custId
    AND
        CO.cust_add_infoFieldKey = '$fieldName'    
    WHERE
        C.custId =$id    
  ";
    $dbConfigObj = new DBConfig();
    $custData = $dbConfigObj->fetchAll($query);
    return $custData;
}

?>