! function($) {
    "use strict";
    var SweetAlert = function() {};
    //examples 
    SweetAlert.prototype.init = function() {
            //Basic
            $('#sa-basic').click(function() {
                swal("Here's a message!");
            });
            //A title with a text under
            $('#sa-title').click(function() {
                swal("Here's a message!", "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed lorem erat eleifend ex semper, lobortis purus sed.")
            });
            //Success Message
            $('#sa-success').click(function() {
                swal("Good job!", "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed lorem erat eleifend ex semper, lobortis purus sed.", "success")
            });
            //Warning Message
            $('#sa-warning').click(function() {
                swal({
                    title: "Are you sure you want to start module test ?",
                    text: "Proceed by clicking on the proceed button below !",
                    type: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#ff9800",
                    confirmButtonText: "Procees",
                    closeOnConfirm: false
                }, function() {
                    swal("confirmed!", "Test begins shortly.", "success");
                });
            });
            //Parameter
            $('#sa-params').click(function() {
                swal({
                    title: "Are you sure you want to start module test ?",
                    text: "Proceed by clicking on the proceed button below !",
                    type: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#ff9800",
                    confirmButtonText: "Proceed",
                    cancelButtonText: "Cancel",
                    closeOnConfirm: false,
                    closeOnCancel: false
                }, function(isConfirm) {
                    if (isConfirm) {
                        swal("Deleted!", "Your imaginary file has been deleted.", "success");
                    } else {
                        swal("Cancelled", "Your imaginary file is safe :)", "error");
                    }
                });
            });
            //Custom Image
            $('#sa-image').click(function() {
                swal({
                    title: "Govinda!",
                    text: "Recently joined twitter",
                    imageUrl: "../plugins/images/users/govinda.jpg"
                });
            });
            //Auto Close Timer
            $('#sa-close').click(function() {
                swal({
                    title: "Auto close alert!",
                    text: "I will close in 2 seconds.",
                    timer: 2000,
                    showConfirmButton: false
                });
            });
        },
        //init
        $.SweetAlert = new SweetAlert, $.SweetAlert.Constructor = SweetAlert
}(window.jQuery),
//initializing 
function($) {
    "use strict";
    $.SweetAlert.init()
}(window.jQuery);