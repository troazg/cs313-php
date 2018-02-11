<?php 
session_start();
include('connection.php');

//$query = $db->prepare('SELECT diary_text FROM diaries AS d JOIN users AS u ON u.user_diary = d.diary_id WHERE user_id = :id LIMIT 1');
//$query->bindValue(':id', $_SESSION['id'], PDO::PARAM_INT);
//$query->execute();
//$rows = $query->fetch(PDO::FETCH_ASSOC);
//$diary = $rows['diary_text'];

?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    

    <title>Board Game Collection</title>

    <!--jQuery-->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>

    <!-- Latest compiled and minified CSS -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">

	<!-- Optional theme -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap-theme.min.css" integrity="sha384-fLW2N01lMqjakBkx3l/M9EahuwpSfeNvV63J5ezn3uZzapT0u7EYsXMjQV+0En5r" crossorigin="anonymous">

	<link rel="stylesheet" type="text/css" href="styles.css">

	<!-- Latest compiled and minified JavaScript -->
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>

	<script> 
    var page = "pageNotepad";
    </script> 

    <style type="text/css">
    	
    </style>
	
    
	

  </head>
<body>
<div class="container text-center" id="main"> 

	<div class="row">

		<div class="col-md-12 text-right">
		
			<a href="bgsignin.php?logout=1" id="logOut" class="btn btn-info">Log Out</a>
		</div>
	</div>


	<div class="row">
		<div class="col-md-4">
			<strong>Name:</strong>
		</div>
		<div class="col-md-2">
			<strong>Min Players</strong>
		</div>
		<div class="col-md-2">
			<strong>Max Players</strong>
		</div>
		<div class="col-md-4">
			<strong>Publisher</strong>
		</div>
	</div>

	<?php   

	$stmt = ($db->prepare('SELECT g.game_name, g.game_min_players, g.game_max_players, p.publisher_name FROM game AS g JOIN publisher AS p ON g.game_publisher = p.publisher_id WHERE g.game_owner = :user_id'));
	$stmt->bindValue(':user_id', $_SESSION['id'], PDO::PARAM_INT);
	$stmt->execute();

	$rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

	foreach ($rows as $row) {
		echo

		'
		<div class="row">
			<div class="col-md-4">
				<p>' . $row['game_name'] . '</p>
			</div>
			<div class="col-md-2">
				<p>' . $row['game_min_players'] . '</p>
			</div>
			<div class="col-md-2">
				<p>' . $row['game_max_players'] . '</p>
			</div>
			<div class="col-md-4">
				<p>' . $row['publisher_name'] . '</p>
			</div>
		</div>
	';

	}	


	?>


</div>


<!-- <script type="text/javascript">
	$("textarea").css("height", $(window).height() - 110);
	$("textarea").keyup( function() {
		$.post("updatediary.php", { diary:$("#diaryText").val() } );
	});
</script> -->
    
    
</body>
</html>
