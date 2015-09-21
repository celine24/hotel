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
			<div class="panel-heading"><h2>S'enregistrer</h2></div>
				<div class="panel-body">

					<?php if (isset($error_msg)) :?>
						<p class="msg bg-danger text-danger">
							<?php echo $error_msg; ?>
							<?php if (isset($errors)) :?>
							<ul class="text-danger">
							<?php foreach ($errors as $error) :?>
								<li><?php echo $error; ?></li>
							<?php endforeach;?>
							</ul>
							<?php endif ?>
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
		<?php endif;?>
	</div>
</div>

<?php require_once('../footer.php');?>
