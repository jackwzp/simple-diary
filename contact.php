<?php
    session_start();

    if($_POST["submit"]) {
        if($_POST["name"] AND $_POST["email"]) {

            $emailTo="jackwzp@gmail.com";
            $subject="Someone contacted you";
            $body="A person contacted you, his/her name is ".$_POST['name']." and email is ".$_POST['email'];
            $headers="From: jackwu@jackwu.com";

            if( mail($emailTo, $subject, $body, $headers)) {
                $result = '<div class="alert alert-success">Form submitted</div>';
                
            }
            else {
                $result="Form not sent";
            }

        }
        else {
            $result='<div class="alert alert-danger">Please enter all information</div>';
        }

    }

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
        		padding-top: 10px;
        		color: #B0B0B0;
            }

            #topRow {
                margin-top: 100px;
                text-align: center;
            }


            h1 {
                padding-bottom: 20px;
                margin-left: -120px;
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
                    <ul class="nav navbar-nav">
                        <!-- Notice the href is referencing the divs -->
                        <li><a href="index.php">Home</a></li>
                        <li><a href="#">Contact</a></li>
                    </ul>

                    <form id="loginform" class="navbar-form navbar-right" method="post">
                        <!-- Adding the form-group div will give spacing b/w the fields and buttons -->
                        <div class="form-group">
                            <input type="email" name="login-email" class="form-control" placeholder="Email" value="<? echo $_POST['login-email']?>"/>
                        </div>
                        <div class="form-group">
                            <input type="password" name="login-pass" class="form-control" placeholder="Password"/>
                        </div>
                        <div class="form-group">
                            <input type="submit" id="login" name="login" class="btn btn-success" value="Log In"/>
                        </div>
                    </form>
                </div>

            </div>
        </div>


        <div class="container content" id="topContainer">
            <div class="row" id="topRow">
                <!-- col-md-offset-3 centers the div; since total 12 col -->
                <div class="col-md-6 col-md-offset-3">

                    <h1>Contact Form</h1>

                    <?php echo $result; ?>

                    <form class="form-horizontal" method="post">
                      <div class="form-group">
                        <label for="name" class="col-sm-2 control-label">Name</label>
                        <div class="col-sm-10">
                          <input type="text" class="form-control" name="name" placeholder="Your Name" value="<?php echo $_POST['name']; ?>">
                        </div>
                      </div>

                      <div class="form-group">
                        <label for="email" class="col-sm-2 control-label">Email</label>
                        <div class="col-sm-10">
                          <input type="email" class="form-control" name="email" placeholder="Email" value="<?php echo $_POST['email']; ?>">
                        </div>
                      </div>

                      <div class="form-group">
                        <label for="email" class="col-sm-2 control-label">Comments</label>
                        <div class="col-sm-10">
                          <textarea class="form-control" name="comment" rows="10"><?php echo $_POST['comment']; ?></textarea>
                        </div>
                      </div>

                      <div class="form-group">
                        <div class="col-sm-offset-2 col-sm-10">
                          <input type="submit" name="submit" class="btn btn-success" value="Send">
                        </div>
                      </div>


                    </form>


                </div>
            </div>
        </div>






     <!-- Latest compiled and minified JavaScript -->
	<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
	<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>

    <script>
        $(".content").css("min-height", $(window).height());

        // Using ajax to submit the form instead of inline include php files in the index page
        $("#signupform").submit(function(event) {
            event.preventDefault();           
            var serialData = $(this).serialize();

            // serialize() does not add the value of the submit button to post form, so add it manually
            var buttonVal = '&' + encodeURI($("#submit").attr('name')) + '=' +  encodeURI($("#submit").attr('value'));

            serialData += buttonVal;
            submitForm(serialData);
        });

        // Using ajax to submit the form instead of inline include php files in the index page
        $("#loginform").submit(function(event) {
            event.preventDefault();
            var serialData = $(this).serialize();

            // serialize() does not add the value of the submit button to post form, so add it manually
            var buttonVal = '&' + encodeURI($("#login").attr('name')) + '=' +  encodeURI($("#login").attr('value'));

            serialData += buttonVal;
            submitForm(serialData);
        });

        function submitForm(serialData) {
            
            $.post("login.php", serialData, function(err) {
                    if(err) {
                        $('#popup').removeClass('alert-success').addClass('alert-danger');
                        $('#popup').html(err).fadeIn();
                    }
                    else {
                        // Redirect to logged in page 
                        window.location.href = "diary.php";                        
                    }
            });

        };

    </script>

  </body>
</html>