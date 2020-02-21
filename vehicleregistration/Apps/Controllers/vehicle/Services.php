<?php

namespace Apps\Controllers\Vehicle;
use \Core\View;
use Apps\Models\Vehicle;

class Services extends \Core\Controller{
    public function indexAction(){
        if($this->isLoggedIn()){
            View::renderTemplate('home.html');
        }else{
            $redirect = $_SESSION['base_url']."/public/user/index";
            header("Location:$redirect"); 
        }
    }
    public function registerAction(){
        if($this->isLoggedIn()){
            if(!isset($_POST['register'])){
                View::renderTemplate('vehicleRegistration.html');
            }else{
                $data = $this->cleanArray($_POST['vehicle']);
                // var_dump(date('y-m-d'));
                // if($data['date'] <= date('y-m-d')){
                //     echo "enter Valid date";
                // }
                // die();
                // if($data['date'] ==)
                $timeslotAvailable = $this->checkTimeSlot($data['timeslot'], $data['date']);
                if($timeslotAvailable == false){
                    $_SESSION['errorMessage'] = "Sorry max limit for time slot";
                    $redirect = $_SESSION['base_url']."/public/vehicle/services/register";
                    header("Location:$redirect");  
                }else{
                    $data['user_id'] = $_SESSION['user_id'];
                    $table = 'service_registrations';
                    $user_id = Vehicle::insert($data, $table);
                    if($user_id > 0){
                        $_SESSION['errorMessage'] = "Registered Successsfully";
                        $redirect = $_SESSION['base_url']."/public/vehicle/services/index";
                        header("Location:$redirect");  
                    }else{
                        $_SESSION['errorMessage'] = "Cannot Register";
                        View::renderTemplate('vehicleRegistration.html',['data' =>$_POST]);         
                    }
                }
            }
        }else{
            $redirect = $_SESSION['base_url']."/public/user/index";
            header("Location:$redirect"); 
        }
    }
    public function checkTimeSlot($time, $date){
    $query = "SELECT count(*) AS time FROM service_registrations  WHERE timeslot = '$time' AND date = '$date' GROUP BY timeslot";
     $result = Vehicle::fetchRow($query);
        if($result['time'] >= 3){
            return false;
        }else{
            return true;
        } 
        
    }
    public function checkvehicleAction(){
        if(isset($_GET['vehicle'])){
            $jsonData = (array) json_decode($_GET['vehicle']);
            $table = 'service_registrations';
            $where = "vehicle_number ='".$jsonData['vehicleNumber']."'";
            $unique = Vehicle::is_unique('*',$table, $where);
            if($unique == 0){
                return 0;
            }else{
                return 1;
            }
        }
    }
    public function checklicenseAction(){
        $jsonData = (array) json_decode($_GET['license']);
        $table = 'service_registrations';
        $where = "user_license_number ='".$jsonData['licenseNumber']."'";
        $unique_license = Vehicle::is_unique('*',$table, $where);
        var_dump($unique_license);
     
        return $unique_license;
    }
    protected function cleanArray($fielValues){
        $data = [];
        foreach($fielValues as $key=>$values){
           switch($key){
                case 'title':
                    $data['title'] = $values;
                break;
                case 'user_license_number':
                    $data['user_license_number'] = $values;
                break;
                case 'vehicle_number':
                    $data['vehicle_number'] = $values;
                break;    
                case 'date':
                    $data['date'] = $values;
                break;
                case 'time_slot':
                    $data['timeslot'] = $values;
                break;
                case 'vehicle_issue':
                    $data['vehicle_issue'] = $values;
                break;
                case 'service_center':
                    $data['service_center'] = $values;
                break;
            }
        }
        return $data;
    } 
    protected function isLoggedIn(){
        if(isset($_SESSION['user_id'])){
            return true;
        } else{
            return false;
        }
    }
}