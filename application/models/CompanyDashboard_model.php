<?php  
if (!defined('BASEPATH')) exit('No direct script access allowed');

   class CompanyDashboard_model extends CI_Model
   {
        public function __construct() 
        {
           parent::__construct();
           
        }
        
        public function get_total_flow_id_m($company_code)
        {
        if($company_code!="")
             $this->db->where(['company_code'=>$company_code]);
        $result = $this->db->select('count(distinct flow_id) as total')->from('tbl_device_allotment_details')->where(['status'=>1])->get()->result_array();
        return $result[0]['total'];
        }

        public function getDeviceList($company_code)
        {
         if($company_code!="")
                $this->db->where('da.company_code',$company_code);
        return $this->db->select("da.company_code,dm.imei_no,dm.device_id,dm.device_type,TIMESTAMPDIFF(MINUTE,log_date_time,now()) as last_status_minutes")
            ->from('tbl_device_allotment_details da')
            ->join('tbl_device_master dm','dm.device_id=da.flow_id','left')
            ->join('device_status_log f','f.imei_no=dm.imei_no','left')
            ->where(['da.status'=>1,'dm.current_status'=>1])->order_by('da.id','desc')->get()->result_array();
        }
   }
?>