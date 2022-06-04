<?php
   
require APPPATH . 'libraries/REST_Controller.php';
     
class Login extends REST_Controller 
{
   public function __construct()
   {
       parent::__construct();
     $this->load->model('Login_model');
   }

   public function login_post()
   {
        if($this->input->post('email',true)=='')
        {
            $this->response(['status'=>false,'data'=>[],'msg'=>'email required !','response_code' => REST_Controller::HTTP_BAD_REQUEST]);
        }elseif($this->input->post('password',true)=='')
        {
            $this->response(['status'=>false,'data'=>[],'msg'=>'password required !','response_code' => REST_Controller::HTTP_BAD_REQUEST]);
        }else
        {
            $verify = $this->Login_model->verifyUserIdExistOrNot($this->input->post('email',true));
            if($verify>0)
            {

                $userData = $this->Login_model->getUserIdDetails($this->input->post('email',true));
                if($userData['password'] == md5($this->input->post('password',true)))
                {

                    if(date('Y-m-d',strtotime($userData['expiry_date']))<date('Y-m-d'))
                    {
                        $this->response(['status'=>false,'data'=>[],'msg'=>'This account is expired !','response_code' => REST_Controller::HTTP_BAD_REQUEST]);
                    }else
                    {
                        $userInfo = [];
                        $userInfo['user_id'] = $userData['id'];
                        $userInfo['company_code'] = $userData['company_code'];
                        $userInfo['company_name'] = $userData['company_name'];
                        $userInfo['logo'] = $userData['logo'];
                        $userInfo['website'] = $userData['website'];
                        $userInfo['role_type'] = $userData['role_type'];

                        $this->response(['status'=>true,'data'=>['userData'=>$userInfo],'msg'=>'Auth Success !','response_code' => REST_Controller::HTTP_OK]);

                    }

                }else
                {
                     $this->response(['status'=>false,'data'=>[],'msg'=>'UserId Or Password Not Match !','response_code' => REST_Controller::HTTP_BAD_REQUEST]);
                }

            }else
            {
                $this->response(['status'=>false,'data'=>[],'msg'=>'Invalid Email !','response_code' => REST_Controller::HTTP_BAD_REQUEST]);
            }
        }
   }


	
}
?>