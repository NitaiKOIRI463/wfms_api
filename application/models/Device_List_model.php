<?php  
if (!defined('BASEPATH')) exit('No direct script access allowed');

   class Device_List_model extends CI_Model
   {
        public function __construct() 
        {
           parent::__construct();
           
        }
        
        public function getDeviceList($company_code)
        {
         if($company_code!="")
                $this->db->where('da.company_code',$company_code);
        return $this->db->select("cr.company_name,da.company_code,da.address,da.city,da.date_of_installation,da.state,dm.imei_no,dm.device_id,dm.device_type")
            ->from('tbl_device_allotment_details da')
            ->join('tbl_device_master dm','dm.device_id=da.flow_id','left')
            ->join('tbl_company_registration cr','cr.company_code=da.company_code','left')
            ->where(['da.status'=>1])->order_by('da.id','desc')->get()->result_array();
        }
   }
?>