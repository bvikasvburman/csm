$.validator.setDefaults({
	submitHandler: function() {
            	commonfn.doAjax({
                    url:HTTP_PATH+'menus/editajax',
                    dataString: $("#frmAddPage").serialize()+"&data_id="+data_id,
                    elem:"#submitFrm",
                    ajaxSuccess:function(data)
                    {
                        if(data.error)
                        {
                            error_display(data.error_mess);
                        }
                        else
                        {
                            msg_alert(data.success_mess,HTTP_PATH+"menus/index");
                        }
                    }
                });
	}
});

$.validator.addMethod("lettersonly", function(value, element) {
    return this.optional(element) || /^[a-zA-z\-0-9]+$/i.test(value);
}, " (Letters and numbers only allowed [a-z,A-z,-,0-9])"); 
$.validator.addMethod("urlonly", function(value, element) {
    return this.optional(element) || /^[a-zA-z\-0-9\/#\.]+$/i.test(value);
}, " (URL can contain only letters, numbers only allowed [a-z,A-z,-,0-9,#,/,.])"); 
$().ready(function() {
    
    
    $("#menu_text").keyup(function(e){
            var text = $.trim($(this).val());
            text = text.replace(/\s{1,}/g, '-');
            text = text.replace(/ /gi, '');
            $("#menu_slug").val(text);
    });
    	// validate the form when it is submitted
	var validator = $("#frmAddPage").validate({
		errorPlacement: function(error, element) {
			// Append error within linked label
			$( element )
				.closest( "form" )
					.find( "label[for='" + element.attr( "id" ) + "']" )
						.append( error );
		},
		errorElement: "span",
                rules: {
                        menu_text: {
				required: true,
				minlength: 2,
				maxlength: 255
			},
                        menu_slug: {
				required: true,
				minlength: 2,
				maxlength: 255,
                                lettersonly:true
			},
                        menu_title: {
				required: true,
				minlength: 2,
				maxlength: 255
			},
			menu_url: {
				maxlength: 255,
                                urlonly: true
			},
			menu_alt: {
				minlength: 2,
				maxlength: 255
			}
                },
		messages: {
			menu_text: {
				required: " (required)",
				minlength: " (must be between 2 and 255 characters)",
				maxlength: " (must be between 2 and 255 characters)"
			},
			menu_title: {
				required: " (required)",
				minlength: " (must be between 2 and 255 characters)",
				maxlength: " (must be between 2 and 255 characters)"
			},
			menu_url: {
				
				maxlength: " (must be between 2 and 255 characters)"
			},
			menu_alt: {
				minlength: " (must be between 2 and 255 characters)",
				maxlength: " (must be between 2 and 255 characters)"
			}
		}
	});

	$(".cancel").click(function() {
            	validator.resetForm();
	});
});