<?php
require APPPATH . 'libraries/REST_Controller.php';

	class Company_reg extends REST_Controller
	{
		public function __construct()
		{
			parent:: __construct();
			$this->load->model('Company_reg_model');
		}
		public function addCompany_post()
		{
			if($this->input->post('company_name',true)=='')
			{
				$this->response(['status'=>false,'data'=>[],'msg'=>'company_name  required!!','response_code'=>REST_Controller::HTTP_BAD_REQUEST]);
			}elseif($this->input->post('website',true)=='')
			{
				$this->response(['status'=>false,'data'=>[],'msg'=>'website  required!!','response_code'=>REST_Controller::HTTP_BAD_REQUEST]);
			}elseif($this->input->post('email_id',true)=='')
			{
				$this->response(['status'=>false,'data'=>[],'msg'=>'email_id  required!!','response_code'=>REST_Controller::HTTP_BAD_REQUEST]);
			}elseif($this->input->post('contact_person',true)=='')
			{
				$this->response(['status'=>false,'data'=>[],'msg'=>'contact_person  required!!','response_code'=>REST_Controller::HTTP_BAD_REQUEST]);
			}elseif($this->input->post('contact_no',true)=='')
			{
				$this->response(['status'=>false,'data'=>[],'msg'=>'contact_no  required!!','response_code'=>REST_Controller::HTTP_BAD_REQUEST]);
			}elseif($this->input->post('registration_date',true)=='')
			{
				$this->response(['status'=>false,'data'=>[],'msg'=>'registration_date required!!','response_code'=>REST_Controller::HTTP_BAD_REQUEST]);
			}elseif($this->input->post('expiry_date',true)=='')
			{
				$this->response(['status'=>false,'data'=>[],'msg'=>'expiry_date required!!','response_code'=>REST_Controller::HTTP_BAD_REQUEST]);
			}elseif($this->input->post('address',true)=='')
			{
				$this->response(['status'=>false,'data'=>[],'msg'=>'address required!!','response_code'=>REST_Controller::HTTP_BAD_REQUEST]);
			}elseif($this->input->post('city',true)=='')
			{
				$this->response(['status'=>false,'data'=>[],'msg'=>'city required!!','response_code'=>REST_Controller::HTTP_BAD_REQUEST]);
			}elseif($this->input->post('state',true)=='')
			{
				$this->response(['status'=>false,'data'=>[],'msg'=>'state required!!','response_code'=>REST_Controller::HTTP_BAD_REQUEST]);
			}elseif($this->input->post('logo',true)=='')
			{
				$this->response(['status'=>false,'data'=>[],'msg'=>'logo required!!','response_code'=>REST_Controller::HTTP_BAD_REQUEST]);
			}elseif($this->input->post('c_by',true)=='')
			{
				$this->response(['status'=>false,'data'=>[],'msg'=>'c_by required!!','response_code'=>REST_Controller::HTTP_BAD_REQUEST]);
			}else{
				try{


					$num_rows = $this->Company_reg_model->verify_companyRegisterExist($this->input->post('contact_no',true),$this->input->post('email_id',true));
	                if($num_rows>0)
	               {
	                  $this->response(['status'=>false,'data'=>[],'msg'=>'contact_no or email already exist !','response_code' => REST_Controller::HTTP_BAD_REQUEST]);
	                }else{
	                	$inside_image ='';
	                	if($this->input->post('logo',true)!='')
	                	{
	                		$inside_image_incoded = $this->input->post('logo',true);
	                       
	                        $imageData = base64_decode($inside_image_incoded);
	                        $inside_image = uniqid() . '.jpg';
	                        $inside_image_file = '../all-uploaded-img/' . $inside_image;
	                        $success = file_put_contents(APPPATH . $inside_image_file, $imageData);
	                	}
	                	$company_code = uniqid().rand(1111,9999).date('dmYhis');
	                	$data = [];
	                	$data['company_name'] = $this->input->post('company_name',true);
	                	$data['company_code'] = $company_code;
	                	$data['website'] = $this->input->post('website',true);
	                	$data['email_id'] = $this->input->post('email_id',true);
	                	$data['contact_person'] = $this->input->post('contact_person',true);
	                	$data['contact_no'] = $this->input->post('contact_no',true);
	                	$data['registration_date'] = date('Y-m-d',strtotime($this->input->post('registration_date',true)));
	                	$data['expiry_date'] = date('Y-m-d',strtotime($this->input->post('expiry_date',true)));
	                	$data['address'] = $this->input->post('address',true);
	                	$data['city'] = $this->input->post('city',true);
	                	$data['state'] = $this->input->post('state',true);
	                	$data['logo'] = $inside_image;
	                	$data['c_by'] = $this->input->post('c_by',true);
	                	$data['c_date'] = date('Y-m-d H:i:s');
	                	$data['status'] = 1;
	                	$this->Company_reg_model->addCompanyData($data);
	                	
	                	
	                	$userData = [];
	                	$userData['email_id'] = $data['email_id'];
	                	$userData['password'] = md5($this->input->post('password',true));
	                	$userData['company_code'] = $data['company_code'];
	                	$userData['c_by'] = $data['c_by'];
	                	$userData['c_date'] = $data['c_date'];
	                	$userData['status'] = $data['status'];
	                	$this->Company_reg_model->add_RegCompanyData($userData);


	               		$this->response(['status'=>true,'data'=>[],'msg'=>'successfully saved','response_code' => REST_Controller::HTTP_OK]);
	                	} 

				}catch(Exception $e)
				{
					$this->response(['status'=>false,'data'=>[],'msg'=>'something went wrong !','response_code' => REST_Controller::HTTP_INTERNAL_SERVER_ERROR]);
				}
			}
		}
		public function CompanyList_post()
		{
			try{
			$company_code = $this->input->post('company_code')!=""?$this->input->post('company_code'):"";
            $result = $this->Company_reg_model->getCompanyList($company_code);
            $this->response(['status'=>true,'data'=>$result,'msg'=>'successfully fetched!','response_code' => REST_Controller::HTTP_OK]);
        }catch(Exception $e)
        {
            $this->response(['status'=>false,'data'=>[],'msg'=>'something went wrong !','response_code' => REST_Controller::HTTP_INTERNAL_SERVER_ERROR]);
        }
		}

		public function updateCompany_post()
		{
			if($this->input->post('company_name',true)=='')
			{
				$this->response(['status'=>false,'data'=>[],'msg'=>'company_name  required!!','response_code'=>REST_Controller::HTTP_BAD_REQUEST]);
			}elseif($this->input->post('website',true)=='')
			{
				$this->response(['status'=>false,'data'=>[],'msg'=>'website  required!!','response_code'=>REST_Controller::HTTP_BAD_REQUEST]);
			}elseif($this->input->post('company_code',true)=='')
			{
				$this->response(['status'=>false,'data'=>[],'msg'=>'company_code  required!!','response_code'=>REST_Controller::HTTP_BAD_REQUEST]);
			}elseif($this->input->post('contact_person',true)=='')
			{
				$this->response(['status'=>false,'data'=>[],'msg'=>'contact_person  required!!','response_code'=>REST_Controller::HTTP_BAD_REQUEST]);
			}elseif($this->input->post('contact_no',true)=='')
			{
				$this->response(['status'=>false,'data'=>[],'msg'=>'contact_no  required!!','response_code'=>REST_Controller::HTTP_BAD_REQUEST]);
			}elseif($this->input->post('registration_date',true)=='')
			{
				$this->response(['status'=>false,'data'=>[],'msg'=>'registration_date required!!','response_code'=>REST_Controller::HTTP_BAD_REQUEST]);
			}elseif($this->input->post('expiry_date',true)=='')
			{
				$this->response(['status'=>false,'data'=>[],'msg'=>'expiry_date required!!','response_code'=>REST_Controller::HTTP_BAD_REQUEST]);
			}elseif($this->input->post('address',true)=='')
			{
				$this->response(['status'=>false,'data'=>[],'msg'=>'address required!!','response_code'=>REST_Controller::HTTP_BAD_REQUEST]);
			}elseif($this->input->post('city',true)=='')
			{
				$this->response(['status'=>false,'data'=>[],'msg'=>'city required!!','response_code'=>REST_Controller::HTTP_BAD_REQUEST]);
			}elseif($this->input->post('state',true)=='')
			{
				$this->response(['status'=>false,'data'=>[],'msg'=>'state required!!','response_code'=>REST_Controller::HTTP_BAD_REQUEST]);
			}elseif($this->input->post('logo',true)=='')
			{
				$this->response(['status'=>false,'data'=>[],'msg'=>'logo required!!','response_code'=>REST_Controller::HTTP_BAD_REQUEST]);
			}elseif($this->input->post('d_by',true)=='')
			{
				$this->response(['status'=>false,'data'=>[],'msg'=>'d_by required!!','response_code'=>REST_Controller::HTTP_BAD_REQUEST]);
			}else{
				try{


					$num_rows = $this->Company_reg_model->verifyRegisterContactExist($this->input->post('contact_no',true),$this->input->post('company_code',true));
	                if($num_rows>0)
	               {
	                  $this->response(['status'=>false,'data'=>[],'msg'=>'contact_no or email already exist !','response_code' => REST_Controller::HTTP_BAD_REQUEST]);
	                }else{
	                	$comData = [];
	                	if (isset($_POST['logo']) && !empty($_POST['logo'])) 
                  		{
	                        $logo_incoded = $this->input->post('logo',true);
	                        // $inside_image = str_replace(' ', '+', $inside_image_incoded);
	                        $imageData = base64_decode($logo_incoded);
	                        $logo = uniqid() . '.jpg';

                     		$photo_file = '../all-uploaded-img/' . $logo;
                     		$success = file_put_contents(APPPATH . $photo_file, $imageData);
                     		$comData['logo'] = $logo;
                  		}
                  		$comData['company_name'] = $this->input->post('company_name',true);
                  		$comData['website'] = $this->input->post('website',true);
                  		$comData['contact_person'] = $this->input->post('contact_person',true);
                  		$comData['contact_no'] = $this->input->post('contact_no',true);
                  		$comData['registration_date'] = date('Y-m-d',strtotime($this->input->post('registration_date',true)));
                  		$comData['expiry_date'] = date('Y-m-d',strtotime($this->input->post('expiry_date',true)));
                  		$comData['address'] = $this->input->post('address',true);
                  		$comData['city'] = $this->input->post('city',true);
                  		$comData['state'] = $this->input->post('state',true);
                  		$comData['d_by'] = $this->input->post('d_by',true);
                  		$comData['d_date'] = date('Y-m-d H:i:s');
                  		$this->Company_reg_model->editCompanyData($comData,['company_code'=> $this->input->post('company_code',true),'status'=>1]);

	               		$this->response(['status'=>true,'data'=>[],'msg'=>'successfully updated','response_code' => REST_Controller::HTTP_OK]);
	                	} 

				}catch(Exception $e)
				{
					$this->response(['status'=>false,'data'=>[],'msg'=>'something went wrong !','response_code' => REST_Controller::HTTP_INTERNAL_SERVER_ERROR]);
				}
			}
		}
	}
?>