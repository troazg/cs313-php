<?php session_start(); ?>

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
	<div class="row item4sale">
    <div class="row-height">
      <div class="col col-height">
        <div class="inside">
          <div class="content">
            <h4 class="b1">Apple Pumpkin</h4>
            <p class="add1">Cultivated with care … home-grown apples and pumpkins blended with ginger and clove.</p>
          </div>
        </div>
      </div>
      
      <div class="col-2 col-height col-middle">
        <div class="inside">
          <div class="content">
            <button type="button" id="b1" class="btn btn-primary float-right add" 
            <?php 
            if(isset($_SESSION['b1'])) {
            	echo "disabled>Added!";
            }
            else {
            	echo ">Add to Cart";
            }
            	 ?>
            	</button>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<div class="container">
	<div class="row item4sale">
    <div class="row-height">
      <div class="col col-height">
        <div class="inside">
          <div class="content">
            <h4 class="b2">Autumn Bouquet</h4>
            <p class="add2">A gathering of bold fall scents—late blooms, cinnamon - with a dash of earthy patchouli.</p>
          </div>
        </div>
      </div>
      
      <div class="col-2 col-height col-middle">
        <div class="inside">
          <div class="content">
            <button type="button" id="b2" class="btn btn-primary float-right add" 
            <?php 
            if(isset($_SESSION['b2'])) {
            	echo "disabled>Added!";
            }
            else {
            	echo ">Add to Cart";
            }
            	 ?>
            	</button>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<div class="container">
	<div class="row item4sale">
    <div class="row-height">
      <div class="col col-height">
        <div class="inside">
          <div class="content">
            <h4 class="b3">Cinnamon Stick</h4>
            <p class="add3">The fragrant mystery of imported cinnamon bundled with cloves.</p>
          </div>
        </div>
      </div>
      
      <div class="col-2 col-height col-middle">
        <div class="inside">
          <div class="content">
            <button type="button" id="b3" class="btn btn-primary float-right add" 
            <?php 
            if(isset($_SESSION['b3'])) {
            	echo "disabled>Added!";
            }
            else {
            	echo ">Add to Cart";
            }
            	 ?>
            	</button>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<div class="container">
	<div class="row item4sale">
    <div class="row-height">
      <div class="col col-height">
        <div class="inside">
          <div class="content">
            <h4 class="b4">Mountain Pine</h4>
            <p class="add4">A walk in the winter woods...the clean, familiar scent of fresh pine and crystal clear air.</p>
          </div>
        </div>
      </div>
      
      <div class="col-2 col-height col-middle">
        <div class="inside">
          <div class="content">
            <button type="button" id="b4" class="btn btn-primary float-right add" 
            <?php 
            if(isset($_SESSION['b4'])) {
            	echo "disabled>Added!";
            }
            else {
            	echo ">Add to Cart";
            }
            	 ?>
            	</button>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<div class="container">
	<div class="row item4sale">
    <div class="row-height">
      <div class="col col-height">
        <div class="inside">
          <div class="content">
            <h4 class="b5">Sweet Strawberry</h4>
            <p class="add5">The essence of perfectly ripe strawberries sprinkled with sugar</p>
          </div>
        </div>
      </div>
      
      <div class="col-2 col-height col-middle">
        <div class="inside">
          <div class="content">
            <button type="button" id="b5" class="btn btn-primary float-right add" 
            <?php 
            if(isset($_SESSION['b5'])) {
            	echo "disabled>Added!";
            }
            else {
            	echo ">Add to Cart";
            }
            	 ?>
            	</button>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<div class="container">
	<div class="row">
		<div class="col">
			<a role="button" class="btn btn-success btn-block float-center" href="cart.php">View Cart</a>
		</div>
	</div>
</div>



    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.2.1.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js" integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/js/bootstrap.min.js" integrity="sha384-h0AbiXch4ZDo7tp9hKZ4TsHbi047NrKGLO3SEJAg45jXxnGIfYzk4Si90RDIqNm1" crossorigin="anonymous"></script>


    <script type="text/javascript">
	
		$('button.add').click(function(){
			var $name = $(this).attr('id');
			console.log($name);
			request = $.ajax({
				url: "redirect.php",
				type: "POST",
				data: $name + "=" + $("h4."+$name).html()
			});
			$(this).html("Added!");
			$(this).prop('disabled', true);
		});
</script>
  </body>
</html>