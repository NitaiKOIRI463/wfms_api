<?php
   
require APPPATH . 'libraries/REST_Controller.php';
     
class AssignDevice extends REST_Controller 
{
   public function __construct()
   {
       parent::__construct();
     $this->load->model('AssignDevice_model');
   }

   public function assign_device_post()
   {
        if($this->input->post('company_code',true)=='')
        {
            $this->response(['status'=>false,'data'=>[],'msg'=>'company_code required !','response_code' => REST_Controller::HTTP_BAD_REQUEST]);
        }elseif($this->input->post('device_id',true)=='')
        {
            $this->response(['status'=>false,'data'=>[],'msg'=>'device_id required !','response_code' => REST_Controller::HTTP_BAD_REQUEST]);
        }elseif($this->input->post('address',true)=='')
        {
            $this->response(['status'=>false,'data'=>[],'msg'=>'address required !','response_code' => REST_Controller::HTTP_BAD_REQUEST]);
        }elseif($this->input->post('state',true)=='')
        {
            $this->response(['status'=>false,'data'=>[],'msg'=>'state required !','response_code' => REST_Controller::HTTP_BAD_REQUEST]);
        }elseif($this->input->post('city',true)=='')
        {
            $this->response(['status'=>false,'data'=>[],'msg'=>'city required !','response_code' => REST_Controller::HTTP_BAD_REQUEST]);
        }elseif($this->input->post('latitude',true)=='')
        {
            $this->response(['status'=>false,'data'=>[],'msg'=>'latitude required !','response_code' => REST_Controller::HTTP_BAD_REQUEST]);
        }elseif($this->input->post('longitude',true)=='')
        {
            $this->response(['status'=>false,'data'=>[],'msg'=>'longitude required !','response_code' => REST_Controller::HTTP_BAD_REQUEST]);
        }elseif($this->input->post('installation_date',true)=='')
        {
            $this->response(['status'=>false,'data'=>[],'msg'=>'installation_date required !','response_code' => REST_Controller::HTTP_BAD_REQUEST]);
        }else
        {

            $mainData = [];
            $mainData['flow_id'] = $this->input->post('device_id',true);
            $mainData['company_code'] = $this->input->post('company_code',true);
            $mainData['address'] = $this->input->post('address',true);
            $mainData['city'] = $this->input->post('city',true);
            $mainData['state'] = $this->input->post('state',true);
            $mainData['latitude'] = $this->input->post('latitude',true);
            $mainData['longitude'] = $this->input->post('longitude',true);
            $mainData['date_of_installation'] = date('Y-m-d H:i:s',strtotime($this->input->post('installation_date',true)));
            $mainData['c_by'] = $this->input->post('c_by',true);
            $mainData['c_date'] = date('Y-m-d H:i:s');
            $mainData['status'] = 1;
            $this->AssignDevice_model->assignDevice_m($mainData);

            $this->response(['status'=>true,'data'=>[],'msg'=>'Successfully Done','response_code' => REST_Controller::HTTP_OK]);
        }
   }


	
}
?>