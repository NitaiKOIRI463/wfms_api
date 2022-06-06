<?php
require APPPATH . 'libraries/REST_Controller.php';

	class CompanyDashboard extends REST_Controller
	{
		public function __construct()
		{
			parent:: __construct();
			$this->load->model('CompanyDashboard_model');
		}
		public function dashboard_post()
		{
		try{
            $company_code = $this->input->post('company_code',true)!=""?$this->input->post('company_code',true):"";
            $result = $this->CompanyDashboard_model->get_total_flow_id_m($company_code);
            $output = $this->CompanyDashboard_model->getDeviceList($company_code);
            $this->response(['status'=>true,'data'=>$result, 'Data'=>$output,'msg'=>'successfully','response_code' => REST_Controller::HTTP_OK]);
        }catch(Exception $e)
        {
            $this->response(['status'=>false,'data'=>[],'msg'=>'something went wrong !','response_code' => REST_Controller::HTTP_INTERNAL_SERVER_ERROR]);
        }

		}
	}
?>