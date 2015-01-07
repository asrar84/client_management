<div class="row" style="margin-bottom:20px">
	<div class="span12">
		<a href="<?php echo site_url("countries");?>" class="btn btn-primary pull-right">Manage Geo</a>
	</div>
</div>
<div class="row">
	<div class="span9">
		<?php echo form_open('clients','id="form_search" class="pull-left" style="margin: 0;"'); ?>
			<label style="display: inline; font-size: large;">Search:</label>
			<input type="text" name="seach_client_name" placeholder="Client" value="" />
			<input type="submit" value="Seach" />
		<?php form_close();?>
	</div>
	<div class="span3">
		<a href="<?php echo site_url("clients/registration")?>" class="btn btn-primary pull-right">Add New</a>
	</div>
</div>
<div class="row">
	<div class="span12">
		<table class="table table-bordered">
			<thead>
				<tr>
					<th>Company Name</th>
					<th>Client Name</th>
					<th>Mobile Number</th>
					<th>Services Taken</th>
					<th>Selected Products</th>
					<th></th>
				</tr>
			</thead>
			<tbody>
				<?php if($clients):?>
					<?php foreach ($clients as $client): ?>
						<tr>
							<td><?php echo $client->company_name;?></td>
							<td><?php echo $client->client_name;?></td>
							<td><?php echo $client->mobile_number;?></td>
							<td><?php echo $client->services_taken;?></td>
							<td><?php echo $client->selected_products;?></td>
							<td>
								<a href="<?php //echo site_url("clients/edit/".$client->id);?>">edit</a>
								<a href="<?php //echo site_url("countries/delete/".$country->id);?>">delete</a>
							</td>
						</tr>
					<?php endforeach;?>
				<?php else:?>
					<tr>
						<td colspan="2">No Clients found</td>
					</tr>
				<?php endif;?>
			</tbody>
		</table>
	</div>
</div>