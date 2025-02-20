<?php 
namespace App\Http\Controllers\Inventory;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Session;
use App\Models\Roll;
use App\Models\User;
use App\Models\Laptop;
use App\Models\Userinventory;
use DateTime;
use DateInterval;
use DatePeriod;
use DB;
class LaptopInventoryController extends Controller
{  

    public function __construct(){
       
    }
    
    public function laptop(Request $request ,$id=""){

        if($_SERVER['REQUEST_METHOD'] === 'POST'){

            $validatedData = $request->validate([
                'brand' => 'required|min:2|max:20',
                'serial_no' => 'required|unique:laptop_details,serial_no',
                'processors' => 'required',
            ],[

                'serial_no.unique' => 'This Laptop Model Already  Exist !!',

            ]);

            $brand = strtoupper($request['brand']);
            $serial_no = $request['serial_no'];
            $processors = $request['processors'];
            $inserData = [
                    'brand' => $brand,
                    'serial_no' => $serial_no,
                    'processors' => $processors,
                    'status' => 1,
                    'created_at' => date('d-m-Y h:i:s'),
                ];

               $res =  Laptop::insert($inserData);

               if($res){
                    Session::flash('success', 'System Add Successfully');
                    return redirect()->back();
               }else{
                    Session::flash('error', 'Task Created Invalid');
                    return redirect()->back();
               }
        }
        if($id == 'all'){
            $data['laptop'] = Laptop::orderBy('id','DESC');
        }else{

            $data['laptop'] =  DB::table('user_inventory')

                ->rightJoin('laptop_details', 'user_inventory.device_brand' ,'=', 'laptop_details.id',)->where('laptop_details.status',1)->whereNull('user_inventory.device_brand')->select('laptop_details.*');  

               
        }
        $data['id'] = $id;
        $data['js_file'] = 'inventory';
        $data['title'] = 'Laptop List';
        return view('inventory/laptop',$data);
    }

    public function lap_status(Request $request ,$id){
        
        $id = encrypt_decrypt('decrypt',$id);

            if($id){
                $check_user = Laptop::select('id','status')->where('id',$id);

                    if($check_user->count() != 0){

                        if($check_user->first()->status == 1){
                            $updateData = ['status' => 0];
                            $Update = Laptop::where('id', $id)->update($updateData);
                            Session::flash('success', 'Status Deactive Successfully');
                            return redirect()->back();
                        }else if($check_user->first()->status == 0){
                            $updateData = ['status' => 1];
                            $Update = Laptop::where('id', $id)->update($updateData);
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

    public function delete_laptop(Request $request ,$id){

        $id = encrypt_decrypt('decrypt',$id);

            if($id){

                $check_user = Laptop::select('id','status')->where('id',$id);

                    if($check_user->count() != 0){

                            $Update = Laptop::where('id',$id)->delete();
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


    function edit_get_laptop(Request $request ,$id){

        $check_user = Laptop::where('id',$id);

            if($check_user->count() != 0){
                $get_details = $check_user->first();
                $array = [
                    'id' => $id,
                    'brand' => $get_details->brand,
                    'serial_no' => $get_details->serial_no,
                    'processors' => $get_details->processors,
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

    function edit_laptop(Request $request){

        $validatedData = $request->validate([
                'brand' => 'required|min:2|max:20',
                'serial_no' => 'required',
                'processors' => 'required',
            ]);
             $id = $request['id'];
             $serial_no = $request['serial_no'];
            $unique = Laptop::select('serial_no')->where('id','!=',$id)->where('serial_no',$serial_no)->count();

            if($unique == 0){
                    $brand = strtoupper($request['brand']);
                    $processors = $request['processors'];
                    $updateData = [
                            'brand' => $brand,
                            'serial_no' => $serial_no,
                            'processors' => $processors,
                        ];


                   $res =  Laptop::where('id', $id)->update($updateData);

                   if($res){
                        Session::flash('success', 'System Updated Successfully');
                        return redirect()->back();
                   }else{
                        Session::flash('error', 'System Updated Invalid');
                        return redirect()->back();
                   }
            }else{
                 Session::flash('error', 'This Laptop Model Already  Exist !!');
                 return redirect()->back();
            }

           

    }

 }



?>