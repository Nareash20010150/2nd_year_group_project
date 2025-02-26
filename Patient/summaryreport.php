<?php 
session_start();
require_once("../conf/config.php");

if (isset($_SESSION['mailaddress']) && $_SESSION['userRole'] == 'Patient') {

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?php echo BASEURL.'/css/style.css';?>">
    <link rel="stylesheet" href="<?php echo BASEURL.'/css/patientDash.css';?>">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <script src="<?php echo BASEURL . '/js/appoinment.js'; ?>"></script>
    <link rel="stylesheet" href="<?php echo BASEURL.'/css/patientAppointment.css' ?>">
    <script src='https://kit.fontawesome.com/a076d05399.js' crossorigin='anonymous'></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <title>Patient's Summary</title>
    <style>
        body{
            background-color: #f9f8ff;
        }

        .userContents .s-box table{
            overflow-y: hidden;
            max-width: 1700px;
            float: left;
            background-color: #ffffff;
            padding:30px 30px;
            margin:50px 50px;
            width:93%;
            border-radius: 10px;
            /* border-color: black; */
            box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
        }

        .userContents  .s-box table tr{
            background-color: #ffffff;
            border-color: white;
            height: 60px;
            font-size: 18px;
            float: left;
            font-weight: 500;
            width: 100%;
            border-radius: 5px;
            border-color: var(--para-color);
        }
        .userContents .s-box table tr td{
            float: left;
            background-color: #ffffff;
            color: black;
            /* padding:30px 30px; */
            /* margin:30px 30px; */
            width:auto;
            border-radius: 10px;
            border-color: none;
            
        }
        .userContents .s-box table tr label{
            color:var(--primary-color);
            font-size: 22px;
            font-weight: 500;
        }

    </style>
</head>
<body>
    <div class="user">

    <?php
    $name = urlencode( $_SESSION['name']);
    include(BASEURL.'/Components/PatientSidebar.php?profilePic=' . $_SESSION['profilePic'] . "&name=" . $name); ?>
    <!-- <?php //include(BASEURL.'/Components/PatientSidebar.php?profilePic='.$_SESSION['profilePic']."&name".$_SESSION['name']); ?> -->
    
    <div class="userContents"  id="center">
        <?php
        $name = urlencode( $_SESSION['name']);
        include(BASEURL.'/Components/patientTopbar.php?profilePic=' . $_SESSION['profilePic'] . "&name=" . $name . "&userRole=" . $_SESSION['userRole']. "&nic=" . $_SESSION['nic']);
        ?>
        <div class="arrow">
                <img src="../images/arrow-right-circle.svg" alt="arrow">Patient's Summary
        </div>

        <div class="s-box">
        <?php 
            $nic = $_SESSION['nic'];
            $res1 = mysqli_query($con,"select patientID from patient where nic=$nic");
            $pid = mysqli_fetch_assoc($res1)['patientID'];

            // $res2 = mysqli_query($con,"select doctorID from prescription where patientID = $pid");
            // $d_arr = array();
            

            // while($d_push = mysqli_fetch_array($res2))
            // {
            //     array_push($d_arr,$d_push['doctorID']);
            // }
            
            // for($i = 0; $i < count($d_arr); $i++)
            // {
            //     echo $d_arr[$i]."<br>";
            // } 
            // echo $d_arr[0]."<br>";
            // echo $d_arr[1]."<br>";
            // $docnic = array();

                $query = "select i.admit_date,i.admit_time,i.admitID,i.discharge_date,i.admit_duration,u.name,p.investigation,p.Impression from inpatient i inner join patient t on i.patientID=t.patientID
                 inner join prescription p on t.patientID=p.patientID inner join doctor d on d.doctorID=p.doctorID inner join user u on u.nic=d.nic where i.patientID=$pid and patient_type = 'inpatient'";

                $q1 = "select p.date,u.name,p.investigation,p.Impression,t.patient_type from patient t inner join prescription p on p.patientID=t.patientID inner join doctor d on p.doctorID=d.doctorID inner join user u on d.nic=u.nic where t.patientID=$pid and patient_type = 'outpatient';";

                $res = mysqli_query($con,$q1);
                $result = mysqli_query($con,$query);
           

                while($rows = mysqli_fetch_assoc($result)){
                ?>
                
                    <?php if($rows['admitID']){ ?>
                    <table>
                            <tr>
                                <td><label>Admit Date:</label></td>
                                <td><p><?php echo $rows['admit_date']; ?></p></td>
                            </tr>
                            <tr>
                                <td><label>Discharge Date:</label></td>
                                <td><p><?php echo $rows['discharge_date']; ?></p></td>
                            </tr>
                            <tr>
                                <td><label>Doctor Name:</label></td>
                                <td><p><?php echo $rows['name']; ?></p></td>
                            </tr>
                            <tr>
                                <td><label>Patient Type:</label></td>
                                <td><p><?php echo "Inpatient"; ?></p></td>
                            </tr>
                            <tr>
                                <td><label for="">Investigation:</label></td>
                                <td><p><?php echo $rows['investigation']; ?></p></td>
                            </tr>
                            <tr>
                                <td><label for="">Impression:</label></td>
                                <td><p><?php echo $rows['Impression']; ?></p></td>
                            </tr>
                        </table>
                    <?php } 
                    }
                        while($rows1 = mysqli_fetch_assoc($res)){
                            if($rows1['patient_type']=='outpatient'){
                    ?>
                     <table>
                         <tr>
                             <td><label>Prescribed Date:</label></td>
                             <td><p><?php echo $rows1['date']; ?></p></td>
                         </tr>
                         <tr>
                                <td><label>Patient Type:</label></td>
                                <td><p><?php echo "Outpatient"; ?></p></td>
                            </tr>
                         <tr>
                             <td><label>Doctor Name:</label></td>
                             <td><p><?php echo $rows1['name']; ?></p></td>
                         </tr>
                         <tr>
                             <td><label for="">Investigation:</label></td>
                             <td><p><?php echo $rows1['investigation']; ?></p></td>
                         </tr>
                         <tr>
                                <td><label for="">Impression:</label></td>
                                <td><p><?php echo $rows1['Impression']; ?></p></td>
                            </tr>
                     </table>
                     <?php 
                    }
                }
                if(mysqli_num_rows($result) == 0 and mysqli_num_rows($res) == 0)
                {
            ?>
                    <div class="i-image"><img style="width:45%;margin-left:28%;margin-top:-5%;" src="<?php echo BASEURL.'/images/empty.png'?>" >
                    <h1 style="color:black;margin-left:36%;margin-top:-3%">Looks like there are no summary yet!</h1>
                    <h2 style="color:red;margin-left:35.5%;">You are new patient & you were prescribed not yet.</h2>
                </div>
            <?php
                }
            ?>
        
    </div>
</div>       
        <div id="login-modal">
        <div class="modal">
            <div class="login-form">
            <h2>Put Your Appointment</h2><br>
            <form  action="" method="post">
                <label for="">Date</label><br><br>
                <input type="date" name="date" id="date"><br><br>
                <label for="">Department</label><br><br>
                <select name="department" id="department">
                    <option value="">Please A Select Department</option>
                    <option value="ENT">ENT</option>
                    <option value="General medicine">General medicine</option>
                    <option value="Orthopedic">Orthopedic</option>
                </select><br><br>
                <label for="">Doctor</label><br><br>
                <select name="doctor" id="doctor">
                    <option value="">Select A Department First</option>
                </select><br><br>
                <label for="">Message</label><br><br>
                <textarea name="msg" id="msg" cols="30" rows="3" placeholder="Your Message To The Doctor"></textarea><br><br>
                <!-- <br><br><input type="submit" value="Submit" id="btn" name="btn" class="btn"> -->
               
                <button type="submit" name="cancel" id="cancel" value="cancel" class="cancel-modal">Cancel</button>
                <button type="submit" name="submit" id="btn" value="submit" onclick="">Submit</button>
            </form>
            </div>
        </div>
    </div>
    
    <script type="text/javascript">
        // $(function(){
        //     $('#openform').click(function(){
        //         $('#login-modal').fadeIn().css("display","flex");
        //     });
        //     $('.cancel-modal').click(function(){
        //         $('#login-modal').fadeOut();
        //     });
        // });

        $(function(){
            $('#open').click(function(){
                $('#login-modal').fadeIn().css("display","flex");
            });
            $('#open-').click(function(){
                $('#login-modal').fadeIn().css("display","flex");
            });
            $('.cancel-modal').click(function(){
                $('#login-modal').fadeOut();
            });
        });
    </script>
</body>
</html>
<?php } ?>