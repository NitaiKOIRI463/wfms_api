<?php
require APPPATH . 'libraries/REST_Controller.php';

	class CompanyProfile extends REST_Controller
	{
		public function __construct()
		{
			parent:: __construct();
			$this->load->model('CompanyProfile_model');
		}
		public function get_ProfileList_post()
		{
			try{
            $company_code = $this->input->post('company_code',true)!=""?$this->input->post('company_code',true):"";
            $result = $this->CompanyProfile_model->getProfileList($company_code);
            $output = $this->CompanyProfile_model->getDeviceList($company_code);
            $this->response(['status'=>true,'data'=>$result,'device'=>$output,'msg'=>'successfully','response_code' => REST_Controller::HTTP_OK]);
        }catch(Exception $e)
        {
            $this->response(['status'=>false,'data'=>[],'msg'=>'something went wrong !','response_code' => REST_Controller::HTTP_INTERNAL_SERVER_ERROR]);
        }
		}
	}
?>