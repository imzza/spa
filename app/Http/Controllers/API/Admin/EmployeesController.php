<?php

namespace App\Http\Controllers\API\Admin;

use App\Http\Controllers\Controller;
use App\Http\Resources\EmployeeResource;
use App\Mail\EmployeeActivation;
use App\Models\Admin\Assign;
use App\Models\Admin\Employee;
use App\Models\Admin\TimeCard;
use App\Models\Admin\TimeStatus;
use App\User;
use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Spatie\Permission\Models\Role;

class EmployeesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        // $roles = Spatie\Permission\Models\Role::all();
        // $users = \App\User::with('roles')->get();


        $sortRules = $request->input('sort');
        $limit = $request->input('per_page');
        list($field, $dir) = explode('|', $sortRules);
        return response()->json(Employee::with(["user" => function($query){
                $query->with('roles');
        }])->orderBy($field, $dir)->paginate($limit), 200);

        // return response()->json(EmployeeResource::collection(Employee::all()), 200);
    }

    

    public function employees_all(Request $request) {
        echo '<pre>';
        print_r($request->all());
    }



    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        

        // exit;
        // return response()->json($request->all());
        
        $request->validate([
            'EEFN' => 'required',
            'EELN' => 'required',
            'eeName' => 'required',
            'SSN' => 'required',
            'Add1' => 'required',
            'City' => 'required',
            'AddState' => 'required',
            'Zip' => 'required',
            'Phone1' => 'required',
            'DOB' => 'required',
            'OpenFileDate' => 'required',
            'email1' => 'required',
            // 'FedStatus' => 'required',
            // 'FedAllow' => 'required',
            // 'EFWT' => 'required',
            // 'EFW_PER' => 'required',
            // 'EFW' => 'required',
            // 'StStatus' => 'required',
            // 'StAllow' => 'required',
            // 'ESWT' => 'required'
        ]);

        $employee = new Employee();
        $employee->EEFN = $request->EEFN;
        $employee->EEMI = $request->EEMI;
        $employee->EELN = $request->EELN;
        $employee->eeName = $request->eeName;
        $employee->SSN = $request->SSN;
        $employee->Add1 = $request->Add1;
        $employee->Add2 = $request->Add2;
        $employee->City = $request->City;
        $employee->AddState = $request->AddState;
        $employee->Zip = $request->Zip;
        $employee->Phone1 = $request->Phone1;
        $employee->Phone2 = $request->Phone2;
        $employee->DOB = $request->DOB;
        $employee->OpenFileDate = $request->OpenFileDate;
        $employee->EndOfServiceDate = $request->EndOfServiceDate;
        $employee->email1 = $request->email1;
        $employee->FedStatus = $request->FedStatus;
        $employee->FedAllow = $request->FedAllow;
        $employee->EFWT = $request->EFWT;
        $employee->EFW_PER = $request->EFW_PER;
        $employee->EFW = $request->EFW;
        $employee->StStatus = $request->StStatus;
        $employee->StAllow = $request->StAllow;
        $employee->ESWT = $request->ESWT;
        
        if ($request->exists('isMinor')) {
            $employee->isMinor = $request->isMinor;
        }

        $employee->save();


        try{
            if ($employee->id) {
                $send_mail = self::sendAccountCreationEmail($request->emial1, $request->eeName);
                return response()->json($employee, 201);
            } else{
                return response()->json(['message' => 'Bad Request'], 400);
            }
        }catch(\Exception $e){
            if ($e->getCode == 2) {
                return response()->json(['message' => 'Mail sending Failed!'], 400);
            }
            return response()->json(['message' => $e->getMessage()],200);
        }
       
    }





    public static function sendAccountCreationEmail($email,$name){
        // $email = encrypt($email);
        $url = url('/#/create_profile?code='.Crypt::encryptString($email));
        // echo "</br> Decrypted email". decrypt($email);
        // return response()->json(['url' => $url, 'email' => $email, 'dc' =>  Crypt::decryptString(Crypt::encryptString($email))],200);
        // exit('Email Results');
        
        $email_data = array(
            'url' => $url,
            'name' => $name,
            'email' => $email
        );

        try{
            Mail::to($email)->send(new EmployeeActivation($email_data));
            return true;
            // return response()->json('Email Sent', 200);
        }catch(\Exception $e){
            throw new \Exception($e->getMessage(), 2);        }
    }

    public function verify(Request $request) {
        $validator = Validator::make($request->all(), [
            'code' => 'required|min:100'
        ]);

        if ($validator->fails()) {
           return response()->json(['message' => $validator->errors()->get('code')[0]], 400);
        }

        try{
            $email = Crypt::decryptString($request->code);
        }catch(DecryptException $e){
            return response()->json(['message' => 'Invalid Url'],400);
        }

        
        
        if (Employee::where('email1', '=', $email)->exists()) {
            return response()->json($email, 200);
        }else{
            return response()->json(['message' => 'Invalid Url'], 400);
        }
    }

    public function get_code_user($code) {
        
        try{
            $email = Crypt::decryptString($code);

            $user = Employee::where('email1', $email)->first();
            if ($user) {
                return $user;
            }else{
                return false;
            }
        }catch(DecryptException $e){
            return false;
        }

    }

    public function create_profile(Request $request) {
        $request->validate([
            'code' => 'required',
            'email' => 'required|unique:users,email',
            'password' => 'required|min:6|confirmed'
        ]);

        $emp = $this->get_code_user($request->code);
        if ($emp) {
            $user = new \App\User();
            $user->password = Hash::make($request->password);
            $user->email = $request->email;
            $user->first_name = $emp->EEFN;
            $user->last_name = $emp->EELN;
            $user->name = $emp->eeName;
            $user->save();

            if ($user->id) {
                $user->assignRole('EE');
                $emp->user_id = $user->id;
                $emp->save();

                return response()->json($user, 201);
            }else{
                return response()->json(['message' => 'Bad Request'], 400);
            }
        } else {
           return response()->json(['message' => 'Url is Invalid'], 400); 
        }

       
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Admin\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function show(Employee $employee)
    {
        return response()->json(new EmployeeResource($employee), 200);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Admin\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Employee $employee)
    {   

        $employee = Employee::where('weeid', $employee->weeid)->first();
        // return response()->json($employee,400);

        $request->validate([
            'EEFN' => 'required',
            'EELN' => 'required',
            'eeName' => 'required',
            'SSN' => 'required',
            'Add1' => 'required',
            'City' => 'required',
            'AddState' => 'required',
            'Zip' => 'required',
            'Phone1' => 'required',
            'DOB' => 'required',
            'OpenFileDate' => 'required',
            'email1' => 'required',
            // 'FedStatus' => 'required',
            // 'FedAllow' => 'required',
            // 'EFWT' => 'required',
            // 'EFW_PER' => 'required',
            // 'EFW' => 'required',
            // 'StStatus' => 'required',
            // 'StAllow' => 'required',
            // 'ESWT' => 'required'
        ]);

        $employee->EEFN = $request->EEFN;
        $employee->EEMI = $request->EEMI;
        $employee->EELN = $request->EELN;
        $employee->eeName = $request->eeName;
        $employee->SSN = $request->SSN;
        $employee->Add1 = $request->Add1;
        $employee->Add2 = $request->Add2;
        $employee->City = $request->City;
        $employee->AddState = $request->AddState;
        $employee->Zip = $request->Zip;
        $employee->Phone1 = $request->Phone1;
        $employee->Phone2 = $request->Phone2;
        $employee->DOB = $request->DOB;
        $employee->OpenFileDate = $request->OpenFileDate;
        $employee->EndOfServiceDate = $request->EndOfServiceDate;
        $employee->email1 = $request->email1;
        $employee->FedStatus = $request->FedStatus;
        $employee->FedAllow = $request->FedAllow;
        $employee->EFWT = $request->EFWT;
        $employee->EFW_PER = $request->EFW_PER;
        $employee->EFW = $request->EFW;
        $employee->StStatus = $request->StStatus;
        $employee->StAllow = $request->StAllow;
        $employee->ESWT = $request->ESWT;
        
        if ($request->exists('isMinor')) {
            $employee->isMinor = $request->isMinor;
        }

        // $employee->save();

        if ($employee->save()) {
            return response()->json($employee, 200);
        } else{
            return response()->json(['message' => 'Bad Request'], 400);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Admin\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    
    public function destroy($id)
    {   
        Employee::where('weeid', $id)->delete();
        // $employee->delete();
        return response()->json(null, 204);
    }


    public function clock_in(Request $request) {
        $val = [
             'inTime' => 'required',
            'inDate' =>'required'
        ];

        if ($request->user()->clocked_in == 0) {
            $val = array_merge($val, ['shift' => 'required', 'deptname' => 'required', 'client' => 'required']);
        }

        $request->validate($val);



        $user = $request->user();
        $weeid = Employee::where('user_id', $user->id)->first();
        if ($weeid) {
            $weecode = Assign::where('weeid', $weeid->weeid)->first();
            if ($weecode) {
                $time = TimeCard::whereRaw('DATE(datetimeIN) = ?', [$request->inDate])->whereIN('status', ['IN'])->where('weecode', $weecode->weecode)->first();
                if ($time) {
                    return response()->json(['clockIn' => array('status' => 'IN', 'inTime' => $time->timeIN), 'already' => 'yes'], 200);
                }else{
                    $tc = TimeCard::where('weecode', $weecode->weecode)->orderBy('ID', 'DESC')->first();
                    $TimeCard = new TimeCard();
                    if ($tc) {
                        $TimeCard->shiftid = $tc->shiftid;
                        $TimeCard->deptid = $tc->deptid;
                    }else{
                        $TimeCard->shiftid = $request->shift;
                        $TimeCard->deptid = $request->deptname;
                    }

                    


                    //mmddyyyy == mdY
                    $timecode = $weecode->weecode.$TimeCard->shiftid.$TimeCard->deptid.date('mdY', strtotime($request->inDate)).date('hi', strtotime($request->inTime)).'IN';

                    // echo $timecode;

                    // exit;


                    $TimeCard->weeid = $weeid->weeid;
                    $TimeCard->weecode = $weecode->weecode;
                    $TimeCard->eeid = $weeid->weeid;
                    $TimeCard->eecode = $weecode->weecode;
                    $TimeCard->timecode = $timecode;
                    $TimeCard->maintimecode = $timecode;
                    
                    $TimeCard->status = 'IN';
                    
                    
                    $TimeCard->datetimeIN = $request->inTime;
                    $TimeCard->dateIN = $request->inTime;
                    $TimeCard->timeIN = $request->inTime;
                    
                    // echo '<pre>';
                    // print_r($TimeCard);
                    // exit('Some Data');

                    $TimeCard->save();
                    if ($TimeCard->id) {
                        $user->clocked_in = 1;
                        $user->save();

                        //Save a Time Status Entry
                        $TimeStatus = new TimeStatus();
                        $TimeStatus->timecode = $timecode;
                        $TimeStatus->inDate = $request->inTime;
                        $TimeStatus->intime = $request->inTime;

                        $TimeStatus->eeid = $weeid->weeid;
                        $TimeStatus->eecode = $weecode->weecode;
                        $TimeStatus->weeid = $weeid->weeid;
                        $TimeStatus->weecode = $weecode->weecode;

                        $TimeStatus->instatus = 1;
                        $TimeStatus->deptid = $TimeCard->deptid;
                        $TimeStatus->shiftid = $TimeCard->shiftid;

                        $TimeStatus->save();

                        // bkstatus: 0,
                        // bknum: 0,
                        

                        return response()->json(['clockIn' => array('status' => 'IN', 'inTime' => $TimeCard->datetimeIN)], 200);
                    }else{
                        response()->json(['message' => 'Connection Problem...'], 400);
                    }

                }
            }else{
                return response()->json(['message' => 'Employee is not assigned to any client'], 400);
            }
        }else{
            return response()->json(['message' => 'Employee id is missing'], 400);
        }
    }


    public function clock_out(Request $request) {
        $request->validate([
            'outTime' => 'required',
            'outDate' => 'required',
        ]);


        $user = $request->user();

        $weeid = Employee::where('user_id', $user->id)->first();
        if ($weeid) {
                $TimeStatus = TimeStatus::where('weeid', $weeid->weeid)->first();
                if ($TimeStatus) {
                    
                    $save = TimeCard::where('maintimecode', $TimeStatus->timecode)->where('status', 'IN')->update(
                        [
                        'datetimeOUT' => $request->outTime,
                        'timeOUT' => $request->outTime,
                        'dateOUT' => $request->outDate
                    ]);


                    if ($save) {
                        TimeStatus::where('weeid', $weeid->weeid)->delete();
                        return response()->json(['clockOut' => array('status' => null, 'inTime' => null )], 200);
                    }else{
                        response()->json(['message' => 'Connection Problem...'], 400);
                    }
                }else{
                    return response()->json(['message' => 'Not Cloked In'], 400);
                }
        }else{
            return response()->json(['message' => 'Employee id is missing'], 400);
        }
    }

    //Break In User
    public function break_in(Request $request) {
        $user = $request->user();
        $weeid = Employee::where('user_id', $user->id)->first();
        if ($weeid) {
            $weecode = Assign::where('weeid', $weeid->weeid)->first();
            if ($weecode) {
                $TimeCard = TimeCard::whereRaw('DATE(datetimeIN) = ?', [date('Y-m-d')])->where('status', 'IN')->where('weecode', $weecode->weecode)->first();
                
                if ($TimeCard) {
                    $save = TimeCard::where('ID', $TimeCard->ID)->update(['status' => 'BK']);
                    
                    if ($save) {
                        return response()->json(['breakIn' => array('status' => 'BK', 'inTime' => $TimeCard->datetimeIN )], 200);
                    }else{
                        response()->json(['message' => 'Connection Problem...'], 400);
                    }
                }else{
                    return response()->json(['message' => 'Not Clocked In'], 400);
                }
            }else{
                return response()->json(['message' => 'Employee is not assigned to any client'], 400);
            }
        }else{
            return response()->json(['message' => 'Employee id is missing'], 400);
        }
    }
    
    public function break_out(Request $request) {
        $user = $request->user();
        $weeid = Employee::where('user_id', $user->id)->first();
        if ($weeid) {
                $TimeStatus = TimeStatus::where('weeid', $weeid->weeid)->first();
                $TimeCard = TimeCard::where('timecode', $TimeStatus->timecode)->where('status', 'IN')->first();
                
                if ($TimeCard) {
                    $TC = new TimeCard();
                    $TC->timecode = $TimeStatus->timecode.'BK'. $TimeStatus->bknum+1;
                    $TC->maintimecode = $TimeCard->maintimecode;
                    $TC->eeid = $TimeStatus->eeid; 
                    $TC->eecode = $TimeStatus->eecode; 
                    $TC->weeid = $TimeStatus->weeid; 
                    $TC->weecode = $TimeStatus->weecode;
                    $TC->bknum = $TimeStatus->bknum+1;
                    $TC->shiftid = $TimeStatus->shiftid; 
                    $TC->deptid = $TimeStatus->deptid; 
                    $TC->datetimeOUT = date('Y-m-d H:i:s');
                    $TC->dateOUT = date('Y-m-d H:i:s');
                    $TC->timeOUT = date('Y-m-d H:i:s');
                    
                    $TC->save();
                    if ($TC->ID) {
                        $save = TimeStatus::where('timecode', $TimeStatus->timecode)->update(['bkstatus' => 1, 'bknum' => $TC->bknum]);

                        if ($save) {
                            return response()->json(['breakOut' => array('status' => 'BK', 'inTime' => $TimeStatus->inDate )], 200);
                        }else{
                            response()->json(['message' => 'Connection Problem...'], 400);
                        }
                    }
                    
                }else{
                    return response()->json(['message' => 'Not Clocked In'], 400);
                }
         
        }else{
            return response()->json(['message' => 'Employee id is missing'], 400);
        }

    }


    //assig Role
    public function get_user_role(User $user) {
        // return response()->json($user->roles,200);
        $urole =  array_column($user->roles->toArray(), 'name');
        $all = array_column(Role::all()->toArray(), 'name');

        return response()->json(['user_roles'=> $urole, 'roles' => Role::all()], 200);
    }

    public function assign_role(Request $request) {
        $user = User::where('id', $request->id)->first();
        $user->syncRoles($request->roles);
        return response()->json(null, 200);
    }
}
