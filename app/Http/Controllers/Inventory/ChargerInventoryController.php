<?php 
namespace App\Http\Controllers\Inventory;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Session;
use App\Models\Roll;
use App\Models\User;
use App\Models\Charger;
use App\Models\Userinventory;
use DateTime;
use DateInterval;
use DatePeriod;
use DB;
class ChargerInventoryController extends Controller
{  

    public function __construct(){
       
    }
    
    public function charger(Request $request ,$id=""){

        if($_SERVER['REQUEST_METHOD'] === 'POST'){

            $validatedData = $request->validate([
                'brand' => 'required|min:2|max:20',
                'serial_no' => 'required|unique:charger_details,serial_no',
            ],[

                'serial_no.unique' => 'This Charger Model Already  Exist !!',

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

               $res =  Charger::insert($inserData);

               if($res){
                    Session::flash('success', 'System Add Successfully');
                    return redirect()->back();
               }else{
                    Session::flash('error', 'System Add Invalid');
                    return redirect()->back();
               }
        }

        if($id == 'all'){
            $data['charger'] = Charger::orderBy('id','DESC');
        }else{

            $data['charger'] =  DB::table('user_inventory')->rightJoin('charger_details', 'user_inventory.charger', '=', 'charger_details.id')->where('charger_details.status',1)->whereNull('user_inventory.charger')->select('charger_details.id')->orderBy('id','DESC'); 
               
        }



        $data['id'] = $id;
        $data['js_file'] = 'charger_inventory';
        $data['title'] = 'Charger List';
        return view('inventory/charger',$data);
    }

    public function charger_status(Request $request ,$id){
        
        $id = encrypt_decrypt('decrypt',$id);
            if($id){
                $check_user = Charger::select('id','status')->where('id',$id);

                    if($check_user->count() != 0){

                        if($check_user->first()->status == 1){
                            $updateData = ['status' => 0];
                            $Update = Charger::where('id', $id)->update($updateData);
                            Session::flash('success', 'Status Deactive Successfully');
                            return redirect()->back();
                        }else if($check_user->first()->status == 0){
                            $updateData = ['status' => 1];
                            $Update = Charger::where('id', $id)->update($updateData);
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

    public function delete_charger(Request $request ,$id){

        $id = encrypt_decrypt('decrypt',$id);

            if($id){

                $check_user = Charger::select('id','status')->where('id',$id);

                    if($check_user->count() != 0){

                            $Update = Charger::where('id',$id)->delete();
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


    function edit_get_charger(Request $request ,$id){

        $check_user = Charger::where('id',$id);

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

    function edit_charger(Request $request){

        $validatedData = $request->validate([
                'brand' => 'required|min:2|max:20',
                'serial_no' => 'required',
            ]);
             $id = $request['id'];
             $serial_no = $request['serial_no'];
            $unique = Charger::select('serial_no')->where('id','!=',$id)->where('serial_no',$serial_no)->count();

            if($unique == 0){
                    $brand = strtoupper($request['brand']);
                    $updateData = [
                            'brand' => $brand,
                            'serial_no' => $serial_no,
                        ];


                   $res =  Charger::where('id', $id)->update($updateData);

                   if($res){
                        Session::flash('success', 'System Updated Successfully');
                        return redirect()->back();
                   }else{
                        Session::flash('error', 'System Updated Invalid');
                        return redirect()->back();
                   }
            }else{
                 Session::flash('error', 'This Charger Serial Number Already  Exist !!');
                 return redirect()->back();
            }

           

    }

 }



?>