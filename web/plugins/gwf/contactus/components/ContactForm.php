<?php

namespace Gwf\Contactus\Components;

use Lang;

use Cms\Classes\ComponentBase;

use Gwf\Contactus\Models\Contactus;
use Input;
use Flash;
use Mail;
use Redirect;
use Response;
use Validator;
use Illuminate\Http\Request;

use ValidationException;
use Illuminate\Support\MessageBag;

class ContactForm extends ComponentBase
{
    public $contactinfo;

    public function componentDetails()
    {
        return [
            'name'        => 'Contactus Form',
            'description' => 'Contactus'
        ];
    }

    public function  onRun(){
       // $this->addJs('/plugins/gwf/contactus/assets/js/form.js');
        $this->addJs('/plugins/gwf/contactus/assets/js/form.js');
        $this->contactinfo = $this->loadContactInfo();
    }

    protected function loadContactInfo(){
        return Contactus::all();
    }  

    public function onSend(){
        $vars = ['name' => Input::get('name'), 'email' => Input::get('email') ,'content' => Input::get('message')];
        /// copy 
        $validator = Validator::make(
            [
                'name' => Input::get('name'),
                'subject' => Input::get('subject'),
                'message' => Input::get('message'),
                'email' => Input::get('email')
            ],
            [
                'name' => 'required',
                'subject' => 'required',
                'message' => 'required',
                'email' => 'required|email'
            ]
        );
        if ($validator->fails()) {
            return Redirect::back()->withErrors($validator);
        }
        else{ ////// end copy
            $send = Mail::send('gwf.contactus::mail.message', $vars, function($message) {
                $receiver =  Contactus::orderby('id','DESC')->first()->email;    
                $message->to($receiver, 'Admin Person');
                $message->subject('Feedback from website');
            });
            sleep(5);
            if($send){
                Flash::success("Thank you, you have Successfully sent your feedback!!");
            }else{
               Flash::error("Sorry,your feedback not sent!!");
            }
            return Redirect::to('/contact-us');
        } /////copy
    }
}

