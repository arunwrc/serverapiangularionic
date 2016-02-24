<?php
require APPPATH . '/libraries/REST_Controller.php';
class User_api extends REST_Controller {

    function __construct(){
        parent::__construct();
        $this->load->model('User_model');
        $this->crossorigin->initiate();
    }
    function Users_get(){
       $data=$this->User_model->get_all();
        if($data){
            $this->response(array(RESP_STATUS => HTTP_OK,RESP_MSG => LISTING_SUCCESS,DATA => $data));
        }else{
            $this->response(array(RESP_STATUS => HTTP_NO_CONTENT,RESP_MSG => NO_RECORDS));
        }
    }
    
    function Addusername_post(){
           
       $data = json_decode(file_get_contents('php://input'),true);  
        if(isset($data['username'])) {
            $username = $data['username'];
        }else{
            
            $username = "";
            $error['1'] = "Cant be Blank";
            $error['2'] = "Cant be Blank2";
        }   
        $current_datetime = date('Y-m-d H:i:s');
		if ($username != "") {
            $data = array( // inputs
                'username'=> $username,
                'created_at' =>  $current_datetime
            );
            $this->db->insert('user', $data);
            $insert_id = array( 
                'insertID'=> $this->db->insert_id()
            );
            $merged_data = array_merge($data,$insert_id);
            $this->response(array(RESP_STATUS => HTTP_OK,RESP_MSG => CREATED_SUCCESS,DATA => $merged_data));
		}
		else {
			$this->response(array(RESP_STATUS => HTTP_NO_CONTENT,RESP_MSG => CREATE_FAILED,"resp_error" => $error));
		}	
    }


}