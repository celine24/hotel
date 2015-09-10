<?php 
require_once('../header.php');
require_once('../../process/process_registration_connection.php');
?>

<div class="row">
	<div class="col-md-offset-2 col-md-8">

		<?php if (isset ($success_msg)): ?> 
			<p class="msg bg-success text-success">
				<?php echo $success_msg;?>
			</p>
		<?php else :?>
		<div class="panel panel-default">
			<div class="panel-heading"><h2>Se connecter</h2></div>
				<div class="panel-body">

					<?php if (isset($error_msg)) :?>
						<p class="msg bg-danger text-danger">
							<?php echo $error_msg; ?>
						</p>
					<?php endif ?>

					<?php //if(isset($_SESSION['user'])){

					//var_dump($_SESSION['user']);} ?>
				 
					<form action="" method="post">
						<div class="form-group">
							<label for="email">Email</label>
							<input type="text" class="form-control" name="email" placeholder="Email" />
						</div>	
						<div class="form-group">				 
							<label>Mot de passe</label>
							<input type="password" class="form-control" name="password" />
					 	</div>
					 	<div class="form-group">				 
							<input type="submit" class="btn btn-default pull-right" name="connection" value="Se connecter" />
					 	</div>
						
					</form>
				</div>
			</div>
		</div>
		<?php endif;?>
	</div>
</div>

<?php require_once('../footer.php');?>