<?php

class Task extends MY_Controller {

        public function __construct()
        {
                parent::__construct();
                $this->load->helper(array('form', 'url'));
		$this->load->model('Home/m_home', 'm_home');
                $this->load->library('toastr');

        }

        public function upload()
        {
                $id = $this->session->userdata('id');
                $config['upload_path']          = './assets/files/';
                $config['allowed_types']        = 'xls|xlsx|ppt|pptx|pdf|docx|doc|zip|rar';
                $config['max_size']             = 0;
                $config['max_width']            = 20000;
                $config['max_height']           = 20000;
                
                $this->load->library('upload', $config);
                $errorCnt = 0;
                $fileInfo = [
                        'title'         =>      ['caption' => 'File Title', 'datafieldname'=>'file_title', 'required'=>false ],
                        'position'      =>      ['caption' => 'Position', 'datafieldname' => 'file_position', 'required'=>false ],
                        'office'      =>      ['caption' => 'Originating Office', 'datafieldname' => 'file_originating_office', 'required'=>false ],
                        'team'      =>      ['caption' => 'Originating Team', 'datafieldname' => 'file_originating_team', 'required'=>false ],
                        'category'      =>      ['caption' => 'File Category', 'datafieldname'=>'file_category', 'required' => false],
                        'details'      =>      ['caption' => 'File Details', 'datafieldname'=>'file_details', 'required' => false],
                        'created'      =>      ['caption' => 'Created', 'datafieldname'=>'file_date_created', 'required' => false],
                        'updated'      =>      ['caption' => 'Updated', 'datafieldname'=>'file_date_updated', 'required' => false],
                        'isEvent' =>    ['caption' => 'Is Event', 'datafieldname' => 'isEvent', 'required' => false],
                        'event_Start'   => ['caption' => 'Event Start', 'datafieldname' => 'event_Start', 'required' => false],
                        'event_End'     => ['caption' => 'Event End', 'datafieldname' => 'event_End', 'required' => false],
                        'isExclusive'   => ['caption' => 'Exclusive File', 'datafieldname' => 'isExclusive', 'required' => false]
                ];

                $postval = []; $errorArray = [];
                foreach($fileInfo as $fld => $mess)
                {
                        if($mess['required'] && (empty($_POST[$fld]) || trim($_POST[$fld]) == '')){
                                $tmp = $fld.'Error';
                                $$tmp = $mess['caption']." is required";
                                $errorArray[] = $$tmp;
                                $errorCnt++;
                        }
                        else{
                                $$fld = $this->test_input(@$_POST[$fld]);
                                $postval[$fld] = $$fld;
                        }
                }
                
                if($errorCnt == 0)
                {
                        if ( ! $this->upload->do_upload('userfile'))
                        {
                                if(isset($_POST['file_ID']) && $_POST['file_ID'] <> '')
                                {
                                        $qResult = $this->m_home->updatefileData($_POST['file_ID'], $postval);
                                        if($_SESSION['user_type'] == 'Office Admin'){
                                                redirect(site_url('home/do_office'));
                                        }
                                        else{
                                                redirect(site_url('home/admin_panel'));
                                        }
                                }
                                else
                                {
                                        //Build a better redirect after blank upload
                                        $this->data = array('error' => $this->upload->display_errors());
                                        $viewfile = 'upload_file';
                                        $this->data['title'] = 'UPLOAD FILE';
                                        $this->load->template($viewfile, $this->data, false, true);
                                }
                        }
                        else
                        {
                                $this->data = array('upload_data' => $this->upload->data());
                                $saved_file = $this->upload->data('file_name');
                                $file_ext = pathinfo($saved_file);
                                $qResult = '';

                                if( isset($_POST['file_ID']) && $_POST['file_ID'] <> '')
                                {
                                        $qResult = $this->m_home->updatefileData($_POST['file_ID'], $postval);
                                        if($_SESSION['user_type'] == 'Office Admin'){
                                                redirect(site_url('home/do_office'));
                                        }
                                        else{
                                                redirect(site_url('home/admin_panel'));
                                        }
                                }
                                else
                                {
                                        $qResult = $this->m_home->uploadfileData($file_ext, $postval); // returns $returnMsg as an integer if successful

                                }
        
                                if (is_numeric($qResult))
                                {
                                        $this->session->set_flashdata('uploadcheck', 1);
                                        $fileTitle = $fileInfo['title'];
                                        $this->send_email($postval);
                                        $this->unread_notification($qResult);
                                        if($_SESSION['user_type'] == 'Office Admin'){
                                                redirect(site_url('home/do_office'));
                                        }
                                        else{
                                                redirect(site_url('home/admin_panel'));
                                        }
                                }
                                else
                                {
                                        echo '<br>'.$qResult;
                                }
                                
                        }
                        
                }
                

                else
                {
		        $this->data['errorArray']= $errorArray;
                        $viewfile = 'upload_failed';
                        $this->data['title']= 'UPLOAD FILE';
                        $this->load->template($viewfile, $this->data, false, true);
                }
                
        }

        function download($filename = NULL)
        {
                if($filename){
                        $this->m_home->incrementDownloadCount($filename);
                        $data = file_get_contents(base_url('assets/files/'.$filename));
                        force_download($filename, $data);
                }
                else;
        }

        function download_form($filename = NULL)
        {
                if($filename){
                        $this->m_home->incrementFormCount($filename);
                        $data = file_get_contents(base_url('assets/downloads/'.$filename));
                        force_download($filename, $data);
                }
                else;
        }

        function view($filename = NULL)
        {
                if ($filename) {
                        $this->m_home->incrementViewCount($filename); // Increment the view count

                        //$file_path = base_url('assets/files/'.$filename);
                        //echo '<script>window.open("'.$file_path.'", "_blank");</script>';
                } 
                else;
        }




        function delete($file_ID = '', $data = '')
	{	
		if(!$file_ID)
		{
			redirect(base_url('home/admin_panel'));
		}

                $eventID = $this->m_home->getEventID($file_ID);
                $issuanceID = $this->m_home->getGroupID($file_ID);

                $this->db->trans_start();

                $this->db->where('file_ID', $file_ID);
                $this->db->delete('phin_tb');

                if ($eventID) {
                        $this->db->where('event_ID', $eventID);
                        $this->db->delete('event_tb');
                }

                if ($issuanceID) {
                        $this->db->where('issuance_ID', $issuanceID);
                        $this->db->delete('issuance_tb');
                }

                $this->db->trans_complete(); 

                if ($this->db->trans_status() === false)
                {
                	$dbError = $this->db->error();
			echo 'Failed to delete file<br>
			<button type="button" onclick="javascript:window.location.href=\''.site_url("downloads/downloads").'\'">Go Back</button>';
		}
		else
		{
			unlink('./assets/files/'.$data);
			redirect(base_url('home/admin_panel'));
		}
	}

        function delete_form($file_ID = '', $data = '')
	{	
		if(!$file_ID)
		{
			redirect(base_url('home/do_download'));
		}

                $this->db->trans_start();
                $this->db->where('file_ID', $file_ID);
                $this->db->delete('forms_tb');
                $this->db->trans_complete(); 

                if ($this->db->trans_status() === false)
                {
                	$dbError = $this->db->error();
			echo 'Failed to delete file<br>
			<button type="button" onclick="javascript:window.location.href=\''.site_url("downloads/downloads").'\'">Go Back</button>';
		}
		else
		{
			unlink('./assets/downloads/'.$data);
			redirect(base_url('home/do_download'));
		}
	}

        public function delete_file_action()
        {
                $file_ID = $this->input->post('file_ID');
                $file_name = $this->input->post('file_name');

                if (!$file_ID || !$file_name) {
                        // Handle errors if needed
                        echo 'Error: Missing file_ID or file_name';
                        return;
                }

                $eventID = $this->m_home->getEventID($file_ID);
                $this->db->trans_start();

                $this->db->where('file_ID', $file_ID);
                $this->db->delete('phin_tb');

                if ($eventID) {
                        $this->db->where('event_ID', $eventID);
                        $this->db->delete('event_tb');
                }
        
                $this->db->trans_complete();
        
                if ($this->db->trans_status() === false) 
                {
			$dbError = $this->db->error();
			echo 'Failed to delete file<br>
			<button type="button" onclick="javascript:window.location.href=\''.site_url("downloads/downloads").'\'">Go Back</button>';
		}
		else
		{
			unlink('./assets/files/'.$file_name);
			redirect(base_url('home/admin_panel'));
		}
        }


        function test_input($data)
	{
		$data = trim($data);
		$data = stripslashes($data);
		$data = htmlspecialchars($data);
		return $data;
	}

        function user_approve($user_id = '')
        {
                if(!$user_id)
		{
			redirect(base_url('home/admin_panel'));
		}
		$tQuery = "UPDATE user_tb SET user_status = 'Active' WHERE user_id = ".$user_id ."";
		$fQuery = $this->db->query($tQuery);
		if(!$fQuery)
		{
			$dbError = $this->db->error();
			echo 'Failed to approve user<br>
			<button type="button" onclick="javascript:window.location.href=\''.base_url("home/admin_panel").'\'">Go Back</button>';
		}
		else
		{
			redirect(base_url('home/admin_panel'));
		}
        }

        public function update_status()
        {
                $userId = $this->input->post('userId');
                $newStatus = $this->input->post('newStatus');

                // Update the user status in the database using your model function
                $this->m_home->updateUserStatus($userId, $newStatus);

                // Return a response if needed
                echo 'User status updated successfully';
        }

        public function update_usertype()
        {
                $userId = $this->input->post('userId');
                $newType = $this->input->post('newType');

                // Update the user status in the database using your model function
                $this->m_home->updateUserType($userId, $newType);

                // Return a response if needed
                echo 'User type updated successfully';
        }

        public function update_office()
        {
                $userId = $this->input->post('userId');
                $newOffice = $this->input->post('newOffice');

                // Update the user status in the database using your model function
                $this->m_home->updateUserOffice($userId, $newOffice);

                // Return a response if needed
                echo 'User office updated successfully';
        }

        function open_bulk(){
                $this->load->view('upload_bulk');
        }

        public function upload_bulk()
        {
                if (isset($_POST['submit'])) {
                        $uploadedFilesArray = array(); // Array to store file details for each file

                        $config['upload_path']      = './assets/files/';
                        $config['allowed_types']    = 'xls|xlsx|ppt|pptx|pdf|docx|doc|zip|rar';
                        $config['max_size']         = 0;
                        $config['max_width']        = 20000;
                        $config['max_height']       = 20000;

                        $this->load->library('upload', $config);

                        foreach ($_FILES['userfile']['name'] as $index => $filename) {
                                // Get the sanitized filename from $_FILES
                                $sanitizedFilename = $_FILES['userfile']['name'][$index];

                                // Manually restore underscores to the sanitized filename
                                $filenameWithUnderscores = str_replace('_', ' ', $sanitizedFilename);

                                // Extract the file extension for each file
                                $file_ext = pathinfo($filename, PATHINFO_EXTENSION);

                                // Replace spaces back with underscores in the filename
                                $filenameWithUnderscores = str_replace(' ', '_', $filenameWithUnderscores);

                                $today = $_POST['file_date_created'];

                                // Handle each file individually
                                $_FILES['file']['name']     = $filename;
                                $_FILES['file']['type']     = $_FILES['userfile']['type'][$index];
                                $_FILES['file']['tmp_name'] = $_FILES['userfile']['tmp_name'][$index];
                                $_FILES['file']['error']    = $_FILES['userfile']['error'][$index];
                                $_FILES['file']['size']     = $_FILES['userfile']['size'][$index];

                                if (!$this->upload->do_upload('file')) {
                                        // File upload failed
                                        $error = $this->upload->display_errors();
                                        echo $error;
                                } 
                                else {
                                        // File upload succeeded
                                        $fileData = array(
                                        'filename' => $filenameWithUnderscores, // Use the filename with underscores
                                        'extension' => $file_ext,
                                        'file_date_created' => $today
                                        );
                                        // Add file details to the array
                                        $uploadedFilesArray[] = $fileData;
                                }
                        }

                        $groupFiles = isset($_POST['group_files']) ? true : false;

                        if (!empty($uploadedFilesArray)) {
                                // Call the model function to insert file details into the database
                                $result = $this->m_home->bulk_upload_files($uploadedFilesArray, $groupFiles);

                                if ($result) {
                                        $this->session->set_flashdata('bulkuploadcheck', 1);
                                        if($_SESSION['user_type'] == 'Office Admin'){
                                                redirect(site_url('home/do_office'));
                                        }
                                        else{
                                                redirect(site_url('home/admin_panel'));
                                        }
                                        
                                } 
                                else {
                                        $this->session->set_flashdata('bulkuploadcheck', 2);
                                        if($_SESSION['user_type'] == 'Office Admin'){
                                                redirect(site_url('home/do_office'));
                                        }
                                        else{
                                                redirect(site_url('home/admin_panel'));
                                        }
                                }
                        } 
                        else {
                                $this->session->set_flashdata('bulkuploadcheck', 3);
                                if($_SESSION['user_type'] == 'Office Admin'){
                                        redirect(site_url('home/do_office'));
                                }
                                else{
                                        redirect(site_url('home/admin_panel'));
                                }
                        }
                }
                
        }

        public function file_details() {
                $dataID = $this->input->post('dataID');
                $data = array(
                        'dataID' => $dataID
                );
                $this->load->view('downloads/file_data', $data);
        }

        public function person_details(){
                $dir_id = $this->input->post('dir_id');
                $data = array(
                        'dir_id' => $dir_id
                );
                $this->load->view('directory_view', $data);
        }

        public function person_print(){
                $dir_id = $this->input->get('dir_id');
                $data = array(
                        'dir_id' => $dir_id
                );
                $this->load->view('directory_print', $data);
        }

        public function upload_form()
        {
                if (isset($_POST['submit'])) {
                        $uploadedFilesArray = array(); // Array to store file details for each file

                        $config['upload_path']      = './assets/downloads/';
                        $config['allowed_types']    = 'xls|xlsx|ppt|pptx|pdf|docx|doc|zip|rar';
                        $config['max_size']         = 0;
                        $config['max_width']        = 20000;
                        $config['max_height']       = 20000;

                        $this->load->library('upload', $config);

                        foreach ($_FILES['userfile']['name'] as $index => $filename) {
                                // Get the sanitized filename from $_FILES
                                $sanitizedFilename = $_FILES['userfile']['name'][$index];

                                // Manually restore underscores to the sanitized filename
                                $filenameWithUnderscores = str_replace('_', ' ', $sanitizedFilename);

                                // Extract the file extension for each file
                                $file_ext = pathinfo($filename, PATHINFO_EXTENSION);

                                // Replace spaces back with underscores in the filename
                                $filenameWithUnderscores = str_replace(' ', '_', $filenameWithUnderscores);

                                $today = $_POST['file_date_created'];

                                // Handle each file individually
                                $_FILES['file']['name']     = $filename;
                                $_FILES['file']['type']     = $_FILES['userfile']['type'][$index];
                                $_FILES['file']['tmp_name'] = $_FILES['userfile']['tmp_name'][$index];
                                $_FILES['file']['error']    = $_FILES['userfile']['error'][$index];
                                $_FILES['file']['size']     = $_FILES['userfile']['size'][$index];

                                if (!$this->upload->do_upload('file')) {
                                        // File upload failed
                                        $error = $this->upload->display_errors();
                                        echo $error;
                                } 
                                else {
                                        // File upload succeeded
                                        $fileData = array(
                                                'filename' => $filenameWithUnderscores, // Use the filename with underscores
                                                'extension' => $file_ext,
                                                'category' => $_POST['category']
                                        );
                                        // Add file details to the array
                                        $uploadedFilesArray[] = $fileData;
                                }
                        }

                        if (!empty($uploadedFilesArray)) {
                                // Call the model function to insert file details into the database
                                $result = $this->m_home->uploadForm($uploadedFilesArray);

                                if ($result) {
                                        $this->session->set_flashdata('bulkuploadcheck', 1);
                                        redirect(site_url('home/admin_panel'));
                                } 
                                else {
                                        $this->session->set_flashdata('bulkuploadcheck', 2);
                                        redirect(site_url('home/admin_panel'));
                                }
                        } 
                        else {
                                $this->session->set_flashdata('bulkuploadcheck', 3);
                                redirect(site_url('home/admin_panel'));
                        }
                }
        }

        public function uploadFile(){
                $this->load->view('upload_file');
        }

        public function uploadForm(){
                $this->load->view('upload_form');
        }

        public function viewdir(){
                $this->load->view('directory_view');
        }
        
        public function processform()
	{
		// echo '<pre>';
		// echo 'this is model';
		// print_r($_POST);
		// die();

		
		log_message("error", json_encode($_REQUEST)); //Subject=office topic=team
		$errorCnt = 0;
		if ($_SERVER["REQUEST_METHOD"] == "POST") {
			$required_List = [
				'per_name'	=> ['caption' =>	'dir_name', 'required' => true],
                                'position'	=> ['caption' =>	'dir_position', 'required' => true],
                                'sector'	=> ['caption' =>	'dir_sector', 'required' => true],
				'office'	=>	['caption' =>	'dir_office', 'required' => false],
				'topic'	=>	['caption' =>	'dir_team', 'required' => false],
				'contact'	=>	['caption' =>	'dir_contact', 'required' => false],
				'local'	=>	['caption' =>	'dir_local', 'required' => false]	
		];
		$postval = [];
		foreach($required_List as $fld => $mess)
		{
			if( $mess['required'] && (empty($_POST[$fld]) || trim($_POST[$fld]) == '' ) ) 
			{
				$tmp = $fld.'Err';
				$$tmp = $mess['caption']." is required";
				$errorArray[] = $$tmp;
				$errorCnt++;
				// echo '<pre>';
				// echo 'this is model';
				// print_r($data);
				// die();
				
			} else {
				$$fld = $this->test_input($_POST[$fld]);
				$postval[$fld] = $$fld;
			}
		}
			
			if( $errorCnt == 0)
			{
			echo "<h2>Your Input:</h2>";
			echo implode("<br>",$postval);
			$qResult = '';
			if(isset($_POST['dir_id']) && $_POST['dir_id'] <>'')
			{
				//UPDATE OR EDIT data
				$qResult = $this->m_home->updateData($_POST['dir_id'],$postval);
                                
			}
			else
			{
				//INSERT OR ADD NEW data
				$qResult = $this->m_home->insertData($postval);
			}
			//echo $this->m_home->insertData($postval);
			//$insertResult = $this->m_home->insertData($postval);
			if (is_numeric($qResult))
				{
					redirect(site_url('home/directory'));
				}
				else
				{
					echo '<br>'.$qResult;
				}
			}
			else
			{
				echo "<h2>Invalid Input:</h2>";
				echo implode("<br>",$errorArray);
			?>
			<br><br>
			<button type='button' class="btn btn-secondary" onclick="javascript:window.location.href='<?php echo site_url('home'); ?>'"> Return to Home</button>  
			<button type='button' class="btn btn-secondary" onclick="javascript:window.location.href='<?php echo site_url('home/addform'); ?>'">Add New Personnel</button>
			
			<?php
			}
		}
	else{show_404(); }
	}

        public function send_email($fileInfo) {
                $this->load->library('email');
                $this->load->helper('url'); 

                $fileTitle = $fileInfo['title'];
                $isExclusive = $fileInfo['isExclusive'];
                $email_list = $this->m_home->getActiveUsers(); //Gets Active users from the database
                

                $this->email->from('noreply@philhealth.gov.ph', 'noreply@philhealth.gov.ph');
                $this->email->bcc($email_list);
                $this->email->subject('There\'s a new post in the Intranet!');
                $this->email->set_mailtype("html");

                if ($isExclusive == 'Yes') {
                        $fileOffice = $fileInfo['office'];
                        $filteredEmailList = $this->m_home->getFilteredUsers($fileOffice);
                        $this->email->bcc($filteredEmailList); // Update bcc with the filtered list
                        $email_content = $this->load->view('email_message', ['fileTitle' => $fileTitle, 'fileOffice' => $fileOffice], TRUE);
                } 
                else {
                        // If the file is not exclusive, send to everyone as is
                        $this->email->bcc($email_list);
                        $email_content = $this->load->view('email_message', ['fileTitle' => $fileTitle], TRUE);
                }

                $this->email->message($email_content);
        
                if ($this->email->send()) {
                        $this->session->set_flashdata('emailcheck', 1);
                } 
                else {
                        $this->session->set_flashdata('emailcheck', 2);
                }
        }        
}
?>