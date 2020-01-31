<!DOCTYPE html>
<html lang="en">

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
        table,td,th{
            border-spacing :0px;
            padding :10px;
            border :1px solid;  
        }
        table{
            border-collapse: collapse;
        }
        .likeabutton {
            padding: 10px 15px 11px !important;
            font-size: 18px !important;
            background-color: #57d6c7;
            font-weight: bold;
            text-shadow: 1px 1px #57D6C7;
            color: #ffffff;
            border-radius: 5px;
            -moz-border-radius: 5px;
            -webkit-border-radius: 5px;
            border: 1px solid #57D6C7;
            cursor: pointer;
            box-shadow: 0 1px 0 rgba(255, 255, 255, 0.5) inset;
            -moz-box-shadow: 0 1px 0 rgba(255, 255, 255, 0.5) inset;
            -webkit-box-shadow: 0 1px 0 rgba(255, 255, 255, 0.5) inset;
        }
    </style>

</head>

<body>
    <?php
        require_once('form_details.php');       
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
                        <select name="account[prefix]">
                            <?php $prefix = ['Mr.', 'Miss.', 'Ms.', 'Mrs.', 'Dr.']; ?>
                            <?php foreach($prefix as $value) : ?>
                            <?php $selected = in_array(getFieldValue("account","prefix"), [$value]) ? "selected":"";?>
                            <option value=<?= $value; ?> <?= $selected;?>><?= $value;?></option>
                            <?php endforeach;?>
                        </select>
                    </div>
                    <br /><br />
                    <div class="col-25">
                        <label>First Name : </label>
                    </div>
                    <div class="col-75">
                        <input type="text" required name="account[firstname]"
                            value="<?= getFieldValue("account", "firstname"); ?>">
                    </div>
                    <br /><br />
                    <div class="col-25">
                        <label>Last Name : </label>
                    </div>
                    <div class="col-75">
                        <input type="text" required name="account[lastname]" placeholder="Last Name"
                            value="<?= getFieldValue("account", "lastname");?>">
                    </div>
                    <br /><br />
                    <div class="col-25">
                        <label>Date of Birth : </label>
                    </div>
                    <div class="col-75">
                        <input type="date" name="account[dob]" value="<?= getFieldValue("account", "dob");?>" />
                    </div>
                    <br /><br />
                    <div class="col-25">
                        <label>Phone Number : </label>
                    </div>
                    <div class="col-75">
                        <input type="text" required  name="account[phoneNumber]" value="<?= getFieldValue("account", "phoneNumber");?>">
                    </div>
                    <br /><br />
                    <div class="col-25">
                        <label>Email : </label>
                    </div>
                    <div class="col-75">
                        <input type="text" required name="account[email]" value="<?= getFieldValue("account", "email");?>">
                    </div>
                    <br /><br />
                    <div class="col-25">
                        <label>Password : </label>
                    </div>
                    <div class="col-75">
                        <input type="password" required name="account[pwd]" value="<?= getFieldValue("account", "pwd");?>" />
                    </div>
                    <br /><br />
                    <div class="col-25">
                        <label>Confirm Password : </label>
                    </div>
                    <div class="col-75">
                        <input type="password"  name="account[cnfpwd]" />
                    </div>
                    <br /><br />
                </fieldset>
            </div>
            <div>
                <fieldset>
                    <legend>Address Information</legend>
                    <div class="col-25">
                        <label>Address Line 1 : </label>
                    </div>
                    <div class="col-75">
                        <textarea name="address[add1]" required rows="3"><?= getFieldValue("address", "add1");?></textarea>
                    </div>
                    <br /><br />
                    <div class="col-25">
                        <label>Address Line 2 : </label>
                    </div>
                    <div class="col-75">
                        <textarea name="address[add2]" required rows="3"><?= getFieldValue("address", "add2");?></textarea>
                    </div>
                    <br /><br />
                    <div class="col-25">
                        <label>Company : </label>
                    </div>
                    <div class="col-75">
                        <input type="text" name="address[company]" value="<?= getFieldValue("address", "company");?>" />
                    </div>
                    <br /><br />
                    <div class="col-25">
                        <label>City : </label>
                    </div>
                    <div class="col-75">
                        <input type="text" name="address[city]" value="<?= getFieldValue("address", "city");?>" />
                    </div>
                    <br /><br />
                    <div class="col-25">
                        <label>State : </label>
                    </div>
                    <div class="col-75">
                        <input type="text" name="address[state]" value="<?= getFieldValue("address", "state");?>" />
                    </div>
                    <br /><br />
                    <div class="col-25">
                        <label>Country : </label>
                    </div>
                    <div class="col-75">
                        <select name="address[country]">
                            <?php $country = ['India','USA', 'UK'];
                      foreach ($country as $value) :
                          $selected = in_array(getFieldValue('address', 'country'),[$value])? "selected" :"";?>
                            <option value=<?=  $value;?> <?= $selected ; ?>><?= $value; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <br /><br />
                    <div class="col-25">
                        <label>Postal Code : </label>
                    </div>
                    <div class="col-75">
                        <input type="text" required name="address[postalCode]"
                            value="<?= getFieldValue("address", "postalCode");?>">
                    </div>
                    <br /><br />
                </fieldset>
                <input type="checkbox" name="next" id="next" value="Next" onchange="displayOtherForm(this.checked);" />
                Other Information
                <br /><br />
            </div>
            <div id="otherForm" style="display : none ;">
                <fieldset>
                    <legend>Other Information</legend>
                    <div class="col-25">
                        <label>Describe Yourself : </label>
                    </div>
                    <div class="col-75">
                        <textarea name="other[yourself]" required rows="3"><?= getFieldValue("other", "yourself");?></textarea>
                    </div>
                    <br /><br />
                    <div class="col-25">
                        <label>Profile Upload : </label>
                    </div>
                    <div class="col-75">
                        <input type="file" name="other[profile]" />
                    </div>
                    <br /><br />
                    <div class="col-25">
                        <label>Certificate Upload : </label>
                    </div>
                    <div class="col-75">
                        <input type="file" name="other[certificate]" />
                    </div>
                    <br /><br />
                    <div class="col-25">
                        <label>How long have you been in business ?
                        </label>
                    </div>
                    <div class="col-75">
                        <?php $bussinessYears = ['UNDER 1 YEAR','1-2 YEARS','2-5 YEARS','5-10 YEARS', 'OVER 10 YEARS']; ?>
                        <?php  foreach($bussinessYears as $years) :
                      $selected = in_array(getFieldValue('other', 'bussinessYears'), [$years]) ?"checked" :"";
                    ?>
                        <input type=radio name='other[bussinessYears]' value="<?=$years;?>" <?= $selected;?>>
                        <?=$years;?>
                        <?php endforeach; ?>
                    </div>
                    <br /><br />
                    <div class="col-25">
                        <label>Number of unique clients you see each week?
                        </label>
                    </div>
                    <div class="col-75">
                        <select name="other[unqiueClients]">
                            <?php $uniqueClients = ['1-5', '6-10', '11-15', '15+'];?>
                            <?php foreach ($uniqueClients as $clients) : 
                              $selected = in_array(getFieldValue('other', 'unqiueClients'), [$clients])?"Selected" : "";
                            ?>
                            <option value="<?= $clients;?>" <?= $selected;?>><?= $clients;?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <br /><br />
                    <div class="col-25">
                        <label>How do you like us to get in touch with you ?</label>
                    </div>
                    <div class="col-75">
                        <?php $getInTouch = ['Phone', 'Email', 'SMS', 'Post'];?>
                        <?php
                            foreach($getInTouch as $touch) :
                            $checked = array_intersect(getFieldValue('other','touch',[]), [$touch])                                  ? "checked"
                                                              :"";
                       ?>
                        <input type=checkbox name="other[touch][]" value="<?=$touch;?>" <?=$checked;?> /><?=$touch;?>
                        <?php endforeach; ?>
                    </div>
                    <br /><br />
                    <div class="col-25">
                        <label>Hobbies </label>
                        <br />
                        <label>Hold down the Ctrl (windows) / Command (Mac) button to select
                            multiple options.</label>
                    </div>
                    <div class="col-75">
                        <select name="other[hobbies][]" multiple>
                            <?php $hobbies = ['Blogging', "Listening to Music", "Travelling", "Sports", "Arts"];?>
                            <?php 
                foreach($hobbies as $value) :
                   $selected = array_intersect(getFieldValue('other' ,'hobbies',[]), [$value])
                                                                ? "selected"
                                                                : "";  
             ?>
                            <option value="<?= $value?>" <?= $selected; ?>><?= $value; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <br /><br />
                <?php
                    if(isset($_SESSION['id'])){
                ?>
                  <input type="hidden" name="custId" value="<?=$_SESSION['id']; ?>" />
                  <input type="submit" name="edit" value="Edit" />
                
                <?php        
                    }else{
                ?>     
                  <input type="submit" name="submit" value="Submit" />   
                <?php        
                    }
                
                ?>
                
                  </fieldset>
            </div>
        </form>
        <br/>
        <br/>
<?php

$allData = displayData();
if(mysqli_num_rows($allData) > 0){
?> <table>
<th>Id</th><th>First Name</th>
<th>Last Name</th><th>DOB</th>
<th>Address Line 1</th>
<th> Hobbies</th>
<th> Get-In Touch</th>
<th colspan=2>Action</th>
<?php
    while($data = mysqli_fetch_assoc($allData)){
?>  
        <tr>
        <td><?=$data['custId'];?></td>
        <td><?=$data['custFirstName'];?></td>
        <td><?=$data['custLastName'];?></td>
        <td><?=$data['custDOB'];?></td>
        <td><?=$data['cust_addAdd1'];?></td>
        <td><?=$data['hobbies'];?></td>
        <td><?=$data['touch'];?></td>
        <td>
            <form action = <?php echo $_SERVER['PHP_SELF']; ?> method=post >
                <input type=hidden value=<?=$data['custId'];?> name="custId"> 
                <input type=submit value=delete name="deleteButton" onclick="return confirmation();" class="likeabutton ">
                </form>        
        </td>
        <td>
            <a href = "form.php?id=<?=$data['custId']; ?>" class="likeabutton ">Update</a>
        </td>
        </tr>
<?php } ?>
    </table>
<?php    
}else{
    echo "No Data Found";
}                
?>
    </div>
    <script>
        function displayOtherForm(checked) {
            if (checked == true) {
                document.getElementById("otherForm").style.display = "block";
            } else {
                document.getElementById("otherForm").style.display = "none";
            }
        }
        function confirmation(){
            var x = confirm("Are you sure you want to delete this data");
            if(x){
                return true;
            }else{
                return false;
            }
        }
    </script>

</body>
</html>