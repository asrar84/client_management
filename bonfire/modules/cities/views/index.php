<div class="row" style="margin-bottom:20px">
	<div class="span12">
		<a href="<?php echo site_url("cities/add")?>" class="btn btn-primary pull-left">Add New</a>
		<a href="<?php echo site_url("countries");?>" class="btn btn-primary pull-right">Manage Countries</a>
		<a href="<?php echo site_url("states");?>" class="btn btn-primary pull-right">Manage States</a>
	</div>
</div>
<div class="row">
	<div class="span12">
		<table class="table table-bordered">
			<thead>
				<tr>
					<th>Country Name</th>
					<th>State Name</th>
					<th>City Name</th>
					<th></th>
				</tr>
			</thead>
			<tbody>
				<?php if($cities):?>
					<?php foreach ($cities as $city): ?>
						<tr>
							<td><?php echo $city->country_name;?></td>
							<td><?php echo $city->state_name;?></td>
							<td><?php echo $city->name;?></td>
							<td>
								<a href="<?php echo site_url("cities/edit/".$city->id);?>">edit</a>
								<a href="<?php //echo site_url("cities/delete/".$city->id);?>">delete</a>
							</td>
						</tr>
					<?php endforeach;?>
				<?php else:?>
					<tr>
						<td colspan="4">No state found</td>
					</tr>
				<?php endif;?>
			</tbody>
		</table>
	</div>
</div>