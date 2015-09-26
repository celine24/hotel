<?php 
require_once('../header.php');
require_once('../../process/process_list.php');
?>

<div class="row">
	<div class="col-md-12">

		<?php if (isset ($success_msg)): ?> 
		<p class="msg bg-success text-success">
			<?php echo $success_msg;?>
		</p>
		<?php elseif (isset ($error_msg)):?>
		<p class="msg bg-danger text-danger">
			<?php echo $error_msg;?>
		</p>
		<?php endif;?>
		<?php if (isset($errors)) :?>
		<ul class="msg bg-danger text-danger">
			<?php foreach ($errors as $error) :?>
			<li><?php echo $error; ?></li>
			<?php endforeach; ?>
		</ul>
		<?php endif;?>
	</div>
</div>

<?php foreach($hotels_list as $hotel):?>
<div class="row" id="<?php echo $hotel['id']; ?>">
	<div class="panel panel-default">
		<div class="panel-heading">
		 	<h2><?php echo $hotel['name']; ?>
		 		<span class="pull-right label label-default"><?php echo $hotel['city_name']; ?></span>
		 	</h2>
		</div>
	    <div class="panel-body">
	    	<img src="<?php echo $hotel['picture']; ?>" alt="" class="col-xs-12 col-sm-3 pull-left thumbnail" />
		    <blockquote class="col-xs-12 col-sm-9 pull-right">“ <?php echo $hotel['description']; ?> ”</blockquote>
			<address class="text-center col-xs-12 col-md-2">
				<strong><?php echo 'Hotel ' . $hotel['name']; ?></strong><br>
				<?php echo $hotel['adress']; ?><br>
				<?php echo $hotel['postcode'] . ' ' . $hotel['city_name']; ?><br>
			</address>
			<div class="col-xs-12 col-md-7 pull-right">
			<?php if($user_session->isConnected()) : ?>
		    	<?php require('booking_form.php');?>
		    <?php else :?>
		    	<p class="msg bg-info">
					<?php echo 'Envie de réserver ? <a href="registration.php">Créez un compte</a> ou <a href="connection.php">authentifiez-vous</a> !'; ?>
				</p>
		    <?php endif; ?>
		</div>
		</div>
	
	</div>
</div>
<?php endforeach;

require_once('../footer.php');?>
