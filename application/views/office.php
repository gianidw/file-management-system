<style>
    .inputbx{
	display:inline-block;
	width:250px;
}
</style>

<label >Office</label>
        <select class="form-select form-select-sm inputbx" name="office" id="office" style="margin-left; ">
        <div class="form-group container" >
        <option>Select Office</option>
    <div id="officeBox">
        <?php 
    if (!empty($office)){
        foreach($office as $office){
            ?>
            <option value="<?php echo $office['office'];?>"><?php echo $office['office'];?></option>
            <?php
    
        }
    }
    ?>
</select>