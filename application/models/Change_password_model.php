<?php 
	if (!defined('BASEPATH')) exit('No direct script access allowed');

	class Change_password_model extends CI_Model
	{
		public function __construct()
		{
			parent:: __construct();
		}

		public function getOld_password($id)
		{
			if($id !='')
				$this->db->where('id',$id);
			return $this->db->select('password')->from('tbl_user_master')->where('status',1)->get()->result_array();
		}

		public function updatePassword($id,$arrayData)
		{
			return $this->db->update('tbl_user_master',$arrayData,['id'=>$id]);
		}
	}
?>