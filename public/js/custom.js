$(document).ready(function() {
    var list = $("nav>ul li > a"); //Liste de tout les liens
    //Gestion du clique sur le boutton des trois bars afin d'afficher le menu dans les support avec un width <769
    $("nav > a").click(function(event){
        $("nav>ul").slideToggle();
    });
    //Gestion des cliques sur les liens avec Ã©limination du comportement par dÃ©faut du a dans le cas oÃ¹ il existe un sous menu
    list.click(function (event) {
        var submenu = this.parentNode.getElementsByTagName("ul").item(0);
        //S'il existe un sous menu sinon c'est un lien terminal
        if(submenu!=null){
            event.preventDefault();
            $(submenu).slideToggle();
        }
    });
    //Gestion du resize de la fenetre pour eliminer le style ajoutÃ© par la mÃ©thode .slideToggle()
    $(window).resize(function () {
        if ($(window).width() > 1024) {
            $("nav > ul, nav > ul  li  ul").removeAttr("style");
        }
    });

    $("body").on('click', '#add_column', function(event) {
        //event.preventDefault();
   
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
        $.each( nuid, function( key, value ) {
            html.push("<option value='"+value.id+"' data-in='"+value.administrator+"'>"+value.name+"</option>");
        });

        if(document.location.href.match(/[^\/]+$/)[0] == 'Addons' || document.location.href.match(/[^\/]+$/)[0] == 'Addons#'){
            var selecthtml = "<select name='forcecall["+actualstate+"]' class='selectpicker form-control' size='1'><option value='0'>Book on-line</option><option value='1'>Require phone call</option></select>";
        }
        else{
            var selecthtml = "<select name='forcecall["+actualstate+"]' class='selectpicker form-control' size='1'><option value='1' selected=''>Book using size/age</option><option value='2'>Book as standalone</option><option value='0'>Require phone call</option><option value='3'>Use as Label</option></select>";
        }


        $('.txtBuildId').append("<tr class='trtable_"+actualstate+"'><td><input type='text' class='form-control' name='desc["+actualstate+"]' size='32' value=''><input type='hidden' name='id["+actualstate+"]' value='0'></td><td><select name='buffer["+actualstate+"]' class='small_select selectpicker form-control'><option value='0'>0 min</option><option value='900'>15 min</option><option value='1800'>30 min</option><option value='2700'>45 min</option><option value='3600'>60 min</option><option value='4500'>75 min</option><option value='5400'>90 min</option><option value='6300'>1.75 hrs</option><option value='7200'>2 hrs</option><option value='8100'>2.25 hrs</option><option value='9000'>2.5 hrs</option><option value='9900'>2.75 hrs</option><option value='10800'>3 hrs</option><option value='11700'>3.25 hrs</option><option value='12600'>3.5 hrs</option><option value='13500'>3.75 hrs</option><option value='14400'>4 hrs</option><option value='15300'>4.25 hrs</option><option value='16200'>4.5 hrs</option><option value='17100'>4.75 hrs</option><option value='18000'>5 hrs</option><option value='18900'>5.25 hrs</option><option value='19800'>5.5 hrs</option><option value='20700'>5.75 hrs</option><option value='21600'>6 hrs</option><option value='22500'>6.25 hrs</option><option value='23400'>6.5 hrs</option><option value='24300'>6.75 hrs</option><option value='25200'>7 hrs</option><option value='26100'>7.25 hrs</option><option value='27000'>7.5 hrs</option><option value='27900'>7.75 hrs</option><option value='28800'>8 hrs</option><option value='29700'>8.25 hrs</option><option value='30600'>8.5 hrs</option><option value='31500'>8.75 hrs</option><option value='32400'>9 hrs</option></select></td><td><input type='text' class='form-control' name='price["+actualstate+"]' value='' size='5' required></td><td align='center'><input type='text' name='rank["+actualstate+"]' value='' class='form-control' size='3' required></td><td class='radiocolumn'><input type='radio' value='"+actualstate+"' name='selected[0]'></td><td>"+selecthtml+"</td><td><select name='selectedusers["+actualstate+"][]' class='form-control newcol selectedbs my_select_"+actualstate+"' size='1' multiple style='display:none;' data-main-id='"+actualstate+"'><option value='' disabled></option>"+html+"</select></td><td><a href='#' class='note_link' id='"+actualstate+"'>Remove</a></td></tr>");
    });


    $("body").on('click', '#add_columnfor_location', function(event) {
        //event.preventDefault();
        var rowCount = $('.txtlocationId tr').length;
        var actualstate = rowCount;
        $('.txtlocationId').append("<tr class='trtable_"+actualstate+"'><input type='hidden' name='id["+actualstate+"]' value='0'><td><input type='text' class='form-control' name='name["+actualstate+"]' value='' size='5' required></td><td align='center'><input type='text' class='form-control' name='price["+actualstate+"]' value='0' size='3' required> </td><td><a href='#' class='note_link' data-id='0' id="+actualstate+">Remove</a></td></tr>");
    });

   $("body").on('click', '.note_link', function(event) {
        /* Act on the event */ 
        var getid = $(this).attr('id');
        var dataid = $(this).attr('data-id');
        var datamodel = $(this).attr('data-model');
        $('.trtable_'+getid).remove();

        if(dataid > 0){
            var location = window.location.protocol + "//" + window.location.host + "/";
            $.ajax({
                url : location + 'ajaxrequest',
                method : "POST",
                data : {id:dataid, _token: $('meta[name="csrf-token"]').attr('content'), table: datamodel},
                dataType : "JSON",
                beforeSend: function() {
                    $('.load').show();
                },
                success:function(data){
                    $("#showtxt").html(data.msg);
                    $('.load').fadeOut(1000);
                }
            });
        }
    });

   $("ul").children().html()

   if($('.thin').children().html() == '<b>tawk.to</b>'){
        $('.thin').children().html('<b>Scheduleze</b>');
   }

    $('.columnaddons').click(function(event) {
        /* Act on the event */
        setTimeout(function(){
            $('.radiocolumn').remove();
        }, 500);
    });
});

$(window).on('load', function(){
    $('.loader').fadeOut(1000);
});