<?php  
if (!defined('BASEPATH')) exit('No direct script access allowed');

   class CompanyDashboard_model extends CI_Model
   {
        public function __construct() 
        {
           parent::__construct();
           
        }
        
        public function get_total_flow_id_m()
        {
        $result = $this->db->select('count(id) as total')->from('tbl_device_allotment_details')->where(['status'=>1])->group_by('flow_id')->get()->result_array();
        return $result[0]['total'];
        }

        public function getDeviceList($company_code)
        {
         if($company_code!="")
                $this->db->where('da.company_code',$company_code);
        return $this->db->select("da.company_code,dm.imei_no,dm.device_id,dm.device_type")
            ->from('tbl_device_allotment_details da')
            ->join('tbl_device_master dm','dm.device_id=da.flow_id','left')
            ->where(['da.status'=>1,'dm.current_status'=>1])->order_by('da.id','desc')->get()->result_array();
        }
   }
?>