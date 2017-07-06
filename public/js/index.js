$(document).ready(function () {
    //stat notificcaion
    $('.tap-target').tapTarget('open');
    //form append
    //responsive slide navigation
    $(".button-collapse").sideNav();
    //drop down menus
    $('body').delegate('.dropdown-button','click',function () {
        $(this).dropdown();
    });
    Materialize.updateTextFields();

    $('body').delegate(".edit_data_btn",'click',function () {
        var user_name = $(this).closest(".avatar").find(".user_name_list").text(),
            email = $(this).closest(".avatar").find(".user_mail_list").text(),
            phone_number = $(this).closest(".avatar").find(".user_phone_list").text(),
            locaion = $(this).closest(".avatar").find(".user_locaion_list").text(),
            date = $(this).closest(".avatar").find(".user_date_list").attr('value'),
            company = $(this).closest(".avatar").find(".user_company_list").text(),
            other = $(this).closest(".avatar").find(".user_other_list").text(),
            image = $(this).closest(".avatar").find(".user_image_list").attr('src');

        $('#editModal').find('#editForm').attr('data-id', $(this).attr('data-id'));

        $("#editModal").find(".user_name_edit").val(user_name);
        $("#editModal").find(".user_phone_edit").val(phone_number);
        $("#editModal").find(".user_date_edit").val(date);
        $("#editModal").find(".user_mail_edit").val(email);
        $("#editModal").find(".user_company_edit").val(company);
        $("#editModal").find(".user_locaion_edit").val(locaion);
        $("#editModal").find(".user_other_edit").val(other);
        $("#editModal").find(".user_image_edit").attr("src", image);
    });
    // the "href" attribute of .modal-trigger must specify the modal ID that wants to be triggered
    $('.modal').modal({
        dismissible: true, // Modal can be dismissed by clicking outside of the modal
        opacity: .5, // Opacity of modal background
        inDuration: 300, // Transition in duration
        outDuration: 200, // Transition out duration
        startingTop: '40%', // Starting top style attribute
        endingTop: '10%', // Ending top style attribute
    });

});




//Handle change in the image input

function showImage(event) {

    readURL($(event.target)[0]);
}

//Read the image file and display it to the user

function readURL(input) {


    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function (e) {
            $(input.form).find('#uploadedImage').fadeIn();
            $(input.form).find('#uploadedImage').attr('src', e.target.result);
        };

        reader.readAsDataURL(input.files[0]);
    }
}

//Open the file input when click on upload

function clickOnFileInput(formId) {

    $(formId+' input[name=image]').click();
}

//Submit a form to the server

function submitForm(e) {

    e.preventDefault();

    var form = e.target;

    if (form._method){

        postContact(form,editContactCallback,form._method.value);
    }

    else{

        postContact(form,addContactCallback);

    }

}

/**
 * Handle the ajax success function of the editContact form
 * @param res : ajax response
 * @param form : the add form
 */



function editContactCallback(res, form) {
    form.reset();
    $('li[data-id='+form.getAttribute('data-id')+']').replaceWith(res);
    Materialize.toast('The contact has been edited successfully',4000);
    $('#editModal').modal('close');
}

/**
 * Handle the ajax success function of the addContact form
 * @param res : ajax response
 * @param form : the add form
 */

function addContactCallback(res,form) {
    form.reset();
    $(form).find('#uploadedImage').fadeOut();
    $('#addModal').modal('close');
    $('#contactsList').prepend(res);
    Materialize.toast('Your contact has been added',1000);
}


/**
 * Yield the form inputs and then post it to the server
 * @param callback a callback function run on success
 * @param form (edit, add)
 * @param method (POST, PATCH)
 */
function postContact(form,callback,method) {

    var formData = new FormData();

    formData.append('_token',form._token.value);
    formData.append('name',form.name.value);
    formData.append('email',form.email.value);
    formData.append('phone',form.phone.value);
    formData.append('address',form.address.value);
    formData.append('image',(form.image && form.image.files[0]) ? form.image.files[0] : null);
    formData.append('company',form.company.value);
    formData.append('birthday',form.birthday.value);

    if(method){
        formData.append('id', form.getAttribute('data-id'));
        formData.append('_method',method);
    }


    $.ajax({


        url:form.getAttribute('action'),
        data: formData,
        method:'POST',
        processData: false,
        contentType: false,
        success:function (res) {
            callback(res, form)
        },
        error:function (xhr,status,error) {

            Materialize.toast((xhr.responseJSON && xhr.responseJSON.email) ? xhr.responseJSON.email : error ,4000);
        }

    });
}

// Set the contact id on the delete modal and open the modal

function setContactId(e) {
    $('#deleteButton').attr('data-id', e.target.getAttribute('data-id'));
    $('#deleteModal').modal('open');
}


//Delete contact , close deleteModal on success
function deleteContact(e) {
    e.preventDefault();
    var contact_id = e.target.getAttribute('data-id');
    var _token = e.target.getAttribute('csrf-token');

    $.ajax({
        url : e.target.getAttribute('href')+'/'+contact_id,
        method:"POST",
        data:{
            _token:_token,
            _method:'DELETE'
        },
        success:function (response) {
            $('li[data-id='+contact_id+']').remove();
            $('#deleteModal').modal('close');
            Materialize.toast('The contact has removed successfully',4000);

        },
        error: function (xhr,status,err) {

            Materialize.toast('An error occured while removing your contact');
        }

    })
}