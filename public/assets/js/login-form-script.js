/*==============================================================*/
// Raque Contact Form  JS
/*==============================================================*/
(function ($) {
    "use strict"; // Start of use strict
    $("#loginForm").validator().on("submit", function (event) {
        if (event.isDefaultPrevented()) {
            // handle the invalid form...
            formError();
            submitMSG(false, "تأكد من صحة البيانات!");
        } else {
            // everything looks good!
            event.preventDefault();
            submitForm();
        }
    });


    function submitForm() {
        $.ajax(
            {
                type: "POST",
                url: "http://127.0.0.1:8000/login",
                data: $('#loginForm').serialize(),
                success: function (text) {
                    if (text == "success") {
                        formSuccess();
                    } else {
                        formError();
                        submitMSG(false, text);
                    }
                }
            }
        );
    }

    function formSuccess() {
        $("#contactForm")[0].reset();
        submitMSG(true, "تم ارسال رسالتك بنجاح!")
    }

    function formError() {
        $("#contactForm").removeClass().addClass('shake animated').one('webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend', function () {
            $(this).removeClass();
        });
    }

    function submitMSG(valid, msg) {
        if (valid) {
            var msgClasses = "h4 tada animated text-success";
        } else {
            var msgClasses = "h4 text-danger";
        }
        $("#msgSubmit").removeClass().addClass(msgClasses).text(msg);
    }
}(jQuery)); // End of use strict
