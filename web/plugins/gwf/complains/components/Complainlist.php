<?php

namespace Gwf\Complains\Components;

use Lang;

use Cms\Classes\ComponentBase;

use Gwf\Complains\Models\Complain;
use Input;
use Mail;
use Gwf\Contactus\Models\Contactus;
use Redirect;
use Route;
use Flash;
use Response;
use Validator;
use App\Http\Requests;
use Illuminate\Http\Request;
use File;

class Complainlist extends ComponentBase
{
    public $complains;

    public function componentDetails()
    {
        return [
            'name'        => 'Complain Form',
            'description' => 'Complain Form'
        ];
    }

    public function  onRun(){
        $this->addJs('/plugins/gwf/complains/assets/js/form.js');
        $this->complains = $this->loadComplains();
    }

    public function loadComplains(){
        return Complain::all();
    }

      public function onSend(){

        $vars = ['name' => Input::get('name'),'title' => Input::get('title'), 'email' => Input::get('email') ,'phone' => Input::get('phone'),'description' => Input::get('description'),'attachments' => Input::get('attachments')];
        //die(Input::get('name'));
        /*$file = new \System\Models\File;
        $file->data = Input::file('attachments');*/
       /* print_r("<pre>");
        print_r($vars); exit;*/
        $validator = Validator::make(
            [
                'name' => Input::get('name'),
                'title' => Input::get('title'),
                'email' => Input::get('email'),
                'phone' => Input::get('phone'),
                'description' => Input::get('description')
            ],
            [
                'name' => 'required',
                'title' => 'required',
                'email' => 'required|email',
                'phone' => 'required',
                'description' => 'required'
            ]
        );
        if ($validator->fails()) {
            return Redirect::back()->withErrors($validator);
        }
        else{ 
           /*$mime_type = 'mimes:jpeg,bmp,png,jpg';
           $file_name = 'file_name';
           $file = new \System\Models\File;
           $file->data = Input::file('attachments');
           $file->save();
          */
            Mail::send('gwf.complains::mail.message', $vars, function($description)  {
                $receiver =  Contactus::orderby('id','DESC')->first()->email;    
                $description->to($receiver, 'Admin Person');
                $description->subject('Complain from website');
                //$description->attach($file_path, ['as' => $file_name, 'mime' => $mime_type]);
               /* $description->attach($file->getRealPath(), array(
                    'as' => 'attachments.' . $file->getClientOriginalExtension(), 
                    'mime' => $file->getMimeType())
                );*/
            });
            //////iNSERT INTO db
            $complain=new complain;//this is model
            $complain->name=Input::get("name");
            $complain->title=Input::get("title");
            $complain->email=Input::get("email");
            $complain->phone=Input::get("phone");
            $complain->description=Input::get("description");
            $complain->attachments = Input::get("attachments");
            $complain->save();
            Flash::success("Thank you, you have Successfully sent your feedback!!");
            return Redirect::back();
     }  
    }
}

