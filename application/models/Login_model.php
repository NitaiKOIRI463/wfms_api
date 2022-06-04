<?php  
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Login_model extends CI_Model
{
  public function __construct() 
  {
     parent::__construct();
     
  }


  public function verifyUserIdExistOrNot($userId)
  {
      $result = $this->db->select('count(id) as total')
      ->from('tbl_registration_master')
      ->where(['member_id'=>$userId,'status'=>1])
      ->get()->result_array();
      if(!empty($result))
      {
         return $result[0]['total'];
      }else
      {
         return 0;
      }
  }

  public function getUserIdDetails($userId)
  {
      $result = $this->db->select('member_id,password,role_type,name,gender,block_status')
      ->from('tbl_registration_master')
      ->where(['member_id'=>$userId,'status'=>1])
      ->get()->result_array();
      if(!empty($result))
      {
         return $result[0];
      }else
      {
         return 105;
      }
  }




}
   
?>