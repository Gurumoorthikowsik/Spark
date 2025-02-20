<?php 
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Session;
use App\Models\User;
use App\Models\Roll;
use App\Models\Event;
use App\Models\Attendance;
use App\Models\Leavedays;
use Redirect;
use DB;
use DateTime;


use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Reader\Exception;
use PhpOffice\PhpSpreadsheet\Writer\Xls;
use PhpOffice\PhpSpreadsheet\IOFactory;



class ExcelController extends Controller{  

    public function __construct(){

    }
 
    public function index(Request $request){
        $table = 'employ_portal_excel.xlsx';
        $data = Excel::load('/Excel', function ($reader) use($table) {
        $data = $reader->toArray();

            echo '<pre>';
            print_r($schdeules);
            die;
        });

        
    }

   
}

?>
