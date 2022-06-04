<?php
   
require APPPATH . 'libraries/REST_Controller.php';
     
class DeviceProfile extends REST_Controller 
{
   public function __construct()
   {
       parent::__construct();
       $this->load->model('DeviceProfile_model');
   }

   public function get_device_profile_post()
   {
        if($this->input->post('device_id')=='')
        {
            $this->response(['status'=>false,'data'=>[],'msg'=>'device_id required !','response_code' => REST_Controller::HTTP_BAD_REQUEST]);
        }else
        {
            $from_date = $this->input->post('from_date')!=""?$this->input->post('from_date'):"";
            $to_date = $this->input->post('to_date')!=""?$this->input->post('to_date'):"";

            $mainData['device_details'] = $this->DeviceProfile_model->DeviceDetails_m($this->input->post('device_id'));
            $mainData['device_status'] = $this->DeviceProfile_model->DeviceCurrentDetails_m($mainData['device_details'][0]['imei_no']);

            $mainData['flow_details'] = $this->DeviceProfile_model->DeviceFlowReport_m($mainData['device_details'][0]['imei_no'],$from_date,$to_date);
            $mainData['flow_rate_details'] = $this->DeviceProfile_model->DeviceFlowRateReport_m($mainData['device_details'][0]['imei_no'],$from_date,$to_date);

            $this->response(['status'=>true,'data'=>$mainData,'msg'=>'Successfully Fetched','response_code' => REST_Controller::HTTP_OK]);
        }
    
   }


	
}
?>