<form class="col-xs-12 col-md-7 pull-right" action="list.php" method="post">
	<input type="hidden" class="form-control" name="hotel_id" value="<?php echo $hotel['id']; ?>">
	<div class="form-group">
		<label for="client_id">Client Id</label>
		<input type="text" class="form-control" name="client_id" placeholder="Client">
	</div>
	<div class="form-group col-sm-6 pull-left">
		<label for="type">Date d'arrivée</label>
		<select class="form-control" name="booking_date_start">
		<?php foreach ($french_dates as $date):?>
			<option name="booking_date_start" value="<?php echo $date;?>"><?php echo $date;?></option>
		<?php endforeach;?>
		</select>
	</div>
	<div class="form-group col-sm-6 pull-right">
		<label for="type">Date de départ</label>
		<select class="form-control" name="booking_date_end">
		<?php foreach ($french_dates as $date):?>
			<option name="booking_date_end" value="<?php echo $date;?>"><?php echo $date;?></option>
		<?php endforeach;?>
		</select>
	</div>
	<div class="clearfix"></div>
	<input type="submit" class="btn btn-default pull-right" name="reserve" value="Réserver"/>
</form>