<?php session_start();
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
	reset($_POST);
	$key = key($_POST);
  unset($_SESSION[$key]);
}
 ?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/css/bootstrap.min.css" integrity="sha384-/Y6pD6FV/Vv2HJnA6t+vslU6fwYXjCFtcEpHbNJ0lyAFsXTsjBbfaDjzALeQsN6M" crossorigin="anonymous">

    <link rel="stylesheet" href="styles.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  </head>
  <body>

  	<div class="top"></div>
    
    <div class="container">
    	<h1>Shopping Cart</h1>
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
	    	      
	    	      <div class="col-2 col-height col-middle">
	    	        <div class="inside">
	    	          <div class="content">
	    	            <button type="button" id="'.$key.'" class="btn btn-primary float-right remove">Remove from Cart</button>
	    	          </div>
	    	        </div>
	    	      </div>
	    	    </div>
	    	  </div>
	    	</div>';
	    }
    }
    ?>

    <div class="container">
    	<div class="row">
    		<div class="col">
    			<a role="button" class="btn btn-success btn-block float-center" href="browse.php">Return to Browse</a>
    		</div>
    		<div class="col">
    			<a role="button" class="btn btn-success btn-block float-center" href="checkout.php">Checkout</a>
    		</div>
    	</div>
    </div>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.2.1.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js" integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/js/bootstrap.min.js" integrity="sha384-h0AbiXch4ZDo7tp9hKZ4TsHbi047NrKGLO3SEJAg45jXxnGIfYzk4Si90RDIqNm1" crossorigin="anonymous"></script>

    <script type="text/javascript">
    	
    	$("button.remove").click(function() {
    		var $name = $(this).attr('id');
    		$.ajax({
					url: "cart.php",
					type: "POST",
					data: $name + "=" + $("h4."+$name).html()
				});
				location.reload(true);
    	});
    </script>
  </body>
</html>