<?php
namespace App\Http\Controllers\API;
use App\Helpers\CheckSite;
use App\Http\Controllers\Controller;
use App\Models\Admin\Client;
use App\Models\Admin\Department;
use App\Models\Admin\Shift;
use App\Models\Admin\Employee;
use App\User;
use App\Models\Admin\TimeCard;
use Carbon\Carbon;
use App\Http\Resources\UserResource;

// use GuzzleHttp\Client;
use App\Models\Admin\Client as Clients;

use App\Models\Admin\Corporation;

use DB;
use File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Input;

use Validator;
use GuzzleHttp;


class UserController extends Controller {
    public $successStatus = 200;
    public $unAuthorizedStatus = 401;
    public $unprocessableStatus = 422;

    public function profile(Request $request){
        return response()->json(new UserResource($request->user()), 200);
    }

    
    public function update(Request $request) {
        $request->validate([
            'email' => 'email|required',
            'password'=>'required_with:current_password|same:password_confirmation',
            'password_confirmation' => 'required_with:current_password|same:password',
        ],
        [
               
              // 'password.required' => 'Password should be same'
            ]);
        $data = $request->user();

        //image uploading
        $upload_path = 'storage/app/uploads/images/';
        $IMPORT_PATH = str_replace('\\', '/', $upload_path);
        $image_name = '';
        if ($request->hasFile('image')) {         
                File::delete(public_path() . 'storage/app/uploads/images/', $data->image); // Delete old flyer
            $file = $request->file('image');
            $fileName = $file->getClientOriginalName();
            $fileName = explode('.', $fileName);
            $fileName = uniqid($fileName[0]) . '.' . $fileName[1];
            $fileExtension = $file->getClientOriginalExtension();
            if (!File::isDirectory($IMPORT_PATH)) { //check the brands directory is exist
                File::makeDirectory($IMPORT_PATH, 0777, true); //if not then create
                $image_name = Input::file('image')->move($IMPORT_PATH, $fileName);
            } else {
                if ($fileExtension == 'jpg' || $fileExtension == 'JPG' || $fileExtension == 'png' || $fileExtension == 'PNG' || $fileExtension == 'jpeg' || $fileExtension == 'JPEG') {
                    Input::file('image')->move($IMPORT_PATH, $fileName);
                    $image_name = $IMPORT_PATH . $fileName;
                   
                }

            }
            
        }

        $current_password =$request->get('current_password');
        $pass=$data->password;


            $data->name = $request->get('name');
            $data->first_name = $request->get('first_name');
            $data->last_name = $request->get('last_name');
            $data->email = $request->get('email');
            $data->phone_no = $request->get('phone_no');

        if ($image_name!='') {
            $data->image = $image_name;
        }

        if($request->current_password!= 'undefined' && $request->current_password!=''){
            if (Hash::check($current_password, $pass)){
                 $data->password = bcrypt($request->password);
            } else{
                 return response()->json(['error'=> true, 'message'=>'Password is incorrect'], 400);
            }
        }

        $data->save();
        return response()->json($data, 200);

            
    }







    public function index(){
            return response()->json(User::all());

    }

    public function permissions(Request $request) {
        
    }

    public function login(Request $request) {
        $request->validate([
            'username' => 'required|email|exists:users,email',
            'password' => 'required',
        ]);

        $http = new GuzzleHttp\Client;

        $response = $http->post('http://spa.test/oauth/token', [
            'form_params' => [
                'grant_type' => 'password',
                'client_id' => '3',
                'client_secret' => 'lHef9ty2asIHrkx16Zz0f4c7fxDM31J0piJaBa6D',
                'username' => $request->username,
                'password' => $request->password,
                'scope' => '',
            ],
        ]);

        return json_decode((string) $response->getBody(), true);
    }

    public function logout(Request $request){
     $loggedOUt=$request->user()->token()->delete(); 
        if($loggedOUt){
            return response()->json(['error'=>false, 'message' => 'success'], 200);
        }else{
            return response()->json(['error'=>true, 'message' => 'success'], 200);
        } 
    }



    public function isloggedin(Request $request){
        if($user = $request->user()->id){
            $token=  $request->user()->token();
            if($token){
                return response()->json(['error'=>false, 'message' => 'success'], 200);
            }else{
                return response()->json(['error'=>true, 'message' => 'Unauthorized'], 401);
            }
        }else{
            return response()->json(['error'=>true, 'message' => 'Unauthorized'], 401);
        }   
    }


    
    public function user_permissions(Request $request) {
            $user = $request->user();
            $perms = $user->getPermissionsViaRoles();
            $keys = array_unique(array_column($perms->toArray(), 'name'));
            $roles = $user->getRoleNames();
            $response = ['permissions' => $keys, 'roles' => $roles, 'me' => new UserResource($user)];
            
            // if ($user->hasAnyRole(['EE'])) {
               
            //     if ($clockin) {
            //         $response = array_merge($response, ['clockin' => $clockin]);
            //     }
            // }
            return response()->json($response,200);
    }



}