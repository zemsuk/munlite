<?php
namespace App\Auth;
use App\Controller;
use App\Auth\Model\User;
use App\User\Model\Country;
use Zems\Hash;

class LoginController extends Controller{
    public function login()  {
        $this->loggedIn();
        // $data = [['id'=>"Hi"]];
        // if($this->api_request){
        //     // echo($data);
        //     return $this->response_json($data);
        // }
        return $this->view('Auth/View/Login', ['theme'=>'Auth/View/LoginTheme']);
    }
    public function login_verify(){
        $phone = $_POST['phone'];
        $password = $_POST['password'];
        $password = md5($password);
        
        $sql = "SELECT * FROM user WHERE `phone`='$phone' AND `password`='$password'";
        $user = new User;
        $check = $user->connect()->query($sql);
        $result = $check->fetch(\PDO::FETCH_OBJ);
        if($result){
            // return $this->response_json($_POST);
            if($result->status == 1){
                if($result->role > 0){
                    $token = Hash::token($result->id);
                    // $code = Hash::hash5($token);
                    $data = [
                        'remember_token'=>$token->set
                    ];
                    $user = User::where($result->id)->update($data);
                    // echo $code;
                    // $ck = Hash::hash_verify($token, $code);
                    // var_dump($ck);
                    return $this->response_json(['token'=> $token->code]); 
                }
            } else if($result->status == 2){
                echo "your account is blocked";
                http_response_code(400); // Example: Bad Request
                header('Content-Type: application/json'); // Indicate JSON response
                echo json_encode(['error' => 'Invalid input provided.']);
                exit();
            } else if ($result->status == 0) {
                echo "You have no permission!!";
                http_response_code(400); // Example: Bad Request
                header('Content-Type: application/json'); // Indicate JSON response
                echo json_encode(['error' => 'Invalid input provided.']);
                exit();
            }
        } else {
            echo "Username or password invalid!!";
            http_response_code(400); // Example: Bad Request
            header('Content-Type: application/json'); // Indicate JSON response
            echo json_encode(['error' => 'Invalid input provided.']);
            exit();
        }
    }
    public function verify()  {
        // return $this->response_json($_POST);
        $phone = $_POST['phone'];
        $password = $_POST['password'];
        $password = md5($password);
        
        $sql = "SELECT * FROM user WHERE `phone`='$phone' AND `password`='$password'";
        $user = new User;
        $check = $user->connect()->query($sql);
        $result = $check->fetch(\PDO::FETCH_OBJ);
        if($result){
            return $this->response_json($_POST);
            if($result->status == 1){
                if($result->role > 0){
                    if($this->api_request){
                        return $this->response_json(['message'=>'successfully login']);
                    }
                    setcookie("auth_id", $result->id, time() + 2 * 2 * 60 * 60, "/");
                    setcookie("authentic", true, time() + 2 * 2 * 60 * 60, "/");
                    echo "logied in ";
                    header("Location:/user");
                    // return $this->redirect('/dashboard');
                } else {
                    echo $result->id;
                    return $this->redirect('/user');
                    echo "Please purchase a package";
                }
            } else if($result->status == 2){
                echo "your account is blocked";
            } else if ($result->status == 0) {
                echo "You have no permission!!";
            }
        } else {
            echo "Username or password invalid!!";
        } 
    }

    public function create(){
        $this->loggedIn();
        $country=Country::get();
        if($this->api_request){
            return $this->response_json($country);
        }
        return $this->view("Auth/View/Create", ['countries'=>$country,'theme'=>'Auth/View/LoginTheme']);
    }
   public function store(){
       // var_dump($_POST);
        $name=$_POST["name"];
        $phone_number=$_POST["phone_number"];
        $email=$_POST["email"];
        $country_id=$_POST["country_id"];
        $password=$_POST["password"];
        $password=md5($password);
        $data = [
             'name'=>$name,
             'phone'=>$phone_number,
             'email'=>$email,
             'country_id'=>$country_id,
             'password'=>$password
        ];
        $user = User::create($data);
        if($user){
            return $this->redirect("/success");
        } else {
            echo "Error";
        }
   }
   public function loggedIn() {
    if(isset($_COOKIE['auth_id'])){
        return $this->redirect('/dashboard');
    }
   }
   public function get_user(){
    // echo "Hi";
    // exit();
    $id = Auth::user();
    return $id;
    $auth_id = Hash::find_key();
    $user = User::select('id,remember_token')->find($auth_id);
    $token = Hash::token_origin($auth_id);
    
    $ck = Hash::hash_verify($token, $user->remember_token);
    if($ck){
        return $this->response_json($user->id);
    }
    return $this->response_json(["something went wrong!!"]);
   }
}