<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//log_message("error", "Models/Home is loaded");

class notification_Model extends CI_Model
{
	public function getUnreadNotifications($user_id){
		$this->db->select('n.notification_id, n.user_id, n.file_id, n.is_read, n.created_at, p.file_title');
		$this->db->from('notifications_tb n');
		$this->db->join('phin_tb p', 'n.file_id = p.file_ID', 'inner');
		$this->db->where('n.is_read', 0);
		$this->db->where('n.user_id', $user_id);
		$this->db->order_by('n.created_at', 'desc');
		return $this->db->get()->result_array();
	}

	public function insertNotification($user_id, $message){
		$data = array(
			'user_id' => $user_id,
			'message' => $message,
			'created_notif' => date('Y-m-d H:i:s'),
			'read' => 0 // Notification is initially unread
		);
		$this->db->insert('notif_test', $data);
	}

	public function markAsRead($notification_id){
		$this->db->where('id', $notification_id);
		$this->db->update('notif_test', array('read' => 1));
	}

}	//End
?>