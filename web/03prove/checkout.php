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
  		<h1>Please enter your shipping information</h1>
  	</div>
    
		<div class="container">
			<form action="confirm.php" method="post">
			  <div class="form-row">
			    <div class="form-group col-md-12">
			      <label for="name">Name</label>
			    	<input type="text" class="form-control" name="name" placeholder="Full name">
			    	<small id="nameHelp" class="form-text text-muted">Please include your first and last name</small>
			    </div>
			  </div>
			  <div class="form-group">
			    <label for="address" class="col-form-label">Address</label>
			    <input type="text" class="form-control" name="address" placeholder="1234 Main St">
			  </div>
			  <div class="form-group">
			    <label for="address2" class="col-form-label">Address 2</label>
			    <input type="text" class="form-control" name="address2" placeholder="Apartment, suite, etc">
			  </div>
			  <div class="form-row">
			    <div class="form-group col-md-6">
			      <label for="city" class="col-form-label">City</label>
			      <input type="text" class="form-control" name="city">
			    </div>
			    <div class="form-group col-md-4">
			      <label for="state" class="col-form-label">State</label>
			      <select name="state" class="form-control">
			      	<option value="AL">Alabama</option>
		      		<option value="AK">Alaska</option>
		      		<option value="AZ">Arizona</option>
		      		<option value="AR">Arkansas</option>
		      		<option value="CA">California</option>
		      		<option value="CO">Colorado</option>
		      		<option value="CT">Connecticut</option>
		      		<option value="DE">Delaware</option>
		      		<option value="DC">District Of Columbia</option>
		      		<option value="FL">Florida</option>
		      		<option value="GA">Georgia</option>
		      		<option value="HI">Hawaii</option>
		      		<option value="ID">Idaho</option>
		      		<option value="IL">Illinois</option>
		      		<option value="IN">Indiana</option>
		      		<option value="IA">Iowa</option>
		      		<option value="KS">Kansas</option>
		      		<option value="KY">Kentucky</option>
		      		<option value="LA">Louisiana</option>
		      		<option value="ME">Maine</option>
		      		<option value="MD">Maryland</option>
		      		<option value="MA">Massachusetts</option>
		      		<option value="MI">Michigan</option>
		      		<option value="MN">Minnesota</option>
		      		<option value="MS">Mississippi</option>
		      		<option value="MO">Missouri</option>
		      		<option value="MT">Montana</option>
		      		<option value="NE">Nebraska</option>
		      		<option value="NV">Nevada</option>
		      		<option value="NH">New Hampshire</option>
		      		<option value="NJ">New Jersey</option>
		      		<option value="NM">New Mexico</option>
		      		<option value="NY">New York</option>
		      		<option value="NC">North Carolina</option>
		      		<option value="ND">North Dakota</option>
		      		<option value="OH">Ohio</option>
		      		<option value="OK">Oklahoma</option>
		      		<option value="OR">Oregon</option>
		      		<option value="PA">Pennsylvania</option>
		      		<option value="RI">Rhode Island</option>
		      		<option value="SC">South Carolina</option>
		      		<option value="SD">South Dakota</option>
		      		<option value="TN">Tennessee</option>
		      		<option value="TX">Texas</option>
		      		<option value="UT">Utah</option>
		      		<option value="VT">Vermont</option>
		      		<option value="VA">Virginia</option>
		      		<option value="WA">Washington</option>
		      		<option value="WV">West Virginia</option>
		      		<option value="WI">Wisconsin</option>
		      		<option value="WY">Wyoming</option>
			      </select>
			    </div>
			    <div class="form-group col-md-2">
			      <label for="zip" class="col-form-label">Zip</label>
			      <input type="text" class="form-control" name="zip">
			    </div>
			  </div>
			  
			  <button type="submit" class="btn btn-primary">Confirm</button>
			</form>
			<
		</div>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.2.1.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js" integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/js/bootstrap.min.js" integrity="sha384-h0AbiXch4ZDo7tp9hKZ4TsHbi047NrKGLO3SEJAg45jXxnGIfYzk4Si90RDIqNm1" crossorigin="anonymous"></script>
  </body>
</html>