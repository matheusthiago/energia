/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
//global the manage member table
var manageMemberTable;
$(document).ready(function () {
    manageMemberTable = $("#manageMemberTable").DataTable({
        "ajax": "php_action/retrieve.php",
        "order": []
    });
    $("#addMemberModalBtn").on('click', function () {
        //reset the form
        $("#createMemberForm")[0].reset();
        // remove the error 
        $(".form-group").removeClass('has-error').removeClass('has-success');
        $(".text-danger").remove();
        // empty the message div
        $(".messages").html("");
//submit form
        $("#createMemberForm").unbind('submit').bind('submit', function () {
            $(".text-danger").remove();
            var form = $(this);
            // validation
            var username = $("#username").val();
            var email = $("#email").val();
            var password = $("#password").val();

            if (username == "") {
                $("#username").closest('.form-group').addClass('has-error');
                $("#username").after('The Name field is required');
            } else {
                $("#username").closest('.form-group').removeClass('has-error');
                $("#username").closest('.form-group').addClass('has-success');
            }

            if (email == "") {
                $("#email").closest('.form-group').addClass('has-error');
                $("#email").after('The Address field is required');
            } else {
                $("#email").closest('.form-group').removeClass('has-error');
                $("#email").closest('.form-group').addClass('has-success');
            }

            if (password == "") {
                $("#password").closest('.form-group').addClass('has-error');
                $("#password").after('The Contact field is required');
            } else {
                $("#password").closest('.form-group').removeClass('has-error');
                $("#password").closest('.form-group').addClass('has-success');
            }


            if (username && email && password) {
                //submi the form to server
                $.ajax({
                    url: form.attr('action'),
                    type: form.attr('method'),
                    data: form.serialize(),
                    dataType: 'json',
                    success: function (response) {

                        // remove the error 
                        $(".form-group").removeClass('has-error').removeClass('has-success');

                        if (response.success == true) {
                            $(".messages").html('<div class="alert alert-success alert-dismissible" role="alert">' +
                                    '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>' +
                                    '<strong> <span class="glyphicon glyphicon-ok-sign"></span> </strong>' + response.messages +
                                    '</div>');

                            // reset the form
                            $("#createMemberForm")[0].reset();

                            // reload the datatables
                            manageMemberTable.ajax.reload(null, false);
                            // this function is built in function of datatables;
                        } else {
                            $(".messages").html('<div class="alert alert-warning alert-dismissible" role="alert">' +
                                    '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>' +
                                    '<strong> <span class="glyphicon glyphicon-exclamation-sign"></span> </strong>' + response.messages +
                                    '</div>');
                        } // /else
                    } // success 
                }); // ajax subit               
            } /// if
            return false;
        }); // /submit form for create member
    }); // /add modal

 
});
function removeMember(id = null) {
    if(id) {
        // click on remove button
        $("#removeBtn").unbind('click').bind('click', function() {
            $.ajax({
                url: 'php_action/remove.php',
                type: 'post',
                data: {member_id : id},
                dataType: 'json',
                success:function(response) {
                    if(response.success == true) {                      
                        $(".removeMessages").html('<div class="alert alert-success alert-dismissible" role="alert">'+
                             '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>'+
                             '<strong> <span class="glyphicon glyphicon-ok-sign"></span> </strong>'+response.messages+
                            '</div>');
 
                        // refresh the table
                        manageMemberTable.ajax.reload(null, false);
 
                        // close the modal
                        $("#removeMemberModal").modal('hide');
 
                    } else {
                        $(".removeMessages").html('<div class="alert alert-warning alert-dismissible" role="alert">'+
                             '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>'+
                             '<strong> <span class="glyphicon glyphicon-exclamation-sign"></span> </strong>'+response.messages+
                            '</div>');
                    }
                }
            });
        }); // click remove btn
    } else {
        alert('Error: Refresh the page again');
    }
}




