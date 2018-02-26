<?php 
session_start();
include_once('connection.php');

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

	<link rel="stylesheet" type="text/css" href="styles.css">

	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

	<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
	
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
	
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

	<script type="text/javascript" src="addGame.js"></script>

		

  </head>
<body>
<?php include('checkIfLoggedIn.php'); ?>
<div class="container-fluid text-center" id="main"> 

	<div class="row">

		<div class="col-md-12 text-right">
		
			<a href="bgsignin.php?logout=1" id="logOut" class="btn btn-info">Log Out</a>
		</div>
	</div>

	<?php 
	if ($_SESSION['error']) {
		echo '
		<div class="row">
			<div class="col-md-12 text-center">			
				<div class="alert alert-danger">' . $_SESSION['error'] .'</div>
			</div>
		</div>
		';
		unset($_SESSION['error']);
	}
	?>


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
		<div class="col-md-2">
			<strong>Publisher</strong>
		</div>
		<div class="col-md-1">
			
		</div>
		<div class="col-md-1">
			
		</div>
		<div class="col-md-1">
			
		</div>
	</div>

	<?php   

	$stmt = ($db->prepare('SELECT g.game_id, g.game_name, g.game_min_players, g.game_max_players, p.publisher_name, p.publisher_website FROM ownership AS o JOIN game AS g ON g.game_id = o.ownership_game_id JOIN publisher AS p ON g.game_publisher = p.publisher_id WHERE o.ownership_user_id = :user_id'));
	$stmt->bindValue(':user_id', $_SESSION['id'], PDO::PARAM_INT);
	$stmt->execute();

	$rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

	foreach ($rows as $row) {


		// I know that doing these nested queries is really inefficient and I will be revisiting this to come up with a better option. 
		$playsStmt = ($db->prepare('SELECT play_id, play_players, play_winner, play_score FROM play WHERE play_owner = :user_id AND play_game = :game'));
		$playsStmt->bindValue(':user_id', $_SESSION['id'], PDO::PARAM_INT);
		$playsStmt->bindValue(':game', $row['game_id'], PDO::PARAM_INT);
		$playsStmt->execute();
		$playRows = $playsStmt->fetchAll(PDO::FETCH_ASSOC);


		$notesStmt = ($db->prepare('SELECT note_id, note_text FROM note WHERE note_owner = :user_id AND note_game = :game'));
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
			<div class="col-md-2">
				<p><a href="http://' . $row['publisher_website'] . '" target="_blank">' . $row['publisher_name'] . '</a></p>
			</div>
			<div class="col-md-1">
				<p><a href="#playLog-' . $row['game_id'] . '" data-toggle="modal" data-target="#playLog-' . $row['game_id'] . '">Play Log</a><p>
			</div>
			<div class="col-md-1">
				<p><a href="#notes-' . $row['game_id'] . '" data-toggle="modal" data-target="#notes-' . $row['game_id'] . '">Notes</a><p>
			</div>
			<div class="col-md-1">
				<p><a href="#delete-' . $row['game_id'] . '" data-toggle="modal" data-target="#delete-' . $row['game_id'] .'">Delete</a><p>
			</div>
		</div>


		<div class="modal fade" id="playLog-' . $row['game_id'] . '" tabindex="-1" role="dialog">
		  <div class="modal-dialog modal-lg" role="document">
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
		       			<td>
		       				<form method="post" action="deletePlay.php">
		       					<input class="hidden" name="deletePlayID" id="deletePlayID" value="' . $playRow['play_id'] . '">
		       					<button type="submit" class="close" aria-label="Close"><span aria-hidden="true">&times;</span></button>
		       				</form>
		       			</td>
		       		</tr>
		       	';
		       	$count++;
		       } 

		      echo '
		      	<form method="post" action="dbwrite.php">
		      	<tr class="addPlayForm">
		      		<td><input name="formID" value="addPlay" class="hidden"</td><input class="hidden" name="addPlayGameID" id="addPlayGameID" value="' . $row['game_id'] .'">
		      		<td><input name="addPlayPlayers" id="addPlayPlayers" type="text" placeholder="Names of players"></td>
		      		<td><input name="addPlayWinner" id="addPlayWinner" type="text" placeholder="Name of winner"></td>
		      		<td><input name="addPlayScore" id="addPlayScore" type="number" placeholder="Winning score"></td>
		      	</tr>
		      	<tr class="addPlayForm" ><td><button type="submit" class="btn btn-success">Add Play</button></td></tr></form>
		      </tbody>
		      </table>
		      </div>
		      <div class="modal-footer">
		      	<button type="button" class="btn btn-success" id="addNewPlayButton" onclick="openAddPlayForm()">Add New Play</button>
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
		        			<td>
		       					<form method="post" action="deleteNote.php">
		       						<input class="hidden" name="deleteNoteID" id="deleteNoteID" value="' . $noteRow['note_id'] . '">
		       						<button type="submit" class="close" aria-label="Close"><span aria-hidden="true">&times;</span></button>
		       					</form>
		       				</td>
		        		</tr>
		        	';
		        }

		      echo '
		      <form method="post" action="dbwrite.php">
		      	<tr class="addNoteForm">
		      		<input name="formID" value="addNote" class="hidden"><input class="hidden" name="addNoteGameID" id="addNoteGameID" value="' . $row['game_id'] .'">
		      		<td><input name="addNoteText" id="addNoteText" type="text" placeholder="Enter note text here"></td>
		      	</tr>
		      	<tr class="addNoteForm" ><td><button type="submit" class="btn btn-success">Add Note</button></td></tr></form>
		      </tbody>
		      </table>
		      </div>
		      <div class="modal-footer">
		      	<button type="button" class="btn btn-success" id="addNewNoteButton" onclick="openAddNoteForm()">Add New Note</button>
		        <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
		      </div>
		    </div>
		  </div>
		</div>

		<div class="modal fade" id="delete-' . $row['game_id'] . '" tabindex="-1" role="dialog">
	  <div class="modal-dialog" role="document">
	    <div class="modal-content">
	      <div class="modal-header">
	        <h5 class="modal-title" id="deleteGameModalLabel">Delete Game</h5>
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
	          <span aria-hidden="true">&times;</span>
	        </button>
	      </div>
	      <div class="modal-body">
	      	<p>Are you sure you want to remove "' . $row['game_name'] . '"" from your collection?</p>
	        
	      </div>
	      <div class="modal-footer">
	        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
	        <form method="post" action="deleteGame.php"><input  class="hidden" name="deleteGameID" id="deleteGameID" value="' . $row['game_id'] . '"</input><input class="hidden" name="deleteGameUserID" id="deleteGameUserID" value="' . $_SESSION['id'] .'">
	        <button type="submit" class="btn btn-primary" id="deleteGameSubmit">Remove Game</button>
	        </form>
	      </div>
	    </div>
	  </div>
	</div>
	';

	}	


	?>

	<div class="row addItem">
		<div class="col-md-12 text-center">
		
			<button type="button" data-toggle="modal" data-target="#addGameModal" id="addNew" class="btn btn-success">Add New Game</button>
		</div>
	</div>

	<div class="modal fade" id="addGameModal" tabindex="-1" role="dialog">
	  <div class="modal-dialog" role="document">
	    <div class="modal-content">
	      <div class="modal-header">
	        <h5 class="modal-title" id="addGameModalLabel">Add Game</h5>
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
	          <span aria-hidden="true">&times;</span>
	        </button>
	      </div>
	      <div class="modal-body">
	        <form id="newGameForm" method="post" action="dbwrite.php">
	        	<input type="text" name="formID" id="formID" value="newGameForm" style="display:none">
	        	<div class="form-group">
	        		<label for="game">Game Name</label>
	        		<select class="form-control" name="addGameSelector" id="addGameSelector" onchange="gameSelect()">
	        			
	        			<?php 
	        				$stmt = ($db->prepare('SELECT game_id, game_name FROM game ORDER BY game_name'));
	        				$stmt->execute();
	        				$rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

	        				foreach ($rows as $row) {
	        					echo '
	        					<option value="' . $row['game_id'] . '">' . $row['game_name'] . '</option>
	        					';
	        				}
	        			 ?>
	        			 <option value="new">Add New Game</option>
	        			 
	        		</select>       		
	        	</div>

	        	<div class="form-group newGameFormElements">
	        		<label for="newGameName">Game Name</label>
	        		<input type="text" name="newGameName" id="newGameName" class="form-control" />
	        		<small id="gameNameHelp" class="form-text text-muted">Please enter a name</small>
	        	</div>

	        	<div class="form-group newGameFormElements">
	        		<label for="addPublisherSelector">Publisher</label>
	        		<select class="form-control" id="addPublisherSelector" name="addPublisherSelector" onchange="publisherSelect()">
	        			<?php 
	        				$stmt = ($db->prepare('SELECT publisher_id, publisher_name FROM publisher ORDER BY publisher_name'));
	        				$stmt->execute();
	        				$rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

	        				foreach ($rows as $row) {
	        					echo '
	        					<option value="' . $row['publisher_id'] . '">' . $row['publisher_name'] . '</option>
	        					';
	        				}
	        			?>
	        			<option value="new">Add New Publisher</option>
	        		</select>
	        	</div>

	        	<div class="form-group newPublisherFormElements">
	        		<label for="newPublisherName">Publisher Name</label>
	        		<input type="text" name="newPublisherName" id="newPublisherName" class="form-control">
	        		<small id="publisherNameHelp" class="form-text text-muted">Please enter a name</small>
	        	</div>

	        	<div class="form-group newPublisherFormElements">
	        		<label for="newPublisherWebsite">Publisher Website</label>
	        		<input type="text" name="newPublisherWebsite" id="newPublisherWebsite" class="form-control">
	        	</div>

	        	<div class="form-group newGameFormElements">
	        		<label for="newGameMinPlayers">Minimum Number of Players</label>
	        		<input type="number" name="newGameMinPlayers" id="newGameMinPlayers" class="form-control" />
	        		<small id="minPlayersHelp" class="form-text text-muted">Please enter a number</small>
	        	</div>

	        	<div class="form-group newGameFormElements">
	        		<label for="newGameMaxPlayers">Maximum Number of Players</label>
	        		<input type="number" name="newGameMaxPlayers" id="newGameMaxPlayers" class="form-control" />
	        		<small id="maxPlayersHelp" class="form-text text-muted">Please enter a number</small>
	        	</div>

	        	<input type="submit" name="newGamePost" value="newGame" style="display:none">
	        	
	        </form>
	      </div>
	      <div class="modal-footer">
	        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
	        <button type="button" class="btn btn-primary" id="newGameSubmit">Add Game</button>
	      </div>
	    </div>
	  </div>
	</div>



	


</div>


<!-- <script type="text/javascript">
	$("textarea").css("height", $(window).height() - 110);
	$("textarea").keyup( function() {
		$.post("updatediary.php", { diary:$("#diaryText").val() } );
	});
</script> -->
    
    
</body>
</html>
