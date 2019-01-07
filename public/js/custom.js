$(document).ready(function () {

    // ..not working in iphone, mobile issue(so it is commented) vue.js
    /*if(document.getElementById("app")){
        new Vue({
            el: '#app',

            methods: {
                doSomething() {
                    $("nav>ul").slideToggle();
                },
                doSomethinginmenu: function(event) {               
                    var submenu = event.path[1].childNodes[2];
                    if (submenu != null) {

                        event.preventDefault();

                        $(submenu).slideToggle();

                    }
                }
            }
        });
    }*/

    // ..working everywhere so uncommented here
    var list = $("nav>ul li > a");

    $("nav > a").click(function(event){
        $("nav>ul").slideToggle();
    });

    list.click(function (event) {
        var submenu = this.parentNode.getElementsByTagName("ul").item(0);
        if(submenu!=null){
            event.preventDefault();
            $(submenu).slideToggle();
        }
    });

    $("#accountInfoBusiness").modal('show');

    $("#phone").keyup(function() {
        var curchr = this.value.length;
        var curval = $(this).val();
        if (curchr == 3) {
            $("#phone").val("(" + curval + ")" + "-");
        } else if (curchr == 9) {
            $("#phone").val(curval + "-");
        }
    });

    $("#phone2").keyup(function() {
        var curchr = this.value.length;
        var curval = $(this).val();
        if (curchr == 3) {
            $("#phone2").val("(" + curval + ")" + "-");
        } else if (curchr == 9) {
            $("#phone2").val(curval + "-");
        }
    });

    /*$('body').on('click', '.finalSubmit', function(event) {
        event.preventDefault();
    });

    $('body').on('click', '.accountInfo', function(event) {
        event.preventDefault();
        //document.getElementById("msform").submit();
        $('.action-button').attr('data-target', '');
        $('.action-button').removeClass('finalSubmit');
        //$('#msform').submit();
        $('.action-button').trigger('click');
    });*/


    $(window).resize(function () {

        if ($(window).width() > 1024) {

            $("nav > ul, nav > ul  li  ul").removeAttr("style");

        }

    });

    $("body").on('click', '#add_column', function (event) {

        event.preventDefault();



        //var rowCount = $('.txtBuildId tr').length;

        //var rowCount = $('#buildId').val() + 1;

        //if(rowCount == ''){

        var rowCount = $('.txtBuildId tr').length;

        //}



        var actualstate = rowCount;



        var nameuserid = $('#txtypol').val();



        var nuid = jQuery.parseJSON(nameuserid);

        console.log(nuid);



        var html = [];

        $.each(nuid, function (key, value) {

            html.push("<option value='" + value.id + "' data-in='" + value.administrator + "'>" + value.name + "</option>");

        });



        if (document.location.href.match(/[^\/]+$/)[0] == 'Addons' || document.location.href.match(/[^\/]+$/)[0] == 'Addons#') {

            var selecthtml = "<select name='forcecall[" + actualstate + "]' class='selectpicker form-control' size='1'><option value='0'>Book on-line</option><option value='1'>Require phone call</option></select>";

        } else if(document.location.href.match(/[^\/]+$/)[0] == 'Sizes' || document.location.href.match(/[^\/]+$/)[0] == 'Sizes#') {
            var selecthtml = "<select name='forcecall[" + actualstate + "]' class='selectpicker form-control' size='1'><option value='1'>Book on-line</option><option value='0'>Require phone call</option><option value='3'>Use as Label Box</option></select>";
        } else {

            var selecthtml = "<select name='forcecall[" + actualstate + "]' class='selectpicker form-control' size='1'><option value='3' selected=''>Use to Label Box</option><option value='2'>Standalone Service Type</option><option value='1'>Use with 2nd/3rd Modifiers</option><option value='0'>Require phone call</option></select>";

        }



        /*<td class='radiocolumn'><input type='radio' value='"+actualstate+"' name='selected[0]'></td>*/



        $('.txtBuildId').append("<tr class='trtable_" + actualstate + "'><td><input type='text' class='form-control' name='desc[" + actualstate + "]' size='32' value=''><input type='hidden' name='id[" + actualstate + "]' value='0'></td><td><select name='buffer[" + actualstate + "]' class='small_select selectpicker form-control'><option value='0'>0 min</option><option value='900'>15 min</option><option value='1800'>30 min</option><option value='2700'>45 min</option><option value='3600'>60 min</option><option value='4500'>75 min</option><option value='5400'>90 min</option><option value='6300'>1.75 hrs</option><option value='7200'>2 hrs</option><option value='8100'>2.25 hrs</option><option value='9000'>2.5 hrs</option><option value='9900'>2.75 hrs</option><option value='10800'>3 hrs</option><option value='11700'>3.25 hrs</option><option value='12600'>3.5 hrs</option><option value='13500'>3.75 hrs</option><option value='14400'>4 hrs</option><option value='15300'>4.25 hrs</option><option value='16200'>4.5 hrs</option><option value='17100'>4.75 hrs</option><option value='18000'>5 hrs</option><option value='18900'>5.25 hrs</option><option value='19800'>5.5 hrs</option><option value='20700'>5.75 hrs</option><option value='21600'>6 hrs</option><option value='22500'>6.25 hrs</option><option value='23400'>6.5 hrs</option><option value='24300'>6.75 hrs</option><option value='25200'>7 hrs</option><option value='26100'>7.25 hrs</option><option value='27000'>7.5 hrs</option><option value='27900'>7.75 hrs</option><option value='28800'>8 hrs</option><option value='29700'>8.25 hrs</option><option value='30600'>8.5 hrs</option><option value='31500'>8.75 hrs</option><option value='32400'>9 hrs</option></select></td><td><input type='text' class='form-control' name='price[" + actualstate + "]' value='' size='5' required></td><td align='center'><input type='text' name='rank[" + actualstate + "]' value='' class='form-control' size='3' required></td><td>" + selecthtml + "</td><td><select name='selectedusers[" + actualstate + "][]' class='form-control newcol selectedbs my_select_" + actualstate + "' size='1' multiple style='display:none;' data-main-id='" + actualstate + "'><option value='' disabled></option>" + html + "</select></td><td><a href='#' class='note_link' id='" + actualstate + "'>Remove</a></td></tr>");

    });

    if(document.getElementById("adminlocation")){
        new Vue({
            el: '#adminlocation',
            methods: {
                addcolumnlocation: function(event) {
                    event.preventDefault();
                    var rowCount = $('.txtlocationId tr').length;

                    var actualstate = rowCount;

                    $('.txtlocationId').append("<tr class='trtable_" + actualstate + "'><input type='hidden' name='id[" + actualstate + "]' value='0'><td><input type='text' class='form-control' name='name[" + actualstate + "]' value='' size='5' required></td><td align='center'><input type='text' class='form-control' name='price[" + actualstate + "]' value='0' size='3' required> </td><td><a href='#' class='note_link' data-id='0' id=" + actualstate + ">Remove</a></td></tr>");
                }
            }
        });
    }

    if(document.getElementById("adminIndustries")){
        new Vue({
            el: '#adminIndustries',
            methods: {
                addIndustryColumn: function(event) {
                    event.preventDefault();
                    var rowCount = $('.txtIndustriesId tr').length;

                    var actualstate = rowCount;

                    $('.txtIndustriesId').append("<tr class='trtable_" + actualstate + "'><input type='hidden' name='id[" + actualstate + "]' value='0'><td><input type='text' class='form-control' name='name[" + actualstate + "]' value='' size='5' required></td><td><input type='text' class='form-control' name='business[" + actualstate + "]' value='' size='5' required></td><td><input type='text' class='form-control' name='type_label[" + actualstate + "]' value='' size='5' required></td><td><input type='text' class='form-control' name='size_label[" + actualstate + "]' value='' size='5' required></td><td><input type='text' class='form-control' name='age_label[" + actualstate + "]' value='' size='5' required></td><td><input type='text' class='form-control' name='addon_label[" + actualstate + "]' value='' size='5' required></td><td><a href='#' class='note_link' data-id='0' id=" + actualstate + ">Remove</a></td></tr>");
                }
            }
        });
    }


    /*$("body").on('click', '#add_columnfor_location', function (event) {

        //event.preventDefault();

        var rowCount = $('.txtlocationId tr').length;

        var actualstate = rowCount;

        $('.txtlocationId').append("<tr class='trtable_" + actualstate + "'><input type='hidden' name='id[" + actualstate + "]' value='0'><td><input type='text' class='form-control' name='name[" + actualstate + "]' value='' size='5' required></td><td align='center'><input type='text' class='form-control' name='price[" + actualstate + "]' value='0' size='3' required> </td><td><a href='#' class='note_link' data-id='0' id=" + actualstate + ">Remove</a></td></tr>");

    });*/

    $("body").on('click', '.appointmentPage', function (event) {
        var fullText = $(this).attr('full-text');
        return confirm(fullText+'?');
    });



    $("body").on('click', '.note_link', function (event) {

        var result = confirm("Want to delete?");
        if (result) {

            /* Act on the event */

            var getid = $(this).attr('id');

            var dataid = $(this).attr('data-id');

            var datamodel = $(this).attr('data-model');

            $('.trtable_' + getid).remove();



            if (dataid > 0) {

                //var location = window.location.protocol + "//" + window.location.host + "/";
                /*$serverName = $_SERVER['SERVER_NAME'];
                var location = "http://$serverName/";*/

                Vue.http.post('/ajaxrequest', {id: dataid, _token: $('meta[name="csrf-token"]').attr('content'), table: datamodel, dataType: "JSON"}).then(response => {
                    // get status
                    $("#showtxt").html(response.msg);
                    $('.submit').trigger('click');
                });

                /*$.ajax({

                    url: location + 'ajaxrequest',

                    method: "POST",

                    data: {id: dataid, _token: $('meta[name="csrf-token"]').attr('content'), table: datamodel},

                    dataType: "JSON",

                    beforeSend: function () {

                        $('.load').show();

                    },

                    success: function (data) {

                        $("#showtxt").html(data.msg);

                        $('.load').fadeOut(1000);

                        $('.submit').trigger('click');

                    }

                });*/

            }
        }

    });







    //$("ul").children().html()



    /*if($('.thin').children().html() == '<b>tawk.to</b>'){
     
     $('.thin').children().html('<b>Scheduleze</b>');
     
     }*/



    $('.columnaddons').click(function (event) {

        /* Act on the event */

        setTimeout(function () {

            $('.radiocolumn').remove();

        }, 500);

    });





    $('#faq-box')

            .on('show.bs.collapse', function (e) {

                $.post('/faq/question/' + $(e.target).attr('data-id'));



                $(e.target).parents('.card').addClass('card-info');

            })

            .on('hide.bs.collapse', function (e) {

                $(e.target).parents('.card').removeClass('card-info');

            });



    $('.btn-helpful').on('click', function (e) {

        e.preventDefault();

        //alert('opsda');



        // show spinner

        var $footer = $('#faq-footer-' + $(this).attr('data-id'));

        $footer.html("<i class=\"fa fa-spinner fa-spin text-primary text-sm\"></i>");



        // post and show response

        $.ajax({

            url: '/faq/question/' + $(this).attr('data-id') + '/' + $(this).attr('data-type'),

            method: "POST",

            data: {_token: $('meta[name="csrf-token"]').attr('content')},

            dataType: "JSON",

            success: function (data) {

                $footer.html("<div><small><span class=\"text-muted\">Thank you for your feedback.</span></small></div>");

            }

        });

        /*$.post('/faq/question/' + $(this).attr('data-id') + '/' + $(this).attr('data-type'), function () {
         
         $footer.html("<div><small><span class=\"text-muted\">Thank you for your feedback.</span></small></div>");
         
         });*/

        return false;

    });

    /*if(document.getElementById("agreementform")){
        new Vue({
            el: '#agreementform',
            methods: {
                clickagreementcheck: function(event) {
                    if (event.target.checked){
                        $('.cls-agree-btn').removeAttr('disabled');
                    }else{
                        $('.cls-agree-btn').attr('disabled', 'disabled');
                    }           
                }
            }
        });
    }*/

    /*$('#agree_term').on('click', function () {
        if (this.checked) {
            $('.cls-agree-btn').removeAttr('disabled');
        } else {
            $('.cls-agree-btn').attr('disabled', 'disabled');
        }
    });*/

    $('.phoneValid').hide();
    $('#business_phone').on('input', function() {
        $('.phoneValid').show();
    });

    $('.confirmedPassword').hide();
    $('#cpass').on('input', function() {
        $('.confirmedPassword').show();
    });
});



$(window).on('load', function () {

    $('.loader').fadeOut(1000);

});

$(window).scroll(function() {    



    var scroll = $(window).scrollTop();

    if (scroll >= 100) {
        $(".header_section").addClass("darkHeader");
    } else {
        $(".header_section").removeClass("darkHeader");
    }
});


/*if(document.getElementById("signup")){
    Vue.use(VeeValidate);
    new Vue({
        el: '#signup',
        data: {
            form : {
                txtIndustries: '',
                email: '',
                txtUserName: ''
            }
        }
    });
}*/