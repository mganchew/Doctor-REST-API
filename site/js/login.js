function submitLoginForm(values) {

    var uri = "http://appointment.dev/site/view/";

    $.ajax({
        type: 'POST',
        url: "http://appointment.dev/REST.php/login",
        data: {email: values['email'], password: values['password'], loginInfo: values['loginInfo']},
        dataType: 'json',
        success: function (data) {
            if (data.status === 'notOk') {
                //event.preventDefault(); // cancel default behavior    
                alert('Грешна парола или потребителско име! Моля опитайте отново!');
            } else {
                //console.log(data);
                setSession(uri,data);
            }
        },
        error: function () {
            window.location.replace(uri + data.redirectPage + "?msg=" + data.msg);
        }
    });

}

function setSession(uri,data){
    redirectPage = data.redirectPage;
    $.ajax({
        type: 'POST',
        url: "login.php",
        data: data,
        dataType: 'json',
        success: function (data) {
            
            window.location.replace(uri + redirectPage);
            //console.log(data);
            
        },
        error:function(data){
            window.location.replace(uri + redirectPage);
        }
    });
    
}

function checkField(tag) {

    value = $(tag).val();
    if (value === "" && tag === "#password") {
        return "Моля въведете вашата парола !";
    }

    if (value === "" && tag === "#email") {
        return "Моля въведете вашият имейл!";
    }

    return true;

}

$(document).ready(function () {

    $("#loginBtn").click(function (event) {
        msgPassword = checkField("#password", event);
        msgMail = checkField("#email");
        if (msgMail !== true || msgPassword !== true) {
            event.preventDefault(); // cancel default behavior
            if(msgMail === true){
                msgMail = "";
            }
            if(msgPassword === true){
                msgPassword = "";
            }
            alert(msgMail + msgPassword);
        } else {

            event.preventDefault(); // cancel default behavior    

            var $inputs = $('#loginForm :input');

            // get an associative array of just the values.
            var values = {};

            $inputs.each(function () {
                values[this.name] = $(this).val();
            });
            console.log(values);
            submitLoginForm(values);
        }
    });
});
