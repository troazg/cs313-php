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

		

  </head>
<body>
<?php include('checkIfLoggedIn.php'); ?>
<div class="container-fluid text-center" id="main"> 

	<div class="row">

		<div class="col-md-12 text-right">
		
			<a href="bgsignin.php?logout=1" id="logOut" class="btn btn-info">Log Out</a>
		</div>
	</div>


	<div class="row headerRow">
		<div class="col-md-3">
			<strong>Name:</strong>
		</div>
		<div class="col-md-1">
			<strong>Min Players</strong>
		</div>
		<div class="col-md-1">
			<strong>Max Players</strong>
		</div>
		<div class="col-md-3">
			<strong>Publisher</strong>
		</div>
		<div class="col-md-1">
			
		</div>
		<div class="col-md-1">
			
		</div>
	</div>

	<?php   

	$stmt = ($db->prepare('SELECT g.game_id, g.game_name, g.game_min_players, g.game_max_players, p.publisher_name, p.publisher_website FROM game AS g JOIN publisher AS p ON g.game_publisher = p.publisher_id WHERE g.game_owner = :user_id'));
	$stmt->bindValue(':user_id', $_SESSION['id'], PDO::PARAM_INT);
	$stmt->execute();

	$rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

	foreach ($rows as $row) {


		// I know that doing these nested queries is really inefficient and I will be revisiting this to come up with a better option. 
		$playsStmt = ($db->prepare('SELECT play_players, play_winner, play_score FROM play WHERE play_owner = :user_id AND play_game = :game'));
		$playsStmt->bindValue(':user_id', $_SESSION['id'], PDO::PARAM_INT);
		$playsStmt->bindValue(':game', $row['game_id'], PDO::PARAM_INT);
		$playsStmt->execute();
		$playRows = $playsStmt->fetchAll(PDO::FETCH_ASSOC);


		$notesStmt = ($db->prepare('SELECT note_text FROM note WHERE note_owner = :user_id AND note_game = :game'));
		$notesStmt->bindValue(':user_id', $_SESSION['id'], PDO::PARAM_INT);
		$notesStmt->bindValue(':game', $row['game_id'], PDO::PARAM_INT);
		$notesStmt->execute();
		$noteRows = $notesStmt->fetchAll(PDO::FETCH_ASSOC);

		echo

		'
		<div class="row">
			<div class="col-md-3">
				<p>' . $row['game_name'] . '</p>
			</div>
			<div class="col-md-1">
				<p>' . $row['game_min_players'] . '</p>
			</div>
			<div class="col-md-1">
				<p>' . $row['game_max_players'] . '</p>
			</div>
			<div class="col-md-3">
				<p><a href="http://' . $row['publisher_website'] . '" target="_blank">' . $row['publisher_name'] . '</a></p>
			</div>
			<div class="col-md-1">
				<p><a href="#playLog-' . $row['game_id'] . '" data-toggle="modal" data-target="#playLog-' . $row['game_id'] . '">Play Log</a><p>
			</div>
			<div class="col-md-1">
				<p><a href="#notes-' . $row['game_id'] . '" data-toggle="modal" data-target="#notes-' . $row['game_id'] . '">Notes</a><p>
			</div>
		</div>


		<div class="modal fade" id="playLog-' . $row['game_id'] . '" tabindex="-1" role="dialog">
		  <div class="modal-dialog" role="document">
		    <div class="modal-content">
		      <div class="modal-header">
		        <h5 class="modal-title">Play Log for ' . $row['game_name'] . '</h5>
		        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
		          <span aria-hidden="true">&times;</span>
		        </button>
		      </div>
		      <div class="modal-body">
		      	<table class="table">
		       		<thead>
		       			<tr>
		       				<th scope="col">#</th>
		       				<th scope="col">Players</th>
		       				<th scope="col">Winner</th>
		       				<th scope="col">Score</th>
		       			</tr>
		       		</thead>
		       		<tbody>';
		       $count = 1;
		       foreach ($playRows as $playRow) {
		       	
		       	echo '
		       		<tr>
		       			<th scope="row">' . $count . '</th>
		       			<td> ' . $playRow['play_players'] . '</td>
		       			<td> ' . $playRow['play_winner'] . '</td>
		       			<td> ' . $playRow['play_score'] . '</td>
		       		<tr>
		       	';
		       	$count++;
		       } 

		      echo '
		      </tbody>
		      </table>
		      </div>
		      <div class="modal-footer">
		        <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
		      </div>
		    </div>
		  </div>
		</div>


		<div class="modal fade" id="notes-' . $row['game_id'] . '" tabindex="-1" role="dialog">
		  <div class="modal-dialog" role="document">
		    <div class="modal-content">
		      <div class="modal-header">
		        <h5 class="modal-title">Notes for ' . $row['game_name'] . '</h5>
		        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
		          <span aria-hidden="true">&times;</span>
		        </button>
		      </div>
		      <div class="modal-body">
		      	<table class="table">
		       		<thead>
		       			<tr>
		       				<th scope="col">Note</th>
		       			</tr>
		       		</thead>
		       		<tbody>';
		        foreach ($noteRows as $noteRow) {
		        	echo '
		        		<tr>
		        			<td>' . $noteRow['note_text'] . '</td>
		        		</tr>
		        	';
		        }

		      echo '
		      </tbody>
		      </table>
		      </div>
		      <div class="modal-footer">
		        <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
		      </div>
		    </div>
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
