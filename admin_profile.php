<?php
	session_start();
	require_once('config.php');
  //phpinfo();
  if(!($_SESSION))
  {
    header("Location:admin_login.php");
  }
  else if($_SESSION)
  {
    if($con!=NULL)
    {
      $username= $_SESSION['username'];
      $password= $_SESSION['password'];
      $sql = "select * from userinfo where username='$username' and password='$password' ";
      $result = mysqli_query($con, $sql);
      if(mysqli_num_rows($result)>0)
      {
        header("Location:profile.php");
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
    header("Location:admin_login.php");
  } 
?>
<html lang="en" >
<head>
    <link rel="icon" href="main.jpg">
    <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Admin Profile</title>
  <link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/angular_material/1.1.0/angular-material.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/MaterialDesign-Webfont/2.0.46/css/materialdesignicons.css">
  <script src="https://cdnjs.cloudflare.com/ajax/libs/pace/1.0.2/pace.min.js"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/pace/1.0.2/themes/red/pace-theme-minimal.min.css">
  <style>
    .top{
        background:url(background.jpg) no-repeat center center fixed;
        -webkit-background-size: cover;
        -moz-background-size: cover;
        -o-background-size: cover;
        background-size: cover;
        background-repeat: no-repeat;
        /* overflow: hidden; */
        height:40vh;
        font-family: 'Open Sans', sans-serif;
    }
    .main-btn {
        display: block;
        position: absolute;
        transform: translateY(-60%) translateX(-50%);
        left: 50%;
        filter: drop-shadow(16px 16px 20px blue);
        -webkit-filter: drop-shadow(0 2px 3px rgba(0, 0, 0, 0.5));
        cursor: pointer;
    }
    .bottom{
        /* background:#ff5722; */
        /* height:60vh; */
    }
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
      background-color:#5f5da2;
      background: #5f5da2; /* For browsers that do not support gradients */
      background: -webkit-linear-gradient(#9ba9ff,#5f5da2); /* For Safari 5.1 to 6.0 */
      background: -o-linear-gradient(#9ba9ff,#5f5da2); /* For Opera 11.1 to 12.0 */
      background: -moz-linear-gradient(#9ba9ff,#5f5da2); /* For Firefox 3.6 to 15 */
      background: linear-gradient(#9ba9ff,#5f5da2); /* Standard syntax */
    }
    .tabsdemoDynamicHeight md-content {
        background-color: transparent !important; 
    }
    .tabsdemoDynamicHeight md-content md-tabs {
        background: #f6f6f6;
        border: 1px solid #e1e1e1; 
    }
    .tabsdemoDynamicHeight md-content md-tabs md-tabs-wrapper {
        background: white; 
    }
    .tabsdemoDynamicHeight md-content h1:first-child {
        margin-top: 0; 
    }
    .to_print {
        display:none;
    }
     @media print {
         body * {
            visibility: hidden;
        }
        .to_print, .to_print * {
            display:block;
            visibility: visible;
        }
        .to_print {
           
            top: 0;
            left:0;
        }
    } 
  </style>
  <link href="https://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet">
</head>
<body ng-app="BlankApp" ng-cloak>
                <?php
                    if(isset($_POST['find'])){  
                        $id = $_POST['id_num'];
                        echo "<div class='to_print'>";
                            $sql = "select * from applications where e_id='$id'";
                            $result = mysqli_query($con, $sql);
                            $count = mysqli_num_rows($result);
                            echo "<h3>List of Participants (".$count.")</h3>";
                            if($count > 0)
                            { 
                                for(;$row = mysqli_fetch_assoc($result);)
                                {    
                                  echo "<p>".$row['id_num']."</p>";
                                }
                            }
                        echo "</div>"; 
                    }
                ?>
    <div layout="row" layout-align="center center" flex="100" class=" top layout-wrap layout-align-center-center layout-row">
    <center>
        <img src="<?php 
            if($con!=NULL)
            {
              $username= $_SESSION['username'];
              $password= $_SESSION['password'];
              $sql = "select * from ceta_admin where username='$username'  and password='$password'";
              $result = mysqli_query($con, $sql);
              $row = mysqli_fetch_assoc($result);
              echo $row['photo'];
            }?>" style="border-radius:100%;" alt="Washed Out" flex-order="1" flex="100" >
    </center>
    <center>    
        <h2 style="color:white;" flex-order="2" flex="100">&nbsp
            <?php 
                if($con!=NULL)
                {
                    $username= $_SESSION['username'];
                    $password= $_SESSION['password'];
                    $sql = "select * from ceta_admin where username='$username'  and password='$password'";
                    $result = mysqli_query($con, $sql);
                    $row = mysqli_fetch_assoc($result);
                    echo "" . $row["name"];
                }
            ?>
        </h2>    
    </center>
    </div>
    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
        <md-button class="main-btn" name="logout" type="submit" class="md-raised md-warn" style="background:#fe0032;z-index:2">
            <md-icon md-font-icon="mdi-logout mdi-2x" class="mdi ng-scope md-font material-icons" style=" color:white;" >&nbsp<b>LOGOUT</b></md-icon>
        </md-button>
    </form>

    <div class="bottom">
    <div ng-cloak style="z-index:-1">
        <md-content>
            <md-tabs md-dynamic-height md-border-bottom > 


                <md-tab label="Active Events (<?php $sql = "select * from events where e_date >= CURDATE()";
                              $result = mysqli_query($con, $sql);
                              $count = mysqli_num_rows($result);
                              echo $count; ?>)">
                    <md-content class="md-padding">
                    <div layout="row" layout-align="start start" flex="100" layout-wrap>
                        <?php 
                            if($con!=NULL)
                            {   
                              $sql = "select * from events where e_date >= CURDATE()";
                              $result = mysqli_query($con, $sql);
                              $count = mysqli_num_rows($result);
                              if($count>0)
                              { 
                                for(;$row = mysqli_fetch_assoc($result);)
                                {
                                echo "<md-card flex-xl='24' flex-lg='30' flex-md='45' flex-sm='45' flex-xs='100'>";
                                echo "<md-card-header>";
                                echo "<md-card-avatar>";
                                echo "<img src='main.jpg'>";
                                echo "</md-card-avatar>";
                                echo "<md-card-header-text>";
                                echo "<span class='md-title'>CETA Event&nbsp(".$row['e_id'].")</span>";
                                echo "<span class='md-subhead'>".$row['e_time'].",on&nbsp".$row['e_date']."</span>";
                                echo "</md-card-header-text>";
                                echo "</md-card-header>";
                                echo "<img ng-src='cetapic.png' class='md-card-image' alt='Washed Out'>";
                                echo "<md-card-title>";
                                echo "<md-card-title-text>";
                                echo "<span class='md-headline'>".$row['e_name']."</span>";
                                echo "</md-card-title-text>";
                                echo "</md-card-title>";
                                echo "<md-card-content>";
                                    echo "<p>".$row['e_description']."</p>";
                                echo "</md-card-content>";
                                echo "</md-card>";
                                }
                              }
                            }
                        ?>
                     </div>  
                     
                    </md-content>
                </md-tab>

                
                <md-tab label="Students Applied">
                    <md-content class="md-padding">
                    <div layout="row" layout-align="start start" flex="100" layout-wrap>
                        <div flex="50" flex-sm="100" flex-md="100" flex-xs="100">
                            <md-card>
                                <md-card-title>
                                    <md-card-title-text>
                                        <span class="md-headline">Event ID</span>
                                    </md-card-title-text>
                                </md-card-title>
                                <md-card-content>
                                    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
                                        <md-input-container class="md-block" flex-order="1" flex="100" >
                                            <label>Enter ID of Event</label>
                                            <input name="id_num"  ng-required="true">
                                        </md-input-container>   
                                        <md-button name="find" flex-order="2"  type="submit" class="md-raised md-primary" >
                                            <md-icon md-font-icon="mdi-magnify mdi-2x" class="mdi ng-scope md-font material-icons">&nbspFind</md-icon>                   
                                        </md-button>
                                    </form>
                                </md-card-content>
                            </md-card>
                        </div>
                        <?php
                        if(isset($_POST['find'])){  
                            $id = $_POST['id_num'];  
                            echo "<div flex='50' flex-xs='100' flex-md='100' flex-sm='100'>";
                                echo "<md-card>";
                                            if($con!=NULL)
                                            {   
                                              $sql = "select * from applications where e_id='$id'";
                                              $result = mysqli_query($con, $sql);
                                              $count = mysqli_num_rows($result);
                                              echo "<md-card-title>";
                                              echo "<md-card-title-text>";
                                                  echo "<span class='md-headline'>List of Participants for Event ID ".$id." (".$count.")</span>";
                                              echo "</md-card-title-text>";
                                                echo "</md-card-title>";
                                                echo "<md-card-content>";
                                                echo "<br>";
                                              if($count > 0)
                                              { 
                                                echo "<table width='100%' border='0'>";
                                                echo "<tr>";
                                                echo "<th width='20%' style='padding:10px; text-align:left;  background:#f1f1f1;'><b>RollNo</b></th>";
                                                echo "<th width='80%' style='padding:10px; text-align:right; background:#f1f1f1;'><b>Student Name</b></th>";
                                                echo "</tr>";
                                                echo "</table>";
                                                for($i=1;$row = mysqli_fetch_assoc($result);$i++)
                                                {    
                                                    $us_id = $row['id_num'];
                                                    $sql1 = "select * from userinfo where id_num = '$us_id'";
                                                    $result1 = mysqli_query($con, $sql1);
                                                    $row1 = mysqli_fetch_assoc($result1);
                                                    echo "<table border='0'>";
                                                    echo "<tr>";
                                                    echo "<td style=''>".$row['id_num']."</td>";
                                                    echo "<td width='100%' style=' text-align:right;'>".$row1['name']."</td>";
                                                    echo "</tr>";
                                                    echo "</table>";
                                                    if($i!= $count)
                                                    {
                                                        echo "<hr >";
                                                    }
                                                }
                                                echo "<br>";
                                                echo "<md-button class='md-raised md-primary' onclick='pr_list()'>";
                                                    echo "<md-icon md-font-icon='mdi-printer mdi-2x' class='mdi ng-scope md-font material-icons'> print</md-icon>";
                                                echo "</md-button>"; 
                                              }
                                              else
                                              {
                                                echo "<md-card-content>No records found.";
                                                echo "</md-card-content>";
                                              }
                                            }
                                    echo "</md-card-content>";   
                                echo "</md-card>";
                            echo "</div>";
                        }?>
                        </div>
                    </md-content>
                </md-tab>
                <script>
                    function pr_list(){
                        window.print();
                    }
                </script>
                <md-tab label="Add/Delete Event">
                    <md-content class="md-padding">
                    <div layout="row" layout-align="start start" flex="100" layout-wrap>    
                        <div flex="50" flex-xs="100">
                        <md-card>
                            <md-card-title>
                                <md-card-title-text>
                                    <span class="md-headline">Add Event</span>
                                </md-card-title-text>
                            </md-card-title>
                                <md-card-content>
                                <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
                                    <md-input-container class="md-block">
                                        <label>Event Name</label>
                                        <input name="e_name"  ng-required="true">
                                    </md-input-container>
                                    <md-input-container class="md-block">
                                        <label>Event Description</label>
                                        <input name="e_desc"  ng-required="true">
                                    </md-input-container>
                                    <div layout="row" layout-align="center center" flex="100" layout-wrap >
                                    <md-input-container class="md-block" flex="33">
                                        <label>DD</label>
                                        <input name="e_d"  ng-required="true">
                                    </md-input-container>
                                    <md-input-container class="md-block" flex="33">
                                        <label>MM</label>
                                        <input name="e_m"  ng-required="true">
                                    </md-input-container>
                                    <md-input-container class="md-block" flex="33">
                                        <label>YYYY</label>
                                        <input name="e_y"  ng-required="true">
                                    </md-input-container>
                                    </div>
                                    <md-input-container class="md-block">
                                        <label>Time of event</label>
                                        <input name="e_time" ng-required="true">
                                    </md-input-container>
                                    <md-button type="submit" name="ad" class="md-raised md-primary">
                                        <md-icon md-font-icon="mdi-plus mdi-2x" class="mdi ng-scope md-font material-icons">&nbspAdd Event</md-icon>                    
                                    </md-button>
                                    </form>
                                </md-card-content>
                            </md-card>
                            <?php
                                if(isset($_POST['ad']))
                                {
                                    if($con!=NULL)
                                    {
                                        $e_n = $_POST['e_name'];
                                        $e_d = $_POST['e_desc'];
                                        $e_dd = $_POST['e_d'];
                                        $e_m = $_POST['e_m'];
                                        $e_y = $_POST['e_y'];
                                        $e_t = $_POST['e_time'];
                                        $e_date = $e_y."-".$e_m."-".$e_dd;
                                        $sql = "INSERT INTO events(e_name,e_description, e_date,e_time) VALUES ('$e_n','$e_d','$e_date','$e_t')";
                                        $result = mysqli_query($con, $sql);
                                        header('Location: ' . $_SERVER['PHP_SELF']);
                                        die('<META http-equiv="refresh" content="0;URL=' . $_SERVER['PHP_SELF'] . '">');
                                    }
                                }
                            ?>
                            </div>

                    <div flex="50" flex-xs="100">
                    <md-card>
                        <md-card-title>
                                <md-card-title-text>
                                    <span class="md-headline">Delete Event</span>
                                </md-card-title-text>
                            </md-card-title>
                            <md-card-content>
                            <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
                                    <md-input-container class="md-block" flex-order="1" flex="100" >
                                        <label>ID of Event</label>
                                        <input name="id_num1"  ng-required="true">
                                    </md-input-container>   
                                    <md-button name="del" flex-order="2"  type="submit" class="md-raised md-primary" style="background:#ff5252;">
                                        <md-icon md-font-icon="mdi-close mdi-2x" class="mdi ng-scope md-font material-icons">&nbspDelete Event</md-icon>                   
                                    </md-button>
                            </form>
                            </md-card-content>
                        </md-card>
                    </div>
                    </div>    
                            <?php
                                if(isset($_POST['del'])){
                                    if($con!=NULL)
                                    {
                                      $id=$_POST['id_num1'];
                                      $sql = "DELETE FROM events WHERE e_id='$id'";
                                      $result = mysqli_query($con, $sql);
                                      if(mysqli_affected_rows($con)>0){
                                        header('Location: ' . $_SERVER['PHP_SELF']);
                                        die('<META http-equiv="refresh" content="0;URL=' . $_SERVER['PHP_SELF'] . '">');
                                      }
                                      else{
                                        echo '<script type="text/javascript">alert("No such id exists")</script>';
                                      }
                                    }
                                }
                            ?>
                    </md-content>
                </md-tab>


                <md-tab label="Past Events (<?php $sql = "select * from events where e_date < CURDATE()";
                              $result = mysqli_query($con, $sql);
                              $count = mysqli_num_rows($result);
                              echo $count; ?>)">
                    <md-content class="md-padding">
                    <div layout="row" layout-align="start start" flex="100" layout-wrap>
                    <?php 
                        if($con!=NULL)
                        {   
                          $sql = "select * from events where e_date < CURDATE()";
                          $result = mysqli_query($con, $sql);
                          if(mysqli_num_rows($result)>0)
                          { 
                            for($i=1;$row = mysqli_fetch_assoc($result);$i++)
                            {
                            echo "<md-card flex-xl='24' flex-lg='30' flex-md='45' flex-sm='45' flex-xs='100'>";
                            echo "<md-card-header>";
                            echo "<md-card-avatar>";
                            echo "<img src='main.jpg'>";
                            echo "</md-card-avatar>";
                            echo "<md-card-header-text>";
                            echo "<span class='md-title'>CETA Event&nbsp(".$row['e_id'].")</span>";
                            echo "<span class='md-subhead'>".$row['e_time'].",on&nbsp".$row['e_date']."</span>";
                            echo "</md-card-header-text>";
                            echo "</md-card-header>";
                            echo "<img ng-src='cetapic.png' class='md-card-image' alt='Washed Out'>";
                            echo "<md-card-title>";
                            echo "<md-card-title-text>";
                            echo "<span class='md-headline'>".$row['e_name']."</span>";
                            echo "</md-card-title-text>";
                            echo "</md-card-title>";
                            echo "<md-card-content>";
                                echo "<p>".$row['e_description']."</p>";
                            echo "</md-card-content>";
                            echo "</md-card>";
                            }
                          }
                        }
                    ?>
                 </div>  

                    </md-content>
                </md-tab>

                <md-tab label="Winnners">
                    <md-content class="md-padding">
                        <div layout="row" layout-align="start start" flex="100" layout-wrap>
                        <div flex="50" flex-xs="100" flex-md="100" flex-sm="100">
                        <md-card>
                        <md-card-title>
                                <md-card-title-text>
                                    <span class="md-headline">Add Winner</span>
                                </md-card-title-text>
                            </md-card-title>
                            <md-card-content>
                            <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
                                    <md-input-container class="md-block">
                                        <label>ID of the Event</label>
                                        <input name="id_num2"  ng-required="true">
                                    </md-input-container> 
                                    <md-input-container class="md-block">
                                        <label>Enter Rollno of winner student</label>
                                        <input name="id_num2_1" ng-required="true">
                                    </md-input-container>   
                                    <md-button name="win" type="submit" class="md-raised md-primary">
                                        <md-icon md-font-icon="mdi-plus mdi-2x" class="mdi ng-scope md-font material-icons">&nbspPost</md-icon>                   
                                    </md-button>
                            </form>
                            </md-card-content>
                        </md-card>
                        
                        <md-card>
                        <md-card-title>
                                <md-card-title-text>
                                    <span class="md-headline">Delete Winner</span>
                                </md-card-title-text>
                            </md-card-title>
                            <md-card-content>
                            <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
                                    <md-input-container class="md-block">
                                        <label>ID of the Event</label>
                                        <input name="id_num3"  ng-required="true">
                                    </md-input-container>    
                                    <md-button name="win_del" type="submit" class="md-raised md-primary" style="background:#ff5252;">
                                        <md-icon md-font-icon="mdi-close mdi-2x" class="mdi ng-scope md-font material-icons">&nbspDelete</md-icon>                   
                                    </md-button>
                            </form>
                            </md-card-content>
                        </md-card>
                    </div>
                    <?php  
                        if(isset($_POST['win_del'])){
                            if($con!=NULL)
                            {
                                $id_num3 = $_POST['id_num3'];
                                $sql = "DELETE FROM winners WHERE e_id='$id_num3'";
                                $result = mysqli_query($con, $sql);
                                if(mysqli_affected_rows($con)>0){
                                    header('Location: ' . $_SERVER['PHP_SELF']);
                                    die('<META http-equiv="refresh" content="0;URL=' . $_SERVER['PHP_SELF'] . '">');
                                }
                                else{
                                    echo '<script type="text/javascript">alert("No record found with that event id.")</script>';
                                }
                            }
                        }
                        if(isset($_POST['win'])){
                            if($con!=NULL)
                            {
                                $id_num2 = $_POST['id_num2'];
                                $sql = "select * from events where e_date < CURDATE() AND e_id = '$id_num2'";
                                $result = mysqli_query($con, $sql);
                                if(mysqli_num_rows($result)>0)
                                {
                                    $id_num2_1 = strtoupper($_POST['id_num2_1']);
                                    $sql = "INSERT INTO winners(`e_id`, `id_num`) VALUES ('$id_num2','$id_num2_1')";
                                    $result = mysqli_query($con, $sql);
                                    if(!$result){
                                        echo '<script type="text/javascript">alert("Unable to insert.")</script>';
                                    }
                                }
                                else
                                {
                                    echo '<script type="text/javascript">alert("Event not yet completedf!")</script>';
                                }
                            }
                        }
                        echo "<div flex='50' flex-xs='100' flex-md='100' flex-sm='100'>";
                            echo "<md-card>";
                            echo "<md-card-title>";
                            echo "<md-card-title-text>";
                                echo "<span class='md-headline'>Winners List</span>";
                            echo "</md-card-title-text>";
                            echo "</md-card-title>";
                            echo "<md-card-content>";
                                        echo "<br>";
                                        if($con!=NULL)
                                        {   
                                          $sql = "select * from winners";
                                          $result = mysqli_query($con, $sql);
                                          $count = mysqli_num_rows($result);
                                         
                                          if($count > 0)
                                          { 
                                            echo "<table width='100%' border='0'>";
                                            echo "<tr>";
                                            echo "<th width='15%' style='text-align:left; padding:10px; background:#f1f1f1;'><b>Event ID</b></th>";
                                            echo "<th width='85%' style='padding:10px; text-align:right; background:#f1f1f1;'><b>Student Name</b></th>";
                                            echo "</tr>";
                                            echo "</table>";
                                            for($i=1;$row = mysqli_fetch_assoc($result);$i++)
                                            {    
                                                $us_id = $row['id_num'];
                                                $sql1 = "select * from userinfo where id_num = '$us_id'";
                                                $result1 = mysqli_query($con, $sql1);
                                                $row1 = mysqli_fetch_assoc($result1);
                                                echo "<table border='0'>";
                                                echo "<tr>";
                                                echo "<td style='padding-left:10px;'>".$row['e_id']."</td>";
                                                echo "<td width='100%' style='text-align:right;'>".$row1['name']."</td>";
                                                echo "</tr>";
                                                echo "</table>";
                                                if($i!= $count)
                                                {
                                                    echo "<hr >";
                                                }
                                            }
                                          }
                                          else
                                          {
                                            echo "<md-card-content>No records found.";
                                            echo "</md-card-content>";
                                          }
                                        }
                                echo "</md-card-content>";   
                            echo "</md-card>";
                        echo "</div>";
                    ?>
                 </div>  
                    </md-content>
                </md-tab>
            </md-tabs>
        </md-content>
    </div>
    </div>
  <!-- Angular Material requires Angular.js Libraries -->
  <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.5.5/angular.min.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.5.5/angular-animate.min.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.5.5/angular-aria.min.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.5.5/angular-messages.min.js"></script>

  <!-- Angular Material Library -->
  <script src="https://ajax.googleapis.com/ajax/libs/angular_material/1.1.0/angular-material.min.js"></script>

  <script type="text/javascript">    
                        angular.module('tabsDemoDynamicHeight', ['ngMaterial']);
                        angular.module('BlankApp', ['ngMaterial']);  
    </script>
  
  <!-- Your application bootstrap  -->
  
</body>
</html>