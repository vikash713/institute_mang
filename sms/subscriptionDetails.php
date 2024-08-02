<?php 
  require './partials/_nav.php';
  require './header.php'; 
  include_once 'db.php';
  @$rollnoErr = $nameErr = $amountErr ="";
  @$rollno = $name = $amount = "";
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
                
            if(empty($_POST["amount"])) {
                $amountErr = "amount is required";
            } else {
                $amount = test_input($_POST["amount"]);
            }

            if(!empty($_POST["rollno"]) && !empty($_POST["name"]) && !empty($_POST["amount"])){
                $sql_2 = "SELECT * FROM `studentsdetail` WHERE `rollno` = $rollno";
                $result_2 = mysqli_query($conn,$sql_2);
                $num_2 = mysqli_num_rows($result_2);
                if ($num_2 > 0){
                    $sql = "INSERT INTO `subscriptionsdetail`(`rollno`, `subscriptionName`, `amount`) VALUES ('$rollno','$name','$amount')";
                    $result = mysqli_query($conn,$sql);
                    if ($result){
                        $signup = true;
                    }else{
                        $signup = false;
                        $msg = 'Something went wrong!';
                    }
                }else{
                    $signup = false;
                    $msg = 'Roll no. doen not exits! Please try to add valid roll no.';
                }

                
            }
        }
        if (!empty($_POST['delete-submit'])) { 
            $rollno2 = $_POST["rollno1"];
            $sql = "DELETE FROM `subscriptionsdetail` WHERE `rollno`='$rollno2'";
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
        <strong>Success!</strong> Subcription hasbeen done.
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
            <th width="15%">#</th>
            <th width="15%">Student Name</th>
            <th width="30%">Course Name</th>
            <th width="20%">Amount</th>
            <th width="20">Action</th>
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
                        <select class="custom-select" name="name" id="courseId" onchange="getCouseIdValue(this)">
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
                            <option value="<?php echo $row[0] ?>">
                                <?php echo $row[1]?>
                            </option>
                            <option hidden id="hiddenAmount_<?php echo $row[0] ?>" value="<?php echo $row[3]?>"><?php echo $row[3]?></option>
                            
                            <?php 
                                    }
                                }
                            ?>
                        </select>
                        <!-- <input type="text" name="courseFee" class="form-control" placeholder="Course Id"/> -->
                        <!-- <span class="error"><?php echo $courseErr;?></span> -->
                    </td>
                    <td>
                    <script type="text/javascript">
                        var getcourseId='';
                        function getCouseIdValue(currentContext){
                            console.log(currentContext);
                            getcourseId = document.getElementById('courseId').value;
                            getcourseAmount= document.getElementById('hiddenAmount_'+getcourseId).value;
                            document.getElementById('getAmountValue').value = getcourseAmount;
                        }
                    </script> 
                      
                        <input type="text" id="getAmountValue" class="form-control" name="amount" value="" readonly/>
                        <!-- <span class="error"><?php echo $subscriptionErr;?></span> -->
                    </td>
                    <td>
                        <!-- <button type="submit" class="btn btn-primary">Add</button> -->
                        <input type="submit" class="btn btn-primary" name="add-submit" value="Add" />
                    </td>
                </form>
            </tr>
            <?php
                $sql = "select * from subscriptionsdetail";
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
                        <?php 
                            $sql_1 = "select * from studentsdetail where rollno=$row[0]";
                            $retval_1 = mysqli_query($conn, $sql_1);
                            $num_1 = mysqli_num_rows($retval_1);
                            if(!$retval_1) {
                                die('Could not get data: ' . mysql_error());
                            }
                            
                            if($num_1 > 0){
                                while($row_1 = mysqli_fetch_array($retval_1)) {
                        ?>
                        <span id="showDataField_<?php echo $counter ?>_1"><?php echo $row_1[1]?></span>
                        <input id="showInputField_<?php echo $counter ?>_2" type="hidden" name="rollno1" value="<?php echo $row_1[1] ?>"/>
                    <?php
                                }
                            }
                    ?>
                    </td>
                    <td>
                            <?php
                                $sql1 = "select * from coursedetails where courseid= '$row[1]'";
                                $retval1 = mysqli_query($conn, $sql1);
                                $num1 = mysqli_num_rows($retval1);
                                if(!$retval1) {
                                    die('Could not get data: ' . mysql_error());
                                }
                                
                                if($num1 > 0){
                                    while($row1 = mysqli_fetch_array($retval1)) {
                            ?> 
                             <span id="showDataField_<?php echo $counter ?>_9"><?php echo $row1[1]?>, <?php echo $row1[2]?></span>
                            <?php 
                                    }
                                }
                            ?>
                    </td>
                    <td>
                        <span id="showDataField_<?php echo $counter ?>_11"><?php echo $row[2]?></span>
                        
                    </td>
                    <td>
                        <!-- <button type="button" id="showDataField_<?php echo $counter ?>_13"class="btn btn-primary" style="padding:3px 5px;" onclick="showEditableFields('<?php echo $counter ?>',this); return false;">Edit</button> -->
                        <input type="submit" class="btn btn-danger" name="delete-submit" value="Delete" style="padding:3px 5px;" />

                        <!-- <input type="submit" id="showInputField_<?php echo $counter ?>_14" class="btn btn-success hide" style="padding:3px 5px;" name="update-submit" value="Save" /> -->
                        <!-- <button type="button" id="showInputField_<?php echo $counter ?>_15" class="btn btn-primary hide" style="padding:3px 5px;" onclick="hideEditableFields('<?php echo $counter ?>',this); return false;" title="Cancel"> X</button> -->

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
    // function getCouseIdValue(currentContext){
    //     console.log(currentContext);
    //     var getcourseId = document.getElementById('courseId').value;
    //     document.getElementById('getAmountValue').value = getcourseId;
    // }

</script>

<?php
 require './footer.php';
?>