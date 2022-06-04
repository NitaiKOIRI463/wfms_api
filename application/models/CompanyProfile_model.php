<?php  
if (!defined('BASEPATH')) exit('No direct script access allowed');

   class CompanyProfile_model extends CI_Model
   {
        public function __construct() 
        {
           parent::__construct();
           
        }
        public function getProfileList($company_code)
        {
         if($company_code!="")
                $this->db->where('company_code',$company_code);
        return $this->db->select("company_name,company_code,logo,website,email_id,contact_person,contact_no,registration_date,expiry_date,address,city,state")
            ->from('tbl_company_registration')
            ->where(['status'=>1])->order_by('id','desc')->get()->result_array();
        }

        public function getDeviceList($company_code)
        {
         if($company_code!="")
                $this->db->where('da.company_code',$company_code);
        return $this->db->select("da.address,da.date_of_installation,dm.imei_no,dm.device_id,dm.device_type")
            ->from('tbl_device_allotment_details da')
            ->join('tbl_device_master dm','dm.device_id=da.flow_id','left')
            ->where(['da.status'=>1])->order_by('da.id','desc')->get()->result_array();
        }
   }
?>