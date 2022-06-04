<?php
require APPPATH . 'libraries/REST_Controller.php';

	class AdminDashboard extends REST_Controller
	{
		public function __construct()
		{
			parent:: __construct();
			$this->load->model('AdminDashboard_model');
		}

		public function get_admin_dashboard_data_post()
		{
			$mainData = [];
			$mainData['total_company'] = $this->AdminDashboard_model->get_total_company_m();
			$mainData['total_device'] = $this->AdminDashboard_model->get_total_flow_id_m();
			$mainData['online_device'] = $this->AdminDashboard_model->DeviceDetails_m();

			$this->response(['status'=>true,'data'=>$mainData,'msg'=>'Successfully Fetched','response_code' => REST_Controller::HTTP_OK]);

		}
		


	}
?>