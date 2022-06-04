<?php  
if (!defined('BASEPATH')) exit('No direct script access allowed');

class AssignDevice_model extends CI_Model
{
  public function __construct() 
  {
     parent::__construct();
     
  }

  public function assignDeviceUpdate_m($data,$where)
  {
      return $this->db->update('tbl_device_allotment_details',$data,$where);
  }

  public function assignDevice_m($data)
  {
      return $this->db->insert('tbl_device_allotment_details',$data);
  }

  public function assignDeviceMasterUpdate_m($data,$where)
  {
      return $this->db->update('tbl_device_master',$data,$where);
  }




}
   
?>