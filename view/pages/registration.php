<?php 
require_once('../header.php');
require_once('../../process/process_registration_connection.php');
?>

<div class="row">
	<div class="col-md-offset-2 col-md-8">
		<div class="panel panel-default">
			<div class="panel-heading"><h2>S'enregistrer</h2></div>
				<div class="panel-body">

					<?php if (isset($error_msg)) :?>
						<p class="msg bg-danger text-danger">
							<?php echo $error_msg; ?>
						</p>
					<?php endif ?>
				 
					<form action="" method="post">
						<div class="form-group">
							<label for="lastname">Nom</label>
							<input type="text" class="form-control" name="lastname" placeholder="Nom" />
						</div>
						<div class="form-group">
							<label for="firstname">Prénom</label>
							<input type="text" class="form-control" name="firstname" placeholder="Prénom" />
						</div>
						<div class="form-group">
							<label for="email">Email</label>
							<input type="email" class="form-control" name="email" placeholder="Email" />
						</div>
						<div class="form-group">				 
							<label>Mot de passe</label>
							<input type="password" class="form-control" name="password" />
					 	</div>
					 	<div class="form-group">				 
							<input type="submit" class="btn btn-default pull-right" name="register" value="S'enregistrer" />
					 	</div>
						
					</form>
				</div>
			</div>
		</div>
	</div>
</div>

<?php require_once('../footer.php');?>
