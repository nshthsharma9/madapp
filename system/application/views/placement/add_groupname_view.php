<div id="content" class="clear">
<!-- Main Begins -->
	<div id="main" class="clear">
    	<div id="head" class="clear">
        	<h1><?php echo $title; ?></h1>
            <!-- start page actions-->
            <a href="<?php echo site_url('placement/placement_view') ?>">< Placement Dashboard</a>
        	<div id="actions"> 
			<a href="<?php echo site_url('placement/popupaddgroup')?>" class="thickbox button primary green popup" name="Add New Group">Add New Group</a>
			</div>
			<!-- end page actions-->
	    </div>
		<div id="topOptions" class="clear">
		</div>
<table id="tableItems" class="clear data-table" cellpadding="0" cellspacing="0">
<thead>
<tr>
	<th class="colCheck1">Id</th>
	<th class="colName sortable">Group Name</th>
        <th class="colName sortable">Class Group</th>
    <th class="colActions">Actions</th>
</tr>
</thead>
<tbody>

<?php 
$norecord_flag = 1;
$shadeFlag = 0;
$shadeClass = ''; 
$statusIco = '';
$statusText = '';
$content = $details->result_array();
$i=0;
foreach($content as $row)
{	$i++;
	$norecord_flag = 0;

	if($shadeFlag == 0)
	  {
  		$shadeClass = 'even';
		$shadeFlag = 1;
  	  }
	else if($shadeFlag == 1)
	  {
  		$shadeClass = 'odd';		
		$shadeFlag = 0;
  	  }
?> 
<tr class="<?php echo $shadeClass; ?>" id="group">
    <td class="colCheck1"><?php echo $i; ?></a></td>
    <td class="colName left"><?php echo $row['name']; ?></a></td>
    <td class="colName left"><?php echo str_replace('_', ',', $row['group']); ?></a></td>
    <td class="colActions right"> 
    <a href="<?php echo site_url('placement/popupEdit_group/'.$row['id'])?>" class="thickbox icon popup edit">Edit</a>
    <a class="actionDelete icon delete confirm" href="<?php echo site_url('placement/ajax_deletegroup/'.$row['id']); ?>">Delete</a>
    </td>
</tr>

<?php }?>
</tbody>
</table>
</div>

</div>

