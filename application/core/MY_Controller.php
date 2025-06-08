<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class MY_Controller extends CI_Controller{
	
	public $data;

	function __construct(){
		parent::__construct();
		$this->load->model('Home/m_home', 'm_home');
		$this->load->model('Home/notification_model', 'notification_model');
	}

	function _remap($method, $params = array())
	{
		if(method_exists($this, $method))
		{
			$params = array_slice($this->uri->rsegment_array(), 2);
			return call_user_func_array(array($this, $method), $params);
		}
		else
		{
			show_404();
			$params = array_slice($this->uri->rsegment_array(), 1);
			$this->index($params);
		}
	}

	public function getUnreadNotifications() { // Placed here to be called universally
		try{
			// Get the user ID (you might need to adjust this based on your user authentication)
			$user_id = $this->session->userdata('user_id'); // Adjust this line to fetch the user ID.
			$notifications = $this->notification_model->getUnreadNotifications($user_id);
			
			// Send the notifications as JSON
			header('Content-Type: application/json');
			echo json_encode($notifications);
		}
		catch (Exception $e) {
			// Handle the exception
			echo json_encode(['error' => $e->getMessage()]);
		}
	}

	public function unread_notification($fileID)
	{
		
		$usersToNotify = $this->userList();
		// $newFileID = $this->db->insert_id();
		// $newFileID = 70;
		$userIDs = array_column($usersToNotify, 'user_id');
		// $userIDs = array();
		// foreach($usersToNotify as $user){
		// 	$userIDs[] = $user['user_id'];
		// }

		$data = array();
		foreach ($userIDs as $userID) {
			$data[] = array(
				'user_id' => $userID,
				'file_id' => $fileID,
				'is_read' => 0
			);
		};
		$this->db->insert_batch('notifications_tb', $data);
	}

	public function userList()
	{
		return $this->db->get('user_tb')->result_array();
	}

	public function markAsRead($notification_id)
	{
		$this->notification_model->markAsRead($notification_id);
		redirect('home/test');
	}
}


?>