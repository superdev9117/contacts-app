@extends('layouts.base')

@section('stylesheets')

    <link rel="stylesheet" href="{{ url('css/index.css') }}">

@endsection

@section('header')

    @include('layouts.header')

@endsection

@section('content')

    <div class="container">

        <div class="row">
            <ul id="contactsList" class="collapsible popout" data-collapsible="accordion">
                @foreach($contacts as $contact)
                    @include('contact', ['contact'=>$contact])
                @endforeach
            </ul>
        </div>
    </div>

    <!-- floating action button -->
    <div class="fixed-action-btn">
        <a id="menu" class="btn btn-floating btn-large light_blue" href="#addModal"
           data-position="left" data-delay="50" data-tooltip="option">
            <i class="material-icons">add</i>
        </a>
    </div>

    <!-- Modal1 Structure  (Add new contact)-->
    <div id="addModal" class="modal thin">
        <div class="modal-content ">
            <h4>Add contact</h4>
            <p>Add Contact phone/address details and have them displayed on your App</p>
            <div class="add_contact">
                <div class="row">
                    <form onsubmit="submitForm(event)" method="post" action="{{ url('/add-contact') }}"
                          id="addContact" class="col s12">
                        {{ csrf_field() }}
                        <div class="row">
                            <center>
                                <div class="col  m6 s12">
                                    <img id="uploadedImage" style="display: none" alt="Uploaded Image"
                                         class="circle upload_img" src="#">
                                </div>
                                <div class="col  m6 s12">
                                    <input onchange="showImage(event)" name="image" type="file" style="display: none" required>
                                    <a onclick="clickOnFileInput('#addContact')"
                                       class="waves-effect waves-light btn light_blue upload_btn">
                                        <i class="material-icons right">file_upload</i>Upload</a>
                                </div>
                            </center>
                        </div>
                        <div class="row">
                            <div class="input-field col m6 s12">
                                <i class="material-icons prefix">account_circle</i>
                                <input name="name" id="icon_prefix" type="text" class="validate" required>
                                <label for="icon_prefix">Name</label>
                            </div>
                            <div class="input-field col m6 s12">
                                <i class="material-icons prefix">Phone</i>
                                <input name="phone" id="icon_telephone" type="tel" class="validate" required>
                                <label for="icon_telephone">Phone</label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="input-field col m6 s12">
                                <i class="material-icons prefix">email</i>
                                <input name="email" id="icon_email" type="email" class="validate" >
                                <label for="icon_email">E-mail</label>
                            </div>
                            <div class="input-field col m6 s12">
                                <i class="material-icons prefix">schedule</i>
                                <input name="birthday" id="icon_birthday" type="date" class="validate" required>
                                <label for="icon_birthday"></label>
                            </div>

                        </div>
                        <div class="row">
                            <div class="input-field col s12">
                                <i class="material-icons prefix">location_on</i>
                                <input name="address" id="icon_adress" type="text" class="validate">
                                <label for="icon_adress">Address</label>
                            </div>

                            <div class="input-field col s12">
                                <i class="material-icons prefix">work</i>
                                <input name="company" id="icon_company" type="text" class="validate">
                                <label for="icon_company">Organization/Company</label>
                            </div>
                        </div>
                        <div class="row more_details">

                        </div>
                        <center>
                            <button type="submit" class="btn-floating btn-large light_blue " id="btn_append">
                                <i class="material-icons">add</i>
                            </button>
                        </center>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div id="deleteModal" class="modal">
        <div class="modal-content">
            <h4>Delete contant</h4>
            <p>this is just to make sure that you wish to delete the contact</p>
        </div>
        <div class="modal-footer">
            <a csrf-token="{{ csrf_token() }}"
               onclick="deleteContact(event)" href="{{ url('/delete-contact') }}" id="deleteButton"
               class="modal-action modal-close waves-effect waves-green btn-flat">OK</a>
            <a href="#!" class="modal-action modal-close waves-effect waves-green btn-flat">CANCEL</a>
        </div>
    </div>


    <div id="editModal" class="modal thin">
        <form onsubmit="submitForm(event)" id="editForm" method="post" action="{{ url('/edit-contact') }}" class="col s12">
            <div class="modal-content ">
                <h4>Edit contact</h4>
                <div class="add_contact">
                    <div class="row">
                            {{ csrf_field() }}
                        <input type="hidden" name="_method" value="PATCH">
                        <div class="row">
                                <center>
                                    <div class="col  m6 s12">
                                        <img id="uploadedImage" alt="Uploaded Image"
                                             class="circle upload_img user_image_edit" src="#">
                                    </div>
                                    <div class="col  m6 s12">
                                        <input onchange="showImage(event)" id="user_image_edit"
                                               name="image" type="file" style="display: none" >
                                        <a onclick="clickOnFileInput('#editForm')"
                                           class="waves-effect waves-light btn light_blue upload_btn">
                                            <i class="material-icons right">file_upload</i>Upload</a>
                                    </div>
                                </center>
                            </div>
                            <div class="row">
                                <div class="input-field col m6 s12">
                                    <i class="material-icons prefix">account_circle</i>
                                    <input name="name" id="icon_prefix" type="text" class="validate user_name_edit" required>

                                </div>
                                <div class="input-field col m6 s12">
                                    <i class="material-icons prefix">phone</i>
                                    <input name="phone" id="icon_telephone" type="tel" class="validate user_phone_edit" required>

                                </div>
                            </div>
                            <div class="row">
                                <div class="input-field col m6 s12">
                                    <i class="material-icons prefix">email</i>
                                    <input name="email" id="icon_email" type="email" class="validate user_mail_edit">

                                </div>
                                <div class="input-field col m6 s12">
                                    <i class="material-icons prefix">schedule</i>
                                    <input name="birthday" required id="icon_birthday" type="date" class="validate user_date_edit">

                                </div>

                            </div>
                            <div class="row">
                                <div class="input-field col s12">
                                    <i class="material-icons prefix">location_on</i>
                                    <input name="address" id="icon_adress" type="text" class="validate user_locaion_edit">

                                </div>

                                <div class="input-field col s12">
                                    <i class="material-icons prefix">work</i>
                                    <input name="company" id="icon_company" type="text" class="validate user_company_edit">

                                </div>
                            </div>
                    </div>
                </div>

            </div>
            <div class="modal-footer">
                <button type="submit" id="submit" class="modal-action waves-effect waves-green btn-flat">Edit</button>
            </div>
        </form>
    </div>



@endsection


@section('scripts')

    <script type="text/javascript" src="js/index.js"></script>

@endsection