<?php 
  require './header.php'; 
  require './partials/_nav.php';
  include_once './db.php';
  @$courseIdErr = $courseNameErr = $courseFeeErr = $courseDurationErr = "";
  @$courseId = $courseName = $courseFee = $courseDuration = "";
  @$signup = false;
  @$msg = '';
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (!empty($_POST['add-submit'])) {
            if(empty($_POST["courseId"])) {
                $courseIdErr = "Course ID is required";
            } else {
                $courseId = test_input($_POST["courseId"]);
            }
            
            if(empty($_POST["courseName"])) {
                $courseNameErr = "Course Name is required";
            } else {
                $courseName = test_input($_POST["courseName"]);
            }
                
            if(empty($_POST["courseDuration"])) {
                $courseDurationErr = "Course Duration is required";
            } else {
                $courseDuration = test_input($_POST["courseDuration"]);
            }

            if(empty($_POST["courseFee"])) {
                $courseFeeErr = "Course Fee is required";
            } else {
                $courseFee = test_input($_POST["courseFee"]);
            }
            if(!empty($_POST["courseId"]) && !empty($_POST["courseName"]) && !empty($_POST["courseDuration"]) && !empty($_POST["courseFee"])){
                $sql = "INSERT INTO `coursedetails` ( `courseId`, `courseName`, `courseDuration`, `courseFee`) VALUES ('$courseId','$courseName','$courseDuration','$courseFee' )";
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
            $courseId1 = $_POST["courseId1"];
            $courseName1 =  $_POST["courseName1"];
            $courseFee1 = $_POST["courseFee1"];
            $courseDuration1 = $_POST["courseDuration1"];
        
            $sql = "UPDATE `coursedetails` SET `courseName`= '$courseName1',`courseDuration`='$courseDuration1',`courseFee`='$courseFee1' WHERE `courseId`= '$courseId1'";
            $result = mysqli_query($conn,$sql);
            if ($result){
                $signup = true;
            }else{
                $signup = false;
                $msg = 'Something went wrong!';
            }
        }
        if (!empty($_POST['delete-submit'])) { 
            $courseId2 = $_POST["courseId1"];
            $sql = "DELETE FROM `coursedetails` WHERE `courseId`= '$courseId2'";
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
            <th width="10%">#</th>
            <th width="10%">Course ID</th>
            <th width="20%">Course Name</th>
            <th width="20%">Course Duration</th>
            <th width="20%">Course Fee</th>
            <th width="20%">Action</th>
            </tr>
        </thead>
        <tbody>
            <tr> 
                <form name="course" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" id="form1">

                    <th scope="row">1</th>
                    <td>
                        <input type="text" name="courseId" class="form-control" placeholder="Id"/>
                        <span class="error"><?php echo $courseIdErr;?></span>
                    </td>
                    <td>
                        <input type="text" name="courseName" class="form-control" placeholder="Name"/>
                        <span class="error"><?php echo $courseNameErr;?></span>
                    </td>
                    <td>
                        <select class="custom-select" name="courseDuration">
                            <option value="">Choose...</option>
                            <option value="1 Months">1 Month</option>
                            <option value="2 Months">2 Months</option>
                            <option value="3 Months">3 Months</option>
                            <option value="6 Months">6 Months</option>
                        </select>
                        <!-- <input type="text" name="courseDuration" placeholder="Duration"/> -->
                        <span class="error"><?php echo $courseDurationErr;?></span>
                    </td>
                    <td>
                        <input type="text" name="courseFee" class="form-control" placeholder="Fee"/>
                        <span class="error"><?php echo $courseFeeErr;?></span>
                    </td>
                    <td>
                        <!-- <button type="submit" class="btn btn-primary">Add</button> -->
                        <input type="submit" class="btn btn-primary" name="add-submit" value="Add" />
                    </td>
                </form>
            </tr>
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
            <tr>
                <form name="course" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" id="form2">

                    <th scope="row"><?php echo $counter; ?></th>
                    <td>
                        <span id="showDataField_<?php echo $counter ?>_1"><?php echo $row[0]?></span>
                        <input id="showInputField_<?php echo $counter ?>_2" type="hidden" name="courseId1" value="<?php echo $row[0] ?>"/>
                    </td>
                    <td>
                        <span id="showDataField_<?php echo $counter ?>_3"><?php echo $row[1]?></span>
                        <input id="showInputField_<?php echo $counter ?>_4" class="hide"type="text" name="courseName1" value="<?php echo $row[1] ?>"/>
                    </td>
                    <td>
                        <span id="showDataField_<?php echo $counter ?>_5"><?php echo $row[2]?></span>
                        <input id="showInputField_<?php echo $counter ?>_6" class="hide" type="text" name="courseDuration1" value="<?php echo $row[2] ?>"/>
                    </td>
                    <td>
                        <span id="showDataField_<?php echo $counter ?>_7"><?php echo $row[3]?></span>
                        <input id="showInputField_<?php echo $counter ?>_8" class="hide" type="text" name="courseFee1" value="<?php echo $row[3] ?>"/>
                    </td>
                    <td>
                        <button type="button" id="showDataField_<?php echo $counter ?>_9"class="btn btn-primary" style="padding:3px 5px;" onclick="showEditableFields('<?php echo $counter ?>',this); return false;">Edit</button>
                        <input type="submit" class="btn btn-danger" name="delete-submit" value="Delete" style="padding:3px 5px;" />

                        <input type="submit" id="showInputField_<?php echo $counter ?>_10" class="btn btn-success hide" style="padding:3px 5px;" name="update-submit" value="Save" />
                        <button type="button" id="showInputField_<?php echo $counter ?>_11" class="btn btn-primary hide" style="padding:3px 5px;" onclick="hideEditableFields('<?php echo $counter ?>',this); return false;" title="Cancel"> X</button>

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
        document.getElementById('showInputField_'+counter+'_11').style.display = 'inline-block';
        ////////////////////////////////////////////////////
        // document.getElementById('showDataField_'+counter+'_1').style.display = 'none';
        document.getElementById('showDataField_'+counter+'_3').style.display = 'none';
        document.getElementById('showDataField_'+counter+'_5').style.display = 'none';
        document.getElementById('showDataField_'+counter+'_7').style.display = 'none';
        document.getElementById('showDataField_'+counter+'_9').style.display = 'none';
        //btn.style.display = 'none';
    }

    function hideEditableFields(counter, btn) {
        // document.getElementById('showInputField_'+counter+'_2').style.display = 'none';
        document.getElementById('showInputField_'+counter+'_4').style.display = 'none';
        document.getElementById('showInputField_'+counter+'_6').style.display = 'none';
        document.getElementById('showInputField_'+counter+'_8').style.display = 'none';
        document.getElementById('showInputField_'+counter+'_10').style.display = 'none';
        document.getElementById('showInputField_'+counter+'_11').style.display = 'none';
        ////////////////////////////////////////////////////
        // document.getElementById('showDataField_'+counter+'_1').style.display = 'block';
        document.getElementById('showDataField_'+counter+'_3').style.display = 'block';
        document.getElementById('showDataField_'+counter+'_5').style.display = 'block';
        document.getElementById('showDataField_'+counter+'_7').style.display = 'block';
        document.getElementById('showDataField_'+counter+'_9').style.display = 'inline-block';
        //btn.style.display = 'none';
    }
</script>

<?php
 require './footer.php';
?>