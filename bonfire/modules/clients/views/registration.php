<style>
.progress{
	max-width: 400px;
}
#city_dd_wraper .control-group{
	margin-bottom: 0;
}
</style>
<?php if(validation_errors()): ?>
	<?php echo validation_errors('<div class="alert alert-error">','</div>'); ?>
<?php endif; ?>

<?php echo form_open('clients/registration','id="form_client_registration" class="form-horizontal"'); ?>

	<div class="control-group">
		<label class="control-label" for="date_added">Date Added</label>
		<div class="controls">
			<input type="text" id="date_added" name="date_added" class="validate_required" placeholder="Select Date" value="<?php echo set_value('date_added');?>">
		</div>
	</div>

	<div class="control-group">
		<label class="control-label" for="company_name">Company Name</label>
		<div class="controls">
			<input type="text" class="validate_trim validate_maxlength validate_required" data-display_name="Company name" data-maxlength=170 id="company_name" name="company_name" placeholder="Enter Company Name" value="<?php echo set_value('company_name');?>">
		</div>
	</div>

	<div class="control-group">
		<label class="control-label" for="client_name">Client Name</label>
		<div class="controls">
			<input type="text" class="validate_trim validate_required" data-display_name="Client name" id="client_name" name="client_name" placeholder="Enter Client Name" value="<?php echo set_value('client_name');?>">
		</div>
	</div>
	
	<div class="control-group">
		<label class="control-label" for="email">Email</label>
		<div class="controls">
			<input type="email" class="validate_trim validate_required" data-display_name="Email" id="email" name="email" placeholder="Enter Email" value="<?php echo set_value('email');?>">
		</div>
	</div>
	
	<div class="control-group">
		<label class="control-label" for="password">Password</label>
		<div class="controls">
			<input type="password" name="password" id="password" class="validate_required" value="" placeholder="password" />
		</div>
	</div>

	<div class="control-group">
		<label class="control-label" for="pass_confirm">Confirm Password</label>
		<div class="controls">
			<input type="password" name="pass_confirm" id="pass_confirm" class="validate_required" value="" placeholder="Confirm Password" />
		</div>
	</div>
	
	<?php echo form_dropdown('country_id', $country_dd, set_value('country_id'),'Country','id="country_id" class="validate_required"');?>
	<?php echo form_dropdown('state_id', $state_dd, set_value('state_id'),'State','id="state_id" class="validate_required"');?>
	<div class="control-group" id="city_dd_wraper">
	<?php echo form_dropdown('city_id', $city_dd, set_value('city_id'),'City','id="city_id" class="validate_required"');?>
		<div class="controls">
			<input type="button" id="add_cities" value="Add City" />
		</div>
	</div>
	
	<div class="control-group">
		<label class="control-label" for="zip_code">Zip Code</label>
		<div class="controls">
			<input type="text" id="zip_code" name="zip_code" class="validate_numeric validate_required" placeholder="Zip Code" value="<?php echo set_value('zip_code');?>">
		</div>
	</div>
	
	<div class="control-group">
		<label class="control-label" for="street_address">Street Address</label>
		<div class="controls">
			<textarea id="street_address" name="street_address" class="validate_maxlength validate_required" data-display_name="Street Address" data-maxlength=150 ><?php echo set_value('street_address');?></textarea>
		</div>
	</div>
	
	<div class="control-group">
		<label class="control-label" for="tel_number">Telephone Number</label>
		<div class="control-group" style="margin: 0;">
			<div class="controls">
				<input type="text" id="tel_number_code" name="tel_number_code" class="validate_maxlength validate_numeric validate_required" data-display_name="Telephone Number Code" data-maxlength=10 placeholder="Code" value="<?php echo set_value('tel_number_code');?>">
			</div>
		</div>
		<div class="control-group" style="margin: 0;">
			<div class="controls">
				<input type="text" id="tel_number_number" name="tel_number_number" class="validate_maxlength validate_numeric validate_required" data-display_name="Telephone Number" data-maxlength=10 placeholder="Number" value="<?php echo set_value('tel_number_number');?>">
			</div>
		</div>
	</div>
	
	<div class="control-group">
		<label class="control-label" for="alt_tel_number">Alternate Telephone Number</label>
		<div class="control-group" style="margin: 0;">
			<div class="controls">
				<input type="text" id="alt_tel_number_code" name="alt_tel_number_code" class="validate_maxlength validate_numeric" data-display_name="Alternate Telephone Number Code" data-maxlength=10 placeholder="Code" value="<?php echo set_value('alt_tel_number_code');?>">
			</div>
		</div>
		<div class="control-group" style="margin: 0;">
			<div class="controls">
				<input type="text" id="alt_tel_number_number" name="alt_tel_number_number" class="validate_maxlength validate_numeric" data-display_name="Alternate Telephone Number" data-maxlength=10 placeholder="Number" value="<?php echo set_value('alt_tel_number_number');?>">
			</div>
		</div>
	</div>
	
	<div class="control-group">
		<label class="control-label" for="mobile_number">Mobile Number</label>
		<div class="controls">
			<input type="text" id="mobile_number" name="mobile_number" class="validate_maxlength validate_numeric validate_required" data-display_name="Mobile Number" data-maxlength=10 placeholder="Mobile Number" value="<?php echo set_value('mobile_number');?>">
		</div>
	</div>
	
	<div class="control-group">
		<label class="control-label" for="fax_number">Fax Number</label>
		<div class="controls">
			<input type="text" id="fax_number" name="fax_number" placeholder="Fax Number" value="<?php echo set_value('fax_number');?>">
		</div>
	</div>
	
	<div class="control-group">
		<label class="control-label" for="dob">Date of Birth</label>
		<div class="control-group" style="margin: 0;">
			<div class="controls">
				<select id="dob_month" name="dob_month" class="validate_required">
					<option value=""> -Select Month- </option>
				<?php for ($i=1; $i<=12; $i++):?>
					<option value="<?php echo $i;?>" <?php echo set_select('dob_month', $i); ?>><?php echo $i;?></option>
				<?php endfor;?>
				</select>
			</div>
		</div>
		<div class="control-group" style="margin: 0;">
			<div class="controls">
				<select id="dob_date" name="dob_date" value="<?php echo set_value('dob_date');?>" class="validate_required">
					<option value=""> -Select Date- </option>
				<?php for ($i=1; $i<=31; $i++):?>
					<option value="<?php echo $i;?>" <?php echo set_select('dob_date', $i); ?>><?php echo $i;?></option>
				<?php endfor;?>
				</select>
			</div>
		</div>
	</div>
	
	<div class="control-group">
		<label class="control-label" for="gender">Gender</label>
		<div class="controls">
			<label><input type="radio" id="gender_male" name="gender" value="male" <?php echo set_radio('gender', 'male', TRUE); ?>>Male</label>
			<label><input type="radio" id="gender_female" name="gender" value="female" <?php echo set_radio('gender', 'female'); ?>>Female</label>
		</div>
	</div>
	
	<div class="control-group">
		<label class="control-label" for="services_taken">Services Taken</label>
		<div class="controls">
			<label><input type="checkbox" id="services_taken_Domain" name="services_taken[]" value="Domain" <?php echo set_checkbox('services_taken[]', 'Domain');?>> Domain</label>
			<label><input type="checkbox" id="services_taken_Hosting" name="services_taken[]" value="Hosting" <?php echo set_checkbox('services_taken[]', 'Hosting');?>> Hosting</label>
			<label><input type="checkbox" id="services_taken_Designing" name="services_taken[]" value="Designing" <?php echo set_checkbox('services_taken[]', 'Designing');?>> Designing</label>
			<label><input type="checkbox" id="services_taken_Programming" name="services_taken[]" value="Programming" <?php echo set_checkbox('services_taken[]', 'Programming');?>> Programming</label>
		</div>
	</div>
	
	<div class="control-group">
		<label class="control-label" for="selected_products">Selected Products</label>
		<div class="controls">
			<select id="selected_products" name="selected_products[]" class="validate_required" multiple="multiple">
				<option value="Sales Software" <?php echo set_select('selected_products', 'Sales Software'); ?>>Sales Software</option>
				<option value="Marketing Software" <?php echo set_select('selected_products', 'Marketing Software'); ?>>Marketing Software</option>
				<option value="CRM" <?php echo set_select('selected_products', 'CRM'); ?>>CRM</option>
			</select>
		</div>
	</div>
	
	<div class="control-group">
		<label class="control-label" for="remarks">Remarks</label>
		<div class="controls">
			<textarea id="remarks" name="remarks"><?php echo set_value('remarks');?></textarea>
		</div>
	</div>
	
	<div class="control-group">
		<div class="controls">
			<button id="btn_add" type="button" class="btn">Add</button>
		</div>
	</div>
<?php form_close();?>
<script>
	function set_error(elem,msg)
	{
		jQuery(elem).closest('.control-group').addClass("error");

		var error_stack = jQuery(elem).attr('data-error_msg');
		if(typeof error_stack == "undefined" || error_stack == "")
		{
			error_stack = msg;
		}
		else
		{
			var error_array = error_stack.split("^,^");
			var index = error_array.indexOf(msg);
			if (index == -1) {
				error_array.push(msg);
			}
			error_stack = error_array.join('^,^');
			msg = error_array.join(' | ');
		}

		var error_block = '<span class="help-inline">'+ msg +'</span>';
		jQuery(elem).attr('data-error_msg',error_stack);
		jQuery(elem).closest('.controls').find("span.help-inline").remove();
		jQuery(elem).closest('.controls').append(error_block);
	}
	function remove_error(elem,msg)
	{
		jQuery(elem).closest('.controls').find("span.help-inline").remove();
		
		var error_stack = jQuery(elem).attr('data-error_msg');
		if(typeof error_stack == "undefined" || error_stack == "")
		{
			jQuery(elem).closest('.control-group').removeClass("error");
		}
		else
		{
			var error_array = error_stack.split("^,^");
			var index = error_array.indexOf(msg);
			if (index > -1) {
				error_array.splice(index, 1);
			}
			error_stack = error_array.join('^,^');
			msg = error_array.join(' | ');

			if(error_stack == "")
				jQuery(elem).closest('.control-group').removeClass("error");
			
			var error_block = '<span class="help-inline">'+ msg +'</span>';
			jQuery(elem).attr('data-error_msg',error_stack);
			jQuery(elem).closest('.controls').append(error_block);
		}
	}
	function init(){
		jQuery('.validate_trim').blur(function(){

			/*var element_name = jQuery(this).data('display_name');
			if(typeof element_name == "undefined")
				element_name = "This field";
			var msg = element_name + ' should not have empty space before or after it.';*/
			var msg = 'Space at starting or end not allowed';
			
			if(/^[\s]|[\s]$/g.test(this.value) == true) {
				set_error(this,msg);
		    }
			else
			{
				remove_error(this,msg);
			}
		});
		jQuery('.validate_maxlength').blur(function(){
			var element_maxlength = jQuery(this).data('maxlength');
			/*var element_name = jQuery(this).data('display_name');

			if(typeof element_name == "undefined")
				element_name = "This field";
			var msg = element_name + ' should not be greater than '+ element_maxlength +' Character.';*/
			var msg = 'MaxLength '+ element_maxlength +' Character';
			
			if(this.value.length > element_maxlength)
			{
				set_error(this,msg);
		    }
			else
			{
				remove_error(this,msg);
			}
		});
		jQuery('.validate_required').blur(function(){
			var msg = 'Required';
			if(jQuery(this).val() == '')
			{
			    set_error(this,msg);
			}
			else
			{
				remove_error(this,msg);
			}
		});
		jQuery(".validate_numeric").numericInput();
		
		jQuery( "#date_added" ).datepicker({
			dateFormat: "yy-mm-dd",
			defaultDate: new Date(),
			onSelect: function(dateText,inst){
				var now = new Date();
				var selected_date = new Date(dateText);
	
				var msg = 'Select valid date';
				if (selected_date.getTime() < now.getTime()){
					set_error(this,msg);
				}
				else
				{
					remove_error(this,msg);
				}
				jQuery(this).trigger('blur');
			}
		});
		jQuery('#company_name').blur(function(){
		    var msg = 'Contains illegal characters';
			if(/^[a-zA-Z0-9- ]*$/.test(this.value) == false) {
			    set_error(this,msg);
			}
			else
			{
				remove_error(this,msg);
			}
		});
		jQuery('#client_name').blur(function(){
		    var msg = 'Contains illegal characters';
			if(/^[a-zA-Z ]*$/.test(this.value) == false) {
			    set_error(this,msg);
			}
			else
			{
				remove_error(this,msg);
			}
		});
		jQuery('#email').blur(function(){
		    var msg = 'Not valid email';
			if(/^[a-z][a-zA-Z0-9_]*(\.[a-zA-Z][a-zA-Z0-9_]*)?@[a-z][a-zA-Z-0-9]*\.[a-z]+(\.[a-z]+)?$/.test(this.value) == false) {
			    set_error(this,msg);
			}
			else
			{
				remove_error(this,msg);
			}
		});
		jQuery('#password').pwstrength({
            onKeyUp: function (evt) {
	            $(evt.target).pwstrength("outputErrorList");
	        },
	        usernameField: "#client_name",
	        errorMessages: {
	        	password_to_short: "The Password is too short",
                same_as_username: "Your password cannot contain Client name"
            }
	    });
		jQuery('#pass_confirm').blur(function(){
			
			var reg = new RegExp('^'+jQuery('#password').val()+'$');
		    var msg = 'Password does not matched';
			if(reg.test(this.value) == false) {
			    set_error(this,msg);
			}
			else
			{
				remove_error(this,msg);
			}
		});
		jQuery('#country_id').change(function(){
			var options = '<option value=""> -Select- </option>';
			if(jQuery(this).val() != '')
			{
				jQuery.get( "<?php echo site_url()?>states/get_list_by_country/"+jQuery(this).val(), function( data ) {
					var data_json = JSON.parse(data);
					jQuery(data_json).each( function( index, state ) {
						options += '<option value="'+state.id+'">'+state.name+'</option>';
					});
					jQuery('#state_id').html(options);
					jQuery('#city_id').html('<option value=""> -Select- </option>');
				});
			}
			else
			{
				jQuery('#state_id').html(options);
				jQuery('#city_id').html(options);
			}
		});
		jQuery('#state_id').change(function(){
			var options = '<option value=""> -Select- </option>';
			if(jQuery(this).val() != '')
			{
				jQuery.get( "<?php echo site_url()?>cities/get_list_by_state/"+jQuery(this).val(), function( data ) {
					var data_json = JSON.parse(data);
					jQuery(data_json).each( function( index, city ) {
						options += '<option value="'+city.id+'">'+city.name+'</option>';
					});
					jQuery('#city_id').html(options);
				});
			}
			else
			{
				jQuery('#city_id').html(options);
			}
		});
		
		/*jQuery('#country_id').blur(function(){
			var msg = 'Country is required.';
			if(jQuery(this).val() != '')
			{
				remove_error(this,msg);
			}
			else
			{
			    set_error(this,msg);
			}
		});
		jQuery('#state_id').blur(function(){
			var msg = 'State is required.';
			if(jQuery(this).val() != '')
			{
				remove_error(this,msg);
			}
			else
			{
			    set_error(this,msg);
			}
		});
		jQuery('#city_id').blur(function(){
			var msg = 'City is required.';
			if(jQuery(this).val() != '')
			{
				remove_error(this,msg);
			}
			else
			{
			    set_error(this,msg);
			}
		});*/
		jQuery("#btn_add").click(function( event ) {
			event.preventDefault();
			var flag_exit = false;
			jQuery('.validate_trim').each(function(){
				if(/^[\s]|[\s]$/g.test(this.value) == true) {
					
					if(!jQuery(this).closest('.control-group').hasClass("error"))
						set_error(this,'Space at starting or end not allowed');
					
					jQuery(this).focus();
					flag_exit = true;
					return false;
			    }
			});
			if(flag_exit)
				return false;
				
			jQuery('.validate_maxlength').each(function(){
				var element_maxlength = jQuery(this).data('maxlength');
				if(this.value.length > element_maxlength)
				{
					if(!jQuery(this).closest('.control-group').hasClass("error"))
						set_error(this,'MaxLength '+ jQuery(this).data('maxlength') +' Character');
					
					jQuery(this).focus();
					flag_exit = true;
					return false;
			    }
			});
			if(flag_exit)
				return false;
			jQuery('.validate_required').each(function(){
				if(jQuery(this).val() == '')
				{
					if(!jQuery(this).closest('.control-group').hasClass("error"))
						set_error(this,'Required');
					
					jQuery(this).focus();
					flag_exit = true;
					return false;
				}
			});
			if(flag_exit)
				return false;

			var now = new Date();
			var selected_date = new Date(jQuery( "#date_added" ).val());
			if (selected_date.getTime() < now.getTime()){
				if(!jQuery("#date_added").closest('.control-group').hasClass("error"))
					set_error("#date_added",'Select valid date');
				
				jQuery("#date_added").focus();
				return false;
			}

			if(/^[a-zA-Z0-9- ]*$/.test(jQuery('#company_name').val()) == false) {
				if(!jQuery("#company_name").closest('.control-group').hasClass("error"))
					set_error("#company_name",'Contains illegal characters');
				jQuery("#company_name").focus();
				return false;
			}

			if(/^[a-zA-Z ]*$/.test(jQuery('#client_name').val()) == false) {
				if(!jQuery("#client_name").closest('.control-group').hasClass("error"))
					set_error("#client_name",'Contains illegal characters');
				jQuery("#client_name").focus();
				return false;
			}

			if(/^[a-z][a-zA-Z0-9_]*(\.[a-zA-Z][a-zA-Z0-9_]*)?@[a-z][a-zA-Z-0-9]*\.[a-z]+(\.[a-z]+)?$/.test(jQuery('#email').val()) == false) {
				if(!jQuery("#email").closest('.control-group').hasClass("error"))
					set_error("#email",'Not valid email');
				jQuery("#email").focus();
				return false;
			}

			var reg = new RegExp('^'+jQuery('#password').val()+'$');
			if(reg.test(jQuery('#pass_confirm').val()) == false) {
				if(!jQuery("#pass_confirm").closest('.control-group').hasClass("error"))
					set_error("#pass_confirm",'Password does not matched');
				jQuery("#pass_confirm").focus();
				return false;
			}

			jQuery("#form_client_registration").submit();
		});

		jQuery("#add_cities").click(function(){
			var state_id = jQuery("#state_id").val();
			if(state_id == '')
			{
				alert('First select the state');
				return false;
			}
			else
			{
				var city_name = prompt("Please enter your city", "");
				if(city_name.trim() != '')
				{
					jQuery.get("<?php echo site_url();?>cities/add_ajax/"+state_id+"/"+city_name, function(data){
						var data_json = JSON.parse(data);
						if(data_json.id != -1)
						{
							options = '<option value="'+data_json.id+'">'+data_json.name+'</option>';
							jQuery('#city_id').append(options);
						}
						else
						{
							alert(data_json.name);
						}
					});
				}
			}
		});
		
	} 
	
	
</script>

<?php Assets::add_js('init();','inline');?>