

(function ($) {
    /*************** MAIN FUNCTION ***************/
    /*****---------- On Ready ----------*****/
    $(document).ready(function () {
        init();
        onChanges();
        onClicks();
        onFocus();
        onInput();
        onMouseUps();
        onMouseOver();
        onKeyUp();
        onKeyDown();
        onSubmit();
        onLoad();
    });

    /*****---------- INIT ----------*****/
    function init() {

    }

    /*****---------- onChanges ----------*****/
    function onChanges() {
        // $(document).on('change', '.class', function() {

        // });


    }
    /*****---------- onClicks ----------*****/
    function onClicks() {


        // $(document).on('click', '#updateBtn', function() {

        // });

        // admin Login
        $(document).on('click', '#adminLogin', function (event) {
            validateAndSubmit(event);
        });

        // Handle keypress event for the Enter key on form inputs
        $(document).on('keypress', 'input', function (event) {
            if (event.which === 13) { // Enter key is pressed
                validateAndSubmit(event);
            }
        });

        $(document).on('click', '#changePassBtn', function (event) {
            var forms = $('#validationChangePass');
            var isValid = true;
        
            // Loop over them and prevent submission if invalid
            forms.each(function () {
                var form = $(this);
                if (!form[0].checkValidity()) {
                    event.preventDefault();
                    event.stopPropagation();
                    isValid = false;
                }
                form.addClass('was-validated');
            });
        
            // Additional check for password strength and match
            var newPass = $('#newPass').val();
            var confirmPass = $('#confirmPass').val();
        
            // Password strength validation regex
            var passwordRegex = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/;
        
            if (newPass && !passwordRegex.test(newPass)) {
                isValid = false;
                Swal.fire({
                    title: 'Error!',
                    text: 'New Password must be at least 8 characters long, include at least one uppercase letter, one lowercase letter, one number, and one special character.',
                    icon: 'error',
                    confirmButtonText: 'OK'
                });
            } else if (newPass !== confirmPass) {
                isValid = false;
                Swal.fire({
                    title: 'Error!',
                    text: 'New Password and Confirm Password do not match!',
                    icon: 'error',
                    confirmButtonText: 'OK'
                });
            }
        
            // Proceed with AJAX request if the form is valid
            if (isValid) {
                var admin_id = $('#admin_id').val();
                var newUsername = $('#newUsername').val();
                var currentPass = $('#currentPass').val();
        
                $.ajax({
                    url: "functions/admin-changeCred.php",
                    type: "POST",
                    data: {
                        admin_id: admin_id,
                        newUsername: newUsername,
                        currentPass: currentPass,
                        newPass: newPass,
                        confirmPass: confirmPass
                    },
                    success: function (data) {
                        console.log(data);
                        $('.loading-ui').hide();
                        if (data.trim() === "Successful") {
                            Swal.fire({
                                title: 'Success!',
                                text: 'Successfully Changed',
                                icon: 'success',
                                confirmButtonText: 'OK'
                            }).then(() => {
                                window.location.reload();
                            });
                        } else {
                            Swal.fire({
                                title: 'Error!',
                                text: 'Double check if the current password correct and new password and confirm password is same!',
                                icon: 'error',
                                confirmButtonText: 'OK'
                            });
                        }
                    }
                });
            }
        });
        
        // Handle keypress event for the Enter key on form inputs within the modal
        $(document).on('keypress', '#validationChangePass input', function (event) {
            if (event.which === 13) { // Enter key is pressed
                event.preventDefault(); // Prevent the default form submission
                $('#changePassBtn').click(); // Trigger the button click event
            }
        });
        



    }

    /*****---------- Validate and Submit ----------*****/
    function validateAndSubmit(event) {
        var forms = $('.needs-validation');
        var isValid = true;

        // Loop over them and prevent submission if invalid
        forms.each(function () {
            var form = $(this);
            if (!form[0].checkValidity()) {
                event.preventDefault();
                event.stopPropagation();
                isValid = false;
            }
            form.addClass('was-validated');
        });

        // Proceed with AJAX request if the form is valid
        if (isValid) {
            var username = $('#username').val();
            var password = $('#password').val();

            $.ajax({
                url: "functions/admin-login.php",
                type: "POST",
                data: {
                    username: username,
                    password: password
                },
                dataType: 'json',
                success: function (response) {
                    if (response.status === 'success') {
                        window.location.href = response.redirect;
                    } else {
                        Swal.fire({
                            icon: "error",
                            title: "Oops...",
                            text: "Incorrect Usename or Password",
                        });
                    }
                },
                error: function (xhr, status, error) {
                    Swal.fire({
                        icon: "error",
                        title: "Oops...",
                        text: "Something went wrong!",
                    });
                }
            });
        }
    }

    /***--------- OnFocus ----------*****/
    function onFocus() {
        // $(document).on('focus', '.class', function() {

        // });
    }

    /***--------- OnInput----------*****/
    function onInput() {
        // $(document).on('input', '.class', function() {

        // });

    }

    /***--------- OnMouseUp ----------*****/
    function onMouseUps() {
        // $(document).on('mouseup', '.class', function(e) {

        // });
    }

    /***--------- OnMouseUp ----------*****/
    function onMouseOver() {
        // $(document).on('mouseover', '.class', function(e) {

        // });
    }

    /***--------- OnKeyUp ----------*****/
    function onKeyUp() {
        // $( document ).on( 'keyup', '.class', function(e) {

        // });
    }

    /***--------- OnKeyDown ----------*****/
    function onKeyDown() {
        $(document).on('keydown', '.class', function (e) {

        });
    }

    /****--------- OnSubmit ----------*****/
    function onSubmit() {
        // $(document).on('submit', '.class', function(e){

        // });
    }


    /**------------- onLoad -------------**/
    function onLoad() {
        // code here
    }



    /**------------- Equalize Height -------------**/
    /** EQUALIZE HEIGHT OF AN ELEMENTS
     *
     * @param     {<type>}  elem    The element
     */
    // window.equalizeHeight = function(elem) {
    //     var arr = [];
    //     var a = 0;
    //     $(elem).each(function() {
    //         arr[a++] = $(this).outerHeight();
    //     });
    //     var largest = Math.max.apply(Math, arr);
    //     $(elem).each(function() {
    //         $(this).css({
    //             'min-height': largest
    //         });
    //     });
    // };

    // usage equalizeHeight('.class');

    /**------------- Window Resize -------------**/
    // $(window).resize(function() { });

})(jQuery);