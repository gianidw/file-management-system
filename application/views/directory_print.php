<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$CI =& get_instance();
$data = $dir_id;
?>

<style>

label{
	display:inline-block;
	width:130px;
}
.label{
	display:inline-block;
	width:130px;
}
.a {
 	text-align: center;
	vertical-align: middle;

}

.b {
	width:150px;
	text-align: center;
	vertical-align: middle;

}
.c {
	width:70px;
	border:none;
	cursor: pointer;
	display: inline-block;"
}
.d {
	width:150px;
}
.e {
	padding: 10px 10px;
	text-align: center;
	text-decoration: none;
	display: inline-block;
	font-size: 16px;
	margin: 4px 2px;
	cursor: pointer;
}
.inputbx{
	display:inline-block;
	width:250px;
}
.txtbx{
	display:inline-block;
	width:350px;
	height:100px;
}
@media print {
	.tedt{
		/* font-weight:bold; */
		display: none;
	}
	.modal {
		overflow: hidden !important;
		overflow-y: hidden !important;
	}
	body{
		/* margin: calc(var(--header-height) + 1rem) 0 0 0;
		padding-left: calc(var(--nav-width) + 2rem); */
		overflow: hidden !important;
		overflow-y: hidden !important;
	}}
</style>

<script>
	function printPage() {
		window.print();
	}  
</script>

<?php
    	$filedata = $this->m_home->viewdirData($data);
?>
<div id="modal-content">
	<input type="hidden" name="dir_id" value="<?php echo @$filedata['dir_id']; ?>">

	<div class="container"><label>NAME:</label>
		 <?php echo @$filedata['dir_name']; ?>
	</div>
   	<br>

	<div class="container"><label>POSITION:</label>
		<?php echo @$filedata['dir_position']; ?>
	</div>
    	<br>

	<div class="container"><label>SECTOR:</label>
		 <?php echo @$filedata['dir_sector']; ?>
	</div>
    	<br>

	<div class="container"><label>OFFICE:</label>
		 <?php echo @$filedata['dir_office']; ?>
	</div>
    	<br>

	<div class="container"><label>DIVISION:</label>
		<?php echo @$filedata['dir_team']; ?>
	</div>
    	<br>

	<div class="container"><label>CONTACTS:</label>
		<?php echo @$filedata['dir_contact']; ?>
	</div>
    	<br>

	<div class="container"><label>LOCAL:</label>
		<?php echo @$filedata['dir_local']; ?>
	</div>
	<br>
</div>