<?php $this->load->view('layout/thickbox_header'); ?>
<h2>Add Permission</h2>
<script>
function validate()
{
if(document.getElementById("permission").value == '')
          {		
              alert("Permission Name Missing.");
			  document.getElementById('permission').focus();
              return false;
          }
}
</script>
<div id="message"></div>
<div style="float:left; margin-top:20px;">
<form id="formEditor" class="mainForm clear" action="<?=site_url('permission/addpermission')?>" method="post" onsubmit="return validate();">
<fieldset class="clear">
	<ul class="form city-form">
	<li>
	<label for="txtName">Name : </label>
	<input id="permission"  name="permission" id="permission"  type="text" /> 
	</li>
    </ul>
    <ul>
	<li>
	<input  id="btnSubmit" class="button green" type="submit" value="Submit" />
	</li>
	</ul>
    </fieldset>
</form>
</div>