<div class="row" style="margin-bottom:20px">
	<div class="span12">
		<a href="<?php echo site_url("countries/add")?>" class="btn btn-primary pull-left">Add New</a>
		<a href="<?php echo site_url("states");?>" class="btn btn-primary pull-right">Manage States</a>
		<a href="<?php echo site_url("cities");?>" class="btn btn-primary pull-right">Manage Cities</a>
	</div>
</div>
<div class="row">
	<div class="span12">
		<table class="table table-bordered">
			<thead>
				<tr>
					<th>Name</th>
					<th></th>
				</tr>
			</thead>
			<tbody>
				<?php if($countries):?>
					<?php foreach ($countries as $country): ?>
						<tr>
							<td><?php echo $country->name;?></td>
							<td>
								<a href="<?php echo site_url("countries/edit/".$country->id);?>">edit</a>
								<a href="<?php //echo site_url("countries/delete/".$country->id);?>">delete</a>
							</td>
						</tr>
					<?php endforeach;?>
				<?php else:?>
					<tr>
						<td colspan="2">No country found</td>
					</tr>
				<?php endif;?>
			</tbody>
		</table>
	</div>
</div>