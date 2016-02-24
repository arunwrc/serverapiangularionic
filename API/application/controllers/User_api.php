<?php
//require APPPATH . '/libraries/REST_Controller.php';
class User_api extends My_Control_Panel {

    function __construct(){
        parent::__construct();
        if (isset($_SERVER['HTTP_ORIGIN'])) {
        header("Access-Control-Allow-Origin: {$_SERVER['HTTP_ORIGIN']}");
        header('Access-Control-Allow-Credentials: true');
        header('Access-Control-Max-Age: 86400');    // cache for 1 day
    }

    // Access-Control headers are received during OPTIONS requests
    if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {

        if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_METHOD']))
            header("Access-Control-Allow-Methods: GET, POST, OPTIONS");         

        if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS']))
            header("Access-Control-Allow-Headers:        
            {$_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS']}");

        exit(0);
    }
        
        $this->load->model('User_model');
        $this->load->library('form_validation');
    }

    

    function Addusername_post(){
       //http://stackoverflow.com/questions/18382740/cors-not-working-php
	

        //$postdata = file_get_contents("php://input");
        $Data = json_decode(file_get_contents('php://input'),true);  
        if(isset($Data['username'])) {
            $username = $Data['username']; 
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
            //echo json_encode(array("status" => "200","resp_msg" => "Username created successfully","resp_data" => $merged_data));
			
		}
		else {
			$this->response(array(RESP_STATUS => HTTP_NO_CONTENT,RESP_MSG => CREATE_FAILED));
		}
	//}
	
    }


}