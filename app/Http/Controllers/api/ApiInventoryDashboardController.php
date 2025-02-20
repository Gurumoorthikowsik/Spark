<?php 
namespace App\Http\Controllers\api;

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

use App\Models\Simcard;

use DateTime;
use DateInterval;
use DatePeriod;
use DB;
use Carbon\Carbon;
use App\Models\ProductStock;
use Illuminate\Support\Facades\Validator;


class ApiInventoryDashboardController extends Controller{  

    public function __construct(){
       
    }
    
    public function add_brand(Request $request){

        if($_SERVER['REQUEST_METHOD'] === 'POST'){

            $validator = Validator::make($request->all(),[
             'user_id' => 'required'
            ]);
    
            if($validator->fails()){
                $errors = $validator->errors()->first();
                 return apiResponse(0,$errors);
            }          
              
            $add_accessories = Accessories::orderBy('id','DESC');   
            $add_brand = Brand::orderBy('id','DESC');      

      
            if($add_brand->count() != 0){
            $i = 1; 
            $out = [];   
           
                foreach ($add_brand->get() as $key => $value){
               
                $out[$key]['s_no'] = $i;
                $out[$key]['brandname'] = $value->brand_name;
                $out[$key]['created_at'] = $value->created_at;
                $out[$key]['edit_id'] =$value->id;
                $out[$key]['delete_id'] =$value->id;
               
              $i++;
            }
        }else{
        $out = [];
    }

    return apiResponse(1,'success',['Brandview' => ($out)? $out : []]);
    }else{
        return apiResponse(0,'Invalid Request Method');
    }

    }



    public function add_product_submit(Request $request) {
       

       
        if($_SERVER['REQUEST_METHOD'] === 'POST'){

            $validator = Validator::make($request->all(),[
             'user_id' => 'required',
             'brand_name' => 'required'
            ]);
    
            if($validator->fails()){
                $errors = $validator->errors()->first();
                 return apiResponse(0,$errors);
            }  
            
            
            $id = $request['id'];
            $brand  = $request['brand_name'];     
            
            $check_brand = Brand::select('brand_name')->where('id','!=',$id)->where('brand_name',$brand)->count();                
                  
            if($check_brand != 0){
              return apiResponse(0,'Brand Name Already Exist!!');
            }
    
            $insertData = [
                'brand_name' => $brand,        
                'status' => 1,
                'created_at' => date('d-m-Y h:i:s'),   
            ];
    
            $Insert = Brand::insert($insertData);
           
                if($Insert){
                    return apiResponse(1,'Brand Added Successfully');
                   
                }else{
                        return apiResponse(0,'Brand Added Invalid');
                }
              
        }
    }

    
    function edit_add_brand(Request $request){      
                     
        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            $validator = Validator::make($request->all(),[
                'user_id' => 'required',
                'edit_id' =>'required',
                'brand_name' => 'required'
               ]);
       
               if($validator->fails()){
                   $errors = $validator->errors()->first();
                    return apiResponse(0,$errors);
               }  
               

               $brand_name  = $request['brand_name'];           
               $id = $request['edit_id'];                     
              
               $updatedData = [
                   'brand_name' => $brand_name,
                   'created_at'  =>  date('d-m-Y h:i:s')           
               ];                  
    
               $res = Brand::where('id',$id)->update($updatedData);
    
                   if($res){
                    return apiResponse(1,'Brand Updated Successfully');
                     
                   }else{
                    return apiResponse(0,'Brand Updated Invalid');
                      
                   }
            }             

   }

   




   function edit_add_brandview(Request $request){

    if($_SERVER['REQUEST_METHOD'] === 'POST'){

    $validator = Validator::make($request->all(),[
        'user_id' => 'required',
         'edit_id' => 'required'
    ]);

       if($validator->fails()){
           $errors = $validator->errors()->first();
            return apiResponse(0,$errors);
       }
       $user_id = $request['user_id'];
       $id = $request['edit_id'];


       $check_brand = Brand::select('brand_name')->select('id','brand_name','created_at')->where('id',$id)->first();

     
       if($check_brand){
           
           $array = [
               'id' => $check_brand->id,
               'brand_name' => $check_brand->brand_name,
               'created_at' => $check_brand->created_at,
               
           ];

           echo json_encode($array);
       }else{
           $array = [
               'id' => $check_brand->id,
               'brand_name' => $check_brand->brand_name,
               'created_at' => $check_brand->created_at,
              
           ];

           echo json_encode($array);
       }

}

}


function delete_add_brand(Request $request){

    if($_SERVER['REQUEST_METHOD'] === 'POST'){

        $validator = Validator::make($request->all(),[
            'user_id' => 'required',
             'delete_id' => 'required'
        ]);
    
           if($validator->fails()){
               $errors = $validator->errors()->first();
                return apiResponse(0,$errors);
           }


      $id = $request->delete_id;     
    $brand_name =  Brand::where('id',$id);

    if($brand_name->count() != 0){
        Brand::where('id', $id)->delete();
        return apiResponse(1,'Brand Name Deleted Successfully');
    }else{
        return apiResponse(0,'Some Error Occured');
    }
}                

}


public function productlist_insert(Request $request){

    
    if($_SERVER['REQUEST_METHOD'] === 'POST'){

        $validator = Validator::make($request->all(),[
            'user_id' => 'required',
            'brand' => 'required',
            'accessories' => 'required',
            'serial_no' => 'required'
        ]);
    
           if($validator->fails()){
               $errors = $validator->errors()->first();
                return apiResponse(0,$errors);
           }
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

            return apiResponse(1,'Added Successfully');
            
        }else{
            return apiResponse(0,'Invalid');
           
        }
  
    }

}



public function view_productlist(Request $request){


    if($_SERVER['REQUEST_METHOD'] === 'POST'){

        $validator = Validator::make($request->all(),[
            'user_id' => 'required',
             
        ]);
    
           if($validator->fails()){
               $errors = $validator->errors()->first();
                return apiResponse(0,$errors);
           }

    $get_user_stack = User_add_inventory::select('product_id')->get()->toArray();
    $inStack_id=[];
    foreach($get_user_stack as $key => $value){
        $inStack_id[] = $value['product_id'];
    }

    $view_productlist =  DB::table('add_product')
    ->join('productinfo', 'add_product.id', '=', 'productinfo.product_id')                
    ->leftJoin('os', 'os.id', '=', 'productinfo.os')     
    ->leftJoin('sim', 'sim.id', '=', 'productinfo.sim')  
    ->leftJoin('simcard', 'simcard.id', '=', 'productinfo.simcard')           

    ->select( 'add_product.serial_no','add_product.created_at','add_product.id', 'productinfo.processor_no','add_product.brand','add_product.accessories','add_product.status','productinfo.userid','productinfo.os','productinfo.sim','productinfo.simcard','productinfo.phone_no','productinfo.mobile_charger','productinfo.mobile_charger','productinfo.Laptop_charger','os.os_name','sim.sim_type','simcard.sim_name')->whereNotIn('add_product.id',$inStack_id)->orderBy('add_product.id','ASC');

    if($view_productlist->count() != 0){
         $i = 1;
         $out = [];   
         foreach ($view_productlist->get() as $key => $value){

            if($value->status == 1){
                $statusvalue = 'Active';
            }else{
                $statusvalue = 'Deactive';
            }

                $out[$key]['s_no'] = $i;
                $out[$key]['created_date'] = $value->created_at;
                $out[$key]['Brand'] = get_brand($value->brand);
                $out[$key]['Accessories'] =get_accessories($value->accessories);
                $out[$key]['SerialNumber'] =($value->serial_no == '') ? '--' :($value->serial_no);
                $out[$key]['SimCard'] = get_sim($value->sim);
                $out[$key]['SimType'] = get_simcard($value->simcard);
                $out[$key]['phone_number'] =($value->phone_no == '') ? '--' :($value->phone_no);
                $out[$key]['mobile_charger'] =get_mobile_charger($value->mobile_charger);
                $out[$key]['processor_number'] =($value->processor_no == '') ? '--' :($value->processor_no);
                $out[$key]['os'] =os_type($value->os);
                $out[$key]['Laptop_charger'] = ($value->Laptop_charger == '') ? '--' :($value->Laptop_charger);
                $out[$key]['status'] =$statusvalue;
                $out[$key]['addproduct_id'] =$value->id;
                $out[$key]['productinfo_id'] =$value->userid;
              
            
               
              $i++;
         }


    }else{
            $out = [];
    }
   
    return apiResponse(1,'success',['ViewProductlist' =>($out) ? $out : []]);
    	
 
}  else{
    return apiResponse(0,'Invalid Request Method');
}


}


public function return_stock_list(Request $request){  
    
    if($_SERVER['REQUEST_METHOD'] === 'POST'){

        $validator = Validator::make($request->all(),[
            'user_id' => 'required',
             
        ]);
    
           if($validator->fails()){
               $errors = $validator->errors()->first();
                return apiResponse(0,$errors);
           }

    
    
    $return_stock = Return_stock::orderBy('id','DESC');    

    $i = 1;
    $out = []; 
    foreach ($return_stock->get() as $key => $value){
                $out[$key]['s_no'] = $i;
                $out[$key]['created_date'] = $value->created_at;
                $out[$key]['Brand'] = get_brand($value->brand);
                $out[$key]['Accessories'] =get_accessories($value->accessories);
                $out[$key]['SerialNumber'] =($value->serial_no == '') ? '--' :($value->serial_no);
                $out[$key]['SimCard'] = get_sim($value->sim);
                $out[$key]['SimType'] = get_simcard($value->simcard);
                $out[$key]['phone_number'] =($value->phone_no == '') ? '--' :($value->phone_no);
                $out[$key]['mobile_charger'] =get_mobile_charger($value->mobile_charger);
                $out[$key]['processor_number'] =($value->processor_no == '') ? '--' :($value->processor_no);
                $out[$key]['os'] =os_type($value->os);
                $out[$key]['Laptop_charger'] = ($value->Laptop_charger == '') ? '--' :($value->Laptop_charger);
                $out[$key]['return_reason'] = $value->return_reason;

                $i++;
    }
   
    return apiResponse(1,'success',['ViewProductlist' =>($out) ? $out : []]);
    
}else{
    return apiResponse(0,'Invalid Request Method');
}

}


function staff_inventory(Request $request){

    if($_SERVER['REQUEST_METHOD'] === 'POST'){

        $validator = Validator::make($request->all(),[
            'user_id' => 'required',
             
        ]);
    
           if($validator->fails()){
               $errors = $validator->errors()->first();
                return apiResponse(0,$errors);
           }

    $inventory =  DB::table('user_info')
    ->join('users_add_inventory', 'user_info.userid', '=', 'users_add_inventory.userid')


    ->leftJoin('add_product', 'users_add_inventory.brand', '=', 'add_product.id')           


    ->select( 'user_info.username', 'user_info.employee_id','user_info.status','add_product.brand','add_product.serial_no','users_add_inventory.brand',
            'users_add_inventory.accessories','users_add_inventory.created_at','users_add_inventory.sim','users_add_inventory.simcard','users_add_inventory.phone_no','users_add_inventory.mobile_charger','users_add_inventory.processor_no',
            'users_add_inventory.serial_no','users_add_inventory.Laptop_charger','users_add_inventory.os','users_add_inventory.id')->orderBy('user_info.username','ASC');
            if($inventory->count() != 0){
                $i = 1;
                $out = []; 
                foreach ($inventory->get() as $key => $value){

                    $out[$key]['s_no'] = $i;
                    $out[$key]['employee_id'] = $value->employee_id;
                    $out[$key]['user_name'] = $value->username;
                    $out[$key]['date'] =$value->created_at;
                    $out[$key]['Brand'] = get_brand($value->brand);
                    $out[$key]['Accessories'] =get_accessories($value->accessories);
                    $out[$key]['serial_number'] = $value->serial_no;
                    $out[$key]['sim'] = get_sim($value->sim);
                    $out[$key]['sim_type'] =get_simcard($value->simcard);
                    $out[$key]['phone_number'] = $value->phone_no;
                    $out[$key]['mobile_charger'] = get_mobile_charger($value->mobile_charger);
                    $out[$key]['processor_number'] =$value->processor_no;
                    $out[$key]['os'] =os_type($value->os);
                    $out[$key]['laptop_charger'] =$value->Laptop_charger;
                    $out[$key]['delete_id'] =$value->id;


                    $i++;
                }
            }else{
                $out = [];
        }

        return apiResponse(1,'success',['staff_inventorylist' =>($out) ? $out : []]);
   

    }else{
    return apiResponse(0,'Invalid Request Method');
    }

}

public function productlist_status($id,$userid){   
    if($_SERVER['REQUEST_METHOD'] === 'POST'){

        $validator = Validator::make($request->all(),[
            'user_id' => 'required',
            
             
        ]);
    
           if($validator->fails()){
               $errors = $validator->errors()->first();
                return apiResponse(0,$errors);
           }   
                
    $check_user = Addproduct::select('id','status')->where('id',$id);

    if($check_user->count() != 0){

        if($check_user->first()->status == 1){
            $updateData = ['status' => 0];
            Addproduct::where('id', $id)->update($updateData);
            ProductInfo::where('product_id', $userid)->update($updateData);
            return apiResponse(1,'Status Deactive Successfully');
        }else if($check_user->first()->status == 0){
            $updateData = ['status' => 1];
            Addproduct::where('id', $id)->update($updateData);
            ProductInfo::where('product_id', $userid)->update($updateData);
            return apiResponse(1,'Status Active Successfully');
        
        }else{
          
            return apiResponse(0,'Inavlid !!');
        }
    }
    else{
        
        return apiResponse(0,'Inavlid  data !!');
    }

}else{
    return apiResponse(0,'Invalid Request Method');
    }
}

 }

      

?>