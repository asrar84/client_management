<div class="row" style="margin-bottom:20px">
	<div class="span12">
		<a href="<?php echo site_url("states/add")?>" class="btn btn-primary pull-left">Add New</a>
		<a href="<?php echo site_url("countries");?>" class="btn btn-primary pull-right">Manage Countries</a>
		<a href="<?php echo site_url("cities");?>" class="btn btn-primary pull-right">Manage Cities</a>
	</div>
</div>
<div class="row">
	<div class="span12">
		<a href="<?php echo site_url("states/add")?>">Add New</a>
	</div>
</div>
<div class="row">
	<div class="span12">
		<table class="table table-bordered">
			<thead>
				<tr>
					<th>Country Name</th>
					<th>State Name</th>
					<th></th>
				</tr>
			</thead>
			<tbody>
				<?php if($states):?>
					<?php foreach ($states as $state): ?>
						<tr>
							<td><?php echo $state->country_name;?></td>
							<td><?php echo $state->name;?></td>
							<td>
								<a href="<?php echo site_url("states/edit/".$state->id);?>">edit</a>
								<a href="<?php //echo site_url("states/delete/".$state->id);?>">delete</a>
							</td>
						</tr>
					<?php endforeach;?>
				<?php else:?>
					<tr>
						<td colspan="2">No state found</td>
					</tr>
				<?php endif;?>
			</tbody>
		</table>
	</div>
</div>