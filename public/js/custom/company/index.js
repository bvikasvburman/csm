var comNo = "";
var comName = "";
var Communitab = 0;
$().ready(function() {

    
    $(document).on('click', '.more_vic_data', function(e){
        e.preventDefault();
        var data_id     = $(this).attr("data-id");
        var data_url    = $(this).data("url");
        var dataVarString  = 'id=' + data_id;
        commonfn.doAjax({
            url: data_url,
            elem: $(this),
            dataString: dataVarString,
            ajaxSuccess: function(data) {
                console.log(data);
                
                
                
                if (data.success)
                {
                    $(".show_more_data").html(data.html);
                    //reset_edit_data();
                    //fill_edit_data(data.content);
                } else {
                    if (data.error)
                    {
                        bootbox.alert(data.error_mess);
                    }
                }
            }
        });
        
        
        /*
        $.ajax({
            url : data_url,
            success : function(data){
                console.log(data);
                if (data.success)
                {
                    $(".add_new_comp").slideDown("slow");
                    reset_edit_data();
                    fill_edit_data(data.content);
                   
                }
                else
                if (data.error)
                {
                    bootbox.alert(data.error_mess);
                }
            }
        });
        */
        
    });
    
    
    $(".view_page_cont").click(function() {
        var id = $(this).attr("data-id");
        var content = $("#" + id).html();
        $("#modal_view_page .modal-body").html(content);
        $("#modal_view_page").modal("show");
    });
    //======================================
    
    var location = HTTP_PATH + "company/listingAjax";
    companyListing(location);
    
    $("body").on("click", ".pagination li a", function(e) {
        e.preventDefault();
        var href = $(this).attr("href");
        companyListing(href);
    });
    //======================================

    $(".add_new_btn").click(function(e) {
        e.preventDefault();
        edit_mode = 0;
        reset_edit_data();
        $(".add_new_comp").slideDown("slow");
    });
    //======================================

    $("body").on("click", ".edit_comp_data", function(e) {
        e.preventDefault();
        edit_mode = 1;
        var data_id = $(this).attr("data-id");
        var data_url = $(this).data("url");
        commonfn.doAjax({
            url: HTTP_PATH + "company/getCompanyData",
            elem: $(this),
            dataString: "data_id=" + data_id,
            ajaxSuccess: function(data) {
                console.log(data);
                if (data.success)
                {
                    $(".add_new_comp").slideDown("slow");
                    reset_edit_data();
                    fill_edit_data(data.content);
                   
                }
                else
                if (data.error)
                {
                    bootbox.alert(data.error_mess);
                }
            }
        });

    });
    //======================================
    
    $(".add_cancel").click(function(e) {
        e.preventDefault();
        $(".add_new_comp").slideUp("slow");
    });
    //======================================

    //$("#searchComNo, #searchComName").keyup(function(e) {
    $(document).on("blur change", "#searchComNo, #searchComName", function(e)  {
        //if (e.keyCode == 13)
        //{
            e.preventDefault();
            //console.log('vikc');
            comNo = $.trim($("#searchComNo").val());
            comName = $.trim($("#searchComName").val());
            companyListing(location);
            return false;
        //}
    });
    
    $("#searchComBtn").click(function(e) {
        e.preventDefault();
        comNo = $.trim($("#searchComNo").val());
        comName = $.trim($("#searchComName").val());
        companyListing(location);
    });

    /*
     * Add new Company functionality
     */


    $(".commu_table").on("click", ".add_commu", function(e) {
        var total_inps = comp_commu_tab;
        var break_s = false;
        for (var i = 0; i < total_inps; i++)
        {
            var vals = $.trim($("#com_inp_" + i).val());

        }
        set_template(total_inps);
        comp_commu_tab = total_inps + 3;
    });
    
    $(".commu_table").on("click", ".remove_commu", function(e) {
        $(this).closest("tr").remove();
    });

    // validate the form when it is submitted
    var validator = $("#frmAddCom").validate({
        errorPlacement: function(error, element) {
            // Append error within linked label
            $(element)
                    .closest("form")
                    .find("label[for='" + element.attr("id") + "']")
                    .append(error);
        },
        errorElement: "span",
        rules: {
            com_no: {
                required: true,
                number: true,
                minlength: 2,
                maxlength: 255,
                lettersonly: true
            },
            com_name: {
                required: true,
                minlength: 2,
                maxlength: 255,
                lettersspaceonly: true
            },
            com_type: {
                required: true
            },
            add_street: {
                required: true,
                maxlength: 255,
                lettersspaceonly: true
            },
            add_postal: {
                required: true,
                number: true,
                minlength: 2
            },
            add_city: {
                required: true,
                lettersonly: true
            },
            add_country: {
                required: true,
                lettersonly: true
            }
        },
        messages: {
            com_no: {
                required: " (required)",
                minlength: " (must be between 2 and 255 characters)",
                maxlength: " (must be between 2 and 255 characters)"

            },
            com_name: {
                required: " (required)",
                minlength: " (must be between 2 and 255 characters)",
                maxlength: " (must be between 2 and 255 characters)"
            },
            com_type: {
                required: " (required)"

            },
            add_street: {
                required: " (required)",
                maxlength: " (max 255 characters)"
            },
            add_postal: {
                required: " (required)",
                minlength: " (minimum 2 characters)"
            },
            add_city: {
                required: " (required)"

            },
            add_country: {
                required: " (required)"

            }

        }
    });

    $(".cancel").click(function() {
        formReset();
    });

    $("body").on("click", "#delete_rows_t", function(e) {
        e.preventDefault();
        var checkval = [];
        $('.actionsid_t:checkbox:checked').each(function(i) {
            checkval[i] = $(this).val();
        });
        if (checkval.length == 0)
        {
            return false;
        }
        var _this = this;
        bootbox.confirm("Are you sure to delete the selected data?", function(result) {
            if (result == true)
            {
                var tab_d = $(_this).attr('href');

                var url = tab_d;
                var dataString = "checkval=" + checkval;
                commonfn.doAjax({'url': url, 'dataString': dataString, 'elem': "#delete_rows_t",
                    ajaxSuccess: function(data) {
                        if (data.success)
                        {
                            $("#searchComNo").val('');
                            $("#searchComName").val('');
                            comNo = "";
                            comName = "";
                            $('.actionsid_t:checkbox:checked').each(function(i) {
                                $(this).closest('tr').remove();
                            });
                            $("#checkallitem_t").iCheck('uncheck');
                            companyListing(location);
                        }
                    }});

            }
        });

    });


});


function companyListing(href)
{
    commonfn.doAjax({
        url: href,
        dataString: "comNo=" + comNo + "&comName=" + comName,
        container: "#company_listing",
        elem: "#searchComBtn",
        ajaxSuccess: function(data) {
            if (data.success)
            {
                index.check_all_handle();
            }
            else
            if (data.error)
            {
                bootbox.alert(data.error_mess);
            }
        }
    });
}

function fill_edit_data(content)
{
    comp_id = content.comp_id;
    $("#com_no").val(content.comp_no);
    $("#com_name").val(content.comp_name);
    $("#com_type").val(content.comp_type);
    $("#add_street").val(content.add_street);
    $("#add_postal").val(content.add_postal);
    $("#add_city").val(content.add_city);
    $("#add_country").val(content.add_country);
    var commu_n = content.commu;
    
    for (var i in commu_n)
    {
        var obj = commu_n[i];
        if (i == 0)
        {
            var count = i;
            $("#com_inp_" + count).val(obj.type);
            $("#com_inp_" + (++count)).val(obj.value);
            $("#com_inp_" + (++count)).val(obj.id);
            comp_commu_tab = count+1;
        }
        else
        {
            var total_inps = comp_commu_tab;
            set_template(total_inps);
            $("#com_inp_" + total_inps).val(obj.type);
            $("#com_inp_" + (total_inps + 1)).val(obj.value);
            $("#com_inp_" + (total_inps + 2)).val(obj.id);
            comp_commu_tab = total_inps + 3;
        }
    }
}

function reset_edit_data()
{
    comp_id = 0;
    comp_commu_tab = 0;
    $("#com_no").val('');
    $("#com_name").val('');
    $("#com_type").val('');
    $("#add_street").val('');
    $("#add_postal").val('');
    $("#add_city").val('');
    $("#add_country").val('');
    $(".commu_table tbody").html('');
    set_template(0);
    comp_commu_tab = 3;
}

function set_template(number)
{
    var template = $("#commu_tab_template").html();
    template = template.replace("{template_id_1}", "com_inp_" + number);
    template = template.replace("{template_name_1}", "com_inp[" + number + "]");
    template = template.replace("{template_name_2}", "com_inp[" + (number + 1) + "]");
    template = template.replace("{template_id_2}", "com_inp_" + (number + 1));
    template = template.replace("{template_name_3}", "com_inp[" + (number + 2) + "]");
    template = template.replace("{template_id_3}", "com_inp_" + (number + 2));
    $(".commu_table tbody").append(template);
}


$.validator.setDefaults({
    submitHandler: function() {
        commonfn.doAjax({
            url: HTTP_PATH + 'company/addajax',
            dataString: $("#frmAddCom").serialize() + "&edit_mode=" + edit_mode + "&comp_id=" + comp_id,
            elem: "#submitFrm",
            ajaxSuccess: function(data)
            {
                if (data.error)
                {
                    error_display(data.error_mess);
                }
                else
                {
                    edit_mode = 0;
                    msg_alert(data.success_mess);
                    $("#frmAddCom input").val('');
                    $("#frmAddCom select").val('');
                    companyListing(location);
                }
            }
        });
    }
});

$.validator.addMethod("lettersonly", function(value, element) {
    return this.optional(element) || /^[a-zA-z\-0-9]+$/i.test(value);
}, " (Letters and numbers only allowed [a-z,A-z,-,0-9])");
$.validator.addMethod("lettersspaceonly", function(value, element) {
    return this.optional(element) || /^[a-z ,A-z\-0-9]+$/i.test(value);
}, " (Letters, space, comma(,) and numbers only allowed [a-z,A-z,-,0-9])");


window.index = window.index || (function init($, undefined) {
    "use strict";
    var exports = {};
    exports.check_sel_opt = function()
    {
        if ($("input.actionsid_t:checked").length == 0)
        {
            $("#delete_rows_t").attr("disabled", 'disabled');
        }
        else
        {
            $("#delete_rows_t").removeAttr("disabled");
        }
    }
    exports.check_all_handle = function()
    {
        if (!$.isFunction($.fn.iCheck))
            return;
        $("#checkallitem_t, input.actionsid_t").iCheck({
            checkboxClass: 'icheckbox_square-blue'
        }).attr("autocomplete", 'off');

        $("#checkallitem_t").on('ifChecked', function(e) {
            $("input.actionsid_t").each(function() {
                $(this).iCheck('check');
            });
            exports.check_sel_opt();
        });
        $("#checkallitem_t").on('ifUnchecked', function(e) {
            $("input.actionsid_t").each(function() {
                $(this).iCheck('uncheck');
            });
            exports.check_sel_opt();
        });

        $("input.actionsid_t").on('ifChecked', function(e) {
            exports.check_sel_opt();
        });
        $("input.actionsid_t").on('ifUnchecked', function(e) {
            $("input.actionsid_t").each(function() {
                if (!(this.checked))
                {
                    $("#checkallitem_t").removeAttr("checked");
                }
            });
            exports.check_sel_opt();
        });
    }
    exports.check_sel_opt2 = function()
    {
        if ($("input.actionsid_t2:checked").length == 0)
        {
            $("#delete_rows_t2").attr("disabled", 'disabled');
        }
        else
        {
            $("#delete_rows_t2").removeAttr("disabled");
        }
    }
    exports.check_all_handle2 = function()
    {
        if (!$.isFunction($.fn.iCheck))
            return;
        $("#checkallitem_t2, input.actionsid_t2").iCheck({
            checkboxClass: 'icheckbox_square-blue'
        }).attr("autocomplete", 'off');

        $("#checkallitem_t2").on('ifChecked', function(e) {
            $("input.actionsid_t2").each(function() {
                $(this).iCheck('check');
            });
            exports.check_sel_opt();
        });
        $("#checkallitem_t2").on('ifUnchecked', function(e) {
            $("input.actionsid_t2").each(function() {
                $(this).iCheck('uncheck');
            });
            exports.check_sel_opt2();
        });

        $("input.actionsid_t2").on('ifChecked', function(e) {
            exports.check_sel_opt2();
        });
        $("input.actionsid_t2").on('ifUnchecked', function(e) {
            $("input.actionsid_t2").each(function() {
                if (!(this.checked))
                {
                    $("#checkallitem_t2").removeAttr("checked");
                }
            });
            exports.check_sel_opt2();
        });
    }


    exports.init = function(_$) {
        window.index = init(_$ || $);
    };
    exports.check_all_handle();
    exports.check_sel_opt();
    exports.check_all_handle2();
    exports.check_sel_opt2();
    return exports;
}(window.jQuery));
