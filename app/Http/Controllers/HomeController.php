<?php

namespace App\Http\Controllers;

use App\Contact;
use App\Http\Requests\ContactEditRequest;
use App\Http\Requests\ContactRequest;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //Require login to use this controller
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        return view('home', ['contacts'=> \request()->user()->contacts]);
    }

    /**
     * Edit Contact data
     * @param ContactEditRequest $request
     * @param Contact $contactModel
     */

    public function editContact(ContactEditRequest $request, Contact $contactModel){

        $contact = $contactModel->where('user_id', $request->user()->id)->findOrFail($request->get('id'));

        if ($request->hasFile('image')){
            $imgName = $this->saveImage($request);
            $request['image_url'] = $imgName;
        }

        $contact->update($request->except('image','_token','method','id'));

        return view('contact',['contact'=>$contact]);
    }

    /**
     * Add Contact to the database
     * Store the image into storage/app/public/images// directory
     * @param ContactRequest $request
     * @param Contact $contactModel
     * @return view of the contact card
     */


    public function addContact (ContactRequest $request, Contact $contactModel){

        //save file to storage/app/img/
        $imgName =$this->saveImage($request);
        //create and return the new contact
        $request['image_url'] = $imgName;
        $request['user_id'] = $request->user()->id;
        return view('contact')->with(['contact'=>
            $contactModel->create($request->except('_token','image'))]);
    }

    /**
     * Store a file into 'storage/app/public/images'
     * @param $request : holding the file to be store
     * @return string : image name
     */

    private function saveImage($request){
        //save file to storage/app/img/
        $imgName = uniqid('img_').'.'
            .$request->file('image')->extension();
        $request->file('image')->storePubliclyAs('public/images/',$imgName);

        return $imgName;
    }

    /**
     *
     * @param $id of the contact to delete
     * @param Contact $contactModel
     * @return array
     */
    public function deleteContact($id, Contact $contactModel){

        $contactModel->where('user_id',request()->user()->id)->findOrFail($id)->delete();

        return ['success'=>true];
    }
}
