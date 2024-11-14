<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB; 
use Illuminate\Support\Facades\Hash;
class UserController extends Controller
{
  public function index(){
    return view('Users.index');
  }
  // public function search_user(request $request){
  //   $val =  $request->get('value');
        
  //   $getdata = DB::table('Users')
  //       ->select('Users.*')
  //       ->where(function ($query) use ($val) {
  //               $query->where(
  //                   'Users.UserId', 'LIKE', $val . '%')->orWhere(
  //                       'Users.FirstName', 'LIKE',  $val . '%')->orWhere(
  //                           'Users.Email', 'LIKE',  $val . '%');
  //       })->limit(2)
  //       ->get();
        
  //   return view('Users.filter_data',['data'=>$getdata]);
  // }
	
	//  FUNCTIUON FOR SEARCHING USER
	
  public function search_user(request $request){
    $val =  $request->get('value');
        
    $getdata = DB::table('Users')
        ->select('Users.*')
        ->where(function ($query) use ($val) {
            $query->where('Users.UserId', 'LIKE', $val . '%')
                  ->orWhere('Users.Email', 'LIKE',  $val . '%')
                  ->orWhere(function ($query) use ($val) {
                      $names = explode(' ', $val);
                      if (count($names) >= 2) {
                          $query->where('Users.FirstName', 'LIKE',  $names[0] . '%')
                                ->where('Users.LastName', 'LIKE',  $names[1] . '%');
                      }
                  });
        })->limit(2)
        ->get();
        
    return view('Users.filter_data',['data'=>$getdata]);
}

   // FUNCTION FOR EDITING USER
	
  public function edit_user($id){ 

    $get_data = DB::table('Users')
    ->leftJoin('Location', 'Location.LocationId', '=', 'Users.LocationId')
    ->select('Users.*', 'Location.Name')
    ->where('Users.UserId', $id)
    ->get();
    return view('Users.edit_user',['getuserdata'=>$get_data]);
  
  }

	
	// FUNCTION FOR ADDING NEW USER
	
  public function add_user(){
  
    return view('Users.add_user');
  }
	
	// FUNCTION FOR STORING USER
	
  public function store_user(request $request){
    $request->validate([
        'fname'=>'required',
    ] );
    $city = $request->ctname;
   $getloc =  DB::table('Location')->where('Name',$city)->get();
   $locationid="";
    if(!$getloc->isEmpty()){
        $locationid = $getloc[0]->LocationId;
    }
    $phone = 0;
    if($request->PhoneNumber !=""){
        $phone = $request->PhoneNumber;
    }

    
    $data = array(
        'FirstName'=>$request->fname,
        'LastName'=>$request->lname,
        'Username'=>$request->username,
        'Email'=>$request->Email,
        'PhoneNumber'=>$phone,
        'LocationId'=>$locationid,
        'IsBlocked'=>0,
        'IsActive'=>0,
        'IsUpdate'=>0,
        'Role'=>0,
        'IsEmailVerify'=>1
    );
    DB::table('Users')->insert($data);
    return redirect()->route('users')->with('success','User Added Sussfully.');
  }

	// FUNCTION FOR UPDATING USER
	
  public function update_user(request $request){
    $city = $request->ctname;
    $id = $request->id;
    $locationid="";
    if($request->ctname !=""){
        $getloc =  DB::table('Location')->where('Name',$city)->get();
       
        if(!$getloc->isEmpty()){
            $locationid = $getloc[0]->LocationId;
        }else{
            return 3;
        }

    }
   
     $phone = 0;
     if($request->phone !=""){
         $phone = $request->phone;
     }
 
     
     $data = array(
         'FirstName'=>$request->fname,
         'LastName'=>$request->lname,
         'Username'=>$request->username,
         'Email'=>$request->Email,
         'PhoneNumber'=>$phone,
         'LocationId'=>$locationid,
         'IsBlocked'=>0,
         'IsActive'=>0,
         'IsUpdate'=>1,
         'Role'=>0,
         'IsEmailVerify'=>1
     );
     $updatedata =  DB::table('Users')->where('UserId',$id)->update($data);

     if($updatedata == 0){
        return 2;
     }
     $get_data = DB::table('Users')
     ->leftJoin('Location', 'Location.LocationId', '=', 'Users.LocationId')
     ->select('Users.*', 'Location.Name')
     ->where('Users.UserId',$id)
     ->get();
   
  
     return view('Users.updated_data',['getuserdata'=>$get_data]);


  }
	
	//FUNCTION FOR admin user

  public function user_index(){
    return view('Users.adm_user_index');
  }

  
// FUNCTION FOR SEARCHING ADMIN USER IN DB
	
  public function search_admin_user(request $request){
    $val =  $request->get('value');
        
    $getdata = DB::table('users')
        ->select('users.*')
        ->where(function ($query) use ($val) {
            $query->where('users.id', 'LIKE', $val . '%')
                  ->orWhere('users.name', 'LIKE',  $val . '%')
                  ->orWhere('users.email', 'LIKE',  $val . '%');
        })->limit(2)
        ->get();
        
    return view('Users.filter_admin_user',['data'=>$getdata]);
  }

	
	// FUNCTION FOR ADDING ADMIN USER
	
  public function add_admin_user(){
    
    return view('Users.add_admin_user');
  }

  // FUNCTION FOR EDITTING ADMIN USER
	
  public function edit_admin_user($id){ 

    $get_data = DB::table('users')->where('id', $id)->get();
    return view('Users.edit_admin_user',['getuserdata'=>$get_data]);
  
  }
  
    // FUNCTION FOR STORING ADMIN USER

  public function store_admin_user(request $request){
    $request->validate([
        'name'=>'required',
        'email'=>'required|email',
        'password'=>'required|min:8',
    ] ); 

    $hashedPassword = Hash::make($request->password);
    $data = array(
        'name'=>$request->name,
        'email'=>$request->email,
        'password'=> $hashedPassword,       
        'created_at'=>now(),       
    );
    
    DB::table('users')->insert($data);
    return redirect()->route('all_admin_user')->with('success','User Added Successfully.');
  }

  
    // FUNCTION FOR STORING ADMIN USER

  public function update_admin_user(request $request){
   
    $id = $request->id;

    $data = array(
      'name'=>$request->name,
      'email'=>$request->email,     
      'updated_at'=>now(),       
  );
     $updatedata =  DB::table('users')->where('id',$id)->update($data);

     if($updatedata == 0){
        return 2;
     }

     $get_data = DB::table('users')->where('id', $id)->get();
     return view('Users.updated_adm_user',['getuserdata'=>$get_data]);


  }
	
	// FUNCTION FOR GETTING ALL ADMIN USERS
	
	 public function all_admin_user(){
    $getuser = DB::table('users')->orderby('id','asc')->get();
    return view('Users.all_adm_user',['getuser'=>$getuser]);
  }
	
	
	// FUNCTION FOR FINDING WHICH ADMIN IS ACTIVE
	
  public function admin_active(request $request){
     $value =  $request->get('value');
     $id = $request->get('id');
     $data = array(
        'isActive'=>$value,           
     );
     DB::table('users')->where('id', $id)->update($data);

     $getuser = DB::table('users')->orderby('id','asc')->get();
     return view('Users.filter_all_adm_users',['getuser'=>$getuser]);

  }

	// FUNCTION FOR DELETE ADMIN 
	
  public function delete_admin_users(request $request){
      $id = $request->get('id');
      DB::table('users')->where('id',$id)->delete();

      $getuser = DB::table('users')->orderby('id','asc')->get();
      return view('Users.filter_all_adm_users',['getuser'=>$getuser]);
  }
  
}
