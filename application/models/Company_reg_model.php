<?php  
if (!defined('BASEPATH')) exit('No direct script access allowed');

   class Company_reg_model extends CI_Model
   {
        public function __construct() 
        {
           parent::__construct();
           
        }
        public function verify_companyRegisterExist($contact_no,$email_id)
        {
            $qry = $this->db->query("select count(id) as total from tbl_company_registration where (contact_no = ? OR email_id = ?) and status = 1",[$contact_no,$email_id]);
            $result = $qry->result_array();
            if(!empty($result))
            {
                return $result[0]['total'];
            }else
            {
                return 0;
            }
        }
        public function addCompanyData($data)
        {
            return $this->db->insert('tbl_company_registration',$data);

        }
        public function add_RegCompanyData($userData)
        {
            return $this->db->insert('tbl_user_master',$userData);

        }
        public function getCompanyList()
       {
            return $this->db->select('company_name,contact_person,contact_no,address,city,state,company_code')->from('tbl_company_registration')->where(['status'=>1])->order_by('id','desc')->get()->result_array();
       }
       public function editCompanyData($data,$where)
       {
        return $this->db->update('tbl_company_registration',$data,$where);
       }
    }
?>