<?php 
  
  session_start();

  include("connection.php"); 

//   if ($_SESSION['id']=="") {
//     header("Location:secretdiary.php");
//   }

  $query="SELECT diary FROM users WHERE ID='".$_SESSION['id']."' LIMIT 1";

  $result = mysqli_query($link, $query);

  $row = mysqli_fetch_array($result);

  $diary = $row['diary'];

?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>Secret Diary</title>

    <!-- Bootstrap -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  

    <style>

      .navbar-brand{
        font-size: 1.8em;

      }

      #topContainer {
        background-image: url("DSC00379.JPG");
        height: 400px;
        width: 100%;
        background-size: cover;
      }

      #topRow {
        margin-top: 800px;
        text-align: center;
      }

      #topRow h1{
        font-size: 300%;
        color: white;
      }

      .bold{
        font-weight: bold;
      }

      .marginTop {
        margin-top: 30px;
      }

      .center{
        text-align: center;
      }

      .title{
        margin-top: 100px;
        font-size: 300%;
      }

      #footer{
        background-color: #B0D1FB;
        padding-top: 70px;
        width: 100%;
      }

      .marginBottom{
        margin-bottom: 30px;
      }

      .appstoreImage{
        width: 250px;
      }


    </style>


  </head>
  <body data-spy="scroll" data-target=".navbar-collapse">

    <div class="navbar navbar-default navbar-fixed-top">

      <div class="container">


        <div class="navbar-header pull-left">

<!--             <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">

              <span class="sr-only">Toggle navigation</span>

              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>

            </button> -->
          
            <a class="navbar-brand">Secret Diary</a>

        </div>

        <div class="pull-right">

          <ul class="navbar-nav nav">
<!--             <li class="active"><a href="#home">Home</a></li> -->
            <li><a href="secretdiary.php?logout=1">Log Out</a></li> 
            <!-- above, provided the location of the logout link with href, and used ? as a get variable and set logout = to 1 -->
<!--             <li><a href="#download">Download The App</a></li> -->

          </ul>



        </div>
      
      </div>

    </div>

    <div class="container contentContainer" id="topContainer">

      <div class="row">
        <div class="col-md-6 col-md-offset-3" id="topRow">

          <textarea class="form-control"><?php echo $diary; ?></textarea> 
 <!--         php code is displaying diary variable -->
        </div>
        

      </div>  

    </div>

   

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>

    <script>

      $(".contentContainer").css("min-height", $(window).height());

      $("textarea").css("height", $(window).height()-110);

      $("textarea").keyup(function() {

        // alert("changed!");

        $.post("updatediary.php", {diary:$("textarea").val()}); //using AJAX post query function, adding content of textarea

      });

    </script>
  </body>
</html>


