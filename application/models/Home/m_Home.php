<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//log_message("error", "Models/Home is loaded");

class m_Home extends CI_Model
{
	public $CI;

	function __construct()
	{
		parent::__construct();
		$this->CI =& get_instance();
		$this->load->library('toastr');
	}


	function getfileData($file_ID='')
	{
		$tQuery = "
		SELECT * FROM phin_tb
		";

		if($file_ID)
		{
			$tQuery .= " WHERE file_ID = ".$file_ID;
		}

		$fQuery = $this->db->query($tQuery);

		if($file_ID)
		{
			$result = $fQuery->row_array();
		}
		else
		{
			$result = $fQuery->result_array();
		}
		return $result;
	}

	function getEventData()
	{
		$tQuery = "
		SELECT phin_tb.*, event_tb.*
		FROM phin_tb
		JOIN event_tb ON phin_tb.file_ID = event_tb.file_ID
		WHERE event_tb.isEvent = 'Yes'
		";

		$fQuery = $this->db->query($tQuery);
		$result = $fQuery->result_array();

		return $result;
	}


	function filterIssuances($file_category='')
	{
		$tQuery = "
		SELECT * FROM phin_tb
		";

		if($file_category)
		{
			$tQuery .= " WHERE file_category = ".$file_category;
		}

		$fQuery = $this->db->query($tQuery);

		if(!$file_category)
		{
			$result = $fQuery->row_array();
		}
		else
		{
			$result = $fQuery->result_array();
		}
		return $result;
	}

	// function filterIssuances($file_category='')
	// {
	// 	$tQuery = "SELECT p.*, i.issuance_ID
	// 		FROM phin_tb p
	// 		LEFT JOIN issuance_tb i ON p.file_ID = i.file_ID";

	// 	if($file_category)
	// 	{
	// 		$tQuery .= " WHERE p.file_category = " . $file_category;
	// 	}

	// 	// $tQuery .= " AND i.issuance_ID IS NOT NULL";
	// 	$tQuery .= " ORDER BY p.file_date_created DESC";

	// 	$fQuery = $this->db->query($tQuery);

	// 	if(!$file_category)
	// 	{
	// 		$result = $fQuery->row_array();
	// 	}
	// 	else
	// 	{
	// 		$groupedData = [];
	// 		foreach ($fQuery->result_array() as $row) {
	// 		$issuanceID = $row['issuance_ID'];

	// 		// Use a conditional check to treat null values separately
	// 		if ($issuanceID === null) {
	// 			// Handle null values as a special case
	// 			if (!isset($groupedData['null'])) {
	// 			$groupedData['null'] = [];
	// 			}
	// 			$groupedData['null'][] = $row;
	// 		} else {
	// 			// Treat non-null values normally
	// 			if (!isset($groupedData[$issuanceID])) {
	// 				$groupedData[$issuanceID] = [];
	// 				}
	// 				$groupedData[$issuanceID][] = $row;
	// 			}
	// 		}
	// 		$result = array_values($groupedData); // Convert back to indexed array

	// 		// To see the grouped data
	// 		echo "<pre>";
	// 		print_r($groupedData);
	// 		echo "</pre>";
	// 	}
	// 	return $result;
	// }

	function uploadfileData($file_ext = '', $postval = '')
	{
		$eventStart = date('Y-m-d', strtotime($postval['event_Start']));
		$eventEnd = date('Y-m-d', strtotime($postval['event_End']));
		$tQuery = [
			'file_name' => $this->db->escape_str($file_ext['basename']),
			'file_extension' => $this->db->escape_str($file_ext['extension']),
			'file_category' => $this->db->escape_str($postval['category']),
			'file_details' => $this->db->escape_str($postval['details']),
			'file_date_created' => $this->db->escape_str($postval['created']),
			'file_date_updated' => $this->db->escape_str($postval['updated']),
			'file_title' => $this->db->escape_str($postval['title']),
			'file_originating_office' => $this->db->escape_str($postval['office']),
			'file_originating_team' => $this->db->escape_str($postval['team']),
			'file_position' => $this->db->escape_str($postval['position']),
			'isExclusive' => $this->db->escape_str($postval['isExclusive'])
		];
		$this->db->insert('phin_tb', $tQuery);
		$fileID = $this->db->insert_id();

		// Insert/update data into event_tb based on isEvent value
		if ($postval['isEvent'] === 'Yes') {
			$eventData = [
			'file_ID' => $fileID,
			'isEvent' => $postval['isEvent'],
			'event_Start' => $eventStart,
			'event_End' => $eventEnd
			];

			$this->db->insert('event_tb', $eventData);
		}

		if(!$tQuery)
		{
			$dbError = $this->db->error();
			log_message("error", json_encode($dbError));
		}
		else
		{
			$db_lastinsert = $this->db->insert_id();
			$returnMsg = $db_lastinsert;
		}
		return $returnMsg;
	}

	function updatefileData($file_ID = '', $postval = '')
	{
		$returnMsg = 'Failed to Update Entry';
		if( $file_ID && is_array($postval))
		{
			$tQuery = [
				'file_title' => $this->db->escape_str($postval['title']),
				'file_position' => $this->db->escape_str($postval['position']),
				'file_originating_office' => $this->db->escape_str($postval['office']),
				'file_originating_team' => $this->db->escape_str($postval['team']),
				'file_category' => $this->db->escape_str($postval['category']),
				'file_details' => $this->db->escape_str($postval['details']),
				'file_date_created' => $this->db->escape_str($postval['created']),
				'file_date_updated' => $this->db->escape_str($postval['updated']),
			];

			$this->db->where('file_ID', $file_ID);
        		$this->db->update('phin_tb', $tQuery);
			if ($postval['isEvent'] === 'Yes') {
				$eventStart = date('Y-m-d', strtotime($postval['event_Start']));
				$eventEnd = date('Y-m-d', strtotime($postval['event_End']));
			
				$eventData = [
					'isEvent' => $postval['isEvent'],
					'event_Start' => $eventStart,
					'event_End' => $eventEnd,
				];
		
				// Update or insert event_tb data
				$eventID = $this->getEventID($file_ID); // Implement a function to get event ID
				if ($eventID) {
					$this->db->where('event_ID', $eventID);
					$this->db->update('event_tb', $eventData);
				} else {
					$eventData['file_ID'] = $file_ID;
					$this->db->insert('event_tb', $eventData);
				}
				} else {
				// Delete event_tb data if isEvent is 'No'
				$this->db->where('file_ID', $file_ID);
				$this->db->delete('event_tb');
			}

			if(!$tQuery)
			{
				$dbError = $this->db->error();
				log_message("error", json_encode($dbError));
			}
			else
			{
				$returnMsg = 1;
			}
		}
		return $returnMsg;
	}

	function getEventID($file_ID)
	{
		$this->db->select('event_ID');
		$this->db->from('event_tb');
		$this->db->where('file_ID', $file_ID);
		$query = $this->db->get();

		if ($query->num_rows() > 0) {
			return $query->row()->event_ID;
		} 
		else {
			return false;
		}
	}

	function getGroupID($file_ID)
	{
		$this->db->select('issuance_ID');
		$this->db->from('issuance_tb');
		$this->db->where('file_ID', $file_ID);
		$query = $this->db->get();

		if ($query->num_rows() > 0) {
			return $query->row()->issuance_ID;
		} 
		else {
			return false;
		}
	}

	function getGroupData()
	{
		$tQuery = "
		SELECT phin_tb.*, issuance_tb.*
		FROM phin_tb
		JOIN issuance_tb ON phin_tb.file_ID = issuance_tb.file_ID
		";

		$fQuery = $this->db->query($tQuery);
		$result = $fQuery->result_array();

		return $result;
	}

	function bulk_upload_files($fileDetailsArray, $groupFiles) 
	{
		if ($groupFiles) {
			// Get the latest non-null issuance_ID from the issuance_tb table
			$lastIssuanceQuery = $this->db->query("SELECT MAX(issuance_ID) AS last_issuance_id FROM issuance_tb WHERE issuance_ID IS NOT NULL");
			$lastIssuanceResult = $lastIssuanceQuery->row();
			$lastIssuanceID = $lastIssuanceResult->last_issuance_id;
			$newIssuanceID = $lastIssuanceID + 1;
		} else {
			$newIssuanceID = null;
		}

		foreach ($fileDetailsArray as $fileData) {
			$file_name = $this->db->escape_str($fileData['filename']);
			$file_extension = $this->db->escape_str($fileData['extension']);
			$file_date_created = $this->db->escape_str($fileData['file_date_created']);
		
		
			$fileData = [
				'file_name' => $file_name,
				'file_extension' => $file_extension,
				'file_date_created' => $file_date_created
			];
		
			// Insert the file data into phin_tb
			$this->db->insert('phin_tb', $fileData);
			$fileID = $this->db->insert_id();

			if ($groupFiles) {
				$issuanceData = [
					'file_ID' => $fileID,
					'issuance_ID' => $newIssuanceID
				];
				$this->db->insert('issuance_tb', $issuanceData);
			}
		}
		return true;
	}

	function uploadForm($fileArray) 
	{
		foreach ($fileArray as $fileData) {
			$file_name = $this->db->escape_str($fileData['filename']);
			$file_extension = $this->db->escape_str($fileData['extension']);
			$category = $this->db->escape_str($fileData['category']);
		
			$fileData = [
				'file_name' => $file_name,
				'file_extension' => $file_extension,
				'file_category' => $category,
			];
		
			// Insert the file data into phin_tb
			$this->db->insert('forms_tb', $fileData);
			$fileID = $this->db->insert_id();
		}
		return true;
	}

	public function incrementDownloadCount($filename) 
	{
		$this->db->where('file_name', $filename);
		$this->db->set('file_download_count', 'file_download_count + 1', FALSE);
		$this->db->update('phin_tb');
	}

	public function incrementFormCount($filename) 
	{
		$this->db->where('file_name', $filename);
		$this->db->set('file_download_count', 'file_download_count + 1', FALSE);
		$this->db->update('forms_tb');
	}

	public function incrementViewCount($filename)
	{
		$this->db->where('file_name', $filename);
		$this->db->set('file_view_count', 'file_view_count + 1', FALSE);
		$this->db->update('phin_tb');
	}

	function getformData($file_ID='')
	{
		$tQuery = "
		SELECT * FROM forms_tb
		";

		if($file_ID)
		{
			$tQuery .= " WHERE file_ID = ".$file_ID;
		}

		$fQuery = $this->db->query($tQuery);
		$result = $fQuery->result_array();
		return $result;
	}
	    

//function===============================================================================================
	function getlistData($DataID = '')
	{
		//to get the table data
		$sQuery = "select * from phin_tb";
		
		if($DataID)
		{
			$sQuery .= " where DataID = ".$DataID;
		}
		$gQuery = $this->db->query($sQuery);
		if($DataID)
		{
			$result = $gQuery->row_array();
		}
		else
		{
			$result = $gQuery->result_array();
		}
		return $result;
			
			
	}
		
	function getuserData()
	{
		$tQuery = "SELECT * FROM user_tb";
		$fQuery = $this->db->query($tQuery);
		$result = $fQuery->result_array();
		return $result;
	}

	function getActiveUsers(){
		$this->db->select('user_email');
		$this->db->from('user_tb');
		$this->db->where('user_status', 'Active');
		$query = $this->db->get();
		return array_column($query->result_array(), 'user_email');
	}

	function getFilteredUsers($fileOffice){
		$this->db->select('user_email');
		$this->db->from('user_tb');
		$this->db->where('user_status', 'Active');
		$this->db->where('user_office', $fileOffice);
		$query = $this->db->get();
		return array_column($query->result_array(), 'user_email');
	}

	function updateUserStatus($userID, $newStatus) 
	{
		$data = array(
			'user_status' => $newStatus
		);
	
		$this->db->where('user_id', $userID);
		$this->db->update('user_tb', $data);
	}

	function updateUserType($userID, $newType) 
	{
		$data = array(
			'user_type' => $newType
		);
	
		$this->db->where('user_id', $userID);
		$this->db->update('user_tb', $data);
	}

	function updateUserOffice($userID, $newOffice) 
	{
		$data = array(
			'user_office' => $newOffice
		);
	
		$this->db->where('user_id', $userID);
		$this->db->update('user_tb', $data);
	}
	    

	function loginCheck()
	{
		$email = $this->input->post('user_email');
		$input_password = $this->input->post('user_password');
		$stored_hashed_password = $this->db->get_where('user_tb', ['user_email' => $email])->row()->user_password;
		$query = $this->db->get_where('user_tb', ['user_email' => $email]);
		$find_user = $query->num_rows();
		if ($find_user == 1) {
			$result = $query->row();
			$user_id = $result->user_id;
			$name = $result->user_name;
			$type = $result->user_type;
			$status = $result->user_status;
			$office = $result->user_office;

			if ($status == 'Active' && password_verify($input_password, $stored_hashed_password)) {
				// Password matches and user is active, allow login
				$this->session->set_userdata('user_id', $user_id);
				$this->session->set_userdata('user_name', $name);
				$this->session->set_userdata('user_office', $office);
				$this->session->set_userdata('user_email', $email);
				$this->session->set_userdata('user_type', $type);
				$this->session->set_userdata('user_status', $status);
				$this->session->set_flashdata('logcheck', 1);
				redirect(site_url('home'));
			} 
			elseif ($status == 'Inactive' && password_verify($input_password, $stored_hashed_password)) {
				$this->session->set_flashdata('info', "Account has been set as inactive.");
				redirect(site_url('home/login'));
			} 
			elseif ($status == 'Pending' && password_verify($input_password, $stored_hashed_password)) {
				$this->session->set_flashdata('info', "Account hasn't been verified yet!");
				redirect(site_url('home/login'));
			}
		}

		// If user doesn't exist or password doesn't match, show invalid login message
		$this->session->set_flashdata('warning', 'Email or password is invalid!');
		redirect(site_url('home/login'));
	}

	function approve_user($user_id='')
	{ 
		$data = array(
			'user_status' => 'Active'
		);
		
		$this->db->where('user_id', $user_id);
		$this->db->update('user_tb', $data);
		redirect(site_url('home/admin_panel'));
	}

	function getlistData1($dir_id = '')
	{
		//to get the table data
		$sQuery = "select * from directory_tb";
		
		if($dir_id)
		{
			$sQuery .= " where dir_id = ".$dir_id;
		}
		$gQuery = $this->db->query($sQuery);
		if($dir_id)
		{
			$result = $gQuery->row_array();
		}
		else
		{
			$result = $gQuery->result_array();
		}
		return $result;
				
	}	

	function insertData($data = '') //Subject=office topic=team
	{
		$returnMessage = 'Failed to Insert Submitted Form!';
		if ( is_array($data) )
		{
			//process the data
			$iquery = " INSERT into directory_tb(`dir_name`, `dir_position`, `dir_sector`,`dir_office`, `dir_team`, `dir_contact`, `dir_local`)
			Values (
			'".$data['per_name']."',
			'".$data['position']."',
			'".$data['sector']."',
			'".$data['office']."',
			'".$data['topic']."',
			'".$data['contact']."',
			'".$data['local']."'
			)";
			
			//Alternative Insert  Command
			//$iquery = $this->db->insert_string('brandnewtable', $data);
			$rquery = $this->db->query($iquery);
			if(!$rquery)
			{
				$dbError = $this->db->error();
				log_message("error", json_encode($dbError));
			}
			else
			{
				$db_lastinsert_id = $this->db->insert_id();
				$returnMessage = $db_lastinsert_id;
				log_message("error", json_encode($rquery));
			}
		}
		
		return $returnMessage;
				
	}
	
	function updateData($dir_id = '',$data = '')
	{
		$returnMessage = 'Failed to Update Selected Data Form!';
		
		if($dir_id && is_array($data) )
		{
			//Process the Data
			$iquery = " UPDATE directory_tb SET
			dir_name = ".$this->db->escape($data['per_name']).",
			dir_position = ".$this->db->escape($data['position']).",
			dir_sector = ".$this->db->escape($data['sector']).",
			dir_office = ".$this->db->escape($data['office']).",
			dir_team = ".$this->db->escape($data['topic']).",
			dir_contact = ".$this->db->escape($data['contact']).",
			dir_local = ".$this->db->escape($data['local'])."
			WHERE dir_id = ".$dir_id ."
			";
			
			$rquery = $this->db->query($iquery);
		
			if(!$rquery)
			{
				$dbError = $this->db->error();
				log_message("error", json_encode($dbError));
			}
			else
			{
				$returnMessage = 1;
				log_message("error", json_encode($rquery));
			}
		}
		return $returnMessage;
	}

	function viewdirData($dir_id = '')
	{
		//to get the table data
		$sQuery = "select * from directory_tb";
		
		if($dir_id)
		{
			$sQuery .= " where dir_id = ".$dir_id;
		}
		$gQuery = $this->db->query($sQuery);
		if($dir_id)
		{
			$result = $gQuery->row_array();
		}
		else
		{
			$result = $gQuery->result_array();
		}
		return $result;
				
	}

	function printdirData($dir_id = ''	)
	{
		//to get the table data
		$sQuery = "select * from directory_tb";
		
		if($dir_id)
		{
			$sQuery .= " where dir_id = ".$dir_id;
		}
		$gQuery = $this->db->query($sQuery);
		if($dir_id)
		{
			$result = $gQuery->row_array();
		}
		else
		{
			$result = $gQuery->result_array();
		}
		return $result;
				
	}

	function fetch_Office()
	{
		$this->db->distinct();
		$this->db->select('office_name','ASC');
		$query = $this->db->get('office');
		return $query->result();
	}
	
	function getoffice($sector)
	{
		$this->db->select('office')
					->distinct()
					->where('sector', $sector);
        $office = $this->db->get('sec_tb')->result_array();
	
		$this->db->last_query();
        return $office;
	}

	function getdivision($office)
	{
		
		$this->db->select('division')
					->distinct()
					->where('office', $office);
        	$division = $this->db->get('sec_tb')->result_array();
	
		$this->db->last_query();
        	return $division;
	}

	public function getEntryDataById($dirID) {
		// Replace 'your_table_name' with the actual name of your database table
		$this->db->where('dir_id', $dirID);
		$query = $this->db->get('directory_tb');
	
		// Check if a result exists
		if ($query->num_rows() > 0) {
		    	return $query->row_array(); // Return the first row as an associative array
		} else {
		   	return false; // Return false if no data is found for the given dir_id
		}
	}

}//End
?>