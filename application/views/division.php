<style>
    .inputbx{
	display:inline-block;
	width:250px;
}
</style>

<label >Division</label>
        <select class="form-select form-select-sm inputbx" name="division" id="division" style="margin-left; ">
        <div class="form-group container" >
        <option></option>
    <?php 
    if (!empty($division)){
        foreach($division as $division){
            ?>
            <option value="<?php echo $division['division'];?>"><?php echo $division['division'];?></option>
            <?php
    
        }
    }
    ?>
</select>