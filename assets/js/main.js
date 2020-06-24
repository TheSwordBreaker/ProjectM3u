const base = 'http://localhost:80/ProjectM3u';

$(document).ready(function() {
    $('input').on('focus focusout keyup', function () {
        $(this).valid();
    });
    $(".close").on('click',function(){
        $(this).hide();
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
                    
                    if (d.status) {
                       
                       window.location = base+'/playlist';
                       
                       
                    }else{
                        
                        if("redirect" in d){
                            window.location = base+d.redirect;
                            
                        }else{
                            $('#alert-success #msg').text(d.msg);
                            $('#alert-success').show()
                        }
                    } 
                },
                error: function(d) {
                   
                    $('#alert-danger #msg').text("there was a connection problem");
                     $('#alert-danger').show()
                }
            });
    
        }
    });


    $("#signup-form").validate({
        rules: {
            
            inputEmail: {
                required: true,
                email: true,
                remote: {
                    url: base + '/checkemail',
                    type: 'post'
                 }
            },
            inputUser: {
                required: true,
                minlength: 5,
                maxlength: 15,
                remote: {
                    url: base + '/checkusername',
                    type: 'post'
                 }
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
            inputEmail: {
                required: "Please enter a valid email address",
                email: "Please enter a valid email address",
                remote: "Email already in use!"
            },
            inputUser: {
                required: "**Please provide a Username",
                minlength: "**Your Username must be at least 5 characters long",
                maxlength: "**Your Username must be at most 15 characters long",
                remote: "Username already in use!"
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
                        window.location = base+"/confirm";

                    }
                    else{
                        $('#alert-danger #msg').text(d.msg);
                        $('#alert-danger').show()
                    }
                },
                error: function(d) {
                    $('#alert-danger #msg').text("something went wrong");
                    $('#alert-danger').show()
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
        

});

