<?php
  session_start();
  // session_destroy();
?>
<!DOCTYPE html>
<html>
  <head>
    <title>Registration Form</title>
    <style>
      .col-75 {
        float: left;
        width: 75%;
        margin-top: 6px;
      }

      .col-25 {
        float: left;
        width: 25%;
        margin-top: 6px;
      }
    </style>
    <script>
      function displayOtherForm(checked) {
        if (checked == true) {
          document.getElementById("otherForm").style.display = "block";
        } else {
          document.getElementById("otherForm").style.display = "none";
        }
      }
    </script>
  </head>

  <body>
    <?php
      if(isset($_POST['submit'])){
          $registeredData =[];
          extract($_POST);
          if(isset($touch)){
            $touch = $touch;
          }else{
            $touch ="";
          }
        $errors = validation($firstname, $lastname ,$email, $phone, $add1, $add2, $country, $postalCode, $yourself, $touch, $pwd, $cnfpwd);
        $fileErrors = checkFileExtension($_FILES['profile']['name'], $_FILES['certificate']['name']);
          if(sizeOf($errors) == 0 && sizeOf($fileErrors) == 0 ){
            $file = fileUpload($_FILES['profile'], $_FILES['certificate'], $firstname);
            if(!isset($file['certificateError']) && !isset($file['profileError'])){
                $_SESSION['firstName'] = $firstname;
                $_SESSION['lastName'] = $lastname;
                $_SESSION['dob'] = $dob;
                $_SESSION['phone'] = $phone;
                $_SESSION['email'] = $email;
                $_SESSION['add1'] = $add1;
                $_SESSION['add2'] = $add2;
                $_SESSION['company'] = $company;
                $_SESSION['city'] = $city;
                $_SESSION['state'] = $state;
                $_SESSION['postalCode'] = $postalCode;
                $_SESSION['yourself'] = $yourself;
                $_SESSION['touch'] = $touch;
                $_SESSION['country'] = $country;
             }
           }   
        } 
    ?>
    <div id="mainContainer">
      <form action="<?php echo $_SERVER['PHP_SELF'];?>" method="post" enctype="multipart/form-data">
        <div id="registrationForm">
          <fieldset>
            <legend>Account Details</legend>
            <div class="col-25">
              <label>Prefix : </label>
            </div>
            <div class="col-75">
              <select name="prefix">
                <option value="Mr.">Mr.</option>
                <option value="Miss.">Miss.</option>
                <option value="Ms.">Ms.</option>
                <option value="Mrs.">Mrs.</option>
                <option value="Dr.">Dr.</option>
              </select>
            </div>
            <br /><br />
            <div class="col-25">
              <label>First Name : </label>
            </div>
            <div class="col-75">
              <input type="text" name="firstname" value="<?php if(isset($firstname)){echo $firstname;}elseif(isset($_SESSION['firstName'])){ echo $_SESSION['firstName'];} ?>" placeholder="First Name" />
              <?php if(isset($errors['firstNameError'])){ echo $errors['firstNameError'];}?>
            </div>
            <br /><br />
            <div class="col-25">
              <label>Last Name : </label>
            </div>
            <div class="col-75">
              <input type="text" name="lastname" placeholder="Last Name" value="<?php if(isset($lastname)){echo $lastname;}elseif(isset($_SESSION['lastName'])){ echo $_SESSION['lastName'];}?>"  />
              <?php if(isset($errors['lastNameError'])){ echo $errors['lastNameError'];}?>
            </div>
            <br /><br />
            <div class="col-25">
              <label>Date of Birth : </label>
            </div>
            <div class="col-75">
              <input type="date" name="dob" value="<?php if(isset($dob)){echo $dob;}elseif(isset($_SESSION['dob'])){ echo $_SESSION['dob'];}?>" />
            </div>
            <br /><br />
            <div class="col-25">
              <label>Phone Number : </label>
            </div>
            <div class="col-75">
              <input type="text" name="phone"  value="<?php if(isset($phone)){echo $phone;}elseif(isset($_SESSION['phone'])){ echo $_SESSION['phone'];}?>" />
              <?php if(isset($errors['numberError'])){ echo $errors['numberError'];}?>
            </div>
            <br /><br />
            <div class="col-25">
              <label>Email : </label>
            </div>
            <div class="col-75">
              <input type="text" name="email" value="<?php if(isset($email)){echo $email;}elseif(isset($_SESSION['email'])){ echo $_SESSION['email'];}?>" />
              <?php if(isset($errors['emailError'])){ echo $errors['emailError'];}?>
            </div>
            <br /><br />
            <div class="col-25">
              <label>Password : </label>
            </div>
            <div class="col-75">
              <input type="password" name="pwd" />
            </div>
            <br /><br />
            <div class="col-25">
              <label>Confirm Password : </label>
            </div>
            <div class="col-75">
              <input type="password" name="cnfpwd" />
              <?php if(isset($errors['pwdError'])){ echo $errors['pwdError'];}?>
            </div>
            <br /><br />
          </fieldset>
          <fieldset>
            <legend>Address Information</legend>
            <div class="col-25">
              <label>Address Line 1 : </label>
            </div>
            <div class="col-75">
              <textarea name="add1" id="add1" rows="3"><?php if(isset($add1)){echo $add1;}elseif(isset($_SESSION['add1'])){ echo $_SESSION['add1'];}?></textarea>
              <?php if(isset($errors['addr1Error'])){ echo $errors['addr1Error'];}?>
            </div>
            <br /><br />
            <div class="col-25">
              <label>Address Line 2 : </label>
            </div>
            <div class="col-75">
              <textarea name="add2" id="add2" rows="3"><?php if(isset($add2)){echo $add2;}elseif(isset($_SESSION['add2'])){ echo $_SESSION['add2'];}?></textarea>
              <?php if(isset($errors['addr2Error'])){ echo $errors['addr2Error'];}?>
            </div>
            <br /><br />
            <div class="col-25">
              <label>Company : </label>
            </div>
            <div class="col-75">
              <input type="text" name="company" id="company" value="<?php if(isset($company)){echo $company;}elseif(isset($_SESSION['company'])){ echo $_SESSION['company'];}?>"/>
            </div>
            <br /><br />
            <div class="col-25">
              <label >City : </label>
            </div>
            <div class="col-75">
              <input type="text" name="city" id="city" value="<?php if(isset($city)){echo $city;}elseif(isset($_SESSION['city'])){ echo $_SESSION['city'];}?>" />
            </div>
            <br /><br />
            <div class="col-25">
              <label>State : </label>
            </div>
            <div class="col-75">
              <input type="text" name="state" id="state" value="<?php if(isset($state)){echo $state;}elseif(isset($_SESSION['state'])){ echo $_SESSION['state'];}?>" />
            </div>
            <br /><br />
            <div class="col-25">
              <label>Country : </label>
            </div>
            <div class="col-75">
              <?php
                $hayStickCountry =['India','USA','UK','China']; 
              ?>
                <select name="country">
              <option hidden>Select Country</option>
              <?php
                      foreach($hayStickCountry as $country){
                        if(isset($_SESSION['country'])){
                            if($country == $_SESSION['country']){
                            echo "<option selected value=$country>$country</option>";
                          }else{
                            echo "<option value=$country>$country</option>";
                          }
                        }else{
                          echo "<option value=$country>$country</option>";
                        } 
                      }
              ?>
              </select>
              <?php if(isset($errors['countryError'])){ echo $errors['countryError'];}?>
            </div>
            <br /><br />
            <div class="col-25">
              <label>Postal Code : </label>
            </div>
            <div class="col-75">
              <input type="text" name="postalCode" id="postalCode" value="<?php if(isset($postalCode)){echo $postalCode;}elseif(isset($_SESSION['postalCode'])){ echo $_SESSION['postalCode'];}?>" />
              <?php if(isset($errors['postalCodeError'])){ echo $errors['postalCodeError'];}?>
            </div>
            <br /><br />
          </fieldset>
          <input
            type="checkbox"
            name="next"
            id="next"
            value="Next"
            onchange="displayOtherForm(this.checked);"
          />Other Information <br /><br />
        </div>
        <div id="otherForm" style="display : none ;">
          <fieldset>
            <legend>Other Information</legend>
            <div class="col-25">
              <label>Describe Yourself : </label>
            </div>
            <div class="col-75">
              <textarea name="yourself" id="yourself" rows="3"> <?php if(isset($yourself)){echo $yourself;}elseif(isset($_SESSION['yourself'])){ echo $_SESSION['yourself'];}?></textarea>
              <?php if(isset($errors['yourselfError'])){ echo $errors['yourselfError'];}?>
            </div>
            <br /><br />
            <div class="col-25">
              <label>Profile Upload : </label>
            </div>
            <div class="col-75">
              <input type="file" name="profile" id="profile" />
              <?php if(isset($fileErrors['profileError'])){ echo $fileErrors['profileError'];}?>
            </div>
            <br /><br />
            <div class="col-25">
              <label>Certificate Upload : </label>
            </div>
            <div class="col-75">
              <input type="file" name="certificate" id="certificate" />
              <?php if(isset($fileErrors['certificateError'])){ echo $fileErrors['certificateError'];}?>
            </div>
            <br /><br />
            <div class="col-25">
              <label
                >How long have you been in business ?
              </label>
            </div>
            <div class="col-75">
              <input
                type="radio"
                name="businessYears"
                id="businessYears1"
                value="UNDER 1 YEAR"
              />UNDER 1 YEAR
              <input
                type="radio"
                name="businessYears"
                id="businessYears2"
                value="1-2 YEARS"
              />1-2 YEARS
              <input
                type="radio"
                name="businessYears"
                id="businessYears3"
                value="2-5 YEARS"
              />2-5 YEARS
              <input
                type="radio"
                name="businessYears"
                id="businessYears4"
                value="5-10 YEARS"
              />5-10 YEARS
              <input
                type="radio"
                name="businessYears"
                id="businessYears5"
                value="OVER 10 YEARS"
              />OVER 10 YEARS
            </div>
            <br /><br />
            <div class="col-25">
              <label>Number of unique clients you see each week?
              </label>
            </div>
            <div class="col-75">
              <select name="unqiueClients">
                <option value="1-5">1-5</option>
                <option value="6-10">6-10</option>
                <option value="11-15">11-15</option>
                <option value="15+">15+</option>
              </select>
            </div>
            <br /><br />
            <div class="col-25">
              <label>How do you like us to get in touch with you ?</label
              >
            </div>
            <div class="col-75">
            <?php
                $hayStick = ['Post','Email','SMS','Phone'];
                  foreach($hayStick as $value){
                    if(isset($_SESSION['touch'])){ 
                      if(in_array($value, $_SESSION['touch'])){
                          echo "<input type=checkbox name=touch[] value=$value checked/>$value";
                        }else{
                          echo"<input type=checkbox name=touch[] value=$value />$value";
                        }
                    }else{
                      echo"<input type=checkbox name=touch[] value=$value />$value";
                    }
                  }   
            ?>
              <?php if(isset($errors['touchError'])){ echo $errors['touchError'];}?>
            </div>
            <br /><br />
            <div class="col-25">
              <label>Hobbies </label>
              <br />
              <label
                >Hold down the Ctrl (windows) / Command (Mac) button to select
                multiple options.</label
              >
            </div>
            <div class="col-75">
              <select name="hobbies[]" multiple>
                <option value="Blogging">Blogging</option>
                <option value="Listening to Music">Listening to Music</option>
                <option value="Travelling">Travelling</option>
                <option value="Sports">Sports</option>
                <option value="Arts">Arts</option>
              </select>
            </div>
            <br /><br />
            <input type="submit" name="submit" value="Submit" />
          </fieldset>
        </div>
      </form>
    </div>

    <?php
   function validation($firstname, $lastname ,$email, $phone, $add1, $add2, $country, $postalCode, $yourself, $touch, $pwd, $cnfpwd){
     $errors =array();
          if(empty($firstname)){
            $errors['firstNameError'] = "First Name Required<br/>";
          }else if(preg_match('/[A-z]/',$firstname) == false){
            $errors['firstNameError'] = "First Name is Invalid<br/>";
          } if(empty($lastname)){
            $errors['lastNameError'] = "Last Name Required<br/>";
          }else if(preg_match('/[A-z]/',$lastname) == false){
            $errors['lastNameError'] = "Last Name is Invalid<br/>";
          } if(empty($email)){
            $errors['emailError'] = "Email Required<br/>";
          }else if(preg_match('/[a-zA-Z0-9._-]+\@[a-zA-Z]+\.[a-zA-Z.]{2,5}/',$email) == false){
            $errors['emailError'] = "Email is Invalid<br/>";
          }if(empty($phone)){
            $errors['numberError'] = "Phone Number Required<br/>";
          }else if(preg_match('/[1-9]{1}[0-9]{9}/',$phone) == false){
            $errors['numberError'] = "Phone Number is Invalid<br/>";
          }if($add1 == " "){
            $errors['addr1Error'] = "Address Line 1 Required<br/>";
          }else if(preg_match('/[A-z0-9]{1}[A-Za-z0-9\.\-\,\s]/',$add1) == false){
            $errors['addr1Error'] = "Address Line 1 is Invalid<br/>";
          }if($add2 == " "){
            $errors['addr2Error'] = "Address Line 2 Required<br/>";
          }else if(preg_match('/[A-z0-9]{1}[A-Za-z0-9\.\-\,\s]/',$add2) == false){
            $errors['addr2Error'] = "Address Line 2 is Invalid<br/>";
          }if($country == "Select Country"){
            $errors['countryError'] = "Select Valid Country<br/>";
          }if(empty($postalCode)){
              $errors['postalCodeError'] = "Postal Code Required<br/>";
          }else if(preg_match('/[0-9]{6}/',$postalCode) == false){
              $errors['postalCodeError'] = "Postal code is Invalid<br/>";
          }if(empty($yourself)){
              $errors['yourselfError'] = "Describe Yourself Required<br/>";
          }else if(preg_match('/[A-z]{1}[A-z0-9]/',$yourself) == false){
              $errors['yourselfError'] = "Describe Yourself is Invalid<br/>";
          }if(empty($touch)){
              $errors['touchError'] = "&nbsp How to get in touch required<br/>";
          }if(empty($pwd)){
            $errors['pwdError'] = "Password required<br/>";
          }else if(empty($cnfpwd)){
            $errors['pwdError'] = "Confrim Password required<br/>";
          }else if($pwd != $cnfpwd){
            $errors['pwdError'] = "Password and Confirm Password does not match<br/>";
          }
      return $errors;
    } 
    function checkFileExtension($profile, $certificate){
        $profileExtensions = array('jpg', 'jpeg', 'gif', 'png');
        $profile = substr($profile, strpos($profile, '.')+1);
        $certificateExtensions = array('pdf');
        $certificate = substr($certificate, strpos($certificate, '.')+1);
        $error =array();
        if(! in_array($profile, $profileExtensions)){
          $error['profileError'] = "Invalid file extension for profile <br/>";
        }if(! in_array($certificate, $certificateExtensions)){
          $error['certificateError'] = "Invalid file extension for certificate <br/>";
        }
        return $error;
    }
    function fileUpload($profile, $certificate, $name){
      $file = [];
      $location ='uploads/';
      $profileName = $profile['name'];
      $certificateName = $certificate['name'];
      $file['profile'] = $name.'_'.rand(1,100).'_'.date('d-m-y').'_'.'Profile'.$profileName;
      $file['certificate'] = $name.'_'.rand(1,100).'_'.date('d-m-y').'_'.'Certificate'.$certificateName;
      if(!move_uploaded_file($profile['tmp_name'], $location.$file['profile'])){
       $file['profileError'] = "can't Upload Profile Picture";
      }if(!move_uploaded_file($certificate['tmp_name'], $location.$file['certificate'])){
        $file['certificateError'] = "can't Upload Certificate";
       }
      return $file; 
    }

?>
</body>
</html>