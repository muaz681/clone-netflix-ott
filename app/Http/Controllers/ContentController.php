<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\ContactRequest;
use App\Models\Contact;

class ContentController extends Controller
{
    public function privacy()
    {
        return View('content.privacy-policy');
    }

    public function about_us()
    {
        return View('content.about-us');
    }

    public function tearmsConditions(){
        return View('content.terms-and-conditions');
    }

    public function returnConditions(){
        return View('content.return-refund');
    }

    public function marketPolicy(){
        return View('content.market-policy');
    }


    public function contactUs(){
        return View('content.contact-us');
    }

    public function helpCenter(){
        return View('content.help-center');
    }


    public function legalNotice(){
        return View('content.legal-notice');
    }

    public function corporateInformation(){
        return View('content.corporate-information');
    }

    public function storeContact(ContactRequest $request){

            $contact = new Contact();
            $contact->fill($request->all());
            $contact->save();
            // $status = true;
            // return redirect()->back()->with('success', true);
            // return redirect()->route('frontend.contact-us', app()->getLocale())->with([
            //     'status' => 'Profile updated successfully',
            // ]);
            return redirect('/');
    }
}
