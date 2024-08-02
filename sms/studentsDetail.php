<?php 
  require './partials/_nav.php';
  require './header.php'; 
  include_once './db.php';
  exit;
  @$rollnoErr = $nameErr = $emailErr = $contactErr = $courseErr = $subscriptionErr = "";
  @$rollno = $name = $email = $contact = $course = $subscription = "";
  @$signup = false;
  @$msg = '';
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (!empty($_POST['add-submit'])) {
            if(empty($_POST["rollno"])) {
                $rollnoErr = "Roll no. is required";
            } else {
                $rollno = test_input($_POST["rollno"]);
            }
            
            if(empty($_POST["name"])) {
                $nameErr = "Name is required";
            } else {
                $name = test_input($_POST["name"]);
            }
                
            if(empty($_POST["email"])) {
                $emailErr = "Email is required";
            } else {
                $email = test_input($_POST["email"]);
            }

            if(empty($_POST["contact"])) {
                $contactErr = "Contact is required";
            } else {
                $contact = test_input($_POST["contact"]);
            }

            if(empty($_POST["course"])) {
                $courseErr = "Course is required";
            } else {
                $course = test_input($_POST["course"]);
            }

            if(empty($_POST["subscription"])) {
                $subscriptionErr = "Subscription is required";
            } else {
                $subscription = test_input($_POST["subscription"]);
            }
            if(!empty($_POST["rollno"]) && !empty($_POST["name"]) && !empty($_POST["email"]) && !empty($_POST["contact"]) && !empty($_POST["course"]) && !empty($_POST["subscription"])){
                $sql = "INSERT INTO `studentsdetail`(`rollno`, `name`, `email`, `contact`, `courseid`, `subscriptions`, `id`) VALUES ('$rollno','$name','$email','$contact','$course','$subscription','')";
                $result = mysqli_query($conn,$sql);
                if ($result){
                    $signup = true;
                }else{
                    $signup = false;
                    $msg = 'Something went wrong!';
                }
            }
        }
        if (!empty($_POST['update-submit'])) {
            $rollno1 = $_POST["rollno1"];
            $name1 =  $_POST["name1"];
            $email1 = $_POST["email1"];
            $contact1 = $_POST["contact1"];
            $course1 = $_POST["course1"];
            $subscription1 = $_POST["subscription1"];
        
            $sql = "UPDATE `studentsdetail` SET `name`='$name1',`email`='$email1',`contact`='$contact1',`courseid`='$course1',`subscriptions`='$subscription1' WHERE `rollno`='$rollno1'";
            $result = mysqli_query($conn,$sql);
            if ($result){
                $signup = true;
            }else{
                $signup = false;
                $msg = 'Something went wrong!';
            }
        }
        if (!empty($_POST['delete-submit'])) { 
            $rollno2 = $_POST["rollno1"];
            $sql = "DELETE FROM `studentsdetail` WHERE `rollno`='$rollno2'";
            $result = mysqli_query($conn,$sql);
            if ($result){
                $signup = true;
            }else{
                $signup = false;
                $msg = 'Something went wrong!';
            }
        }
    }

    // function updateCourseDetails(){
       
    // }

    function test_input($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
?>
<?php
    if($signup){
    echo ' <div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>Success!</strong> User hasbeen created.
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div> ';
    }
    if(!$signup && $msg != ''){
    echo ' <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <strong>Error!</strong> '. $msg.'
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div> ';
    }
?>
<div class="container">
    <table class="table table-bordered" style="margin-top:80px">
        <thead>
            <tr>
            <th width="5%">#</th>
            <th width="8%">Roll no.</th>
            <th width="15%">Name</th>
            <th width="20%">Email</th>
            <th width="10%">Contact</th>
            <th width="20%">Course</th>
            <th width="10%">Subscriptions</th>
            <th width="12%">Action</th>
            </tr>
        </thead>
        <tbody>
            <tr> 
                <form name="course" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" id="form1">

                    <th scope="row">1</th>
                    <td>
                        <input type="text" name="rollno" class="form-control" placeholder="Roll no."/>
                        <span class="error"><?php echo $rollnoErr;?></span>
                    </td>
                    <td>
                        <input type="text" name="name" class="form-control" placeholder="Name"/>
                        <span class="error"><?php echo $nameErr;?></span>
                    </td>
                    <td>
                        <input type="text" name="email" class="form-control"  placeholder="Email"/>
                        <span class="error"><?php echo $emailErr;?></span>
                    </td>
                    <td>
                        <input type="text" name="contact" class="form-control" placeholder="Contact"/>
                        <span class="error"><?php echo $contactErr;?></span>
                    </td>
                    <td>
                        <select class="custom-select" name="course">
                            <option value="">Choose...</option>
                            <?php
                                $sql = "select * from coursedetails";
                                $retval = mysqli_query($conn, $sql);
                                $num = mysqli_num_rows($retval);
                                if(!$retval) {
                                    die('Could not get data: ' . mysql_error());
                                }
                                $counter = 1;
                                if($num > 0){
                                    while($row = mysqli_fetch_array($retval)) {
                                    $counter++;
                            ?> 
                            <option value="<?php echo $row[0] ?>"><?php echo $row[1]?>, <?php echo $row[2]?>, <?php echo $row[3] ?></option>
                            <?php 
                                    }
                                }
                            ?>
                        </select>
                        <!-- <input type="text" name="courseFee" class="form-control" placeholder="Course Id"/> -->
                        <span class="error"><?php echo $courseErr;?></span>
                    </td>
                    <td>
                        <select class="custom-select" name="subscription">
                            <option value="">Choose...</option>
                            <option value="true">True</option>
                            <option value="false">False</option>
                        </select>
                        <!-- <input type="text" name="subscription" class="form-control" placeholder="Subscription"/> -->
                        <span class="error"><?php echo $subscriptionErr;?></span>
                    </td>
                    <td>
                        <!-- <button type="submit" class="btn btn-primary">Add</button> -->
                        <input type="submit" class="btn btn-primary" name="add-submit" value="Add" />
                    </td>
                </form>
            </tr>
            <?php
                $sql = "select * from studentsdetail";
              
                $retval = mysqli_query($conn, $sql);
                $num = mysqli_num_rows($retval);
                if(!$retval) {
                    die('Could not get data: ' . mysql_error());
                }
                $counter = 1;
                if($num > 0){
                    while($row = mysqli_fetch_array($retval)) {
                    $counter++;
            ?>  
            <tr>
                <form name="course" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" id="form2">

                    <th scope="row"><?php echo $counter; ?></th>
                    <td>
                        <span id="showDataField_<?php echo $counter ?>_1"><?php echo $row[0]?></span>
                        <input id="showInputField_<?php echo $counter ?>_2" type="hidden" name="rollno1" value="<?php echo $row[0] ?>"/>
                    </td>
                    <td>
                        <span id="showDataField_<?php echo $counter ?>_3"><?php echo $row[1]?></span>
                        <input id="showInputField_<?php echo $counter ?>_4" class="hide"type="text" name="name1" value="<?php echo $row[1] ?>"/>
                    </td>
                    <td>
                        <span id="showDataField_<?php echo $counter ?>_5"><?php echo $row[2]?></span>
                        <input id="showInputField_<?php echo $counter ?>_6" class="hide" type="text" name="email1" value="<?php echo $row[2] ?>"/>
                    </td>
                    <td>
                        <span id="showDataField_<?php echo $counter ?>_7"><?php echo $row[3]?></span>
                        <input id="showInputField_<?php echo $counter ?>_8" class="hide" type="text" name="contact1" value="<?php echo $row[3] ?>"/>
                    </td>
                    <td>
                            <?php
                                $sql1 = "select * from coursedetails where courseid= '$row[4]'";
                                $retval1 = mysqli_query($conn, $sql1);
                                $num1 = mysqli_num_rows($retval1);
                                if(!$retval1) {
                                    die('Could not get data: ' . mysql_error());
                                }
                                
                                if($num1 > 0){
                                    while($row1 = mysqli_fetch_array($retval1)) {
                            ?> 
                             <span id="showDataField_<?php echo $counter ?>_9"><?php echo $row1[1]?>, <?php echo $row1[2]?>, <?php echo $row1[3] ?></span>
                            <?php 
                                    }
                                }
                            ?>
                        <!-- <span id="showDataField_<?php echo $counter ?>_9"><?php echo $row[4]?></span> -->
                        <!-- <input id="showInputField_<?php echo $counter ?>_10" class="hide" type="text" name="courseFee1" value="<?php echo $row[4] ?>"/> -->
                        <select class="custom-select hide" name="course1" id="showInputField_<?php echo $counter ?>_10">
                            <option value="">Choose...</option>
                            <?php
                                $sql2 = "select * from coursedetails";
                                $retval2 = mysqli_query($conn, $sql2);
                                $num2 = mysqli_num_rows($retval2);
                                if(!$retval2) {
                                    die('Could not get data: ' . mysql_error());
                                }
                                // $counter = 1;
                                if($num2 > 0){
                                    while($row2 = mysqli_fetch_array($retval2)) {
                                    // $counter++;
                            ?> 
                            <option value="<?php echo $row2[0] ?>" <?php if($row[4] == $row2[0]){ ?>selected<?php } ?>><?php echo $row2[1]?>, <?php echo $row2[2]?>, <?php echo $row2[3] ?></option>
                            <?php 
                                    }
                                }
                            ?>
                        </select>
                    </td>
                    <td>
                        <span id="showDataField_<?php echo $counter ?>_11"><?php echo $row[5]?></span>
                        <!-- <input id="showInputField_<?php echo $counter ?>_12" class="hide" type="text" name="courseFee1" value="<?php echo $row[5] ?>"/> -->
                        <select id="showInputField_<?php echo $counter ?>_12" class="custom-select hide" name="subscription1" value="<?php echo $row[5] ?>">
                            <option value="">Choose...</option>
                            <option value="true" <?php if($row[5]== 'true'){ ?>selected <?php } ?>>True</option>
                            <option value="false" <?php if($row[5]== 'false'){ ?>selected <?php } ?>>False</option>
                        </select>
                    </td>
                    <td>
                        <button type="button" id="showDataField_<?php echo $counter ?>_13"class="btn btn-primary" style="padding:3px 5px;" onclick="showEditableFields('<?php echo $counter ?>',this); return false;">Edit</button>
                        <input type="submit" class="btn btn-danger" name="delete-submit" value="Delete" style="padding:3px 5px;" />

                        <input type="submit" id="showInputField_<?php echo $counter ?>_14" class="btn btn-success hide" style="padding:3px 5px;" name="update-submit" value="Save" />
                        <button type="button" id="showInputField_<?php echo $counter ?>_15" class="btn btn-primary hide" style="padding:3px 5px;" onclick="hideEditableFields('<?php echo $counter ?>',this); return false;" title="Cancel"> X</button>

                    </td>
                </form>
            </tr>
            <?php
                }
            }
            ?>
        </tbody>
    </table>

</div>
<script type="text/javascript">
    function showEditableFields(counter, btn) {
        // document.getElementById('showInputField_'+counter+'_2').style.display = 'block';
        document.getElementById('showInputField_'+counter+'_4').style.display = 'block';
        document.getElementById('showInputField_'+counter+'_6').style.display = 'block';
        document.getElementById('showInputField_'+counter+'_8').style.display = 'block';
        document.getElementById('showInputField_'+counter+'_10').style.display = 'inline-block';
        document.getElementById('showInputField_'+counter+'_12').style.display = 'block';
        document.getElementById('showInputField_'+counter+'_14').style.display = 'block';
        document.getElementById('showInputField_'+counter+'_15').style.display = 'inline-block';
        ////////////////////////////////////////////////////
        // document.getElementById('showDataField_'+counter+'_1').style.display = 'none';
        document.getElementById('showDataField_'+counter+'_3').style.display = 'none';
        document.getElementById('showDataField_'+counter+'_5').style.display = 'none';
        document.getElementById('showDataField_'+counter+'_7').style.display = 'none';
        document.getElementById('showDataField_'+counter+'_9').style.display = 'none';
        document.getElementById('showDataField_'+counter+'_11').style.display = 'none';
        document.getElementById('showDataField_'+counter+'_13').style.display = 'none';
        //btn.style.display = 'none';
    }

    function hideEditableFields(counter, btn) {
        // document.getElementById('showInputField_'+counter+'_2').style.display = 'none';
        document.getElementById('showInputField_'+counter+'_4').style.display = 'none';
        document.getElementById('showInputField_'+counter+'_6').style.display = 'none';
        document.getElementById('showInputField_'+counter+'_8').style.display = 'none';
        document.getElementById('showInputField_'+counter+'_10').style.display = 'none';
        document.getElementById('showInputField_'+counter+'_12').style.display = 'none';
        document.getElementById('showInputField_'+counter+'_14').style.display = 'none';
        document.getElementById('showInputField_'+counter+'_15').style.display = 'none';
        ////////////////////////////////////////////////////
        // document.getElementById('showDataField_'+counter+'_1').style.display = 'block';
        document.getElementById('showDataField_'+counter+'_3').style.display = 'block';
        document.getElementById('showDataField_'+counter+'_5').style.display = 'block';
        document.getElementById('showDataField_'+counter+'_7').style.display = 'block';
        document.getElementById('showDataField_'+counter+'_9').style.display = 'block';
        document.getElementById('showDataField_'+counter+'_11').style.display = 'block';
        document.getElementById('showDataField_'+counter+'_13').style.display = 'inline-block';

        //btn.style.display = 'none';
    }
</script>

<?php
 require './footer.php';
?>