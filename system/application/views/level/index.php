<?php $this->load->view('layout/header', array('title'=>'Levels in ' . $center_name)); ?>
<h1>Levels in <?php echo $center_name ?></h1>

<table class="data-table">
<tr><th>Level Name</th><th>Batches</th><th colspan="2">Action</th></tr>
<?php foreach($all_levels as $level) { ?>
<tr>
<td><?php echo $level->name ?></td>
<td><a href="<?php echo base_url() ?>index.php/batch/index/level/<?php echo $level->id ?>">Batches in <?php echo $level->name ?></a></td>
<td><a href="<?php echo base_url() ?>index.php/level/edit/<?php echo $level->id ?>" class="edit">Edit</a></td>
<td><a href="<?php echo base_url() ?>index.php/level/delete/<?php echo $level->id ?>" class="confirm delete" title="Delete <?php echo addslashes($level->name) ?>">Delete</a></td>
</tr>
<?php } ?>
</table>
<a href="<?php echo base_url() ?>index.php/level/create/center/<?php echo $center_id ?>" class="add">Create New Level in <?php echo $center_name ?></a></td>

<?php $this->load->view('layout/footer'); ?>