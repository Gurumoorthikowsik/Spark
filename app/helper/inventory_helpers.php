<?php 
use App\Models\User;
use App\Models\Roll;
use App\Models\Event;
use App\Models\Attendance;
use App\Models\Laptop;
use App\Models\Charger;
use App\Models\Mouse;
use App\Models\Keyboard; 
use App\Models\Userinventory;
use App\Models\Brand;
use App\Models\Accessories;
use App\Models\Productlist;
use App\Models\Addproduct;
use App\Models\Os;
use App\Models\Users_inventory;
use App\Models\MobileCharger;
use App\Models\Sim;
use App\Models\Simcard;

use Carbon\Carbon;



function get_invuser($userId,$feild){

    $check_user = User::where('userid',$userId);

    if($check_user->count() != 0){
        $user = $check_user->first();
        return $user->$feild;
    }else{
        return "";
    }
}

function invuser_id(){

    $userId = Session::get('invuser_id');
    $check_user = User::select('userid')->where('inventory_access',1)->where('userid',$userId);

    if($check_user->count() != 0){
        $user = $check_user->first();
        return $user->userid;
    }else{
        return "";
    }
} 


function get_laptop($id){
    $check_device = Laptop::where('id',$id);

    if($check_device->count() != 0){
        $inventory = $check_device->first();
        return $inventory->brand.' - '.$inventory->serial_no;
    }else{
        return "--";
    }
}

function get_charger($id){
    $check_device = Charger::where('id',$id);

    if($check_device->count() != 0){
        $inventory = $check_device->first();
        return $inventory->brand.' - '.$inventory->serial_no;
    }else{
        return "--";
    }
}

function get_mouse($id){
    $check_device = Mouse::where('id',$id);

    if($check_device->count() != 0){
        $inventory = $check_device->first();
        return $inventory->brand.' - '.$inventory->serial_no;
    }else{
        return "--";
    }
}

function get_keyboard($id){
    $check_device = Keyboard::where('id',$id);

    if($check_device->count() != 0){
        $inventory = $check_device->first();
        return $inventory->brand.' - '.$inventory->serial_no;
    }else{
        return "--";
    }
}

function get_brand($id){
    $check_brand = Brand::where('id',$id);

    if($check_brand->count() != 0){
        $inventory = $check_brand->first();
        return $inventory->brand_name;
    }else{
        return "--";
    }
}


function get_accessories($id){
    $check_device = Accessories::where('id',$id);

    if($check_device->count() != 0){
        $inventory = $check_device->first();
        return $inventory->accessories_name;
    }else{
        return "--";
    }
}


function get_mobile_charger($id){
    $check_mob_charger = MobileCharger::where('id',$id);

    if($check_mob_charger->count() != 0){
        $inventory = $check_mob_charger->first();
        return $inventory->mobile_charger_name;
    }else{
        return "--";
    }
}



function get_sim($id){
    $check_sim = Sim::where('id',$id);

    if($check_sim->count() != 0){
        $inventory = $check_sim->first();
        return $inventory->sim_type;
    }else{
        return "--";
    }
}


function get_simcard($id){
    $check_simcard = Simcard::where('id',$id);

    if($check_simcard->count() != 0){
        $inventory = $check_simcard->first();
        return $inventory->sim_name;
    }else{
        return "--";
    }
}


function get_brands($brand_name){

    $check_brand = Brand::select('id')->where('brand',$brand_name)->first();

    return $check_brand->id;
}

function serial_process_no($id){
    $check_device = Users_inventory::where('id',$id);

    if($check_device->count() != 0){
        $inventory = $check_device->first();
        return $inventory->brand.' / '.$inventory->serial_no.' - '.$inventory->processor_no;
    }else{
        return "--";
    }
}

function os_type($id){
    $check_device = Os::where('id',$id);

    if($check_device->count() != 0){
        $inventory = $check_device->first();
        return $inventory->os_name;
    }else{
        return "--";
    }
}





     

?>