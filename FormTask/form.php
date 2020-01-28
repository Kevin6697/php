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
            <div id="otherForm" style="display : block ;">
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
                    <input type="submit" name="submit" value="Submit" />
                </fieldset>
            </div>
        </form>
    </div>
</body>

</html>