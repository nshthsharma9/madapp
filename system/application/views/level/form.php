<?php $this->load->view('layout/thickbox_header'); ?>
<?php
if(!isset($level)) $level = array(
	'id'		=> 0,
	'name'		=> '',
	'center_id'	=> 0,
	'grade'		=> 5,
	);

?>

<form action="" method="post" class="form-area">
<ul class="form city-form">
<li>
<label for="grade">Grade</label>
<select name="grade" style="width:100px;">
	<?php for($i=1;$i<=12;$i++) { ?>
	<option value="<?php echo $i ?>" <?php if($level['grade'] == $i) echo 'selected'; ?>><?php echo $i ?></option>
	<?php } ?>
	<option value="13" <?php if($level['grade'] == 13) echo 'selected'; ?>>Aftercare</option>
</select>

<select name="name" style="width:100px;">
	<?php foreach(range('A','M') as $l) { ?>
	<option value="<?php echo $l ?>" <?php if($level['name'] == $l) echo 'selected'; ?>><?php echo $l ?></option>
	<?php } ?>
</select>
</li>

<li>
<label for="selBulkActions">Kids:</label>
<select id="students" name="students[]" multiple>
<?php foreach($level['kids'] as $id=>$name) { ?>
<option value="<?php echo $id; ?>" <?php 
	if(in_array($id, $level['selected_students'])) echo 'selected'; 
?>><?php echo $name; ?></option> 
<?php } ?>
</select>
</li>
<li>
	<label>&nbsp;</label>
	<input id="students-filter" class="filter-multiselect" type="text" value="" target-field="students" placeholder="Filter..." />
</li>
<li>
<label for="medium_id">Medium</label>
<select name="medium_id">
	<?php foreach($all_mediums as $medium_id => $medium_name) { ?>
	<option value="<?php echo $medium_id ?>" <?php if($level['medium_id'] == $medium_id) echo 'selected'; ?>><?php echo $medium_name ?></option>
	<?php } ?>
</select>
</li>

<?php
echo form_hidden('center_id', $center_id);
echo form_hidden('project_id', 1);
echo form_hidden('id', $level['id']);
echo '<label for="action">&nbsp;</label>';echo form_submit('action', $action);
?>
</ul>
</form><br />
<script type="text/javascript" src="<?php echo base_url()?>js/libraries/filter-multiselect.js"></script>

<?php $this->load->view('layout/thickbox_footer');