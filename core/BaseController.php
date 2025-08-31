<?php 
namespace Zems;
class BaseController extends Config
{
	public $root_dir;
	public $seo;
	public $api_request = false;
	public function __construct()
    {
		// $this->root_dir = $_SERVER['DOCUMENT_ROOT'];		
		$this->root_dir = dirname(__FILE__);
		$this->isApi();
		header('Access-Control-Allow-Origin: *');
		// $this->seo = $this->settings();
    }
    public function redirect($path){
        // return header("Location:/dashboard");
        return header("Location: $path");
    }
	public function set_message($key, $msg) {
		$set_sess = setcookie($key, $msg, time() + 3600, "/");
		return $set_sess;
	}
	public function get_message($key) {
		$data = "";
		if(isset($_COOKIE[$key]))
			$data = $_COOKIE[$key];
			setcookie($key, "", time() - 3600, "/");
		return $data;
	}
	public function isApi(){
		$uri = strtok($_SERVER['REQUEST_URI'], '?');
        $uri = rtrim($uri, "/");
		if(str_contains($uri, '/api/')){
			$this->api_request = true;
			return true;
        }
		return false;
	}
	public function response_json($data){
		echo json_encode($data);
	}
}