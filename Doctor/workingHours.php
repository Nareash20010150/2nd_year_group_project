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
    <title>Schedule</title> 
</head>


<body>
    <div class="user">
        <?php
        $name = urlencode( $_SESSION['name']);
        include(BASEURL . '/Components/doctorSidebar.php?profilePic=' . $_SESSION['profilePic'] . "&name=" . $name); ?>
        <div class="userContents" id="center">
            <?php
            $name = urlencode( $_SESSION['name']);
            include(BASEURL.'/Components/doctorTopbar.php?profilePic=' . $_SESSION['profilePic'] . "&name=" . $name . "&userRole=" . $_SESSION['userRole'] . "&nic=" . $_SESSION['nic']);
            ?>
            <div class="arrow">
                <img src=<?php echo BASEURL . '/images/arrow-right-circle.svg' ?> alt="arrow">Update Scedule
            </div>


            <div class="main-container">
                <h3>Update Schedule</h3>
                <?php
                    
                    echo date("Y/m/d");
                    date_default_timezone_set("Asia/Colombo");
                    echo date("h:i:sa");
                ?>
                <form action="post">
                    <div class="row">
                        <div class="row-name"></div>
                        <div class="row-content"></div>
                    </div>
                </form>
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
