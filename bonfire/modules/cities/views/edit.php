<?php if(validation_errors()): ?>
	<div class="alert alert-error"><?php echo validation_errors(); ?></div>
<?php endif; ?>
<?php echo form_open('cities/edit/'.$city->id,'class="form-horizontal"'); ?>
	
	<?php echo form_dropdown('state_id', $states_dd, set_value('state_id',$city->state_id),'State','id="state_id"');?>
	
	<div class="control-group">
		<label class="control-label" for="name">Name</label>
		<div class="controls">
			<input type="text" id="name" name="name" placeholder="City Name" value="<?php echo set_value('name',$city->name);?>">
		</div>
	</div>

	<div class="control-group">
		<div class="controls">
			<button type="submit" class="btn">Edit</button>
		</div>
	</div>
<?php form_close();?>
