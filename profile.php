<?php
	session_start();
	require_once('config.php');
  //phpinfo();
  if(!($_SESSION))
   {
     header("Location:index.php");
   }
  else if($_SESSION)
  {
    if($con!=NULL)
    {
      $username= $_SESSION['username'];
      $password= $_SESSION['password'];
      $sql = "select * from ceta_admin where username='$username' and password='$password' ";
      $result = mysqli_query($con, $sql);
      if(mysqli_num_rows($result)>0)
      {
        header("Location:admin_profile.php");
      }
    }
  }
  else{}
?>
<?php
  if(isset($_POST['logout'])){
    session_unset();
    $con->close();
    session_destroy();
    header("Location:index.php");
  } 
?>
<!DOCTYPE html>
<html lang="en">
<head>
<title>User Profile</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="icon" href="main.jpg">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel='stylesheet' href='https://fonts.googleapis.com/css?family=Roboto'>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/angular_material/1.1.0/angular-material.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/MaterialDesign-Webfont/2.0.46/css/materialdesignicons.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/pace/1.0.2/pace.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/pace/1.0.2/themes/red/pace-theme-minimal.min.css">
<style>
    html,body,h1,h2,h3,h4,h5,h6 {font-family: "Roboto", sans-serif}

    body::-webkit-scrollbar 
    {
       width: 7px;
    }
    body::-webkit-scrollbar-track 
    {
      -webkit-box-shadow: inset 0 0 6px rgba(0,0,0,0.3);
      
    }
    body::-webkit-scrollbar-thumb
    {
      background-color:#2196F3;
      background: #2196F3; /* For browsers that do not support gradients */
      background: -webkit-linear-gradient(#9ba9ff,#2196F3); /* For Safari 5.1 to 6.0 */
      background: -o-linear-gradient(#9ba9ff,#2196F3); /* For Opera 11.1 to 12.0 */
      background: -moz-linear-gradient(#9ba9ff,#2196F3); /* For Firefox 3.6 to 15 */
      background: linear-gradient(#9ba9ff,#2196F3); /* Standard syntax */
    }
    /* When the input is not focused */
    md-input-container label {
      color:#2196f3;
    }

    /* When the input is focused */
    md-input-container.md-input-focused label {
      color: #2196f3;
    }
</style>
</head>
<body ng-app="BlankApp" ng-cloak>

<!-- Page Container -->
<div class="w3-content w3-margin-top" style="max-width:1400px;">

  <!-- The Grid -->
  <div class="w3-row-padding">
  
    <!-- Left Column -->
    <div class="w3-third">
    
      <div class="w3-white w3-text-grey w3-card-4">
        <div class="w3-display-container">

          <img src="profile/<?php 
            if($con!=NULL)
            {
              $sql = "select * from userinfo where username='$username'  and password='$password'";
              $result = mysqli_query($con, $sql);
              $row = mysqli_fetch_assoc($result);
              echo $row['image'];
              $name = $row["name"];
              $id_num = $row['id_num'];
            }?>" style="width:100%" alt="Washed out" class="w3-image">
          
        </div>
        <div class="w3-display-container">
          <div class="w3-container w3-text-black">
            <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
              <h2>
                <?php 
                if($con!=NULL)
                {
                    echo $name;
                }
                ?>
                <span class="w3-right">
                <md-button class="md-warn" name="logout" type="submit">
                  <md-icon md-font-icon="mdi-logout mdi-2x" class="mdi ng-scope md-font material-icons" ><b>&nbspLOGOUT</b></md-icon>
                </md-button>
                </span>
              </h2>
              
            </form>
          </div>
        </div>
        
        <div class="w3-container">
          <p><i class="fa fa-id-card fa-fw w3-margin-right w3-large w3-text-blue"></i><?php 
                  if($con!=NULL)
                  {
                    echo $id_num;
                  }
            ?>
          </p>
          
          <hr>
          <?php
            $sql = "select * from winners where id_num = '$id_num'";
            $result = mysqli_query($con, $sql);
            if(mysqli_num_rows($result)>0)
            { 
              echo "<p class='w3-large'><b><i class='fa fa-certificate fa-fw w3-margin-right w3-text-blue'></i>Congratulations you won in these events :</b></p>";
              for($i=1;$row = mysqli_fetch_assoc($result);$i++)
              {
                $e_id = $row['e_id'];
                $sql1 = "select * from events where e_id = '$e_id'";
                $result1 = mysqli_query($con, $sql1);
                $row1 = mysqli_fetch_assoc($result1);
                echo "<label style='padding-left:30px;'>".$i.") ".$row1['e_name']."</label><br>";
              }
            }
          ?>

          <hr>
          <p class="w3-large"><b><i class="fa fa-rocket fa-fw w3-margin-right w3-text-blue"></i>To apply to an Event</b></p>
          <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post"> 
              <div layout="row" layout-align="start center" flex="100" layout-wrap >    
              <md-input-container class="md-block" flex="65" flex-md="100" flex-sm="100" flex-xs="100" style="margin:0px;">
                <label>Enter event code</label>
                <input name="e_code"  ng-required="true">
              </md-input-container>
              <md-button name="apply" type="submit" class="md-raised md-primary" style="background:#2196f3;">
                <md-icon md-font-icon="mdi-gesture-tap mdi-2x" class="mdi ng-scope md-font material-icons" >&nbsp<b>Click here</b></md-icon>
              </md-button> 
              </div>    
          </form> 

        </div>
        <?php
          if(isset($_POST['apply']))
          {
            if($con!=NULL)
            {
              $e_code = $_POST['e_code'];
              $sql = "select * from events where e_id= '$e_code' AND e_date >= CURDATE()";
              $result = mysqli_query($con, $sql);
              $count1 = mysqli_num_rows($result);
              if($count1 > 0)
              {
                $sql = "select * from applications where id_num = '$id_num' AND e_id = '$e_code'";
                $result = mysqli_query($con, $sql);
                $count1 = mysqli_num_rows($result);
                if($count1 == 0)
                {
                  $sql = "INSERT INTO applications(e_id,id_num) VALUES ('$e_code','$id_num')";
                  $result = mysqli_query($con, $sql);
                  header('Location: ' . $_SERVER['PHP_SELF']);
                  die('<META http-equiv="refresh" content="0;URL=' . $_SERVER['PHP_SELF'] . '">');
                }
                else
                {
                  echo '<script type="text/javascript">alert("You have already applied to this event.")</script>';
                }
              }
              else
              {
                echo '<script type="text/javascript">alert("You cannot apply to that event.")</script>';
              }
            }
          }
        ?>                                      
        <br>
      </div>
                  <br>
    <!-- End Left Column -->
    </div>

    <!-- Right Column -->
    <div class="w3-twothird">
    
      <div class="w3-container w3-card-2 w3-white w3-margin-bottom">
        <h2 class="w3-text-grey w3-padding-16"><i class="fa fa-rocket fa-fw w3-margin-right w3-xxlarge w3-text-blue"></i>Events you applied&nbsp<span class="w3-tag w3-blue w3-round w3-large">Active Events</span></h2>
        <?php 
          if($con!=NULL)
          {   
            $sql = "select * from events where e_date >= CURDATE() AND e_id IN(select e_id from applications where id_num='$id_num')";
            $result = mysqli_query($con, $sql);
            $count = mysqli_num_rows($result);
            if($count>0)
            { 
              for(;$row = mysqli_fetch_assoc($result);)
              {
                echo "<div class='w3-container'>";
                echo "<hr>";
                echo "<h5 class='w3-opacity'><b>".$row['e_name']."</b></h5>";
                echo "<h6 class='w3-text-blue'>
                    <i class='fa fa-calendar fa-fw w3-margin-right'></i>".$row['e_date'].
                    "&nbsp&nbsp<span class='w3-tag w3-blue w3-round'>".$row['e_time']."</span>
                  </h6>";
                echo "<p>".$row['e_description']."</p>";
                echo "</div>";
              }
            }
            else{
              echo "<div class='w3-container'>";
              echo "<h4>No events to display</h4>";
              echo "</div>";
            }
          }
        ?>
        <br>
      </div>

      <div class="w3-container w3-card-2 w3-white">
        <h2 class="w3-text-grey w3-padding-16"><i class="fa fa-rocket fa-fw w3-margin-right w3-xxlarge w3-text-blue"></i>Events you applied&nbsp<span class="w3-tag w3-blue w3-round w3-large">Past Events</span></h2>
        <?php 
          if($con!=NULL)
          {   
            $sql = "select * from events where e_date < CURDATE() AND e_id IN(select e_id from applications where id_num='$id_num')";
            $result = mysqli_query($con, $sql);
            $count = mysqli_num_rows($result);
            if($count>0)
            { 
              for(;$row = mysqli_fetch_assoc($result);)
              {
                echo "<div class='w3-container'>";
                echo "<hr>";
                echo "<h5 class='w3-opacity'><b>".$row['e_name']."</b></h5>";
                echo "<h6 class='w3-text-blue'>
                    <i class='fa fa-calendar fa-fw w3-margin-right'></i>".$row['e_date'].
                    "&nbsp&nbsp<span class='w3-tag w3-blue w3-round'>".$row['e_time']."</span>
                  </h6>";
                echo "<p>".$row['e_description']."</p>";
                echo "</div>";
              }
            }
            else{
              echo "<div class='w3-container'>";
              echo "<h4>No events to display</h4>";
              echo "</div>";
            }
          }
        ?>
        <br>
      </div>

    <!-- End Right Column -->
    </div>
    
  <!-- End Grid -->
  </div>
  <br><br>
<!-- End Page Container -->
</div>

  <!-- Angular Material requires Angular.js Libraries -->
  <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.5.5/angular.min.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.5.5/angular-animate.min.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.5.5/angular-aria.min.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.5.5/angular-messages.min.js"></script>

  <!-- Angular Material Library -->
  <script src="https://ajax.googleapis.com/ajax/libs/angular_material/1.1.0/angular-material.min.js"></script>
  
  <!-- Your application bootstrap  -->
  <script type="text/javascript">    
    /**
     * You must include the dependency on 'ngMaterial' 
     */
    angular.module('BlankApp', ['ngMaterial']);
  </script>
  
</body>
</html>
