<?php

namespace Apps\Controllers\Admin;
use \Core\View;
use \Apps\Models\Vehicle;

class AdminHome extends \Core\Controller{
    public function indexAction(){
        $query ="SELECT * FROM service_registrations INNER JOIN users ON users.user_id = service_registrations.user_id";
        $data = Vehicle::fetchAll($query);
        View::renderTemplate('dashboard.html',['data' => $data]);
    }
    public function updateAction(){
        if(!isset($_POST['update'])){
            $query ="SELECT * FROM service_registrations INNER JOIN users ON users.user_id = service_registrations.user_id WHERE service_id =".$this->route_params['id'];
            $data = Vehicle::fetchRow($query);
            View::renderTemplate('updateRegistration.html',['data' => $data]);
        }else{
                $data = $this->cleanArray($_POST['vehicle']);
                $timeslotAvailable = true;
                if(array_key_exists('timeslot', $data)){
                    $timeslotAvailable = $this->checkTimeSlot($data['timeslot'], $data['date']); 
                }
                if($timeslotAvailable == false){
                    $_SESSION['errorMessage'] = "Sorry max limit for time slot";
                    unset($_POST['update']);
                    $redirect = $_SESSION['base_url']."/public/admin/adminHome/update/".$_POST['vehicle']['service_id'];
                    header("Location:$redirect");
                }else{
                    $table = 'service_registrations';
                    $where = "service_id =".$_POST['vehicle']['service_id'];
                    $user_id = Vehicle::update($data, $where, $table);
                    if($user_id > 0){
                    $_SESSION['errorMessage'] = "Updated Successsfully";
                            $redirect = $_SESSION['base_url']."/public/admin/adminHome";
                            header("Location:$redirect");  
                        }else{
                            $_SESSION['errorMessage'] = "Cannot Update or Nothing to Update";
                            unset($_POST['update']);
                            $redirect = $_SESSION['base_url']."/public/admin/adminHome/update/".$_POST['vehicle']['service_id'];
                            header("Location:$redirect");        
                        }
                }
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
                    if($fielValues['previous_slot'] != $fielValues['time_slot']){
                        $data['timeslot'] = $values; 
                    }
                break;
                case 'vehicle_issue':
                    $data['vehicle_issue'] = $values;
                break;
                case 'service_center':
                    $data['service_center'] = $values;
                break;
                case 'status':
                    $data['status'] = $values;
                break;
            }
        }
        return $data;
    } 
}