<?php  
if (!defined('BASEPATH')) exit('No direct script access allowed');

class DeviceProfile_model extends CI_Model
{
  public function __construct() 
  {
     parent::__construct();
     
  }

  public function DeviceDetails_m($device_id)
  {
    return $this->db->select('d.company_code,c.company_name,d.address,d.flow_id as device_id,f.device_type,f.imei_no,d.date_of_installation,d.latitude,d.longitude')
              ->from('tbl_device_allotment_details d')
              ->join('tbl_company_registration c','c.company_code=d.company_code','left')
              ->join('tbl_device_master f','f.device_id=d.flow_id','left')
              ->where(['d.flow_id'=>$device_id,'d.status'=>1])
              ->get()
              ->result_array();
  }

  public function DeviceCurrentDetails_m($imei_no)
  {
    return $this->db->query("SELECT total_flow,flow_measured,flow_rate,DATE_FORMAT(log_date_time,'%d-%m-%Y %H:%i:%s') as last_operated,TIMESTAMPDIFF(MINUTE,log_date_time,now()) as last_minutes FROM `tbl_device_log` where imei_no = '$imei_no' and status = 1 ORDER BY id DESC LIMIT 1")->result_array();
  }

  public function DeviceFlowReport_m($imei_no,$from_date,$to_date)
  {
      if($from_date!="" && $to_date!="")
            $this->db->where(['date(log_date_time)>='=>date('Y-m-d',strtotime($from_date)),'date(log_date_time)<='=>date('Y-m-d',strtotime($to_date))]);

    return $this->db->select("total_flow,flow_measured,DATE_FORMAT(log_date_time,'%d-%m-%Y %H:%i:%s') as date_time")->from('tbl_device_log')->where(['imei_no'=>$imei_no,'status'=>1])->order_by('id','dec')->get()->result_array();
  }

  public function DeviceFlowRateReport_m($imei_no,$from_date,$to_date)
  {
      if($from_date!="" && $to_date!="")
            $this->db->where(['date(log_date_time)>='=>date('Y-m-d',strtotime($from_date)),'date(log_date_time)<='=>date('Y-m-d',strtotime($to_date))]);

    return $this->db->select("flow_rate,DATE_FORMAT(log_date_time,'%d-%m-%Y %H:%i:%s') as date_time")->from('tbl_device_log')->where(['imei_no'=>$imei_no,'status'=>1])->order_by('id','dec')->get()->result_array();
  }

  




}
   
?>