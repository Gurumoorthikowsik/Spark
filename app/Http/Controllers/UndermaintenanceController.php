<?php 
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;


class UndermaintenanceController extends Controller{  

    public function __construct(){

    }
 
    public function employeeerror(){      
        return view('employee.under_maintenance');
    }

   
}

?>
