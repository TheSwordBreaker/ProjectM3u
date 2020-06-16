$(document).ready(function() {

    $('input').on('focus focusout keyup', function () {
        $(this).valid();
    });

   

    $("#login-form").validate({
        rules: {
            inputUser: {
                required: true,
                minlength: 5
            },
            inputPassword: {
                required: true,
                minlength: 5
            }
        },
        errorClass: "myError",
        messages: {
            inputUser: {
                required: "**Please provide a Username",
                minlength: "**Your Username must be at least 5 characters long"
            },
            inputPassword: {
                required: "**Please provide a password",
                minlength: "**Your password must be at least 5 characters long"
            },
        },
        submitHandler: function(form) {
            var user = $("#inputUser").val();
            var password = $("#inputPassword").val();
           
            // alert(user + password + op)
            $.ajax({
                url: auth,
                method: "POST",
                data: {
                    "user": user,
                    "password": password,
                    
                },
                success: function(d) {
                    if (d.status == 0) {
                        // sessionStorage.setItem("username", user);
                        // sessionStorage.setItem("path", "/");
                        // sessionStorage.setItem("token", d.token);
                        // sessionStorage.setItem("id", d.id);
                        // window.location = "control.php";
                        alert(d.msg);
                    } else {
                        alert(d.msg);
                    }
                },
                error: function(d) {
                    alert("there was a connection problem")
                }
            });
    
        }
    }
    });
});