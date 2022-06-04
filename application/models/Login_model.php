<?php  
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Login_model extends CI_Model
{
  public function __construct() 
  {
     parent::__construct();
     
  }


  public function verifyUserIdExistOrNot($email_id)
  {
      $result = $this->db->select('count(id) as total')
      ->from('tbl_user_master')
      ->where(['email_id'=>$email_id,'status'=>1])
      ->get()->result_array();
      if(!empty($result))
      {
         return $result[0]['total'];
      }else
      {
         return 0;
      }
  }

  public function getUserIdDetails($email_id)
  {
      $result = $this->db->select('u.email_id,u.password,u.company_code,c.company_name,c.logo,c.website,c.registration_date,c.expiry_date,u.role_type,u.id')
      ->from('tbl_user_master u')
      ->join('tbl_company_registration c','c.company_code=u.company_code','left')
      ->where(['u.email_id'=>$email_id,'u.status'=>1])
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