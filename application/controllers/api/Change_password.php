<?php 
require APPPATH . 'libraries/REST_Controller.php';
class Change_password extends REST_Controller {

    public function __construct() {
       parent::__construct();
     $this->load->model('Change_password_model');
    }

    public function ChangePassword_post()
		{
			if($this->input->post('id',true)==''){
				$this->response(['status'=>false,'data'=>[],'msg'=>'id required!!','response_code'=>REST_Controller::HTTP_BAD_REQUEST]);
			}elseif($this->input->post('old_password',true)==''){
				$this->response(['status'=>false,'data'=>[],'msg'=>'old_password required!!','response_code'=>REST_Controller::HTTP_BAD_REQUEST]);
			}elseif($this->input->post('new_password',true)==''){
				$this->response(['status'=>false,'data'=>[],'msg'=>'new_password required!!','response_code'=>REST_Controller::HTTP_BAD_REQUEST]);
			}
			else{
				$password = $this->Change_password_model->getOld_password($this->input->post('id',true));
				$oldPassword = $password[0]['password'];
				if ($oldPassword == md5($this->input->post('old_password',true))) 
				{
					try {
						$arrayData = [];
						$arrayData['password'] = md5($this->input->post('new_password',true));
						$arrayData['d_date'] = date("Y-m-d H:i:s");
						$arrayData['d_by'] = $this->input->post('id',true);
						$this->Change_password_model->updatePassword($this->input->post('id',true),$arrayData);
						$this->response(['status'=>true,'data'=>[],'msg'=>'Successfully Updated !','response_code'=>REST_Controller::HTTP_OK]);

					}catch (Exception $e) 
					{
						$this->response(['status'=>false,'data'=>[],'msg'=>'Something went wrong !','response_code'=>REST_Controller::HTTP_BAD_REQUEST]);
					}
				}else{
					$this->response(['status'=>false,'data'=>[],'msg'=>'Old password not matched !','response_code'=>REST_Controller::HTTP_BAD_REQUEST]);		
				}
			}
		}
}
?>