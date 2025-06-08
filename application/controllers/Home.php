<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require 'vendor/autoload.php';
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class Home extends MY_Controller {


	function __construct()
	{
		parent::__construct();
		//Notes
		//Work on Notification javascripts in the footer.php
		//Update all upload functions with task/send_email(), currently only on task/upload
	}
	public function index()
	{
		$data1 = $this->m_home->getfileData();
		$data2 = $this->m_home->getEventData();
		$this->data['tableData']= $data1;
		$this->data['eventData']= $data2;
		$viewfile = "home";
		$this->data['title'] = 'PhilHealth Intranet';
		$this->load->template($viewfile, $this->data, false, true);
	}

	public function admin_panel()
	{
		if($_SESSION['user_email'] && ($_SESSION['user_type'] == 'Admin')){
			$data['users'] = $this->m_home->getuserData();
			$data['files'] = $this->m_home->getfileData();
			$this->data['tableData1']= $data['users'];
			$this->data['tableData2']= $data['files'];
			$viewfile = "auth/admin_panel";
			$this->data['title'] = 'Admin Panel';
			$this->load->template($viewfile, $this->data, false, true);
		}
		else{
			$this->session->set_flashdata('admincheck', 1);
			redirect(site_url('home'));
		}

	}

	public function do_office()
	{
		if($_SESSION['user_email'] && ($_SESSION['user_status'] == 'Active')){
			$eventData = $this->m_home->getEventData();
			$data['users'] = $this->m_home->getuserData();
			$data['files'] = $this->m_home->getfileData();
			$this->data['tableData1']= $data['users'];
			$this->data['tableData2']= $data['files'];
			$this->data['eventData']= $eventData;
			$viewfile = "your_office";
			// $this->data['title'] = $this->get_office().' OFFICE';
			$this->data['title'] = $_SESSION['user_office'];
			$this->load->template($viewfile, $this->data, false, true);
		}
		else{
			$this->session->set_flashdata('admincheck', 1);
			redirect(site_url('home'));	
		}
	}

	public function do_events()
	{
		$data1 = $this->m_home->getfileData();
		$data2 = $this->m_home->getEventData();
		$this->data['tableData']= $data1;
		$this->data['eventData']= $data2;
		$viewfile = "events";
		$this->data['title'] = 'Events & Training';
		$this->load->template($viewfile, $this->data, false, true);
	}

	public function do_issuances()
	{
		$issuanceFilter = $_GET['link'];
		switch($issuanceFilter)
		{
			case "co":
				$issuancePage = "Corporate Order (CO)";
				$issuanceFilter = "\"Corporate Order (CO)\"";
				break;
			case "cpo":
				$issuancePage = "Corporate Personnel Order (CPO)";
				$issuanceFilter = "\"Corporate Personnel Order (CPO)\"";
				break;        
			case "sop":
				$issuancePage = "Standard Operating Procedure (SOP)";
				$issuanceFilter = "\"Standard Operating Procedure (SOP)\"";
				break;
			case "wins":
				$issuancePage = "Work Instruction (WIns)";
				$issuanceFilter = "\"Work Instruction (WIns)\"";
				break;
			case "cm":
				$issuancePage = "Corporate Memorandum";
				$issuanceFilter = "\"Corporate Memorandum (CM)\"";
				break;
			case "circular":
				$issuancePage = "PhilHealth Circular";
				$issuanceFilter = "\"PhilHealth Circular\"";
				break;
			case "advisory":
				$issuancePage = "PhilHealth Advisory";
				$issuanceFilter = "\"PhilHealth Advisory\"";
				break;
			default:
			echo "Sorry! Filter error!";
		}
		$data = $this->m_home->filterIssuances($issuanceFilter);
		$this->data['issuanceData']= $data;
		$viewfile = 'issuances';
		$this->data['title']= $issuancePage;
		$this->load->template($viewfile, $this->data, false, true);
	}

	public function directory()
    	{
		$data = $this->m_home->getlistData1();
		$this->data['tableData']= $data;
		$viewfile = "directory";
		$this->data['title'] = 'Directory';
		$this->load->template($viewfile, $this->data, false, true);
   	}

	public function do_download()
	{
		$data = $this->m_home->getformData();
		$this->data['files']= $data;
		$viewfile = "downloads/downloads";
		$this->data['title'] = 'DOWNLOADS';
		$this->load->template($viewfile, $this->data, false, true);
	}

	public function do_edit()
	{
		$file_ID = $this->input->post('file_ID');
		if(!$file_ID)
		{
			redirect(site_url('home'));
		}
		$singleRecord = $this->m_home->getfileData($file_ID);
		// $this->data['FormData'] = $singleRecord;
		$data['FormData'] = $singleRecord;
		$this->load->view('edit_file', $data);
		// $viewfile = 'edit_file';
		// $this->data['title']= 'EDIT DATA';
		// $this->load->template($viewfile, $this->data, false, true);
	}

	public function do_search()
	{
		$data = $this->m_home->getfileData();
		$this->data['tableData'] = $data;
		$viewfile = "search/global_search";
		$this->data['title'] = 'Search';
		$this->load->template($viewfile, $this->data, false, true);
	}

	//TEMPORARY FUNCTION
	public function test()
	{
		// $data = '0';
		// phpinfo();
		// echo '<pre>';
		// print_r($data);
		// die();
		
		if($_SESSION['user_email'] && ($_SESSION['user_type'] == 'Admin')){
			// $data = $this->m_home->getlistData1();
			// $this->data['tableData']= $data;
			// $viewfile = "test";
			// $this->data['title'] = 'Test Module';
			// $this->load->template($viewfile, $this->data, false, true);
			// echo '<pre>';
			// print_r();
			// echo '<br>';
			// print_r($this->get_office());
			// $user_id = $this->session->userdata('user_id'); // Get the user's ID
			// $data['notifications'] = $this->notification_model->getUnreadNotifications($user_id);
			// echo $user_id;
			// echo '<pre>';
			// print_r($data);
			// $notifications = $this->notification_model->getUnreadNotifications($user_id);
			// print_r($notifications);
			// die();
			$this->load->view('test');	
		}
		elseif($_SESSION['user_type'] != 'Admin')
		{
			$this->session->set_flashdata('admincheck', 1);
			redirect(site_url('home'));
		}
		else{
			redirect(site_url('home/login'));
		}
	}

	public function get_office(){
		$officeAbbreviations = array(
			"Dev" => "Dev",
			"Office of the President and Chief Executive Officer" => "OP-CEO",
			"Office of the Chief Information Officer - Information Management Sector" => "OCIO-IMS",
			"Office of the Chief Operating Officer" => "OCOO",
			"Task Force Informatics" => "TFI",
			"IPPSD" => "IPPSD",
			"ITMD" => "ITMD",
			"PMO" => "PMO",
			"Human Resource Department" => "HRD",
			"Physical Resource and Infrastructure Department" => "PRID",
			"Protest and Appeals Review Department" => "PARD",
			"Fund Management Sector" => "FMS",
			"Treasury Department" => "Treasury Department",
			"International and Local Engagement Department" => "ILED",
			"CorComm" => "CorComm",
			"Corporate Planning Department" => "CorPlan",
			"Corporate Marketing Department" => "CorMar",
			"Management Services Sector" => "MMS",
			"Corporate Affairs Group" => "CAG",
			"Health Finance Policy Sector" => "HFPS"
		    );
		    // Set "Your Office" module to user's office
		return $yourOffice = $officeAbbreviations[$_SESSION['user_office']];
	}

//-------------------for login and registration------------------------------------
	public function register()
	{
		$this->load->library('form_validation');
		$this->form_validation->set_rules('user_name', 'Full Name', 'trim|required');
		$this->form_validation->set_rules('user_email', 'E-Mail Address', 'trim|required|valid_email');
		$this->form_validation->set_rules('user_password', 'Password', 'trim|required|min_length[6]');
		$this->form_validation->set_rules('con_password', 'Confirm Password', 'trim|required|matches[user_password]');
		$this->form_validation->set_rules('user_office', 'User\'s Office', 'required|callback_validate_dropdown');
		
		if ($this->form_validation->run() == false) 
		{
			// Form validation failed, load the registration form view
			$this->load->view('auth/register');
		} 
		else 
		{
			// Form validation passed, proceed with registration
			// Redirect to the registration process handler function
			$this->do_register();
		}
	}

	public function add_user(){
                $this->load->view('auth/add_user');
        }

	public function login()
    	{
		$viewfile = 'auth/login';
        	$this->load->view($viewfile);		
   	}

	public function login_check()
	{
		$data = $this->m_home->loginCheck();
	}

	public function validate_dropdown($value) {
		// Check if the value is not empty or the default option
		if ($value === '') {
			$this->form_validation->set_message('validate_dropdown', 'Please select a valid option for User Office.');
			return FALSE;
		} else {
			return TRUE;
		}
	}
	    

	public function do_register()
	{
		$password = $this->input->post('user_password');
		$email = $this->input->post('user_email');
		$is_email_duplicate = $this->db->get_where('user_tb', ['user_email' => $email])->num_rows() > 0;
		
		if ($is_email_duplicate) 
		{
			$this->session->set_flashdata('wrong', 'Email is already registered!');
			if($_SESSION['user_type'] == "Admin"){
				redirect(site_url('home/admin_panel'));
			}
			else{
				redirect(site_url('home/register'));
			}
			
		} 
		else 
		{
			// Hash the password before inserting into the database
			$hashed_password = password_hash($password, PASSWORD_DEFAULT);
			
			// Prepare data for insertion
			$data = array(
				'user_name' => $this->input->post('user_name'),
				'user_office' => $this->input->post('user_office'),
				'user_email' => $email,
				'user_password' => $hashed_password,
				'user_status' => 'Pending',
				'user_type' => 'Regular'
			);

			// Call the model function to insert data
			$this->db->insert('user_tb', $data);
			$this->session->set_flashdata('regcheck', 1);
			if($_SESSION['user_type'] == "Admin"){
				redirect(site_url('home/admin_panel'));
			}
			else{
				redirect(site_url('home/login'));
			}
		}
	}

	public function denyform($dataid = '')
	{
		if(!$dataid)
		{
			redirect(site_url('home/admin_panel'));
		}
		$dquery = " DELETE FROM user_tb WHERE user_id = ".$dataid." ";
		
		$rquery = $this->db->query($dquery);
		
		if(!$rquery)
		{
			$dbError = $this->db->error();
			echo 'FAILED TO DELETE RECORD<br>
			<button type="button"
			onclick="javascript:window.location.href=\''.site_url('home').'\'">
			Go BACK </button>';
		}
		else
		{
			redirect(site_url('home/admin_panel'));
		}
	}

	public function approveform($dataid = '')
	{
		$singleRecord = $this->m_home->approve_user($dataid);
	}

	public function signoutform()
	{
		$this->m_home->logout();
	}

	public function logout()
	{
		// Clear session data
		$this->session->unset_userdata('user_id');
		$this->session->unset_userdata('user_email');
		$this->session->unset_userdata('user_name');
		$this->session->unset_userdata('user_type');
		
		// Destroy the session
		$this->session->sess_destroy();

		// Redirect to the login page or any other page
		redirect(site_url('home'));
	}	   

	// Print Directory
	// public function print_dir($dir_id = '')
	// {
	// 	$singleRecord = $this->m_home->printdirData($dir_id);
	// 	$this->data['tableData'] = $singleRecord;
	// 	$viewfile = 'print_directory';
	// 	$this->load->view($viewfile, $this->data, false, true);
	// }

	//deletedirectory 
	public function deletedir_form($dir_id = '')
	{
	   if( !$dir_id )
	   {
		redirect(site_url('home/directory'));
	   }
	   $dquery = " DELETE FROM directory_tb WHERE dir_id = ".$dir_id." ";
	   $rquery = $this->db->query($dquery); 
	   if(!$rquery)
	   {
		   $dbError = $this->db->error(); 
		   echo 'FAILED TO DELETE RECORD<br> 
		   <button type="button"
		   onclick="javascript:window.location.href=\''.site_url('home').'\'">
		   Go Back</button>';
	   }
	   else
	   {
		redirect(site_url('home/directory'));
	   }
	}
	
	public function editdir_form($dir_id  = '')
	{
		if( !$dir_id)
		{
			redirect(site_url('home/directory'));
			
		}
			$singleRecord = $this->m_home->getlistData1($dir_id);
			$this->data['tableData']= @$singleRecord;
			$viewfile='edit_personnel';
			$this->data['title'] = 'Edit Data';
			$this->load->template($viewfile,$this->data,false,true);
	}

	// public function addpersonnel() //function for the Add to Directory
	// {
	// 	// $data = $this->m_home->getlistData1();
	// 		$data['office_name'] = $this->m_home->fetch_office();
	// 		$this->data['tableData']= $data;
	// 		$viewfile = "add_personnel";
	// 		$this->data['title'] = 'Add Personnel';
	// 		$this->load->template($viewfile, $this->data, false, true);
	// }

	public function addpersonnel()
	{
		// echo '<pre>';
		// echo 'this is model';
		// die();
		// $this->load->view('add_personnel');
		$viewfile = "add_personnel";
		$this->data['title'] = 'Add Personnel';
		$this->load->template($viewfile, $this->data, false, true);
	}

	public function addform() //for Add function in model
	{
		$viewfile='home';
		$this->load->view($viewfile,$this->data);
		$this->data['title'] = 'ADD PERSONNEL';
		$this->load->template($viewfile, $this->data,false,true);
	}

	public function DirectoryList()
	{
		$spreadsheet = new Spreadsheet();
		$sheet = $spreadsheet->getActiveSheet();
		//getActiveSheet not working
		//https://stackoverflow.com/questions/46845015/what-does-this-code-mean-objphpexcel-getactivesheet-toarraynull-true-tru

		foreach(range('A','G') as $columnID)
		{
			$spreadsheet->getActiveSheet()->getColumnDimension($columnID)->setAutosize(true);
		}
		$sheet->setCellValue('A1','ID');
		$sheet->setCellValue('B1','NAME');
		$sheet->setCellValue('C1','SECTOR');
		$sheet->setCellValue('D1','OFFICE');
		$sheet->setCellValue('E1','DIVISION');
		$sheet->setCellValue('F1','CONTACT');
		$sheet->setCellValue('G1','LOCAL');

		$users = $this->db->query("SELECT * FROM directory_tb")->result_array();
		//This query selects all (*)

		$x=2; //start from row 2
		foreach($users as $row)
		{ 
			$sheet->setCellValue('A'. $x, $row['dir_id']);
			$sheet->setCellValue('B'. $x, $row['dir_name']);
			$sheet->setCellValue('C'. $x, $row['dir_sector']);
			$sheet->setCellValue('D'. $x, $row['dir_office']);
			$sheet->setCellValue('E'. $x, $row['dir_team']);
			$sheet->setCellValue('F'. $x, $row['dir_contact']);
			$sheet->setCellValue('G'. $x, $row['dir_local']);
			$x++;
		}
		
		$writer = new Xlsx($spreadsheet);
		$filename = 'users_details_export.xlsx';
		//$writer->save($filename); //this is to save in folder

		//to force download
		header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
		header('Content-Disposition: attachment; filename"'.$filename.'"');
		$writer->save('php://output');
	}

	public function print_selected_entries() {
		$selectedEntries = $this->input->post('entries');
	    
		if (!empty($selectedEntries)) {
			// Fetch the data for the selected entries from your database
			$selectedEntriesData = array();
		
			foreach ($selectedEntries as $entryID) {
				$entryData = $this->m_home->getEntryDataById($entryID);
			
				if ($entryData) {
					$selectedEntriesData[] = $entryData;
				}
			}
	    
		    	if (!empty($selectedEntriesData)) {
				// Generate the HTML or format for printing the selected entries
				$html = '<table border="1" cellpadding="5" cellspacing="0" style="border-collapse: collapse;">';
				$html .= '<tr>';
				$html .= '<th>Office</th>';
				$html .= '<th>Division</th>';
				$html .= '<th>Contact No.</th>';
				$html .= '<th>Local No.</th>';
				// Add more table headers as needed
				$html .= '</tr>';
		
				// Loop through the selected entries data and add rows to the table
				foreach ($selectedEntriesData as $entry) {
				$html .= '<tr>';
				$html .= '<td>' . $entry['dir_office'] . '</td>';
				$html .= '<td>' . $entry['dir_team'] . '</td>';
				$html .= '<td>' . $entry['dir_contact'] . '</td>';
				$html .= '<td>' . $entry['dir_local'] . '</td>';
				// Add more table cells for additional columns
				$html .= '</tr>';
				}
		
				$html .= '</table>';
		
				// Return the HTML content for printing
				echo $html;
			} else {
				echo 'No data found for the selected entries.';
			}
		} else {
		    echo 'No entries selected for printing.';
		}
	}
	    
	    
	
	function getoffice ()
	 {
		$sector = $this->input->post('sector');
		$office = $this->m_home->getoffice($sector);
		$data ['office']= $office;
		/*echo */ $officeString = $this->load->view('office', $data, true); // this will not load -- it will return as string 
		$response['office'] = $officeString;
		echo json_encode($response);
	 }

	 function getdivision ()
	 {
		
		$office = $this->input->post('office');
		$division = $this->m_home->getdivision($office);
		
		$data['division']= $division;
		$divisionString = $this->load->view('division', $data, true); // this will not load -- it will return as string 
		$response['division'] = $divisionString;
		echo json_encode($response);
	 }
}
?>