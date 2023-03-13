<?php
session_start();
//die( $_SESSION['profilePic']);
require_once("../conf/config.php");
if (isset($_SESSION['mailaddress']) && $_SESSION['userRole'] == 'Doctor') {
  $nic = $_SESSION['nic'];
  $doctorID_query = "select doctorID from doctor join user on user.nic = doctor.nic where user.nic = $nic";
  $get_doctorID = mysqli_query($con,$doctorID_query);
  $row = mysqli_fetch_assoc($get_doctorID);
  $doctorID = $row["doctorID"];
    ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <link rel="stylesheet" href="<?php echo BASEURL . '/css/style.css' ?>">
    <link rel="stylesheet" href="<?php echo BASEURL . '/css/doctorStyle.css' ?>">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">
    <script
      src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js">
    </script>
    <script src="https://kit.fontawesome.com/04b61c29c2.js" crossorigin="anonymous"></script>
    <style>
        .next {
            position: initial;
            height: auto;
        }
    </style>   
    <title>Doctor Dashboard</title> 
</head>


<body>
    <div class="user">
      
    <?php 
    $name = urlencode( $_SESSION['name']);
    include(BASEURL . '/Components/doctorSidebar.php?profilePic=' . $_SESSION['profilePic'] . "&name=" . $_SESSION['name']); ?>
        <div class="userContents" id="center">
        <?php
          include(BASEURL.'/Components/topbar.php?profilePic=' . $_SESSION['profilePic'] . "&name=" . $name);
          ?>

            <div class="main-container">
              <div class="doctor-cards">
              <div class="doctor-card">
                <div class="card-content">
                    <div class="number">
                      <?php
                      $appointment_query = "select * from appointment where doctorID= $doctorID;";
                      $appointment_query_run = mysqli_query($con,$appointment_query);
                      if($appointment_count =mysqli_num_rows($appointment_query_run)){
                        echo $appointment_count;
                      }
                      else{
                        echo 'No Data';
                      }
                      ?>
                    </div>
                    <div class="card-name">
                      Appointments
                    </div>
                </div>
                <div class="icon-box">
                    <i class="fas fa-user-injured"></i>
                </div>
              </div>
              <div class="doctor-card">
                <div class="card-content">
                    <div class="number">
                      <?php
                      $dash_patient_query = "select * from `user` where user_role = 'Patient';";
                      $dash_patient_query_run = mysqli_query($con,$dash_patient_query);
                      if($total_patient = mysqli_num_rows($dash_patient_query_run)){
                        echo $total_patient ;
                      }
                      else{
                        echo 'No Data';
                      }
                      ?>
                    </div>
                    <div class="card-name">
                      Total Patients
                    </div>
                </div>
                <div class="icon-box">
                    <i class="fas fa-user-injured"></i>
                </div>
              </div>
              <div class="doctor-card">
                <div class="card-content">
                    <div class="number">
                      <?php
                      $dash_bed_query="Select * from `room` where room_availability='available';";
                      $dash_bed_query_run = mysqli_query($con,$dash_bed_query);
                      if($total_available_beds = mysqli_num_rows($dash_bed_query_run)){
                        echo $total_available_beds;
                      }
                      else{
                        echo 'No data';
                      }
                      ?>
                    </div>
                    <div class="card-name">
                      Available Beds
                    </div>
                </div>
                <div class="icon-box">
                    <i class="fas fa-bed"></i>
                </div>
              </div>
              </div>

              <h3>Upcomming Appointments</h3>
              <!-- <div class="wrapper">
                <div class="tableWrapper">
                  <div class="row headerT">
                    <div class="cell">Profile Picture</div>
                    <div class="cell">Name</div>
                    <div class="cell">Date</div>
                    <div class="cell">Time</div>
                    <div class="cell">Message</div>
                    <div class="cell">Option</div>
                  </div>
                  <?php
                    $sql="select user.profile_image,user.name,appointment.date,appointment.time,appointment.message,appointment.patientID from appointment join patient on appointment.patientID=patient.patientID join user on user.nic=patient.nic where doctorID =$doctorID;";
                    $result=mysqli_query($con,$sql);
                    if($result){
                      while($row=mysqli_fetch_assoc($result)){ ?>
                  <div class="row">
                    <div class="cell" data-title="profile_image">
                      <?php
                        echo "<img src='".BASEURL."/uploads/".$row['profile_image']."'width = 50px height=50px>";
                      ?>
                    </div>
                    <div class="cell" data-title="Name">
                      <?php echo $row['name']; ?>
                    </div>
                    <div class="cell" data-title="Date">
                      <?php echo $row['date']; ?>
                    </div>
                    <div class="cell" data-title="Time">
                      <?php echo $row['time']; ?>
                    </div>
                    <div class="cell" data-title="Message">
                      <?php echo $row['message']; ?>
                    </div>
                    <div class="cell" data-title="Option">
                      
                    </div>
                    <?php }} ?>
                  </div>
                </div>
              </div> -->

              <div class="table-container">
                    <table class="table">
                        <thead>
                          <th> </th>    
                          <th>Patient</th>
                          <th>Date</th>
                          <th>Time</th>
                          <th>Message</th>
                          <th>Option</th>
                        </thead>
                        <tbody>
                            <?php
                                $sql="select user.profile_image,user.name,appointment.date,appointment.time,appointment.message,appointment.patientID from appointment join patient on appointment.patientID=patient.patientID join user on user.nic=patient.nic where doctorID =$doctorID;";
                                $result=mysqli_query($con,$sql);

                                if($result){
                                  while($row=mysqli_fetch_assoc($result)){
                                    $profile_image = $row['profile_image'];
                                    $name =  $row['name'];
                                    $date = $row['date'];
                                    $time = $row['time'];
                                    $message = $row['message'];
                                    $patientID= $row['patientID'];
                                    echo '<tr> 

                                    <td>'."<img src='".BASEURL."/uploads/".$row['profile_image']."'width = 50px height=50px></td>
                                    <td>".$name.'</td>
                                    <td>'.$date.'</td>
                                    <td>'.$time.'</td>
                                    <td>'.$message.'</td>
                                    <td><a href="displayPatient.php?patientid='.$patientID.'&name='.$name.'">
                                      <img src="../images/eye.png "width = 50px height=50px> </a>
                                    </button></td>
                                    </tr>';
                                  }
                                }
                            ?>    
                        </tbody>
                    </table>
              </div>
            </div>
        </div>
    </div>
    
    
</body>
</html>
<?php
} else {
    header("location: " . BASEURL . "/Homepage/login.php");
}
?>
