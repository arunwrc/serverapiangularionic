<?php
//require APPPATH . '/libraries/REST_Controller.php';
class User_api extends CI_Controller {

    function __construct(){
        parent::__construct();
        //Login check
        
        $this->load->model('User_model');
        $this->load->library('form_validation');
    }

    

    function Addusername(){
       //http://stackoverflow.com/questions/18382740/cors-not-working-php
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

    $postdata = file_get_contents("php://input");
	if (isset($postdata)) {
		$request = json_decode($postdata);
		$username = $request->username;
        $current_datetime = date('Y-m-d H:i:s');
		if ($username != "") {
            $data = array( // inputs
                'username'=> $username,
                'created_at' =>  $current_datetime
            );
            $this->db->insert('user', $data);
            
            echo json_encode(array("status" => "200","msg" => "Username created successfully","data" => $data));
			
		}
		else {
			echo json_encode(array("status" => "404","msg" => "Please enter Username"));
		}
	}
	else {
		echo "Not called properly with username parameter!";
	}
    }


}