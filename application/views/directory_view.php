<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$CI =& get_instance();
$data = $_POST;
?>

<style>

/* label{
	display:inline-block;
	width:130px;
} */
.label{
	display:inline-block;
	width:120px;
	vertical-align: top;
	padding-left: 30px;
}
.label2{
	display:inline-block;
	width:290px;
}
.colon {
        display: inline-block;
        width: 20px;
        text-align: right;
	vertical-align: top;
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
	function printModalContent(dirID) {
		var printWindow = window.open('', '', 'width=600,height=600,left=' + (screen.width / 2 - 300) + ',top=' + (screen.height / 2 - 300));

		// Use AJAX to fetch the content from the separate PHP file
		var xhr = new XMLHttpRequest();
		
		// Pass dir_id in the data object
    		xhr.open('GET', '<?php echo base_url('task/person_print'); ?>?dir_id=' + dirID, true);

		xhr.onload = function () {
			if (xhr.status === 200) {
				// Log the fetched content to the console for debugging
				console.log(xhr.responseText);
				// Load the fetched content into the new window
				printWindow.document.open();
				printWindow.document.write('<html><head><title>Print Modal Content</title></head><body>');
				printWindow.document.write('<div id="modal-content">');
				printWindow.document.write(xhr.responseText);
				printWindow.document.write('</div>');
				printWindow.document.write('</body></html>');
				printWindow.document.close();

				// Trigger printing in the new window
				printWindow.print();

				// Close the new window after printing
				printWindow.close();
			}
		};

		xhr.send();
	}
</script>

<?php
foreach($data as $dataID => $id){
    	$filedata = $this->m_home->viewdirData($id);
?>
<div id="modal-content">
	<input type="hidden" name="dir_id" value="<?php echo @$filedata['dir_id']; ?>">

	<div class="mx-1">
		<label class="label text-muted">NAME</label>
		<span class="colon">: &nbsp;&nbsp;</span>
		<label class="label2"><?php echo @$filedata['dir_name']; ?></label>
	</div>
   	<br>

	<div class="mx-1">
		<label class="label text-muted">POSITION</label>
		<span class="colon">: &nbsp;&nbsp;</span>
		<label class="label2"><?php echo @$filedata['dir_position']; ?></label>
	</div>
    	<br>

	<div class="mx-1">
		<label class="label text-muted">SECTOR</label>
		<span class="colon">: &nbsp;&nbsp;</span>
		<label class="label2"><?php echo @$filedata['dir_sector']; ?></label>
	</div>
    	<br>

	<div class="mx-1">
		<label class="label text-muted">OFFICE</label>
		<span class="colon">: &nbsp;&nbsp;</span>
		<label class="label2"><?php echo @$filedata['dir_office']; ?></label>
	</div>
    	<br>

	<div class="mx-1">
		<label class="label text-muted">DIVISION</label>
		<span class="colon">: &nbsp;&nbsp;</span>
		<label class="label2"><?php echo @$filedata['dir_team']; ?></label>
	</div>
    	<br>

	<div class="mx-1">
		<label class="label text-muted">CONTACTS</label>
		<span class="colon">: &nbsp;&nbsp;</span>
		<label class="label2"><?php echo @$filedata['dir_contact']; ?></label>
	</div>
    	<br>

	<div class="mx-1">
		<label class="label text-muted">LOCAL</label>
		<span class="colon">: &nbsp;&nbsp;</span>
		<label class="label2"><?php echo @$filedata['dir_local']; ?></label>
	</div>
	<br>
 	<br>

	<div class="container">

		<button class="btn btn-secondary tedt" type="button" onclick="javascript:window.location.href='<?php echo htmlspecialchars(base_url('home/directory'));?>'">OK</button>
		<button class="btn btn-primary tedt" type="button" onclick="printModalContent('<?php echo @$filedata['dir_id']; ?>')"><i class="fa-solid fa-print"></i> Print Data</button>

	</div>
</div>

<?php     
}
?>