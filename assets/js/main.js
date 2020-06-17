$(document).ready(function() {
    const base = 'http://localhost:80/ProjectM3u'

    $('input').on('focus focusout keyup', function () {
        $(this).valid();
    });
    
    $("#showpassword").click(function(){
        if($('input[type="checkbox"]').is(':checked')== true){
            $('#inputPassword').attr('type', 'text') 
            $('#inputPassword2').attr('type', 'text') 
        }else{
            $('#inputPassword').attr('type', 'password') 
            $('#inputPassword2').attr('type', 'password') 
        }
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
           
           
            $.ajax({
                url: base + '/login',
                method: "POST",
                data: {
                    "user": user,
                    "password": password,
                    
                },
                success: function(d) {

                    console.log(d)
                    var d = JSON.parse(d);
                    alert(d.msg);
                    if (d.status) {
                       
                       window.location = base+'/playlist';
                       
                    } 
                },
                error: function(d) {
                    alert("there was a connection problem")
                }
            });
    
        }
    });


    $("#signup-form").validate({
        rules: {
            
            inputEmail: {
                required: true,
                email: true
            },
            inputUser: {
                required: true,
                minlength: 5,
                maxlength: 15
            },
            inputPassword: {
                required: true,
                minlength: 5
            },
            inputPassword2: {
                required: true,
                minlength: 5,
                equalTo : "#inputPassword"
            },
        },
        errorClass: "myError",
        messages: {
            inputEmail: "Please enter a valid email address",
            inputUser: {
                required: "**Please provide a Username",
                minlength: "**Your Username must be at least 5 characters long",
                maxlength: "**Your Username must be at most 15 characters long"
            },
            inputPassword: {
                required: "**Please provide a password",
                minlength: "**Your password must be at least 5 characters long"
            },
            inputPassword2: {
                required: "**Please provide a password",
                minlength: "**Your password must be at least 5 characters long",
                equalTo : "**Your password must be same."
            },
        },
        submitHandler: function(form) {
            var user = $("#inputUser").val();
            var email = $("#inputEmail").val();
            var password = $("#inputPassword").val();
    
    
            $.ajax({
                url: base + '/signup',
                method: "POST",
                data: {
                    "user": user,
                    "password": password,
                    "email": email,
                    "extra": ""
                },
                success: function(d) {
                    // $('#alert #msg').text(d.msg)
                    // $('#alert').show()
                    var d = JSON.parse(d);
                    alert(d.msg);
                    if (d.status === 1) {
                        window.location = base+"/login";

                    }
                },
                error: function(d) {
                    alert("something went wrong");
                }
            });
        }
    });
});

    $("#uploadPlaylist-form").validate({
        rules: {
            
            playlistSource: {
                required: true,
                
            },
            playlistName: {
                required: true,
                maxlength: 60
            },
            playlistUrl:{
                required: true,
                maxlength: 600,
            },
            playlistFile:{
                required:true,
            },

            
        },
        errorClass: "myError",
        // messages: {
        //     inputEmail: "Please enter a valid email address",
        //     inputUser: {
        //         required: "**Please provide a Username",
        //         minlength: "**Your Username must be at least 5 characters long",
        //         maxlength: "**Your Username must be at most 15 characters long"
        //     },
        //     inputPassword: {
        //         required: "**Please provide a password",
        //         minlength: "**Your password must be at least 5 characters long"
        //     },
        //     inputPassword2: {
        //         required: "**Please provide a password",
        //         minlength: "**Your password must be at least 5 characters long",
        //         equalTo : "**Your password must be same."
        //     },
        // },
        submitHandler: function(form) {
            var playlistSource = $("#playlistSource").val();
            var playlistName = $("#playlistName").val();
            alert(playlistName+" "+playlistSource);
    
            // $.ajax({
            //     url: base + '/signup',
            //     method: "POST",
            //     data: {
            //         "user": user,
            //         "password": password,
            //         "email": email,
            //         "extra": ""
            //     },
            //     success: function(d) {
            //         // $('#alert #msg').text(d.msg)
            //         // $('#alert').show()
            //         var d = JSON.parse(d);
            //         alert(d.msg);
            //         if (d.status === 1) {
            //             window.location = base+"/login";

            //         }
            //     },
            //     error: function(d) {
            //         alert("something went wrong");
            //     }
            // });
        }

});