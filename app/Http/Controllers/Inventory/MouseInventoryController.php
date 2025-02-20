<?php 
namespace App\Http\Controllers\Inventory;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Session;
use App\Models\Roll;
use App\Models\User;
use App\Models\Mouse;
use App\Models\Userinventory;
use DateTime;
use DateInterval;
use DatePeriod;
use DB;
class MouseInventoryController extends Controller
{  

    public function __construct(){
       
    }
    
    public function mouse(Request $request ,$id=""){

        if($_SERVER['REQUEST_METHOD'] === 'POST'){

            $validatedData = $request->validate([
                'brand' => 'required|min:2|max:20',
                'serial_no' => 'required|unique:mouse_details,serial_no',
            ],[

                'serial_no.unique' => 'This Mouse Model Already  Exist !!',

            ]);

            $brand = strtoupper($request['brand']);
            $serial_no = $request['serial_no'];
            $processors = $request['processors'];
            $inserData = [
                    'brand' => $brand,
                    'serial_no' => $serial_no,
                    'status' => 1,
                    'created_at' => date('d-m-Y h:i:s'),
                ];

               $res =  Mouse::insert($inserData);

               if($res){
                    Session::flash('success', 'System Add Successfully');
                    return redirect()->back();
               }else{
                    Session::flash('error', 'Task Created Invalid');
                    return redirect()->back();
               }
        } 

        if($id == 'all'){
            $data['mouse'] = Mouse::orderBy('id','DESC');
        }else{
            $data['mouse'] =  DB::table('user_inventory')->rightJoin('mouse_details', 'user_inventory.mouse', '=', 'mouse_details.id')->where('mouse_details.status',1)->whereNull('user_inventory.mouse')->select('mouse_details.*')->orderBy('id','DESC'); 

            
        }
        $data['id'] = $id;
        $data['js_file'] = 'mouse_inventory';
        $data['title'] = 'Mouse List';
        return view('inventory/mouse',$data);
    }

    public function mouse_status(Request $request ,$id){
        
        $id = encrypt_decrypt('decrypt',$id);
            if($id){
                $check_user = Mouse::select('id','status')->where('id',$id);

                    if($check_user->count() != 0){

                        if($check_user->first()->status == 1){
                            $updateData = ['status' => 0];
                            $Update = Mouse::where('id', $id)->update($updateData);
                            Session::flash('success', 'Status Deactive Successfully');
                            return redirect()->back();
                        }else if($check_user->first()->status == 0){
                            $updateData = ['status' => 1];
                            $Update = Mouse::where('id', $id)->update($updateData);
                            Session::flash('success', 'Status Active Successfully');
                            return redirect()->back();
                        }else{
                            Session::flash('error', 'Inavlid !!');
                            return redirect()->back();
                        }
                    }else{
                        Session::flash('error', 'Invalid data !!');
                        return redirect()->back();
                    }
            }else{
                Session::flash('error', 'Invalid data Id !!');
                return redirect()->back();
            }

    }

    public function delete_mouse(Request $request ,$id){

        $id = encrypt_decrypt('decrypt',$id);

            if($id){

                $check_user = Mouse::select('id','status')->where('id',$id);

                    if($check_user->count() != 0){

                            $Update = Mouse::where('id',$id)->delete();
                            if($Update){
                                Session::flash('success', 'Record Delete Successfully');
                                return redirect()->back();
                            }else{
                                Session::flash('error', 'Invalid !!');
                                return redirect()->back();
                            }
                            
                    }else{
                        Session::flash('error', 'Invalid data !!');
                        return redirect()->back();
                    }
            }else{
                Session::flash('error', 'Invalid data Id !!');
                return redirect()->back();
            }
    }


    function edit_get_mouse(Request $request ,$id){

        $check_user = Mouse::where('id',$id);

            if($check_user->count() != 0){
                $get_details = $check_user->first();
                $array = [
                    'id' => $id,
                    'brand' => $get_details->brand,
                    'serial_no' => $get_details->serial_no,
                    'status' => 1,
                ]; 
               echo json_encode($array); die;
            }else{
                $array = [
                'msg' => 'Invalid Details',
                'status' => 0,
                ];
               echo json_encode($array); die;
        }
    }

    function edit_mouse(Request $request){

        $validatedData = $request->validate([
                'brand' => 'required|min:2|max:20',
                'serial_no' => 'required',
            ]);
             $id = $request['id'];
             $serial_no = $request['serial_no'];
            $unique = Mouse::select('serial_no')->where('id','!=',$id)->where('serial_no',$serial_no)->count();

            if($unique == 0){
                    $brand = strtoupper($request['brand']);
                    $updateData = [
                            'brand' => $brand,
                            'serial_no' => $serial_no,
                        ];


                   $res =  Mouse::where('id', $id)->update($updateData);

                   if($res){
                        Session::flash('success', 'System Updated Successfully');
                        return redirect()->back();
                   }else{
                        Session::flash('error', 'System Updated Invalid');
                        return redirect()->back();
                   }
            }else{
                 Session::flash('error', 'This Mouse Serial Number Already  Exist !!');
                 return redirect()->back();
            }

           

    }

 }



?>