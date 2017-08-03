function startRegistration() {
    document.getElementById('repeatPassword').style.display = 'block';
    document.getElementById('comeIn').style.display = 'none';
    document.getElementById('register').style.display = 'block';
    document.getElementById('labelRegister').style.display = 'none';
    document.getElementById('labelComeIn').style.display = 'block';
    //document.getElementById('lostPassword').style.display = 'none';
    document.getElementById('errorText').style.display = 'none';
}

function finishRegistration() {
    document.getElementById('repeatPassword').style.display = 'none';
    document.getElementById('comeIn').style.display = 'block';
    document.getElementById('register').style.display = 'none';
    //document.getElementById('lostPassword').style.display = 'block';
    document.getElementById('labelComeIn').style.display = 'none';
    document.getElementById('labelRegister').style.display = 'block';
    document.getElementById('errorText').style.display = 'none';
}

function loginIn() {
    var login = $("#login-name").val();
    var password = $("#login-pass").val();
    var inputElem = $("#login-name,#login-pass");
    var labelElem = $("#login-name-label,#login-pass-label");

    if ($.trim(login) && $.trim(password)) {

        $.ajax({
            type: "POST",
            url: "authorization.php",
            data: {login: login, password: password},
            success: function (data) {
                if (data == 'valid') {
                    document.location.href = "workingPage.php";
                } else if (data == 'invalid') {
                    writeErrorText("Неправильный логин или пароль");
                    inputElem.css('border-color', 'red');
                    labelElem.css('color', 'red');
                    inputElem.focus(function () {
                        inputElem.css('border-color', '');
                        labelElem.css('color', '');
                    });
                }
            }
        });
    } else {
        if (!$.trim(login) && !$.trim(password)) {
            writeErrorText("Поля не могут быть пустыми");
            inputElem.css('border-color', 'red');
            labelElem.css('color', 'red');
        } else {
            if (!$.trim(login)) {
                $("#login-name").css('border-color', 'red');
                $("#login-name-label").css('color', 'red');
                writeErrorText("Поле \"Логин\" не может быть пустым");
            }
            if (!$.trim(password)) {
                $("#login-pass").css('border-color', 'red');
                $("#login-pass-label").css('color', 'red');
                writeErrorText("Поле \"Пароль\" не может быть пустым");
            }
        }
        inputElem.focus(function () {
            inputElem.css('border-color', '');
            labelElem.css('color', '');
        });
    }

}

function registration() {
    var login = $("#login-name").val();
    var password = $("#login-pass").val();
    var passwordConfirm = $("#confirm-pass").val();
    var inputElem = $("#login-name,#login-pass,#confirm-pass");
    var labelElem = $("#login-name-label,#login-pass-label,#confirm-pass-label");

    if ($.trim(login) && $.trim(password) && $.trim(passwordConfirm)) {

        $.ajax({
            type: "POST",
            url: "registration.php",
            data: {login: login, password: password, passwordConfirm: passwordConfirm},
            success: function (data) {
                if (data == 'valid') {
                    writeErrorText("Вы успешно зарегистрированы");
                    inputElem.val('');
                    finishRegistration();
                } else {
                    if (data == 'busyLogin') {
                        writeErrorText("Такой \'login\' уже занят");
                        $("#login-name").css('border-color', 'red');
                        $("#login-name-label").css('color', 'red');

                    }
                    if (data == 'diffPass'){
                        writeErrorText("Пароли не совпадают");
                        $("#login-pass").css('border-color', 'red');
                        $("#login-pass-label").css('color', 'red');
                        $("#confirm-pass").css('border-color', 'red');
                        $("#confirm-pass-label").css('color', 'red');
                    }
                    inputElem.focus(function () {
                        inputElem.css('border-color', '');
                        labelElem.css('color', '');
                    });
                }
            }
        });
    } else {
        if (!$.trim(login) && !$.trim(password) && !$.trim(passwordConfirm)) {
            writeErrorText("Поля не могут быть пустыми");
            inputElem.css('border-color', 'red');
            labelElem.css('color', 'red');
        } else {
            if (!$.trim(login)) {
                $("#login-name").css('border-color', 'red');
                $("#login-name-label").css('color', 'red');
                writeErrorText("Поле \"Логин\" не может быть пустым");
            }
            if (!$.trim(password)) {
                $("#login-pass").css('border-color', 'red');
                $("#login-pass-label").css('color', 'red');
                writeErrorText("Поле \"Пароль\" не может быть пустым");
            }
            if (!$.trim(passwordConfirm)) {
                $("#confirm-pass").css('border-color', 'red');
                $("#confirm-pass-label").css('color', 'red');
                writeErrorText("Поле \" Подтверждения пароля\" не может быть пустым");
            }
        }
        inputElem.focus(function () {
            inputElem.css('border-color', '');
            labelElem.css('color', '');
        });
    }
}

function writeErrorText(text) {
    document.getElementById('errorText').style.display = 'block';
    document.getElementById("errorText").innerHTML = text;
}

