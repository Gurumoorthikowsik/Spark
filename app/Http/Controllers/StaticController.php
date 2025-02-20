<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class StaticController extends Controller
{
    //

    
    public function StaticWebsite(){


        $data['js_file'] = '';
        $data['title'] = 'Static';      
        return view('MainPage.Index',$data);

    }

    public function about(){

        
        $data['js_file'] = '';
        $data['title'] = 'About';      
        return view('MainPage.about',$data);

    }

    public function contact(){

        
$data['js_file'] = '';
$data['title'] = 'Contact';      
return view('MainPage.contact',$data);

}

    
public function cybersecurity(){
  
    $data['js_file'] = '';
$data['title'] = 'Cyber Security';      
return view('MainPage.cyber-security',$data);
}

public function webdevelopment(){

      
    $data['js_file'] = '';
$data['title'] = 'Web Development';      
return view('MainPage.web-development',$data);

}


public function softwaredevelopment(){

      
$data['js_file'] = '';
$data['title'] = 'Software Development';      
return view('MainPage.software-development',$data);

}


public function mobileappdevelopment(){

      
$data['js_file'] = '';
$data['title'] = 'Mobile App Development';      
return view('MainPage.mobile-app-development',$data);

}


public function digitalmarketing(){

      
$data['js_file'] = '';
$data['title'] = 'Digital Marketing';      
return view('MainPage.digital-marketing',$data);

}

public function coursePage(){

      
$data['js_file'] = '';
$data['title'] = 'Course Page';      
return view('MainPage.course-page',$data);

}

}
