<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="initial-scale=1.0, maximum-scale=2.0">
<title>NOTE APP</title>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
	
<!-- jQuery and JS bundle w/ Popper.js -->
<script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
	



<link rel="stylesheet" type="text/css" href="css/style.css">

<link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
		
</head>

	<body>
	
	<nav>
        	<?php
					
					require_once 'config.php';
					
					session_start();

					if(!isset($_SESSION['user_login']))	
					{
						header("location: main.php");
					}
					
					$id = $_SESSION['user_login'];
					
					$select_stmt = $db->prepare("SELECT * FROM user WHERE id=:uid");
					$select_stmt->execute(array(":uid"=>$id));
		
					$row=$select_stmt->fetch(PDO::FETCH_ASSOC);
					?>
			<script>var user = '<?php echo $row['id']?>';</script>
			<script type="text/javascript" src="js/app.js"></script>	


        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <i class="fa fa-bars text-white"></i>
        </button>
        	<font size="4" color="white" face="Verdana,Arial,sans-serif">
        		<i>
        		<?php
					if(isset($_SESSION['user_login']))
					{
					?>
					<?php
					echo $row['name'];
					}
					?>
					</i>
				</font>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ml-auto">

                <li>
                    <a class="fas fa-sign-out-alt" href="logout.php">Logout</a>
                </li>
            
        </div>
    </nav>
	



	
	<div class="container">
		<div class="row">
			<button class="col-1 offset-10 btn btn-primary" data-toggle="modal" data-target="#addNoteModal">
			<i class="fa fa-plus"></i>
			</button>
		</div>

		<div class="notes">
			<ul class="notes_list">
	
			</ul>	
		</div>
	</div>

<!--MODALS-->

	<div class="modal fade" id="addNoteModal" tabindex="-1" role="dialog" aria-labelledby="addNoteModalLabel" aria-hidden="true">
	  <div class="modal-dialog" role="document">
	    <div class="modal-content">
	      <div class="modal-header">
	        <h5 class="modal-title" id="addNoteModalLabel">New Note</h5>
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
	          <span aria-hidden="false">&times;</span>
	        </button>
	      </div>
	      <div class="modal-body">
	        <form>
	          <div class="form-group">
	            <label for="note-name" class="col-form-label">Name:</label>
	            <input type="text" class="form-control" id="note-name">
	          </div>
	          <div class="form-group">
	            <label for="note-description" class="col-form-label">Description:</label>
	            <textarea class="form-control" id="note-description"></textarea>
	          </div>
	        </form>
	      </div>
	      <div class="modal-footer">
	        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
	        <button type="button" class="btn btn-primary" id="add_note">Add Note</button>
	      </div>
	    </div>
	  </div>
	</div>



		<div class="modal fade" id="editNoteModal" tabindex="-1" role="dialog" aria-labelledby="editNoteModalLabel" aria-hidden="true">
		  <div class="modal-dialog" role="document">
	  	    <div class="modal-content">
		      <div class="modal-header">
		        <h5 class="modal-title" id="editNoteModalLabel">Edit Note</h5>
		        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
		          <span aria-hidden="true">&times;</span>
		        </button>
		      </div>
		      <div class="modal-body">
		        <form>
		          <div class="form-group">
		            <label for="editnote-name" class="col-form-label">Name:</label>
		            <input type="text" class="form-control" id="editnote-name">
		          </div>
		          <div class="form-group">
		            <label for="editnote-description" class="col-form-label">Description:</label>
		            <textarea class="form-control" id="editnote-description"></textarea>
		          </div>
		        </form>
		      </div>
		      <div class="modal-footer">
		        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
		        <button type="button" class="btn btn-primary" id="edit_note">Save Changes</button>
		      </div>
		    </div>
		  </div>
		</div>							
	</body>
</html>