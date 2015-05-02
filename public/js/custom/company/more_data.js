$().ready(function() {
    var add_listing = HTTP_PATH+"company/listingOtherAdd";
    var person_listing = HTTP_PATH+"company/listingPerson";
    var person_commu_listing = HTTP_PATH+"company/listingPersonCommu";
    companyOtherAdd(add_listing);
    companyPerson(person_listing);
    $("body").on("click",".commu_table1 .pagination li a",function(e) {
        e.preventDefault();
        var href = $(this).attr("href");
        companyOtherAdd(href);
    });
    
    $("body").on("click",".commu_table2 .pagination li a",function(e) {
        e.preventDefault();
        var href = $(this).attr("href");
        companyPerson(href);
    });
    
    $("body").on("click",".commu_table3 .pagination li a",function(e) {
        e.preventDefault();
        var href = $(this).attr("href");
        companyPersonCommu(href);
    });
    
    /*
     * Add new Company functionality
     */
    
    $("body").on("click",".add_address_d",function(e) {
        if($(".commu_table1 #add_type_new").length > 0)
        {
            $(".commu_table1 #add_type_new").focus();
            return false;
        }
        set_template(1);
    });
    
    $("body").on("click",".add_person_d",function(e) {
        if($(".commu_table2 #add_surname_new").length > 0)
        {
            $(".commu_table2 #add_surname_new").focus();
            return false;
        }
        set_template(2);
    });
    
    $("body").on("click",".person_commu_d",function(e) {
        if($(".commu_table3 #commu_type_new").length > 0)
        {
            $(".commu_table3 #commu_type_new").focus();
            return false;
        }
        set_template(3);
    });
    
    
    $("body").on("click",".save_other_add",function(e){
        
        var _this = $(this);
        var close_tr = $(this).closest("tr").attr("data-id");
        var add_type = $("#add_type_"+close_tr).val();
        var add_postal = $("#add_postal_"+close_tr).val();
        var add_city = $("#add_city_"+close_tr).val();
        var add_country = $("#add_country_"+close_tr).val();
        var add_street = $("#add_street_"+close_tr).val();
        
        commonfn.doAjax({
            url:HTTP_PATH+'company/saveOtherAdd',
            dataString: "add_type="+add_type+"&add_postal="+add_postal+"&add_city="+add_city+"&add_country="+add_country+"&add_street="+add_street+"&data_id="+close_tr+"&comp_no="+comp_no,
            elem:_this,
            ajaxSuccess:function(data)
            {
                if(data.error)
                {
                    msg_alert(data.error_mess);
                }
                else
                {
                    msg_alert(data.success_mess);
                    companyOtherAdd(add_listing);
                }
            }
        }); 
    });
    
    $("body").on("click",".save_person",function(e){
        var _this = $(this);
        var close_tr = $(this).closest("tr").attr("data-id");
        var add_surname = $("#add_surname_"+close_tr).val();
        var add_name = $("#add_name_"+close_tr).val();
        var add_title = $("#add_title_"+close_tr).val();
        var add_position = $("#add_position_"+close_tr).val();
        commonfn.doAjax({
            url:HTTP_PATH+'company/savePerson',
            dataString: "add_surname="+add_surname+"&add_name="+add_name+"&add_title="+add_title+"&add_position="+add_position+"&data_id="+close_tr+"&comp_no="+comp_no,
            elem:_this,
            ajaxSuccess:function(data)
            {
                if(data.error)
                {
                    msg_alert(data.error_mess);
                }
                else
                {
                    msg_alert(data.success_mess);
                    companyPerson(person_listing);
                }
            }
        }); 
    });
    
    $("body").on("click",".save_person_commu",function(e){
        var _this = $(this);
        var close_tr = $(this).closest("tr").attr("data-id");
        var commu_type = $("#commu_type_"+close_tr).val();
        var commu_value = $("#commu_value_"+close_tr).val();
        commonfn.doAjax({
            url:HTTP_PATH+'company/savePersonCommu',
            dataString: "commu_type="+commu_type+"&commu_value="+commu_value+"&data_id="+close_tr+"&comp_no="+comp_no+"&person_ref_no="+person_ref_no,
            elem:_this,
            ajaxSuccess:function(data)
            {
                if(data.error)
                {
                    msg_alert(data.error_mess);
                }
                else
                {
                    msg_alert(data.success_mess);
                    companyPersonCommu(person_listing,_this);
                }
            }
        }); 
    });
    
    $("body").on("click",".get_person_commu",function(e){
        var _this = $(this);
        person_ref_no = $(this).attr("data-id");
        companyPersonCommu(person_commu_listing,_this);
    });
    
    
    $("body").on("click","#delete_rows_t",function(e){
                    e.preventDefault();
                    var checkval = [];
                    $('.actionsid_t:checkbox:checked').each(function(i){
                        checkval[i] = $(this).val();
                    });
                    if(checkval.length==0)
                    {
                        return false;
                    }
                    var _this = this;
                    bootbox.confirm("Are you sure to delete the selected data?",function(result){
                            if (result == true)
                            {
                                var tab_d = $(_this).attr('href');

                                var url = tab_d;
                                var dataString="checkval="+checkval;
                                commonfn.doAjax({'url':url,'dataString':dataString,'elem':"#delete_rows_t",
                                ajaxSuccess:function(data){
                                    if(data.success)
                                    {
                                        $('.actionsid_t:checkbox:checked').each(function(i){
                                            $(this).closest('tr').remove();
                                        });
                                        $("#checkallitem_t").iCheck('uncheck');
                                        companyPerson(person_listing);
                                    }
                                }});

                            }
                    });

            });
            
    $("body").on("click","#delete_rows_t2",function(e){
                    e.preventDefault();
                    var checkval = [];
                    $('.actionsid_t2:checkbox:checked').each(function(i){
                        checkval[i] = $(this).val();
                    });
                    if(checkval.length==0)
                    {
                        return false;
                    }
                    var _this = this;
                    bootbox.confirm("Are you sure to delete the selected data?",function(result){
                            if (result == true)
                            {
                                var tab_d = $(_this).attr('href');

                                var url = tab_d;
                                var dataString="checkval="+checkval;
                                commonfn.doAjax({'url':url,'dataString':dataString,'elem':"#delete_rows_t2",
                                ajaxSuccess:function(data){
                                    if(data.success)
                                    {
                                        $('.actionsid_t2:checkbox:checked').each(function(i){
                                            $(this).closest('tr').remove();
                                        });
                                        $("#checkallitem_t2").iCheck('uncheck');
                                        companyOtherAdd(add_listing);
                                    }
                                }});

                            }
                    });
            });
            
    $("body").on("click","#delete_rows_t3",function(e){
                    e.preventDefault();
                    var checkval = [];
                    $('.actionsid_t3:checkbox:checked').each(function(i){
                        checkval[i] = $(this).val();
                    });
                    if(checkval.length==0)
                    {
                        return false;
                    }
                    var _this = this;
                    bootbox.confirm("Are you sure to delete the selected data?",function(result){
                            if (result == true)
                            {
                                var tab_d = $(_this).attr('href');

                                var url = tab_d;
                                var dataString="checkval="+checkval;
                                commonfn.doAjax({'url':url,'dataString':dataString,'elem':"#delete_rows_t3",
                                ajaxSuccess:function(data){
                                    if(data.success)
                                    {
                                        $('.actionsid_t3:checkbox:checked').each(function(i){
                                            $(this).closest('tr').remove();
                                        });
                                        $("#checkallitem_t3").iCheck('uncheck');
                                        companyPersonCommu(person_commu_listing);
                                    }
                                }});

                            }
                    });

            });
    
});



function set_template(number)
{
    var template = $("#commu_tab_template"+number).html();
    $(".commu_table"+number+" tbody").append(template);
}


function companyOtherAdd(href)
    {
        commonfn.doAjax({
            url:href,
            dataString: "comp_id="+comp_id,
            container:"#address_tab",
            ajaxSuccess:function(data){
                if(data.success)
                {
                    more_data.check_all_handle2();
                    more_data.check_all_handle();
                }
                else
                if(data.error)
                {
                    bootbox.alert(data.error_mess);
                }
            }
        });
    }
    
function companyPerson(href)
    {
        commonfn.doAjax({
            url:href,
            dataString: "comp_id="+comp_id,
            container:"#person_tab",
            ajaxSuccess:function(data){
                if(data.success)
                {
                    more_data.check_all_handle();
                    more_data.check_all_handle2();
                }
                else
                if(data.error)
                {
                    bootbox.alert(data.error_mess);
                }
            }
        });
    }
function companyPersonCommu(href,elem)
    {
        //$(".nav-tabs-custom li").removeClass('active');
        //$(".nav-tabs-custom li:eq(2)").addClass('active')
        //$(".tab-pane").removeClass('active')
        //$("#person_commu_tt").addClass('active')
        commonfn.doAjax({
            url:HTTP_PATH+'company/getPersonCommu',
            dataString: "comp_no="+comp_no+"&person_ref_no="+person_ref_no,
            container:"#person_commu_tab",
            elem:elem,
            ajaxSuccess:function(data){
                if(data.success)
                {
                    more_data.check_all_handle3();
                }
                else
                if(data.error)
                {
                    bootbox.alert(data.error_mess);
                }
            }
        });
    }


    window.more_data = window.more_data || (function init($, undefined) {
        "use strict";
        var exports={};
        exports.check_sel_opt = function ()
        {
            if($("input.actionsid_t:checked").length == 0)
            {
                $("#delete_rows_t").attr("disabled",'disabled');
            }
            else
            {
                $("#delete_rows_t").removeAttr("disabled");
            }
        }
         exports.check_all_handle = function()
        {
            if(!$.isFunction($.fn.iCheck))
                return;
            $("#checkallitem_t, input.actionsid_t").iCheck({
                checkboxClass: 'icheckbox_square-blue'
            }).attr("autocomplete",'off');

            $("#checkallitem_t").on('ifChecked',function(e) {
                $("input.actionsid_t").each(function() {
                        $(this).iCheck('check');
                });
                exports.check_sel_opt();
            });
            $("#checkallitem_t").on('ifUnchecked',function(e) {
                $("input.actionsid_t").each(function() {
                        $(this).iCheck('uncheck');
                });
                exports.check_sel_opt();
            });

            $("input.actionsid_t").on('ifChecked',function(e) {
                exports.check_sel_opt();
            });
            $("input.actionsid_t").on('ifUnchecked',function(e) {
                $("input.actionsid_t").each(function() {
                    if(!(this.checked))
                    {
                        $("#checkallitem_t").removeAttr("checked");
                    }
                });
                exports.check_sel_opt();
            });
         }
        exports.check_sel_opt2 = function ()
        {
            if($("input.actionsid_t2:checked").length == 0)
            {
                $("#delete_rows_t2").attr("disabled",'disabled');
            }
            else
            {
                $("#delete_rows_t2").removeAttr("disabled");
            }
        }
         exports.check_all_handle2 = function()
        {
            if(!$.isFunction($.fn.iCheck))
                return;
            $("#checkallitem_t2, input.actionsid_t2").iCheck({
                checkboxClass: 'icheckbox_square-blue'
            }).attr("autocomplete",'off');

            $("#checkallitem_t2").on('ifChecked',function(e) {
                $("input.actionsid_t2").each(function() {
                        $(this).iCheck('check');
                });
                exports.check_sel_opt2();
            });
            $("#checkallitem_t2").on('ifUnchecked',function(e) {
                $("input.actionsid_t2").each(function() {
                        $(this).iCheck('uncheck');
                });
                exports.check_sel_opt2();
            });

            $("input.actionsid_t2").on('ifChecked',function(e) {
                exports.check_sel_opt2();
            });
            $("input.actionsid_t2").on('ifUnchecked',function(e) {
                $("input.actionsid_t2").each(function() {
                    if(!(this.checked))
                    {
                        $("#checkallitem_t2").removeAttr("checked");
                    }
                });
                exports.check_sel_opt2();
            });
         }
        exports.check_sel_opt3 = function ()
        {
            if($("input.actionsid_t3:checked").length == 0)
            {
                $("#delete_rows_t3").attr("disabled",'disabled');
            }
            else
            {
                $("#delete_rows_t3").removeAttr("disabled");
            }
        }
         exports.check_all_handle3 = function()
        {
            if(!$.isFunction($.fn.iCheck))
                return;
            $("#checkallitem_t3, input.actionsid_t3").iCheck({
                checkboxClass: 'icheckbox_square-blue'
            }).attr("autocomplete",'off');

            $("#checkallitem_t3").on('ifChecked',function(e) {
                $("input.actionsid_t3").each(function() {
                        $(this).iCheck('check');
                });
                exports.check_sel_opt3();
            });
            $("#checkallitem_t3").on('ifUnchecked',function(e) {
                $("input.actionsid_t3").each(function() {
                        $(this).iCheck('uncheck');
                });
                exports.check_sel_opt3();
            });

            $("input.actionsid_t3").on('ifChecked',function(e) {
                exports.check_sel_opt3();
            });
            $("input.actionsid_t3").on('ifUnchecked',function(e) {
                $("input.actionsid_t3").each(function() {
                    if(!(this.checked))
                    {
                        $("#checkallitem_t3").removeAttr("checked");
                    }
                });
                exports.check_sel_opt3();
            });
         }

             
         exports.init = function(_$) {
            window.more_data = init(_$ || $);
        };
        exports.check_all_handle();
        exports.check_sel_opt();
        exports.check_all_handle2();
        exports.check_sel_opt2();
        exports.check_all_handle3();
        exports.check_sel_opt3();
        return exports;
    }(window.jQuery));