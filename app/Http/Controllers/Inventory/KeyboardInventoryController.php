<?php 
namespace App\Http\Controllers\Inventory;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Session;
use App\Models\Roll;
use App\Models\User;
use App\Models\Keyboard;
use App\Models\Userinventory;

use DateTime;
use DateInterval;
use DatePeriod;
use DB;
class KeyboardInventoryController extends Controller
{  

    public function __construct(){
       
    }
    
    public function keyboard(Request $request,$id=""){

        if($_SERVER['REQUEST_METHOD'] === 'POST'){

            $validatedData = $request->validate([
                'brand' => 'required|min:2|max:20',
                'serial_no' => 'required|unique:keyboard_details,serial_no',
            ],[

                'serial_no.unique' => 'This Keyboard Model Already  Exist !!',

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

               $res =  Keyboard::insert($inserData);

               if($res){
                    Session::flash('success', 'System Add Successfully');
                    return redirect()->back();
               }else{
                    Session::flash('error', 'Task Created Invalid');
                    return redirect()->back();
               }
        }

        if($id == 'all'){
            $data['keyboard'] = Keyboard::orderBy('id','DESC');
        }else{
            $data['keyboard'] =  DB::table('user_inventory')->rightJoin('keyboard_details', 'user_inventory.keyboard', '=', 'keyboard_details.id')->where('keyboard_details.status',1)->whereNull('user_inventory.keyboard')->select('keyboard_details.*')->orderBy('id','DESC');     
        }

        $data['id'] = $id;
        $data['js_file'] = 'keyboard_inventory';
        $data['title'] = 'Keyboard List';
        return view('inventory/keyboard',$data);
    }

    public function keyboard_status(Request $request ,$id){
        
        $id = encrypt_decrypt('decrypt',$id);
            if($id){
                $check_user = Keyboard::select('id','status')->where('id',$id);

                    if($check_user->count() != 0){

                        if($check_user->first()->status == 1){
                            $updateData = ['status' => 0];
                            $Update = Keyboard::where('id', $id)->update($updateData);
                            Session::flash('success', 'Status Deactive Successfully');
                            return redirect()->back();
                        }else if($check_user->first()->status == 0){
                            $updateData = ['status' => 1];
                            $Update = Keyboard::where('id', $id)->update($updateData);
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

    public function delete_keyboard(Request $request ,$id){

        $id = encrypt_decrypt('decrypt',$id);

            if($id){

                $check_user = Keyboard::select('id','status')->where('id',$id);

                    if($check_user->count() != 0){

                            $Update = Keyboard::where('id',$id)->delete();
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


    function edit_get_keyboard(Request $request ,$id){

        $check_user = Keyboard::where('id',$id);

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

    function edit_keyboard(Request $request){

        $validatedData = $request->validate([
                'brand' => 'required|min:2|max:20',
                'serial_no' => 'required',
            ]);
             $id = $request['id'];
             $serial_no = $request['serial_no'];
            $unique = Keyboard::select('serial_no')->where('id','!=',$id)->where('serial_no',$serial_no)->count();

            if($unique == 0){
                    $brand = strtoupper($request['brand']);
                    $updateData = [
                            'brand' => $brand,
                            'serial_no' => $serial_no,
                        ];


                   $res =  Keyboard::where('id', $id)->update($updateData);

                   if($res){
                        Session::flash('success', 'System Updated Successfully');
                        return redirect()->back();
                   }else{
                        Session::flash('error', 'System Updated Invalid');
                        return redirect()->back();
                   }
            }else{
                 Session::flash('error', 'This Keyboard Serial Number Already  Exist !!');
                 return redirect()->back();
            }

           

    }


 }



?>