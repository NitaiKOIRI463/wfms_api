<?php  
if (!defined('BASEPATH')) exit('No direct script access allowed');

class AdminDashboard_model extends CI_Model
{
    public function __construct() 
    {
       parent::__construct();
       
    }

    public function get_total_company_m()
    {
    	$result = $this->db->select('count(id) as total')->from('tbl_company_registration')->where(['status'=>1])->get()->result_array();
    	return $result[0]['total'];
    }

    public function get_total_flow_id_m()
    {
    	$result = $this->db->select('count(id) as total')->from('tbl_device_allotment_details')->where(['status'=>1])->group_by('flow_id')->get()->result_array();
    	return $result[0]['total'];
    }

    public function DeviceDetails_m()
	  {
	    return $this->db->select('g.log_date_time,d.company_code,c.company_name,d.flow_id as device_id,TIMESTAMPDIFF(MINUTE,g.log_date_time,now()) as online_minutes')
	              ->from('tbl_device_allotment_details d')
	              ->join('tbl_company_registration c','c.company_code=d.company_code','left')
	              ->join('tbl_device_master f','f.device_id=d.flow_id','left')
	              ->join('device_status_log g','g.imei_no=f.imei_no','left')
	              ->where(['d.status'=>1,'f.current_status'=>1])
	              ->get()
	              ->result_array();
	  }




}