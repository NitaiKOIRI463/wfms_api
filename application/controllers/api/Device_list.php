<?php
require APPPATH . 'libraries/REST_Controller.php';

	class Device_list extends REST_Controller
	{
		public function __construct()
		{
			parent:: __construct();
			$this->load->model('Device_List_model');
		}
		public function get_deviceList_post()
		{
			try{
            $company_code = $this->input->post('company_code',true)!=""?$this->input->post('company_code',true):"";
            $result = $this->Device_List_model->getDeviceList($company_code);
            $this->response(['status'=>true,'data'=>$result,'msg'=>'successfully','response_code' => REST_Controller::HTTP_OK]);
        }catch(Exception $e)
        {
            $this->response(['status'=>false,'data'=>[],'msg'=>'something went wrong !','response_code' => REST_Controller::HTTP_INTERNAL_SERVER_ERROR]);
        }
		}
	}
?>