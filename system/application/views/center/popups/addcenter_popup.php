<?php $this->load->view('layout/thickbox_header'); ?>

<form id="formEditor" class="mainForm clear" action="<?php echo site_url('center/addCenter')?>" method="post" style="width:500px;" onsubmit="return validate();"  >
<fieldset class="clear">
	<?php 
	$this_city_id = $this->session->userdata('city_id');
	if($this->user_auth->get_permission('change_city')) { ?>
		<div class="field clear">
		<label for="selBulkActions">Select city:</label> 
		<select id="city" name="city" > 
		<option value="0" >- choose action -</option> 
			<?php 
			$details = $details->result_array();
			foreach($details as $row) {
			?>
			<option value="<?php echo $row['id']; ?>" <?php if($this_city_id == $row['id']) print ' selected="selected"'; ?>><?php echo $row['name']; ?></option> 
			<?php } ?>
		</select>
		</div>
<?php } else { ?>
	<input type="hidden" name="city" value="<?php echo $this_city_id; ?>" />
<?php } ?>

<div class="field clear">
<label for="selBulkActions">Select Head:</label> 
<select id="user_id" name="user_id"> 
<option selected="selected" value="0" >- Choose -</option> 
	<?php 
	$user_name = $user_name->result_array();
	foreach($user_name as $row)
	{
	?>
	<option value="<?php echo $row['id']; ?>"><?php echo $row['name']; ?></option> 
	<?php } ?>
</select>
</div>

<div class="field clear"> 
			<label for="txtName">Center Name : </label>
			<input id="center" name="center"  type="text" /> 
</div><br />

<div class="field clear"> 
<input id="btnSubmit" class="button primary" type="submit" value="Save" />
<a href="#" class="cancel-button">Cancel</a>
</div>
</fieldset>
</form>


<script>
function validate()
{
if(document.getElementById("city").value == '0')
	{		
		alert("Select a City.");
		return false;
	}
if(document.getElementById("center").value == '')
	{
		alert("Center Missing.");
		return false;
	}
}
</script>
