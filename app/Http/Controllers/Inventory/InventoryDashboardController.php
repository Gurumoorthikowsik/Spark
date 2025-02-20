<?php
namespace App\Http\Controllers\Inventory;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Session;
use App\Models\Roll;
use App\Models\User;
use App\Models\Leavedays;
use App\Models\Laptop;
use App\Models\Charger;
use App\Models\Mouse;
use App\Models\Keyboard;
use App\Models\Userinventory;
use App\Models\Brand;
use App\Models\Accessories;
use App\Models\MobileCharger;
use App\Models\ReturnProduct;
use App\Models\Addproduct;
use App\Models\Users_inventory;
use App\Models\Os;
use App\Models\Sim;
use App\Models\ProductInfo;
use App\Models\User_add_inventory;
use App\Models\Return_stock;
use Validator;
use App\Models\Simcard;

use DateTime;
use DateInterval;
use DatePeriod;g
use DB;
use Carbon\Carbon;
use App\Models\ProductStock;
class InventoryDashboardController extends Controller
{

    public function __construct(){

    }

    public function index(Request $request ){

        $data['rolled'] = DB::table('add_product')
        ->join('brand', 'add_product.id', '=', 'brand.id')
        ->join('accessories', 'accessories.id', '=', 'add_product.id')
        ->select('add_product.id','add_product.brand','add_product.accessories','accessories.accessories_name','brand.brand_name')
        ->get();

        $get_user_stack = User_add_inventory::select('product_id')->get()->toArray();
		$inStack_id=[];
		foreach($get_user_stack as $key => $value){
			$inStack_id[] = $value['product_id'];
		}

        $data['available'] =  DB::table('add_product')
        ->join('productinfo', 'add_product.id', '=', 'productinfo.product_id')
        ->leftJoin('os', 'os.id', '=', 'productinfo.os')
        ->leftJoin('sim', 'sim.id', '=', 'productinfo.sim')
        ->leftJoin('simcard', 'simcard.id', '=', 'productinfo.simcard')

        ->select( 'add_product.serial_no','add_product.id', 'productinfo.processor_no','add_product.brand','add_product.accessories','add_product.status','productinfo.userid','productinfo.os','productinfo.sim','productinfo.simcard','productinfo.phone_no','productinfo.mobile_charger','productinfo.mobile_charger','productinfo.Laptop_charger','os.os_name','sim.sim_type','simcard.sim_name')->whereNotIn('add_product.id',$inStack_id)->count();


        $data['return_stock'] = Return_stock::orderBy('id')->count();
        $data['roll'] = Accessories::select('accessories_name','id')->where('status',1);
        $data['brand_count'] = Brand::select('brand_name','id')->where('status',1)->count();
        $data['access_count'] = Accessories::select('brand_name','id')->where('status',1)->count();
        $data['total_laptop'] = Laptop::select('id')->count();
        $data['total_charger'] = Charger::select('id')->count();
        $data['total_mouse'] = Mouse::select('id')->count();
        $data['total_keyboard'] = Keyboard::select('id')->count();

        $data['js_file'] = '';
        $data['title'] = 'Inventory Dashboard';
        return view('inventory/dashboard',$data);
    }

    public function return_stock(Request $request){


        $data['mobile_charger'] = MobileCharger::select('*')->orderBy('id', 'DESC')->get();
        $data['os'] = Os::select('*')->orderBy('id', 'DESC')->get();
        $data['sim'] = Sim::select('*')->orderBy('id', 'DESC')->get();
        $data['simcard'] = Simcard::select('*')->orderBy('id', 'DESC')->get();
        $data['return_product'] =  ReturnProduct::select('*')->orderBy('id', 'DESC')->get();
        $data['brand'] =  Brand::select('*')->orderBy('id', 'DESC')->get();
        $data['accessories'] =  Accessories::select('*')->orderBy('id', 'DESC')->get();
        $data['title'] = 'Inventory Dashboard';
        $data['js_file'] = 'return_stock';
        return view('inventory/return_product',$data);
    }


    public function add_product(Request $request ){
        $data['product'] =  Addproduct::all();
        $data['brand'] =  Brand::select('*')->orderBy('id', 'DESC')->get();
        $data['accessories'] =  Accessories::select('*')->orderBy('id', 'DESC')->get();
        $data['js_file'] = 'add_product';
        $data['title'] = 'Inventory Dashboard';
        return view('inventory/add_product',$data);
    }


    public function add_brand(Request $request ){
        // $data['os'] = Os::orderBy('id','DESC');
        $data['add_accessories'] = Accessories::orderBy('id','DESC');
        $data['add_brand'] = Brand::orderBy('id','DESC');
        $data['js_file'] = 'add_product';
        $data['title'] = 'Inventory Dashboard';
        return view('inventory/add_brand',$data);
    }

    public function add_sim(Request $request ){
        $data['add_sim'] = Sim::orderBy('id','DESC');
        $data['js_file'] = 'add_product';
        $data['title'] = 'Inventory Dashboard';
        return view('inventory/add_sim',$data);
    }

    public function add_charger(Request $request ){
        $data['add_charger'] = Charger::orderBy('id','DESC');
        $data['js_file'] = 'add_product';
        $data['title'] = 'Inventory Dashboard';
        return view('inventory/add_charger',$data);
    }

    public function add_accessories(Request $request ){
        $data['add_accessories'] = Accessories::orderBy('id','DESC');
        $data['js_file'] = 'add_product';
        $data['title'] = 'Inventory Dashboard';
        return view('inventory/add_accessories',$data);
    }

    public function return_product_submit(Request $request)
        {

            $validatedData = $request->validate([
                'date'=> 'required',
	            'brand' => 'required',
	            'accessories' => 'required',
                'serial_no' => 'required|unique:return_product,serial_no',
	            'reason' => 'required',
                'return_by' => 'required',
                'product_condition' => 'required',
	        ], [
                'date.required' => 'Choose Date',
	            'brand.required' => 'Choose Brand',
	            'accessories.required' => 'Choose Accessories',
                'serial_no.unique' => 'This Serial Number Already  Exist !!',
	            'reason.required' => 'Please Enter a Reason',
                'return_by.required' => 'Please Enter a Return By',
                'product_condition.required' => 'Please Enter a Product Condition',
	        ]);
            $date  = $request['date'];
            $brand  = $request['brand'];
            $accessories      = $request['accessories'];
            $processor_no    = $request['processor_no'];
            $serial_no    = $request['serial_no'];
            $reason      = $request['reason'];
            $return_by    = $request['return_by'];
            $product_condition  = $request['product_condition'];
            $os = $request['os'];
            $sim = $request['sim'];
            $simcard = $request['simcard'];
            $phone_no = $request['phone_no'];
            $mobile_charger  = $request['mobile_charger'];
            $Laptop_charger  = $request['Laptop_charger'];
            $remarks  = $request['remarks'];



            $insertData = [
                'date' => $date,
                'brand' => $brand,
                'accessories'=> $accessories,
                'processor_no' => $processor_no,
                'serial_no'  => $serial_no,
                'reason' => $reason,
                'return_by' => $return_by,
                'product_condition' => $product_condition,
                'os' => $os,
                'sim' => $sim,
                'simcard'=>$simcard,
                'phone_no' => $phone_no,
                'mobile_charger' => $mobile_charger,
                'Laptop_charger' => $Laptop_charger,
                'remarks' => $remarks,
                'created_at'=>Carbon::now()
            ];

            $Insert = ReturnProduct::insert($insertData);

            if($Insert){
                Session::flash('success', 'Return Product Data Submitted Successfully');
                return redirect()->back();z
            }
        }

    public function add_os(Request $request ){
        $data['os'] = Os::orderBy('id','DESC');
        $data['js_file'] = 'add_product';
        $data['title'] = 'Inventory Dashboard';
        return view('inventory/add_os',$data);
    }

    public function add_mobile(Request $request ){
        $data['sim'] = Sim::select('*')->orderBy('id', 'DESC')->get();
        $data['os'] = Os::orderBy('id','DESC');
        $data['js_file'] = 'add_mobile';
        $data['title'] = 'Inventory Dashboard';
        return view('inventory/add_mobile',$data);
    }

    public function status(Request $request ,$id){


        $id = $request['id'];

                $check_user = Addproduct::select('id','status')->where('id',$id);

                    if($check_user->count() != 0){

                        if($check_user->first()->status == 1){
                            $updateData = ['status' => 0];
                            $Update = Addproduct::where('id', $id)->update($updateData);
                            Session::flash('success', 'Status Deactive Successfully');
                            return redirect()->back();
                        }else if($check_user->first()->status == 0){
                            $updateData = ['status' => 1];
                            $Update = Addproduct::where('id', $id)->update($updateData);
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
    }


    public function os_status(Request $request ,$id){

            $id = $request['id'];

            $check_user = Os::select('id','status')->where('id',$id);

                    if($check_user->count() != 0){

                        if($check_user->first()->status == 1){
                            $updateData = ['status' => 0];
                            $Update = Os::where('id', $id)->update($updateData);
                            Session::flash('success', 'Status Deactive Successfully');
                            return redirect()->back();
                        }else if($check_user->first()->status == 0){
                            $updateData = ['status' => 1];
                            $Update = Os::where('id', $id)->update($updateData);
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
    }


    function delete_product($id){

        $check_inventory =  Addproduct::where('id',$id);

            if($check_inventory->count() != 0){

                $inventory = $check_inventory->first();
                Addproduct::where('id', $id)->delete();

                Session::flash('success', 'User Inventory Delete Successfully');
                return redirect()->back();
            }else{
                Session::flash('error', 'Some Error Occured');
                return redirect()->back();
            }

    }


    public function return_status(Request $request ,$id){


        $id = $request['id'];

        $check_user = ReturnProduct::select('id','status')->where('id',$id);

            if($check_user->count() != 0){

                if($check_user->first()->status == 1){
                    $updateData = ['status' => 0];
                    $Update = ReturnProduct::where('id', $id)->update($updateData);
                    Session::flash('success', 'Status Deactive Successfully');
                    return redirect()->back();
                }else if($check_user->first()->status == 0){
                    $updateData = ['status' => 1];
                    $Update = ReturnProduct::where('id', $id)->update($updateData);
                    Session::flash('success', 'Status Active Successfully');
                    return redirect()->back();
                }else{
                    Session::flash('error', 'Inavlid !!');
                    return redirect()->back();
                }
            }
            else{
                Session::flash('error', 'Invalid data !!');
                return redirect()->back();
            }
    }

    function delete_returnproduct($id){

        $check_inventory =  ReturnProduct::where('id',$id);

            if($check_inventory->count() != 0){

                $inventory = $check_inventory->first();
                ReturnProduct::where('id', $id)->delete();

                Session::flash('success', 'User Inventory Delete Successfully');
                return redirect()->back();
            }else{
                Session::flash('error', 'Some Error Occured');
                return redirect()->back();
            }

    }

    public function add_product_submit(Request $request) {


            $validatedData = $request->validate([
	            'brand_name' => 'required',
	        ], [
	            'brand_name.required' => 'Choose Staff Roll',
	        ]);
        $id = $request['id'];
        $brand  = $request['brand_name'];

        $check_brand = Brand::select('brand_name')->where('id','!=',$id)->where('brand_name',$brand)->count();

        if($check_brand != 0){

          Session::flash('error', 'Brand Name Already Exist!!');
          return redirect()->back();
        }

        $insertData = [
            'brand_name'   => $brand,
            'status' => 1,
            'created_at' => date('d-m-Y h:i:s'),
        ];

        $Insert = Brand::insert($insertData);

            if($Insert){
                Session::flash('success', 'Brand Added Successfully');
                return redirect('/add_brand');
            }else{
                    Session::flash('error', 'Brand Added Invalid');
                    return redirect('/add_brand');
            }
        }


        public function add_access_submit(Request $request)
        {

            $validatedData = $request->validate([
	            'accessories_name' => 'required',
	        ], [
	            'accessories_name.required' => 'Choose Staff Roll',
	        ]);
            $id = $request['id'];
            $accessories_name  = $request['accessories_name'];

            $check_accessories = Accessories::select('accessories_name')->where('id','!=',$id)->where('accessories_name',$accessories_name)->count();

            if($check_accessories != 0){

            Session::flash('error', 'Accessories Name Already Exist!!');
            return redirect()->back();
            }

            $insertData = [
                'accessories_name'   => $accessories_name,
                'status' => 1,
                'created_at' => date('d-m-Y h:i:s'),
            ];

            $Insert = Accessories::insert($insertData);

            if($Insert){
                Session::flash('success', 'Accessories Added Successfully');
                return redirect()->back();
            }
        }

        function edit_add_brand(Request $request){

                if($_SERVER['REQUEST_METHOD'] === 'POST'){
                  $validatedData = $request->validate([
                       'brand_name' => 'required',
                   ], [
                       'brand_name.required' => 'Please Choose The Brand Name',
                   ]);

                   $brand_name  = $request['brand_name'];
                   $id = $request['pick_brand_id'];

                   $updatedData = [
                       'brand_name' => $brand_name,
                       'created_at'  =>  date('d-m-Y h:i:s')
                   ];

                   $res = Brand::where('id',$id)->update($updatedData);

                       if($res){
                           Session::flash('success', 'Brand Updated Successfully');
                           return redirect()->back();
                       }else{
                           Session::flash('error', 'Updated Invalid');
                           return redirect()->back();
                       }
                }

           }

           function delete_add_brand($id){

            $brand_name =  Brand::where('id',$id);

            if($brand_name->count() != 0){
                Brand::where('id', $id)->delete();

                Session::flash('success', 'Brand Name Deleted Successfully');
                return redirect()->back();
            }else{
                Session::flash('error', 'Some Error Occured');
                return redirect()->back();
            }
        }

        function edit_add_access(Request $request){

            if($_SERVER['REQUEST_METHOD'] === 'POST'){
              $validatedData = $request->validate([
                   'accessories_name' => 'required',
               ], [
                   'accessories_name.required' => 'Please Enter The Accessories Name',
               ]);

               $accessories_name  = $request['accessories_name'];
               $id = $request['id'];


               $updatedData = [
                   'accessories_name' => $accessories_name,
                   'created_at'  =>  date('d-m-Y h:i:s')
               ];

               $res = Accessories::where('id',$id)->update($updatedData);
                   if($res){
                       Session::flash('success', 'Accessories Name Updated Successfully');
                       return redirect()->back();
                   }else{
                       Session::flash('error', 'Updated Invalid');
                       return redirect()->back();
                   }
            }

            $data['js_file'] = 'add_product';
            $data['title'] = 'Inventory Dashboard';
            return view('inventory/add_accessories',$data);
       }


       function delete_add_access($id){

        $accessories_name =  Accessories::where('id',$id);

        if($accessories_name->count() != 0){
            Accessories::where('id', $id)->delete();

            Session::flash('success', 'Accessories Name Deleted Successfully');
            return redirect()->back();
        }else{
            Session::flash('error', 'Some Error Occured');
            return redirect()->back();
        }
    }


    function edit_get_product(Request $request ,$id){

        $check_user = Addproduct::where('id',$id);

            if($check_user->count() != 0){
                $get_details = $check_user->first();
                $array = [
                    'id' => $id,
                    'serial_no' => $get_details->serial_no,
                    // 'processor_no' => $get_details->processor_no,
                    'brand' => $get_details->brand,
                    'accessories' => $get_details->accessories,
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


    function edit_add_product(Request $request){

        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            $validatedData = $request->validate([
                'serial_no' => 'required',
                //  'processor_no' => 'required',
                 'brand' => 'required',
                 'accessories' => 'required',
             ], [
                 'serial_no.required' => 'Please Enter a Serial Number',
                 'processor_no.required' => 'Please Enter a Processor Number',
                 'brand.required' => 'Please Choose The Brand',
                 'accessories.required' => 'Please Choose The Accessories',
             ]);
             $serial_no  = $request['serial_no'];
            //  $processor_no  = $request['processor_no'];
             $brand  = $request['brand'];
             $accessories  = $request['accessories'];
             $id = $request['id'];


             $updatedData = [
                 'serial_no' => $serial_no,
                //  'processor_no' => $processor_no,
                 'brand' => $brand,
                 'accessories' => $accessories,
             ];

             $res = Addproduct::where('id',$id)->update($updatedData);
                 if($res){
                     Session::flash('success', 'Product Updated Successfully');
                     return redirect()->back();
                 }else{
                     Session::flash('error', 'Updated Invalid');
                     return redirect()->back();
                 }
          }

          $data['js_file'] = 'add_product';
          $data['title'] = 'Inventory Dashboard';
          return view('inventory/add_product',$data);
        }


        function edit_add_os(Request $request){


            if($_SERVER['REQUEST_METHOD'] === 'POST'){
              $validatedData = $request->validate([
                   'os_name' => 'required',
               ], [
                   'os_name.required' => 'Please Choose The OS Name',
               ]);

               $os_name  = $request['os_name'];
               $id = $request['id'];

               $updatedData = [
                   'os_name' => $os_name,
               ];

               $res = Os::where('id',$id)->update($updatedData);

                   if($res){
                       Session::flash('success', 'OS Name Updated Successfully');
                       return redirect()->back();
                   }else{
                       Session::flash('error', 'Updated Invalid');
                       return redirect()->back();
                   }
            }

            $data['js_file'] = 'add_product';
            $data['title'] = 'Inventory Dashboard';
            return view('inventory/add_os',$data);
       }

     function staff_inventory(){

        $data['inventory'] =  DB::table('user_info')
        ->join('users_add_inventory', 'user_info.userid', '=', 'users_add_inventory.userid')


        ->leftJoin('add_product', 'users_add_inventory.brand', '=', 'add_product.id')


        ->select( 'user_info.username', 'user_info.employee_id','user_info.status','add_product.brand','add_product.serial_no','users_add_inventory.brand',
                'users_add_inventory.accessories','users_add_inventory.created_at','users_add_inventory.sim','users_add_inventory.simcard','users_add_inventory.phone_no','users_add_inventory.mobile_charger','users_add_inventory.processor_no',
                'users_add_inventory.serial_no','users_add_inventory.Laptop_charger','users_add_inventory.os','users_add_inventory.id')->orderBy('user_info.username','ASC');


        $data['js_file'] = 'staff';
        $data['title'] = 'Staff Inventory List';
        return view('inventory/inventory_list',$data);

    }



    function delete_staff_inventory($id){

        $check_inventory =  Users_inventory::where('id',$id);

            if($check_inventory->count() != 0){

                $inventory = $check_inventory->first();
                Users_inventory::where('id', $id)->delete();
                // Laptop::where('id', $inventory->device_brand)->update(['assigned' => 0]);
                // Charger::where('id', $inventory->charger)->update(['assigned' => 0]);
                // keyboard::where('id', $inventory->keyboard)->update(['assigned' => 0]);
                // Mouse::where('id', $inventory->mouse)->update(['assigned' => 0]);

                Session::flash('success', 'User Inventory Deleted Successfully');
                return redirect()->back();
            }else{
                Session::flash('error', 'Some Error Occured');
                return redirect()->back();
            }

    }

    function product_insert(Request $request)
    {

                    if($request->ajax())
                    {
                    $rules = array(

                    'serial_no*'  => 'required',
                //    'processor_no*'  => 'required',
                    'brand'=>'required',
                    'accessories'=>'required'
                    );
                    $error = Validator::make($request->all(), $rules);
                    if($error->fails())
                    {
                    return response()->json([
                    'error'  => $error->errors()->all()
                    ]);
                    }

                    $serial_no = $request->serial_no;
                //   $processor_no = $request->processor_no;
                    $brand = $request->brand;
                    $accessories = $request->accessories;
                //   for($count = 0; $count < count($serial_no); $count++)
                    {
                    $data = array(

                    'serial_no' => $serial_no,
                    // 'processor_no'  => $processor_no,
                    'brand' => $brand,
                    'accessories' => $accessories,
                    );
                    $insert_data = $data;
                    }

                    Addproduct::insert($insert_data);
                    return response()->json([
                    'success'  => 'Product Added successfully.'
                    ]);
                    }

    }

    public function add_os_submit(Request $request)
    {

                $validatedData = $request->validate([
                    'os_name' => 'required',
                ], [
                    'os_name.required' => 'Choose OS Name',
                ]);
            $id = $request['id'];
            $os  = $request['os_name'];

            $check_os = Os::select('os_name')->where('id','!=',$id)->where('os_name',$os)->count();

            if($check_os != 0){

            Session::flash('error', 'OS Name Already Exist!!');
            return redirect()->back();
            }

            $insertData = [
                'os_name'   => $os,
                'status' => 1,
                'created_at' => date('d-m-Y h:i:s'),
            ];

            $Insert = Os::insert($insertData);

            if($Insert){
                Session::flash('success', 'OS Name Submitted Successfully');
                return redirect()->back();
            }
    }

    function delete_os($id){

        $delete_os =  Os::where('id',$id);

            if($delete_os->count() != 0){

                $inventory = $delete_os->first();
                Os::where('id', $id)->delete();

                Session::flash('success', 'User Inventory Delete Successfully');
                return redirect()->back();
            }else{
                Session::flash('error', 'Some Error Occured');
                return redirect()->back();
            }

    }


    public function add_sim_submit(Request $request)
    {

            $validatedData = $request->validate([
                'sim_type' => 'required',
            ], [
                'sim_type.required' => 'Choose OS Name',
            ]);
            $id = $request['id'];
            $sim_type  = $request['sim_type'];

            $check_sim_type = Sim::select('sim_type')->where('id','!=',$id)->where('sim_type',$sim_type)->count();

            if($check_sim_type != 0){

            Session::flash('error', 'OS Name Already Exist!!');
            return redirect()->back();
            }

            $insertData = [
                'sim_type'   => $sim_type,
                'status' => 1,
                'created_at' => date('d-m-Y h:i:s'),
            ];

            $Insert = Sim::insert($insertData);

            if($Insert){
                Session::flash('success', 'OS Name Submitted Successfully');
                return redirect()->back();
            }
    }


// new product list

    public function add_productlist(Request $request){

        $data['mobile_charger'] = MobileCharger::select('*')->orderBy('id', 'DESC')->get();
        $data['os'] = Os::select('*')->orderBy('id', 'DESC')->get();
        $data['sim'] = Sim::select('*')->orderBy('id', 'DESC')->get();
        $data['simcard'] = Simcard::select('*')->orderBy('id', 'DESC')->get();
        $data['product'] =  Addproduct::all();
        $data['brand'] =  Brand::select('*')->orderBy('id', 'DESC')->get();
        $data['accessories'] =  Accessories::select('*')->orderBy('id', 'DESC')->get();
        $data['js_file'] = 'add_product';
        $data['title'] = 'Add Product List';
        return view('inventory/add_productlist',$data);
    }


    public function productlist_insert(Request $request){

        $validatedData = $request->validate([
            'brand' => 'required',
            'accessories' => 'required',
            'serial_no' => 'required|unique:add_product,serial_no|alpha_num',

        ],[

            'serial_no.unique' => 'This Serial Number Already  Exist !!',

        ]);

        $id = $request['id'];
        $userid = $request['userid'];
        $brand = strtoupper($request['brand']);
        $accessories = $request['accessories'];
        $serial_no = $request['serial_no'];
        $processor_no = $request['processor_no'];
        $os = $request['os'];
        $sim = $request['sim'];
        $phone_no = $request['phone_no'];
        $mobile_charger = $request['mobile_charger'];
        $Laptop_charger = $request['Laptop_charger'];
        $simcard = $request['simcard'];

            $inserData = [
                'brand' => $brand,
                'accessories' => $accessories,
                'serial_no' => $serial_no,
                'created_at' => Carbon::now()
            ];

           $createUser =  Addproduct::insert($inserData);
           $productId = DB::getPdo()->lastInsertId();


            $adminData = [

                'product_id' =>  $productId,
                'processor_no' => $processor_no,
                'os' => $os,
                'sim' => $sim,
                'simcard'=>$simcard,
                'phone_no' => $phone_no,
                'mobile_charger' => $mobile_charger,
                'Laptop_charger' => $Laptop_charger,
                'created_at' => Carbon::now()
            ];
            $createAdmin = ProductInfo::insert($adminData);

            if($createAdmin){
                Session::flash('success', 'Added Successfully');
                return redirect()->back();
            }else{
                Session::flash('error', 'Invalid');
                return redirect()->back();
            }



    }


    public function view_productlist(Request $request){

        $get_user_stack = User_add_inventory::select('product_id')->get()->toArray();
		$inStack_id=[];
		foreach($get_user_stack as $key => $value){
			$inStack_id[] = $value['product_id'];
		}

        $data['view_productlist'] =  DB::table('add_product')
        ->join('productinfo', 'add_product.id', '=', 'productinfo.product_id')
        ->leftJoin('os', 'os.id', '=', 'productinfo.os')
        ->leftJoin('sim', 'sim.id', '=', 'productinfo.sim')
        ->leftJoin('simcard', 'simcard.id', '=', 'productinfo.simcard')

        ->select( 'add_product.serial_no','add_product.created_at','add_product.id', 'productinfo.processor_no','add_product.brand','add_product.accessories','add_product.status','productinfo.userid','productinfo.os','productinfo.sim','productinfo.simcard','productinfo.phone_no','productinfo.mobile_charger','productinfo.mobile_charger','productinfo.Laptop_charger','os.os_name','sim.sim_type','simcard.sim_name')->whereNotIn('add_product.id',$inStack_id)->orderBy('add_product.id','ASC');


        // echo '<pre>';
        // print_r( $data['view_productlist']->get()->toArray());
        // die;
        $data['js_file'] = 'return_stock';
        $data['title'] = 'View Product List';
        return view('inventory/view_productlist',$data);
    }


    public function get_edit_viewallproduct($id,$user_ids){

        $check_user = Addproduct::where('id',$id);
        $userid = $user_ids;
        $check_product = ProductInfo::where('userid',$userid);




        $data['brand'] = Brand::select('brand_name','id')->where('status',1)->get();

        $data['accessories'] = Accessories::select('accessories_name','id')->where('status',1)->get();

        $data['mobilecharger'] = MobileCharger::select('mobile_charger_name','id')->where('status',1)->get();

        $data['os'] = Os::select('*')->orderBy('id', 'DESC')->get();
        $data['access'] = Accessories::select('*')->orderBy('id', 'DESC')->get();
        $data['sim'] = Sim::select('*')->orderBy('id', 'DESC')->get();
        $data['simcards'] = Simcard::select('*')->orderBy('id', 'DESC')->get();
        $data['user'] = $check_user->first();
        $data['product'] = $check_product->first();
        $data['check_user'] = $id;
        $data['check_product'] =$userid;
        $data['js_file'] = 'add_product';
        $data['title'] = 'Edit Product List';

        return view('inventory/edit_productlist',$data);


    }



    public function staffstocklist(){


        $data['js_file'] = 'add_product';
        $data['title'] = 'Inventory Dashboard';
        return view('inventory/staffstocklist',$data);
    }

    public function edit_returnproduct($id)
    {
        $data['return'] = ReturnProduct::find($id);
        $data['brand'] =  Brand::select('*')->orderBy('id', 'DESC')->get();
        $data['accessories'] =  Accessories::select('*')->orderBy('id', 'DESC')->get();
        $data['mobilecharger'] = MobileCharger::select('mobile_charger_name','id')->where('status',1)->get();
        $data['os'] = Os::select('*')->orderBy('id', 'DESC')->get();
        $data['access'] = Accessories::select('*')->orderBy('id', 'DESC')->get();
        $data['sim'] = Sim::select('*')->orderBy('id', 'DESC')->get();
        $data['simcards'] = Simcard::select('*')->orderBy('id', 'DESC')->get();
        $data['js_file'] = 'add_product';
        $data['title'] = 'Return List';
        return view('inventory/edit_returnproductlist',$data);


    }

    public function update_returnproduct(Request $request){

        if($_SERVER['REQUEST_METHOD'] === 'POST'){
          $validatedData = $request->validate([
            'date'=> 'required',
            'brand' => 'required',
            'accessories' => 'required',
            'serial_no' => 'required',
            'reason' => 'required',
            'return_by' => 'required',
            'product_condition' => 'required',
        ], [
            'date.required' => 'Choose Date',
            'brand.required' => 'Choose Brand',
            'accessories.required' => 'Choose Accessories',
            'serial_no.unique' => 'This Serial Number Already  Exist !!',
            'reason.required' => 'Please Enter a Reason',
            'return_by.required' => 'Please Enter a Return By',
            'product_condition.required' => 'Please Enter a Product Condition',
        ]);


        $id = $request['id'];
        $date = $request['date'];
        $brand  = $request['brand'];
        $accessories = $request['accessories'];
        $processor_no = $request['processor_no'];
        $serial_no = $request['serial_no'];
        $reason = $request['reason'];
        $return_by = $request['return_by'];
        $product_condition  = $request['product_condition'];
        $os = $request['os'];
        $sim = $request['sim'];
        $simcard = $request['simcard'];
        $phone_no = $request['phone_no'];
        $mobile_charger  = $request['mobile_charger'];
        $Laptop_charger  = $request['Laptop_charger'];
        $remarks  = $request['remarks'];


        $updatedData = [

               'date' => $date,
               'brand' => $brand,
               'accessories'=> $accessories,
               'processor_no' => $processor_no,
               'serial_no' => $serial_no,
               'reason' => $reason,
               'return_by' => $return_by,
               'product_condition' => $product_condition,
               'os' => $os,
               'sim' => $sim,
               'simcard'=>$simcard,
               'phone_no' => $phone_no,
               'mobile_charger' => $mobile_charger,
               'Laptop_charger' => $Laptop_charger,
               'remarks' => $remarks,
               'created_at'=>Carbon::now()
           ];

           $res = ReturnProduct::where('id', $id)->update($updatedData);
        //    echo ($res);
        //    die;
               if($res){
                   Session::flash('success', 'Product Return Updated Successfully');
                   return redirect('inventory/return_stock');
                }else{
                   Session::flash('error', 'Updated Invalid');
                   return redirect()->back();
                }
        }else{
            Session::flash('error', 'Invalid');
            return redirect()->back();
        }


   }


    public function productlist_status($id,$userid){

        $check_user = Addproduct::select('id','status')->where('id',$id);

        if($check_user->count() != 0){

            if($check_user->first()->status == 1){
                $updateData = ['status' => 0];
                Addproduct::where('id', $id)->update($updateData);
                ProductInfo::where('product_id', $userid)->update($updateData);
                Session::flash('success', 'Status Deactive Successfully');
                return redirect()->back();
            }else if($check_user->first()->status == 0){
                $updateData = ['status' => 1];
                Addproduct::where('id', $id)->update($updateData);
                ProductInfo::where('product_id', $userid)->update($updateData);
                Session::flash('success', 'Status Active Successfully');
                return redirect()->back();
            }else{
                Session::flash('error', 'Inavlid !!');
                return redirect()->back();
            }
        }
        else{
            Session::flash('error', 'Invalid data !!');
            return redirect()->back();
        }

    }



    public function delete_productlist(Request $request,$id,$userid){

        $validatedData = $request->validate([
            'return_reason' => 'required',
        ], [
            'return_reason.required' => 'Please Enter the Return Reason',
        ]);

        $product_id = $request['product_id'];
		 $return_reason  = $request['return_reason'];

		$value =  DB::table('add_product')
        ->join('productinfo', 'add_product.id', '=', 'productinfo.product_id')
        ->leftJoin('os', 'os.id', '=', 'productinfo.os')
        ->leftJoin('sim', 'sim.id', '=', 'productinfo.sim')
		->leftJoin('simcard', 'simcard.id', '=', 'productinfo.simcard')
        ->where('add_product.id',$product_id)
        ->select( 'add_product.serial_no','add_product.id', 'productinfo.processor_no','add_product.brand','add_product.accessories','add_product.status','productinfo.userid','productinfo.simcard','simcard.sim_name','productinfo.os','productinfo.sim','productinfo.phone_no','productinfo.mobile_charger','productinfo.mobile_charger','productinfo.Laptop_charger','os.os_name','sim.sim_type')->first();




            $insertData = [
                'product_id' =>$product_id,
                'brand' => $value->brand,
                'accessories' => $value->accessories,
                'serial_no' => $value->serial_no,
                'processor_no' => $value->processor_no,
                'sim' => $value->sim,
                'phone_no' => $value->phone_no,
                'mobile_charger' => $value->mobile_charger,
                'os' => $value->os,
                'Laptop_charger' => $value->Laptop_charger,
                'return_reason'   => $return_reason,
                'created_at' => date('d-m-Y h:i:s')

            ];

    // print_r($insertData);
    // die();
        $Insert = Return_stock::insert($insertData);

        if($Insert){
        $check_inventory =  Addproduct::where('id',$id);

            if($check_inventory->count() != 0){

                $inventory = $check_inventory->first();
                Addproduct::where('id', $id)->delete();
                ProductInfo::where('product_id', $userid)->delete();



                Session::flash('success', 'Product Delete Successfully');
                return redirect()->back();
            }else{
                Session::flash('error', 'Some Error Occured');
                return redirect()->back();
            }
        }
    }



    public function updateproductlist_inventory(Request $request){


        $id = $request['id'];
        $userid = $request['userid'];
        $serial_no = $request['serial_no'];
        $brand  = $request['brand'];
        $accessories = $request['accessories'];
        $processor_no = $request['processor_no'];
        $os = $request['os'];
        $sim = $request['sim'];
        $simcard = $request['simcard'];
        $phone_no = $request['phone_no'];
        $mobile_charger  = $request['mobile_charger'];
        $Laptop_charger  = $request['Laptop_charger'];
        $updatedData = [

            'serial_no' => $serial_no,
            'brand'=> $brand,
            'accessories' => $accessories,
            'created_at'=> date('Y-m-d H:i:s')
        ];


        $res = Addproduct::where('id', $id)->update($updatedData);

        // echo ($res);
        // die;
        // $productId = DB::getPdo()->lastInsertId();
        $adminData = [
            // 'product_id' =>  $productId,
            'processor_no' => $processor_no,
            'os' => $os,
            'sim' => $sim,
            'simcard'=>$simcard,
            'phone_no' => $phone_no,
            'mobile_charger' => $mobile_charger,
            'Laptop_charger' => $Laptop_charger,
            'created_at' => date('Y-m-d H:i:s')
        ];



        $result = ProductInfo::where('userid', $userid)->update($adminData);


        if($result){
            Session::flash('success', 'Edit Successfully');
            return redirect('inventory/view_productlist');
        }else{
            Session::flash('error', 'Edit Invalid !!');
            return redirect()->back();
        }
    }




    public function viewbrands(Request $request){

    //  echo $request->id;



    $data['roll'] = Accessories::select('accessories_name','id');
    $data['brand'] = Brand::select('brand_name','id');
    $data['product'] = DB::table('add_product')->where('accessories',$request->id);
    $data['js_file'] = '';
    $data['title'] = 'Inventory Dashboard';
    return view('inventory/dashboard',$data);


    }

    function get_dashboard_names($id){

        $accessories_id = $id;

       $get_brand =  DB::select('SELECT `tbl_brand`.`id`,`tbl_brand`.`brand_name`,SUM(`tbl_add_product`.`accessories`) as total FROM `tbl_brand`,`tbl_add_product` WHERE `tbl_brand`.`id` = `tbl_add_product`.`brand` AND `tbl_add_product`.`accessories` = '.$accessories_id.'  GROUP BY `tbl_brand`.`id`');


        $title = get_accessories($id);

        foreach($get_brand as $key => $value){

            $content[$key]['brand'] = $value->brand_name;
            $content[$key]['count'] = self::brand_count($value->id,$id);
        }

        echo json_encode(['title' => 'Accessories Name'.' - '.$title,'content' => $content]);

    }

    function brand_count($id,$accessories_id){

        $res = Addproduct::where('brand',$id)->where('accessories',$accessories_id)->count();

        return $res;
    }



    public function return_stock_list(Request $request){
        $data['return_stock'] = Return_stock::orderBy('id','DESC');
        $data['title'] = 'Return Stock List';
        $data['js_file'] = 'return_stock';
        return view('inventory/return_stock_list',$data);
    }


}

?>


