// Button switching

$('.close').click(function(){
  $(this).closest('.register-form').toggleClass('open');
});

// Login handler

function login(e) {

  e.preventDefault();

  var form = document.forms.login;

  var email = form.email.value;

  var password = form.password.value;

  var _token = form._token.value;

  $.ajax({

      'method':'POST',
      'url':form.getAttribute('action'),
      'data': {
          email : email,
          _token : _token,
          password: password
      },
      success:function (res) {
          window.location.href = res.redirectTo;
      },

      error:function (xhr, status, error) {

          Materialize.toast((xhr.responseJSON.email) ? xhr.responseJSON.email : error ,4000);
      }

  });


}

// handle user register

function register(e) {

    e.preventDefault();

    var form = document.forms.register;

    var email = form.email.value;

    var password = form.password.value;

    var _token = form._token.value;

    var name = form.name.value;

    $.ajax({

        'method':'POST',
        'url':form.getAttribute('action'),
        'data': {
            email : email,
            _token : _token,
            password: password,
            name: name
        },
        success:function (res) {
            window.location.href = res.redirectTo;
        },

        error:function (xhr, status, error) {

            Materialize.toast((xhr.responseJSON.email) ? xhr.responseJSON.email : error ,4000);
        }

    });

}