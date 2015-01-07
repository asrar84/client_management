<?php if(validation_errors()): ?>
	<div class="alert alert-error"><?php echo validation_errors(); ?></div>
<?php endif; ?>
<?php echo form_open('states/edit/'.$state->id,'class="form-horizontal"'); ?>
	
	<?php echo form_dropdown('country_id', $countries_dd, set_value('country_id',$state->country_id),'Country','id="country_id"');?>
	
	<div class="control-group">
		<label class="control-label" for="name">Name</label>
		<div class="controls">
			<input type="text" id="name" name="name" placeholder="State Name" value="<?php echo set_value('name',$state->name);?>">
		</div>
	</div>

	<div class="control-group">
		<div class="controls">
			<button type="submit" class="btn">Edit</button>
		</div>
	</div>
<?php form_close();?>
