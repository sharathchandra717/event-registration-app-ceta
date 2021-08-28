<?php
  session_start();
  require_once('config.php');
  //phpinfo();
  if($_SESSION)
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
?>
<?php
        if(isset($_POST['login']))
        { 
          $username=$_POST['username'];
          $password=$_POST['password'];
          $query = "select * from ceta_admin where username='$username' and password='$password' ";
          //echo $query;
          $query_run = mysqli_query($con,$query);
          //echo mysql_num_rows($query_run);
          if($query_run)
          {
            if(mysqli_num_rows($query_run)>0)
            {
            $row = mysqli_fetch_array($query_run,MYSQLI_ASSOC);
            $_SESSION['username'] = $username;
            $_SESSION['password'] = $password;
            header("Location:admin_profile.php");
            }
            else
            {
              echo '<script type="text/javascript">alert("No such User exists. Invalid Credentials")</script>';
            }
          }
          else
          {
            echo '<script type="text/javascript">alert("Database Error")</script>';
          }
        }
?>
<html lang="en" >
<head>
    <link rel="icon" href="main.jpg">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/angular_material/1.1.0/angular-material.min.css">
    <title>Admin Login</title>
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/MaterialDesign-Webfont/2.0.46/css/materialdesignicons.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pace/1.0.2/pace.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/pace/1.0.2/themes/red/pace-theme-minimal.min.css">  
    <link href="https://fonts.googleapis.com/css?family=Cabin" rel="stylesheet">
    <style>
        .main{
            background:url(background.jpg) no-repeat center center fixed;
              -webkit-background-size: cover;
            -moz-background-size: cover;
            -o-background-size: cover;
            background-size: cover;
            background-repeat: no-repeat;
            overflow: hidden;
            height: 100vh;
        }
    </style>
</head>
<body ng-app="BlankApp" ng-cloak>

<div class="main w3-container" layout="row" layout-align="center center" layout-wrap>
  <label style="color:#FFFFFF; font-size:85px;font-family: 'Cabin', sans-serif;" flex-xl="50" flex-lg="50" flex-md="40"  hide-xs hide-sm>Admin Login</label>

    <md-card flex-xl="25" flex-lg="30" flex-md="40" flex-sm="50" flex-xs="100">
        <img src="top.jpeg" alt="">
        <md-card-header>
          <md-card-header-text>
            <span class="md-title"><h3>CETA</h3></span>
            <span class="md-subhead">Admin Login</span>
          </md-card-header-text>
        </md-card-header>
        <!-- <img ng-src="login1.png" class="md-card-image" alt="Washed Out"> -->
        <md-card-content>
        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
            <md-input-container class="md-block" >
                <label>Username</label>
                <md-icon md-font-icon="mdi-account" style="font-size:22px" class="mdi md-font material-icons " ></md-icon>
                <input name="username" ng-model="user.userName" ng-required="true">
            </md-input-container>
            <md-input-container class="md-block" >
                <label>Password</label>
                <md-icon style="font-size:22px" md-font-icon="mdi-lock " class="mdi md-font material-icons " ></md-icon>
                <input name="password" ng-model="user.password" type="password" ng-required="true">
            </md-input-container>
            <md-button name="login" type="submit" class="md-raised md-primary" id="login">
              <md-icon md-font-icon="mdi-login mdi-2x" class="mdi ng-scope md-font material-icons" >login</md-icon>
            </md-button>
        </form>
        <br>
        </md-card-content>
    </md-card>

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