<?php
session_start();
header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
header("Access-Control-Allow-Headers: Content-Disposition, Content-Type, Content-Length, Accept-Encoding");
require_once "./config.php";

function msg($success,$status,$message,$extra = []){
    return array_merge([
        'success' => $success,
        'status' => $status,
        'message' => $message
    ],$extra);
}


function logmsg($success,$status,$accesstoken,$data,$message,$extra = []){
    return array_merge([
        'success' => $success,
        'status' => $status,
        'accessToken' => $accesstoken,
        'data'  => $data,
        'message' => $message
    ],$extra);
}


$database = new Database();
$conn = $database->getConnection();

//Start of IF Else to Call Action-Function
if($_POST["action"]=="register"):
    $resp = register($database, $conn);
    // echo json_encode($resp);
else:
    $resp = login($database, $conn);
// 	echo json_encode($resp);
endif;


function register($database, $conn ){

    $username = $_POST["name"];
    $email = $_POST["email"];
    $password = $_POST["password"];
    $cnfpassword = $_POST["cnfpassword"];
    $phone = $_POST["mobile"];
    $occ = $_POST["occupation"];
    $its = $_POST["its"];
    $add = $_POST["address"];

    if ($password != $cnfpassword){
        $returnData = msg(0,422,'Password does not match with Confirm Password');
        return $returnData;
    }

    // CHECKING EMPTY FIELDS
    if(!isset($username) 
        || !isset($email) 
        || !isset($password)
        || empty(trim($username))
        || empty(trim($email))
        || empty(trim($password))
        ):

        $fields = ['fields' => ['name','email','password']];
        $returnData = msg(0,422,'Please Fill in all Required Fields!',$fields);
        return $returnData;

    // IF THERE ARE NO EMPTY FIELDS THEN-
    else:
        
        $name = trim($username);
        $email = trim($email);
        $password = trim($password);

        if(!filter_var($email, FILTER_VALIDATE_EMAIL)):
            $returnData = msg(0,422,'Invalid Email Address!');
            return $returnData;
        
        elseif(strlen($password) < 8):
            $returnData = msg(0,422,'Your password must be at least 8 characters long!');
            return $returnData;

        elseif(strlen($name) < 3):
            $returnData = msg(0,422,'Your name must be at least 3 characters long!');
            return $returnData;

        elseif(strlen($phone) > 10):
            $returnData = msg(0,422,'Mobile Number cannot be greater than 10 digits!');
            return $returnData;

        else:
        $result = array();
        $param = array();
        $sql = "SELECT member_email from member where upper(member_email)=upper(:member_email)"  ;
        $param["member_email"] = $email;
        $result = $database->selectParamQuery($conn, $sql, $param);

        $result1 = array();
        $param1 = array();
        $sql1 = "SELECT member_mobile from member where upper(member_mobile)=upper(:member_mobile)"  ;
        $param1["member_mobile"] = $phone;
        $result1 = $database->selectParamQuery($conn, $sql1, $param1);
        $no = rand(1,8);
        $avatar = 'https://bootdey.com/img/Content/avatar/avatar'.$no. '.png';

        if(count($result) > 0 || count($result1) > 0){
            return $returnData;
        }
        else{
            $hash = md5(rand(0,1000) );
            $result_ = array();
            $param_ = array();
            $sql_ = "INSERT INTO member
                         (member_name, member_email,
                          member_mobile, member_password, member_hash,member_avatar,member_occupation,member_address,member_its,member_active)
                      VALUES (:mName, :mEmail, :mMobile, :mPassword, :HashString,:avatar,:mOcc,:mAdd,:mITS,1)";
            $param_["mEmail"] = $email;
            $param_["mName"] = $name;
            $param_["mMobile"] = $phone;
            $param_["mPassword"] = $password;
            $param_["HashString"] = $hash;
            $param_["avatar"] = $avatar;
            $param_["mOcc"] = $occ;
            $param_["mAdd"] = $add;
            $param_["mITS"] = $its;
            $result_ = $database->insertQuery($conn, $sql_, $param_);
            // print_r($result_);
            // header("Location: https://ashara1450.vercel.app/login.html");
            echo "<script> location.href='https://ashara1450.vercel.app/login.html'; </script>";
            exit;
            return 'register scess';
        }
        endif;
    endif;
}

function login($database, $conn){

    $email = $_POST["email"];
    $password = $_POST["password"];

     if(!isset($email) 
        || !isset($password)
        || empty(trim($email))
        || empty(trim($password))
        ):

        $fields = ['fields' => ['name','email','password']];
        $returnData = msg(0,422,'Please Fill in all Required Fields!',$fields);

    //IF THERE ARE NO EMPTY FIELDS THEN
    else:

        $email = trim($email);
        $password = trim($password);

        $result = array();
        $param = array();
        $sql = " SELECT member_email from member where (upper(member_email)=upper(:member_email) OR member_mobile=:member_email) and member_active = 1"  ;
        $param["member_email"] = $email;
        $result = $database->selectParamQuery($conn, $sql, $param); 

        if(count($result) > 0):
             $result_ = array();
             $param_ = array();
             $sql_ = "SELECT member_id,member_email, member_name ,member_admin 
                        from member where member_password=:member_password 
                       and upper(member_email)=upper(:member_email) " ;
             $param_["member_email"] = $email;
             $param_["member_password"] = $password;
             $result_ = $database->selectParamQuery($conn, $sql_, $param_);
            //  echo $result_;
            // echo count($result_);
             if(count($result_) > 0):
                $id = $result_[0]["member_id"];
                $email = $result_[0]["member_email"];
                $firstname = $result_[0]["member_name"];
                $member_admin = $result_[0]["member_admin"];
               
                $_SESSION['username'] = $firstname;
                $_SESSION['userid'] = $id;
                $_SESSION['member_admin'] = $member_admin;
               // Redirect to user dashboard page
            //   header("Location: https://ashara1450.vercel.app/index.php");
               echo "<script> location.href='https://ashara1450.vercel.app/index.php'; </script>";
               exit;
                
            //   $returnData= logmsg(0,200,$jwt,$data,'Login Done');
            //   $log = $logger->printLogger('Login Done', '1');  
              return  'login';
             else:
                  $returnData= msg(0,100,'Incorrect Password');
                  return $returnData;
             endif;   
            else:
                $returnData= msg(0,100,'User Does not Exists Or Account is not Active');
                return $returnData;
        endif;
    endif;

}
