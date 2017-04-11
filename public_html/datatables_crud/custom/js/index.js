// global the manage memeber table 
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

// submit form
        $("#createMemberForm").unbind('submit').bind('submit', function () {

            $(".text-danger").remove();

            var form = $(this);

            // validation
            var username = $("#username").val();
            var email = $("#email").val();
            var password = $("#password").val();

            if (username == "") {
                $("#username").closest('.form-group').addClass('has-error');
                $("#username").after('The Username field is required');
            } else {
                $("#username").closest('.form-group').removeClass('has-error');
                $("#username").closest('.form-group').addClass('has-success');
            }

            if (email == "") {
                $("#email").closest('.form-group').addClass('has-error');
                $("#email").after.after('<p class="text-danger">The EMAIL field is required</p>');
            } else {
                $("#email").closest('.form-group').removeClass('has-error');
                $("#email").closest('.form-group').addClass('has-success');
            }

            if (password == "") {
                $("#password").closest('.form-group').addClass('has-error');
                $("#password").after('<p class="text-danger">The Password field is required </P>');
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
    if (id) {
        // click on remove button
        $("#removeBtn").unbind('click').bind('click', function () {
            $.ajax({
                url: 'php_action/remove.php',
                type: 'post',
                data: {member_id: id},
                dataType: 'json',
                success: function (response) {
                    if (response.success == true) {
                        $(".removeMessages").html('<div class="alert alert-success alert-dismissible" role="alert">' +
                                '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>' +
                                '<strong> <span class="glyphicon glyphicon-ok-sign"></span> </strong>' + response.messages +
                                '</div>');

                        // refresh the table
                        manageMemberTable.ajax.reload(null, false);

                        // close the modal
                        $("#removeMemberModal").modal('hide');

                    } else {
                        $(".removeMessages").html('<div class="alert alert-warning alert-dismissible" role="alert">' +
                                '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>' +
                                '<strong> <span class="glyphicon glyphicon-exclamation-sign"></span> </strong>' + response.messages +
                                '</div>');
                    }
                }
            });
        }); // click remove btn
    } else {
        alert('Error: Refresh the page again');
}
}

function editMember(id = null) {
	if(id) {
		// remove the error 
		$(".form-group").removeClass('has-error').removeClass('has-success');
		$(".text-danger").remove();
		// empty the message div
		$(".edit-messages").html("");
		// remove the id
		$("#member_id").remove();
		// fetch the member data
		$.ajax({
			url: 'php_action/getSelectedMember.php',
			type: 'post',
			data: {member_id : id},
			dataType: 'json',
			success:function(response) {
				$("#editUsername").val(response.username);

				$("#editEmail").val(response.email);

				$("#editPassword").val(response.password);
				// mmeber id 
				$(".editMemberModal").append('<input type="hidden" name="member_id" id="member_id" value="'+response.id+'"/>');

                            // here update the member data
				$("#updateMemberForm").unbind('submit').bind('submit', function() {
					// remove error messages
					$(".text-danger").remove();

					var form = $(this);

					// validation
					var editUsername = $("#editUsername").val();
					var editEmail = $("#editEmail").val();
					var editPassword = $("#editPassword").val();

					if(editUsername == "") {
						$("#editUsername").closest('.form-group').addClass('has-error');
						$("#editUsername").after('<p class="text-danger">The Username field is required</p>');
					} else {
						$("#editUsername").closest('.form-group').removeClass('has-error');
						$("#editUsername").closest('.form-group').addClass('has-success');				
					}

					if(editEmail == "") {
						$("#editEmail").closest('.form-group').addClass('has-error');
						$("#editEmail").after('<p class="text-danger">The Email field is required</p>');
					} else {
						$("#editEmail").closest('.form-group').removeClass('has-error');
						$("#editEmail").closest('.form-group').addClass('has-success');				
					}

					if(editPassword == "") {
						$("#editPassword").closest('.form-group').addClass('has-error');
						$("#editPassword").after('<p class="text-danger">The Password field is required</p>');
					} else {
						$("#editPassword").closest('.form-group').removeClass('has-error');
						$("#editPassword").closest('.form-group').addClass('has-success');				
					}

		
					if(editUsername && editEmail && editPassword) {
						$.ajax({
							url: form.attr('action'),
							type: form.attr('method'),
							data: form.serialize(),
							dataType: 'json',
							success:function(response) {
								if(response.success == true) {
									$(".edit-messages").html('<div class="alert alert-success alert-dismissible" role="alert">'+
									  '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>'+
									  '<strong> <span class="glyphicon glyphicon-ok-sign"></span> </strong>'+response.messages+
									'</div>');

									// reload the datatables
									manageMemberTable.ajax.reload(null, false);
									// this function is built in function of datatables;

									// remove the error 
									$(".form-group").removeClass('has-success').removeClass('has-error');
									$(".text-danger").remove();
								} else {
									$(".edit-messages").html('<div class="alert alert-warning alert-dismissible" role="alert">'+
									  '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>'+
									  '<strong> <span class="glyphicon glyphicon-exclamation-sign"></span> </strong>'+response.messages+
									'</div>')
								}
							} // /success
						}); // /ajax
					} // /if

					return false;
				});

			} // /success
		}); // /fetch selected member info

	} else {
		alert("Error : Refresh the page again");
	}
}
