<?php
  session_start();
  require_once('config.php');
  //phpinfo();
  if($_SESSION)
  {
    if($con!=NULL)
    {
      $username=$_SESSION['username'];
      $password= $_SESSION['password'];
      $sql = "select * from ceta_admin where username='$username' and password='$password' ";
      $result = mysqli_query($con, $sql);
      if(mysqli_num_rows($result)>0)
      {
        header("Location:admin_profile.php");
      }
      else
      {
        $sql = "select * from userinfo where username='$username' and password='$password' ";
        $result = mysqli_query($con, $sql);
        if(mysqli_num_rows($result)>0)
        {
          header("Location:profile.php");
        }
      }
    }
  }
?>
<?php
        if(isset($_POST['login']))
        { 
          $username=$_POST['username'];
          $password=$_POST['password'];
          $query = "select * from userinfo where username='$username' and password='$password' ";
          $query_run = mysqli_query($con,$query);
          if($query_run)
          {
            if(mysqli_num_rows($query_run)>0)
            {
            $row = mysqli_fetch_array($query_run,MYSQLI_ASSOC);
            $_SESSION['username'] = $username;
            $_SESSION['password'] = $password;
            header("Location:profile.php");
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
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Ceta</title>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <script src="https://cdnjs.cloudflare.com/ajax/libs/pace/1.0.2/pace.min.js"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/pace/1.0.2/themes/red/pace-theme-minimal.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/MaterialDesign-Webfont/2.0.46/css/materialdesignicons.css">
  <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
  <!-- <link href='https://fonts.googleapis.com/css?family=RobotoDraft' rel='stylesheet' type='text/css'> -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/angular_material/1.1.0/angular-material.min.css">
  <link rel="icon" href="main.jpg">
  <!-- Chrome, Firefox OS and Opera -->
  <meta name="theme-color" content="#2196f3">
  <!-- Windows Phone -->
  <meta name="msapplication-navbutton-color" content="#2196f3">
  <!-- iOS Safari -->
  <meta name="apple-mobile-web-app-status-bar-style" content="#2196f3">

  <link href="https://fonts.googleapis.com/css?family=Saira+Extra+Condensed" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css?family=Catamaran:600" rel="stylesheet">

  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/css/bootstrap.min.css" integrity="sha384-/Y6pD6FV/Vv2HJnA6t+vslU6fwYXjCFtcEpHbNJ0lyAFsXTsjBbfaDjzALeQsN6M"
    crossorigin="anonymous">
  <style>
    .main{
       background:url(main7.jpg) no-repeat center center fixed;
  	  -webkit-background-size: cover;
		  -moz-background-size: cover;
		  -o-background-size: cover;
		  background-size: cover;
		  background-repeat: no-repeat;
      overflow: hidden;
      height: 100vh;
      padding: 0 16px;
    }

    .about{
      padding: 0;
    }

    .hf{
      font-family: 'Catamaran', sans-serif;
    }
    /* .main1{
        background:url(main2.jpg) no-repeat center center ;
  	  -webkit-background-size: cover;
		  -moz-background-size: cover;
		  -o-background-size: cover;
		  background-size: cover;
		  background-repeat: no-repeat; 
      overflow: hidden;
      height: 50vh;
      padding: 0 16px;
    } */
    .ab{
      /* position: absolute; */
      /* width: 50%; */
      min-height: 60%;
      padding: 16px 16px 16px 16px;
      text-align: center;
      color: white;
      font-family: 'Saira Extra Condensed', sans-serif;
      /* margin:auto; */
      background: rgba(232, 41, 41, 0.8);
    }

    a:link {
      text-decoration: none;
    }

    a:visited {
      text-decoration: none;
    }

    a:hover {
      text-decoration: none;
    }

    a:active {
      text-decoration: none;
    }
    img[name="mainimg"] { 
      width:50%;
    }
    body
    {
       background: #3f51b5;
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
      background-color:#3f51b5;
      background: #3f51b5; /* For browsers that do not support gradients */
      background: -webkit-linear-gradient(#9ba9ff,#3f51b5); /* For Safari 5.1 to 6.0 */
      background: -o-linear-gradient(#9ba9ff,#3f51b5); /* For Opera 11.1 to 12.0 */
      background: -moz-linear-gradient(#9ba9ff,#3f51b5); /* For Firefox 3.6 to 15 */
      background: linear-gradient(#9ba9ff,#3f51b5); /* Standard syntax */
    }
    md-card[name=myImg1]:hover {
      animation: shake 0.5s;
      animation-iteration-count: infinite;
    }

    @keyframes shake {
      0% { transform: translate(1px, 1px) rotate(0deg); }
      10% { transform: translate(-1px, -2px) rotate(-1deg); }
      20% { transform: translate(-3px, 0px) rotate(1deg); }
      30% { transform: translate(3px, 2px) rotate(0deg); }
      40% { transform: translate(1px, -1px) rotate(1deg); }
      50% { transform: translate(-1px, 2px) rotate(-1deg); }
      60% { transform: translate(-3px, 1px) rotate(0deg); }
      70% { transform: translate(3px, 1px) rotate(-1deg); }
      80% { transform: translate(-1px, -1px) rotate(1deg); }
      90% { transform: translate(1px, 2px) rotate(0deg); }
      100% { transform: translate(1px, -2px) rotate(-1deg); }
    }

    img[name=myImg] {
      
      cursor: pointer;
      transition: 0.3s;
    }

    /* img[name=myImg]:hover {opacity: 0.9;} */




/* Modal Content (image) */
.modal-content {
    margin: auto;
    display: block;
    /* width: 95%; */
    height:auto;
    overflow:hidden;
    /* max-width: 700px; */
}


/* The Close Button */
 .close {
    position: absolute; 
    top: 15px;
    right: 35px;
    color: #f1f1f1;
    /* font-size: 40px;
    font-weight: bold;
    transition: 0.3s; */
} 

.close:hover,
.close:focus {
    color: #bbb;
    text-decoration: none;
    cursor: pointer;
}

/* 100% Image Width on Smaller Screens */
 @media only screen and (max-width: 700px){
    .modal-content {
        margin-top:50%;
        /* width: 100%; */
    } 
}
  </style>
</head>

<body class="" ng-app="BlankApp" ng-cloak>
  
  <!-- Side Navigation -->
  <nav class="w3-sidebar w3-bar-block w3-collapse w3-indigo w3-animate-left w3-card-2" style="z-index:3;width:320px;" id="mySidebar">
    <a href="javascript:void(0)" onclick="w3_close()" title="Close Sidemenu" class="w3-bar-item w3-right-align w3-button w3-hide-large w3-large">
      <i class="fa fa-remove">&nbspClose</i>
    </a>

    <a href="javascript:void(0)" onclick="location.reload()" class="w3-bar-item w3-center w3-button w3-border-bottom w3-large">
      <img src="main.jpg" style="width:50%;" alt="Ceta">
      <h3>Computer Engineers Technical Association (CETA)</h3>
    </a>
    
    <a href="javascript:void(0)" class="w3-bar-item w3-button  w3-button test w3-left-align" onclick="openMail('about');w3_close();"id="about_menu">
      <i class="fa fa-info w3-margin-right"></i>
      About
    </a>

    <form action="index.php" method="POST">
      <a href="javascript:void(0)" class="w3-bar-item w3-button  w3-button w3-left-align" onclick="document.getElementById('login_modal').style.display='block'">
        <i class="fa fa-lock w3-margin-right"></i>Login
      </a>
    </form>


    <a id="myBtn" onclick="myFunc('Demo1')" href="javascript:void(0)" class="w3-bar-item w3-button">
      <i class="fa fa-calendar-o w3-margin-right"></i>Events
      <i class="fa fa-caret-down w3-margin-left"></i>
    </a>
    <div id="Demo1" class="w3-hide w3-animate-left">
      <a href="javascript:void(0)" class="w3-bar-item w3-button w3-border-bottom test w3-hover-light-grey" onclick="openMail('upevent');w3_close();"
        id="firstTab">
        <div class="w3-container">
          <i class="fa fa-calendar-plus-o w3-margin-right"></i>
          <span class="w3-opacity w3-large">Upcoming Events</span>
        </div>
      </a>
      <a href="javascript:void(0)" class="w3-bar-item w3-button w3-border-bottom test w3-hover-light-grey" onclick="openMail('p_event');w3_close();" id="secondTab">
        <div class="w3-container">
          <i class="fa fa-calendar-check-o w3-margin-right"></i>
          <span class="w3-opacity w3-large">Past Events</span>
        </div>
      </a>
      <a href="javascript:void(0)" class="w3-bar-item w3-button w3-border-bottom test w3-hover-light-grey" onclick="openMail('win');w3_close();">
        <div class="w3-container">
          <i class="fa fa-trophy w3-margin-right"></i>
          <span class="w3-opacity w3-large">Winners</span>
        </div>
      </a>
    </div>
    <a href="javascript:void(0)" class="w3-bar-item w3-button test" onclick="openMail('gallery');w3_close();"id="gallery_menu">
      <i class="fa fa-picture-o w3-margin-right"></i>Gallery
    </a>
  </nav>

  <!-- Modal that pops up when you click on "New Message" -->
  <div id="login_modal" class="w3-modal" style="z-index:4; overflow:hidden;">
    <md-card class="w3-modal-content w3-animate-bottom" flex-xl="30" flex-lg="30" flex-md="40" flex-sm="50" flex-xs="95">
    <img src="top.jpeg" alt="">
        <md-card-header>
          <md-card-header-text>
            <span class="md-title"><h3>CETA</h3></span>
            <span class="md-subhead">User Login</span>
          </md-card-header-text>
          <span onclick="document.getElementById('login_modal').style.display='none'" class="w3-right w3-large" style="">
          <i class="fa fa-remove"></i>
        </span>
        </md-card-header>
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
              <md-icon md-font-icon="mdi-login mdi-2x" class="mdi ng-scope md-font material-icons" > login</md-icon>
            </md-button>
          </form>
          <br>
        </md-card-content>
    </md-card>
  </div>

  <!-- Overlay effect when opening the side navigation on small screens -->
  <div class="w3-overlay w3-hide-large w3-animate-opacity" onclick="w3_close()" style="cursor:pointer" title="Close Sidemenu"
    id="myOverlay"></div>

  <!-- Page content -->
  <div class="w3-main" style="margin-left:320px;">
    <div class="w3 w3-indigo">
      <i  id="1" class="fa fa-bars w3-button  w3-hide-large w3-xlarge w3-margin-left w3-margin-top w3-margin-bottom" onclick="w3_open()">&nbspCeta</i>
      <a  href="javascript:void(0)" style="border: 2.5px solid #FFFFFF;" class="w3-hide-large w3-indigo w3-button w3-right w3-margin-top w3-margin-right" onclick="document.getElementById('login_modal').style.display='block'">
       <i id="2" class="fa fa-lock">&nbspLogin</i>
      </a>
    </div>      
    

  <!--tabs-->
  <div class="w3-container person about" id="about">
    <div class="main" layout="row" layout-align="center center">
      <div class="ab" flex-xl="40" flex-lg="45" flex-md="65" flex-sm="70" flex-xs="90">
          <h2>Vardhaman College<br> of Engineering</h2>
          <br>
          <h1 style="font-size:50px;">Computer Engineers Technical Association<br>(C E T A)</h1>
          <br><br>
          <h2>Develope your Technical<br>Skills </h2>
      </div>
    </div>

    <div class="w3 w3-blue" style="height: 50vh; padding:16px 16px 16px 16px;">
      <h3>C E T A</h3> <br><h4>- Computer Engineers Technical Association</h4> 
      <h6> helps students to develop Technical and Soft skills </h6>
    </div>

    <div layout="row" layout-align="center center" flex-xs="100"  class="layout-wrap layout-align-center-center layout-row flex-xs-100">
      <div class="w3 w3-light-grey" flex-order="2" flex-xl="50" flex-lg="50" flex-md="50" flex-sm="100" flex-xs="100" style=" height:65vh;">
        <div layout="row" layout-align="center center" class="layout-wrap layout-align-center-center layout-row">
        <md-card flex-lg="55" flex-md="60" flex-sm="60" flex-xs="90">
        <md-card-header class="w3-animate-right">
          <md-card-avatar>
            <img src="vmeg.png"/>
          </md-card-avatar>
          <md-card-header-text>
            <span class="md-title">Vardhaman College Of Engineering</span>
            <span class="md-subhead">Assistant Professor</span>
          </md-card-header-text>
        </md-card-header>
        <hr>
        <center><img class="w3-animate-left" ng-src="prasad1.jpg" style="border-radius:100%; " class="md-card-image" alt="Washed Out"></center>
        <md-card-title class="w3-animate-right">
          <md-card-title-text>
            <span class="md-headline">G. S. Prasada Reddy</span>
          </md-card-title-text>
        </md-card-title>
        <md-card-content class="w3-animate-left">
          Mentor (CETA)
          <a href="http://www.vardhaman.org/cse-faculty/15.html?view=faculty" target="_blank"><h5>full info&nbsp<i class="fa fa-external-link"></i></h5></a>
        </md-card-content>
      </md-card>
      </div>
     </div>
     
     <div class="w3 w3-blue" flex-order="1" flex-xl="50" flex-lg="50" flex-md="50" flex-sm="100" flex-xs="100" style="padding:16px 16px 16px 16px; text-align:center; height:65vh;">
        <img src="about.png" alt="about" class="w3-image" flex-lg="80" flex-md="70" flex-sm="50">   
     </div>
    </div>


    
  </div>

  <!-- <gallery> -->
  <div class="w3-container w3-white person about layout-wrap layout-align-center-center layout-row" layout="row" layout-align="center center" flex="100" style="min-height:100vh;" id="gallery">
    <header class="w3-indigo" style="padding:16px 16px 16px 30px;">
      <h2><i class="fa fa-picture-o w3-margin-right"></i>Gallery</h2>
    </header>
    <div layout="row" layout-align="start start" flex="100" layout-wrap>
       <?php
        $sql = "select * from gallery";
        $result = mysqli_query($con, $sql);
        for($i=1;$row = mysqli_fetch_assoc($result);$i++){
         echo "<md-card name='myImg1' class='w3 w3-animate-right' flex-xl='30' flex-lg='30' flex-md='40' flex-sm='45' flex-xs='100' >";
           echo "<img ng-src='gallery/".$row['image']."' class='md-card-image' name='myImg' onclick='fun()' id='myImg".$i."' onmouseover='geti(".$i.")' alt='Gallery'>";
         echo "</md-card>";
        }
       ?>
        <!-- The Modal -->
        <div id="myModal" class="w3-modal" title="Click any where to exit">
          <span class="w3 close w3-right w3-xlarge">
            <i class="fa fa-remove"></i>
          </span>
          <img class="modal-content w3-animate-zoom" flex-xl="100" flex-lg="100" flex-md="100" flex-sm="100" flex-xs="100" id="img01">
          <!-- <span class="close">&times;</span> -->
        </div>
        <script>
           var img;
          // Get the modal
          var modal = document.getElementById('myModal');
          // Get the image and insert it inside the modal - use its "alt" text as a caption
          function geti(i){
           img = document.getElementById('myImg'+i);
           
          }
          var modalImg = document.getElementById("img01");
         
          function fun(){
            myModal.style.display = "block";
            //document.getElementById("myModal").style.display = "block";
            modalImg.src = img.src;
            
          }

        // Get the <span> element that closes the modal
        var span = document.getElementsByClassName("close")[0];

        // When the user clicks on <span> (x), close the modal
        span.onclick = function() { 
          myModal.style.display = "none";
        }
        document.getElementById('myModal').onclick = function() {
          document.getElementById('myModal').style.display = "none";
         }
      </script>
    </div>
  </div>

  <!-- events -->
  <div id="upevent" style="height:100vh;" class="w3-container w3-light-grey about person w3-white">
    <header class="w3-indigo" style="padding:16px 16px 16px 30px;">
      <h2><i class="fa fa-calendar-plus-o w3-margin-right"></i>Upcoming Events</h2>
    </header>
    <div layout="row" layout-align="start start" flex="100" layout-wrap>
                        <?php 
                            if($con!=NULL)
                            {   
                              $sql = "select * from events where e_date >= CURDATE()";
                              $result = mysqli_query($con, $sql);
                              if(mysqli_num_rows($result)>0)
                              { 
                                
                                for($i=1;$row = mysqli_fetch_assoc($result);$i++)
                                {
                                echo "<md-card flex='30' flex-md='45' flex-sm='45' flex-xs='100'>";
                                echo "<md-card-header class='w3-animate-right'>";
                                echo "<md-card-avatar>";
                                echo "<img src='main.jpg'>";
                                echo "</md-card-avatar>";
                                echo "<md-card-header-text>";
                                echo "<span class='md-title'>CETA Event</span>";
                                echo "<span class='md-subhead'>".$row['e_time'].",on&nbsp".$row['e_date']."</span>";
                                echo "</md-card-header-text>";
                                echo "</md-card-header>";
                                echo "<img ng-src='cetapic.png' class='md-card-image w3-animate-left alt='Washed Out'>";
                                echo "<md-card-title class='w3-animate-right'>";
                                echo "<md-card-title-text>";
                                echo "<span class='md-headline'>".$row['e_name']."</span>";
                                echo "</md-card-title-text>";
                                echo "</md-card-title>";
                                echo "<md-card-content class='w3-animate-left'>";
                                    echo "<p>".$row['e_description']."</p>";
                                    echo "<hr>";
                                    echo "<p>Event Code:&nbsp<b style='color:#fe0032'>".$row['e_id']."</b></p>";
                                echo "</md-card-content>";
                                echo "</md-card>";
                                }
                              }
                            }
                        ?>
    </div>
  </div>

<div id="p_event" style="height:100vh;" class="w3-container person w3-light-grey about">
  <header class="w3-indigo" style="padding:16px 16px 16px 30px;">
    <h2><i class="fa fa-calendar-check-o w3-margin-right"></i>Past Events</h2>
  </header> 
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
                                echo "<md-card flex='30' flex-md='45' flex-sm='45' flex-xs='100'>";
                                echo "<md-card-header class='w3-animate-right'>";
                                echo "<md-card-avatar>";
                                echo "<img src='main.jpg'>";
                                echo "</md-card-avatar>";
                                echo "<md-card-header-text>";
                                echo "<span class='md-title'>CETA Event</span>";
                                echo "<span class='md-subhead'>".$row['e_time'].",on&nbsp".$row['e_date']."</span>";
                                echo "</md-card-header-text>";
                                echo "</md-card-header>";
                                echo "<img ng-src='cetapic.png' class='md-card-image w3-animate-left' alt='Washed Out'>";
                                echo "<md-card-title class='w3-animate-right'>";
                                echo "<md-card-title-text>";
                                echo "<span class='md-headline'>".$row['e_name']."</span>";
                                echo "</md-card-title-text>";
                                echo "</md-card-title>";
                                echo "<md-card-content class='w3-animate-left'>";
                                    echo "<p>".$row['e_description']."</p>";
                                    echo "<hr>";
                                echo "<p>Event Code:&nbsp<b style='color:#fe0032'>".$row['e_id']."</b></p>";
                                echo "</md-card-content>";
                                echo "</md-card>";
                                }
                              }
                            }
                        ?>
    
  </div>
</div>

<div id="win" style="height:100vh;" class="w3-container about person w3-light-grey">
    <header class="w3-indigo" style="padding:16px 16px 16px 30px;">
      <h2><i class="fa fa-trophy w3-margin-right"></i>Winners</h2>
    </header>
    <div layout="row" layout-align="start start" flex="100" layout-wrap>
                            <?php
                                        if($con!=NULL)
                                        {   
                                          $sql = "select * from winners";
                                          $result = mysqli_query($con, $sql);
                                          $count = mysqli_num_rows($result);
                                         
                                          if($count > 0)
                                          { 
                                            for($i=1;$row = mysqli_fetch_assoc($result);$i++)
                                            { 
                                                echo "<md-card flex-xl='24' flex-lg='30' flex-md='45' flex-sm='45' flex-xs='100'>";
                                                echo "<img class='w3-animate-left' src='cetapic.png' class='md-card-image' alt='Washed Out'>";
                                                $us_id = $row['id_num'];
                                                $sql1 = "select * from userinfo where id_num = '$us_id'";
                                                $result1 = mysqli_query($con, $sql1);
                                                $row1 = mysqli_fetch_assoc($result1);
                                                echo "<md-card-title>";
                                                echo "<md-card-title-text class='w3-animate-right'>";
                                                  echo "<span class='md-headline'>".$row1['name']."<br>(".$row['id_num'].")</span>";
                                                echo "</md-card-title-text>";
                                                echo "</md-card-title>"; 
                                                
                                                $e_id = $row['e_id'];
                                                $sql1 = "select * from events where e_id = '$e_id'";
                                                $result1 = mysqli_query($con, $sql1);
                                                $row1 = mysqli_fetch_assoc($result1);
                                                
                                                echo "<md-card-content class='w3-animate-left'>";
                                                     echo "Event: ".$row1['e_name'];       
                                                echo "</md-card-content>";
                                                echo "</md-card>";
                                            }
                                          }
                                        }
                              ?>
    </div>
  </div>
</div>

  <script>
    // var openInbox = document.getElementById("myBtn");
    // openInbox.click();

    function w3_open() {
      document.getElementById("mySidebar").style.display = "block";
      document.getElementById("myOverlay").style.display = "block";
    }
    function w3_close() {
      document.getElementById("mySidebar").style.display = "none";
      document.getElementById("myOverlay").style.display = "none";
    }

    function myFunc(id) {
      var x = document.getElementById(id);
      if (x.className.indexOf("w3-show") == -1) {
        x.className += " w3-show";
        x.previousElementSibling.className += " w3-red";
      } else {
        x.className = x.className.replace(" w3-show", "");
        x.previousElementSibling.className =
          x.previousElementSibling.className.replace(" w3-red", "");
      }
    }

    //openMail("upevent")
    function openMail(personName) {
      var i;
      var x = document.getElementsByClassName("person");
      for (i = 0; i < x.length; i++) {
        x[i].style.display = "none";
      }
      x = document.getElementsByClassName("test");
      for (i = 0; i < x.length; i++) {
        x[i].className = x[i].className.replace(" w3-light-grey", "");
      }
      document.getElementById(personName).style.display = "block";
      event.currentTarget.className += " w3-light-grey";
    }
  
      var openTab = document.getElementById("about_menu");
      openTab.click();
  </script>
  <!-- Optional JavaScript -->
  <!-- jQuery first, then Popper.js, then Bootstrap JS -->
  <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN"
    crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js" integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4"
    crossorigin="anonymous"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/js/bootstrap.min.js" integrity="sha384-h0AbiXch4ZDo7tp9hKZ4TsHbi047NrKGLO3SEJAg45jXxnGIfYzk4Si90RDIqNm1"
    crossorigin="anonymous"></script>
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
  <script>
    // Get the modal
    var modal = document.getElementById('login_modal');

    // When the user clicks anywhere outside of the modal, close it
    window.onclick = function (event) {
      if (event.target == modal) {
        modal.style.display = "none";
      }
    }
  </script>
</body>
</html>