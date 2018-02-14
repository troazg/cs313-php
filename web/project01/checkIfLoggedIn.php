<div class="modal fade" id="notLoggedInModal" tabindex="-1" role="dialog">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="notLoggedInModalTitle">Oops!</h5>
      </div>
      <div class="modal-body">
        It looks like you aren't logged in. Please return to the login page to first log in. 
      </div>
      <div class="modal-footer">
        <a class="btn btn-primary" href="bgsignin.php">Return to Login</a>
      </div>
    </div>
  </div>
</div>


<?php   

if(!isset($_SESSION['id'])) {
	echo '<script type="text/javascript">
		$(document).ready(function() {
			$("#notLoggedInModal").modal({backdrop: "static", keyboard: false});
			$("#notLoggedInModal").modal("show");
		});
	</script>';
}
?>
