<?php session_start(); ?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/css/bootstrap.min.css" integrity="sha384-/Y6pD6FV/Vv2HJnA6t+vslU6fwYXjCFtcEpHbNJ0lyAFsXTsjBbfaDjzALeQsN6M" crossorigin="anonymous">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <link rel="stylesheet" href="styles.css">
  </head>
  <body>
  	<div class="top"></div>
  	<div class="container">
  		<div class="row">
  			<h2>Success!</h2>
  		</div>
  		<div class="row">
  			<h4>Your order is on its way!</h4>
  		</div>
  	</div>

  	<div class="container">
  		
  		<div class="row item4sale">
  			<div id="shippingDetails"
  				<p> <?= htmlspecialchars($_POST['name']);  ?></p>
  				<p> <?= htmlspecialchars($_POST['address']); if($_POST['address2'] != "") echo htmlspecialchars($_POST['address2']);  ?></p>
  				<p> <?= htmlspecialchars($_POST['city'].", ".$_POST['state']." ".$_POST['zip']);  ?></p>
  			</div>
  		</div>
  	</div>

  	<div class="container">
  		<div class="row">
  			<h4>Order Summary</h4>
  		</div>
	   <?php  
	    foreach ($_SESSION as $key => $value) {
	    	if ($value != "") {
		    	
		    	echo '
		    	<div class="container">
		    		<div class="row item4sale">
		    	    <div class="row-height">
		    	      <div class="col col-height">
		    	        <div class="inside">
		    	          <div class="content">
		    	            <h4 class="'.$key.'">'.$value.'</h4>
		    	          </div>
		    	        </div>
		    	      </div>
		    	    </div>
		    	  </div>
		    	</div>';
		    }
	    }
	    ?>
  	</div>
    

    

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.2.1.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js" integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/js/bootstrap.min.js" integrity="sha384-h0AbiXch4ZDo7tp9hKZ4TsHbi047NrKGLO3SEJAg45jXxnGIfYzk4Si90RDIqNm1" crossorigin="anonymous"></script>
  </body>
</html>