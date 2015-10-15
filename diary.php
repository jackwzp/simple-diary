<?
    session_start();

    include("connection.php");

    $query = "SELECT diary FROM users WHERE id='".$_SESSION['id']."' LIMIT 1";

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

    	<!-- Latest compiled and minified CSS -->
    	<link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">

    	<!-- Optional theme -->
    	<link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap-theme.min.css">

        <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
          <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->

        <style>

            #topContainer {
                background-image: url("https://ununsplash.imgix.net/photo-1429032021766-c6a53949594f?fit=crop&fm=jpg&h=700&q=75&w=1050");
                width: 100%;       
                background-size: cover;  /*this trick will display the whole image */
                background-position: center;
                height: auto;
        		min-height: 100%;
        		padding-top: 150px;
        		color: #B0B0B0;
            }

            #topRow {
                margin-top: 10px;
                text-align: center;
            }

            .bold {
                font-weight: bold;
            }

            .marginTop {
                margin-top: 30px;
            }

            #result {
        		margin-top: 10px;
        		margin-bottom: 10px;
        		color: grey;
        		display: none;
        	}


        </style>
  </head>

  <!-- Add these tags to enable scroll spy; we can add an id instead of referencing the navbar-collapse -->
  <body data-spy="scroll" data-target".navbar-collapse">
    
        <div class="navbar navbar-inverse navbar-fixed-top">
            <div class="container">
            
                <div class="navbar-header">
                    <a href="index.php" class="navbar-brand">App</a>

                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                        <!-- three horitontal lines -->
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>

                </div>

                <div class="collapse navbar-collapse">
                    <ul class="nav navbar-nav navbar-left">
                        <!-- Notice the href is referencing the divs -->
                        <li><a href="index.php">Home</a></li>
                        <li><a href="contact.php">Contact</a></li>
                    </ul>
                    <ul class="nav navbar-nav navbar-right">
                        <!-- Log user out by redirecting to index page with a GET variable -->
                      <li><a href="index.php?logout=1">Log Out</a></li>
                    </ul>
                </div>

            </div>
        </div>

        <div class="container content" id="topContainer">
            <div class="row" id="topRow">
                <div class="col-md-6 col-md-offset-3">

                    <textarea class="form-control" id="diarytext" rows="20" col="70" placeholder="Everything will be saved automatically." autofocus><? echo $diary; ?></textarea>
 
                </div>
            </div>
        </div>




     <!-- Latest compiled and minified JavaScript -->
	<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
	<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>

    <script>
        $(".content").css("min-height", $(window).height());

        $("#diarytext").keyup(function() {
            //alert("changed");
            $.post("updatediary.php", {diary: $("#diarytext").val()});
        });
    </script>

  </body>
</html>