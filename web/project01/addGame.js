$(document).ready(function() {
	$('#newGameSubmit').click(function() {
		var areErrors = false;
		var isNewGame = ($('#addGameSelector').val() == "new");

		if (isNewGame && $('#newGameName').val() == '') {
			$('#gameNameHelp').addClass("alert alert-danger");
			areErrors = true;
		} 

		if ($('#addPublisherSelector').val() == "new" && $('#newPublisherName').val() == '') {
			$('#publisherNameHelp').addClass("alert alert-danger");
			areErrors = true;
		} 

		if ($('#newGameMaxPlayers').val() < 1 && isNewGame) {
			$('#maxPlayersHelp').addClass("alert alert-danger");
			areErrors = true;
		} 

		if ($('#newGameMinPlayers').val() < 1 && isNewGame) {
			$('#minPlayersHelp').addClass("alert alert-danger");
			areErrors = true;
		} 

		if (!areErrors) {
			$('#newGameForm').submit();
			console.log("Submitted");
		}

	});
});

function gameSelect() {
	if ($('#addGameSelector').val() == "new") {
		$('.newGameFormElements').show();

	} else {
		$('.newGameFormElements').hide();
	}
}

function publisherSelect() {
	if ($('#addPublisherSelector').val() == "new") {
		$('.newPublisherFormElements').show();

	} else {
		$('.newPublisherFormElements').hide();
	}
}

function openAddPlayForm() {
	$('.addPlayForm').show();
	$('#addNewPlayButton').hide();
}

function openAddNoteForm() {
	$('.addNoteForm').show();
	$('#addNewNoteButton').hide();
}