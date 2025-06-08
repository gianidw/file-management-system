<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$CI =& get_instance();
?>

<!doctype html>
<html lang="en" data-bs-theme="auto">
    <head><script src="../assets/js/color-modes.js"></script>

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
	width:250px;
	height:100px;
}
.textbox-container{
    margin-right: 100px;
}
</style>

<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">

</head>   
<body>



<?php
echo @$error; 
 // Connect to database
$hostname = $this->db->hostname;
$username = $this->db->username;
$password = $this->db->password;
$database = $this->db->database;
$con = mysqli_connect($hostname,$username,$password,$database);

// mysqli_connect("servername","username","password","database_name")

// Get all the categories from category table
$sql = "SELECT * FROM `sec_tb`";
$all_categories = mysqli_query($con,$sql);
?>

 <form action="<?php echo base_url('Task/processform')?>" method="post" enctype="multipart/form-data">
	
	<br>
	<div class="container">
		<label for="title">Personnel Name</label>
		<input class="inputbx" type="text" name="per_name" id="per_name" value="<?php echo @$FormData['dir_name']; ?>" autofocus>
		<span style="color:red">* <?php echo @$titleError;?></span>
	</div>
	<br>
	<div class="container">
		<label for="title">Position</label>
		<input class="inputbx" type="text" name="position" id="position" value="<?php echo @$tableData['dir_position']; ?>" autofocus>
		<span style="color:red">* <?php echo @$titleError;?></span>
	</div>
	<br>

	<div class="container"><label >Sector:</label>
	<select class="form-select form-select-sm inputbx" name="sector" id="sector" style="margin-left; "><br>
	<option>Select Sector</option>
	<?php
// Use an associative array to keep track of encountered sectors
$encounteredSectors = array();

// Use a while loop to fetch data from the $all_categories variable
// and individually display as an option
while ($category = mysqli_fetch_array($all_categories, MYSQLI_ASSOC)):
    $sector = $category["sector"];

    // Check if this sector has already been encountered
    if (!isset($encounteredSectors[$sector])):
?>
        <option value="<?php echo $sector; ?>">
            <?php echo $sector; ?>
        </option>
<?php
        // Mark this sector as encountered
        $encounteredSectors[$sector] = true;
    endif;
endwhile;
// While loop must be terminated
?>
        </select>
  <span style="color:red">* <?php echo @$titleError;?></span>
  </div>
  <br>

  <div class="form-group container">
    <div id="officeBox"><label >Office:</label>
        <select class="form-select form-select-sm inputbx" name="office" id="office" style="margin-left;">
            <option  value="<?php echo @$FormData['office']; ?>"><?php echo @$FormData['office']; ?>Select office</option>
        </select><span style="color:red">*<?php echo @$titleError;?></span>
    </div>
  </div>
	
		<br>

	
		<div class="form-group container">
    <div id="divisionBox"><label>Division:</label>
        <select class="form-select form-select-sm inputbx" name="division" id="division" style="margin-left;">
            <option  value="<?php echo @$FormData['division']; ?>"><?php echo @$FormData['division']; ?>Select division</option>
        </select><span style="color:red">*<?php echo @$titleError;?></span>
    </div>
  </div>

  <br>
 
	<!-- </form> -->

	</body>
</html>

	<div class="container">
		<label for="contact">Contact No.</label>
		<input class="inputbx" aria-label="Contact" name="contact" id="contact">
			<option selected value='<?php echo @$FormData['dir_contact']; ?>'><?php echo @$FormData['dir_contact']; ?></option>
	</div>

	<div class="container">
		<label for="local">Local No.</label>
		<input class="inputbx" aria-label="Local" name="local" id="local">
		<span style="color:red">* <?php echo @$titleError;?></span>
			<option selected value='<?php echo @$FormData['dir_local']; ?>'><?php echo @$FormData['dir_local']; ?></option>
	</div>

	<!-- <br>
	<div class="container">
		<label for="details">Details:</label>
		<textarea class="txtbx" name="details" value="<?php //echo @$FormData['file_details']; ?>"><?php //echo @$FormData['file_details']; ?></textarea>
	</div> -->

	<!-- <br>
	<div class="container">
		<input class="inputbx" type="hidden" readonly name="created" value="<?php 
		// if(isset($today1)){
		// 	echo $today1;
		// }
		// else{
		// 	echo $today;
		// }  
		?>">
	</div> -->

	<!-- <div class="container">
		<input class="inputbx" type="hidden" name="updated" readonly value="<?php echo $today;?>">
	</div> -->
	
	<br>
	<div class="container">
		<input class="btn btn-primary" type="submit" id="showtoast" value="Submit" />
		<button class="btn btn-secondary" type="button" style="margin-left:20px" onclick="javascript:window.location.href='<?php echo htmlspecialchars(base_url('home/admin_panel'));?>'">Cancel</button>
	</div>
</form>

<!-- <script>
var subjectObject = {
	"Office of the President and Chief Executive Officer": {
    "sadasdas": ["", "", "", ""],
    "Tasdsadasd": ["", "", "", ""],
    "sadasd": ["", "", "", ""],
	"sadasdas": ["", "", "", ""] 
  },
  "Chief Operating Officer": {
    "fgfg": ["", "", "", ""],
    "dfdfd": ["", "", "", ""],
    "dfdfffd": ["", "", "", ""],
	"IPPSD": ["", "", "", ""] 
  },
  "Health Finance Policy Sector": {
    "fg23123": ["", "", "", ""],
    "df4343": ["", "", "", ""],
    "df2322fd": ["", "", "", ""],
	"I324242": ["", "", "", ""] 
  },
  "Management Services Sector": {
    "ghghg": ["", "", "", ""],
    "fdgdfg": ["", "", "", ""],
    "djhkhjk": ["", "", "", ""],
	"hjkhjkhj": ["", "", "", ""] 
  },
  "Actuarial Services & Risk Management Sector": {
    "fgfg": ["", "", "", ""],
    "dfdfd": ["", "", "", ""],
    "dfdfffd": ["", "", "", ""],
	"IPPSD": ["", "", "", ""] 
  },
  "Legal Sector": {
    "fgfg": ["", "", "", ""],
    "dfdfd": ["", "", "", ""],
    "dfdfffd": ["", "", "", ""],
	"IPPSD": ["", "", "", ""] 
  },
  "Chief Information Officer, Information Management Sector	": {
    "ITMD": {"NHDR":"NHDR", "ISMD":"ISMD", "IPPSD":"", "wtes8":""},
    "TFI": {"18":"", "NHDssdR":"", "89":"", "8yyyy":""},
    "PMO": {"18q":"", "NHDsdsdR":"", "y89":"", "y8":""},
	"IPPSD": {"18e":"", "NHDRr":"", "89t":"", "8yy":""},
  },
  "Fund Management Sector": {
    "wqe": ["", "", ""],
    "qwe": ["", "", ""]
  }
}
window.onload = function() {
var subjectSel = document.getElementById("sector");
var topicSel = document.getElementById("subject");
  for (var x in subjectObject) 
  {
    subjectSel.options[subjectSel.options.length] = new Option(x, x);
  }
//   subjectSel.onchange = function() {
//     //empty Chapters- and Topics- dropdowns
//     topic.length = 1;
//     //display correct values
//     for (var y in subjectObject[this.value]) {
// 		subject.options[subject.options.length] = new Option(y, y);
//     }
//   }
}


$("select[grp='select']").change(function(){
	var objVal = '';
	
			
	switch($(this).attr('id'))
	{
		case 'sector':
			objVal = subjectObject[$(this).val()];
			targetselect = document.getElementById("subject");
		break;
		case 'subject':
			objVal = subjectObject[$("select[grp='select']").val()][$(this).val()];
			targetselect = document.getElementById("topic");
		break;
		
	}

	$(targetselect).html('');
	for (var y in objVal) 
	{
		targetselect.options[targetselect.options.length] = new Option(y, y);
    }
});

</script>  -->

<!-- <form id="form1" action="">
<all inputs here>
	</form>
	
	<submit button javascript:window/locati(url)>
<script>
	$("#form1").submit(function({

		ajax.post
	}));
	</script> -->

	<script>    
	$(document).ready(function(){
		   $("#sector").change(function(){
            var sector = $(this).val();
        
            $.ajax({
                url: '<?php echo site_url('home/getoffice'); ?>/',
                type:'POST',
                data:{sector:sector},
                dataType:'json',
                success:function(response){
                    
                    if(response['office'])
                    {
                        $("#officeBox").html(response['office']);
                    }
                },
                error:function(request, status, error){
                    
                    console.log(request);
                    console.log(status);

                    console.log(error);

                    
                }
                
            });
        });
		$(document).on("change","#office",function() {
    	var office = $(this).val();

    
    // Adding a console log to check if the change event is triggered
    // alert(office);

    $.ajax({
        url: '<?php echo site_url('home/getdivision'); ?>/', // Make sure this URL is correct
        type: 'POST',
        data: { office: office },
        dataType: 'json',
        success: function(response) {
            if(response['division'])
			{
                $("#divisionBox").html(response['division']);
            }
        }
    });
});

	});
	</script>


