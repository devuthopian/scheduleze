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
   
        var rowCount = $('.txtBuildId tr').length;
        var actualstate = rowCount + 1;
        $('.txtBuildId').append("<tr class='trtable_"+actualstate+"'><td><input type='text' name='desc["+actualstate+"]' size='32' value=''></td><td><select name='buffer["+actualstate+"]' class='small_select'><option value='0'>0 min</option><option value='900'>15 min</option><option value='1800'>30 min</option><option value='2700'>45 min</option><option value='3600'>60 min</option><option value='4500'>75 min</option><option value='5400'>90 min</option><option value='6300'>1.75 hrs</option><option value='7200'>2 hrs</option><option value='8100'>2.25 hrs</option><option value='9000'>2.5 hrs</option><option value='9900'>2.75 hrs</option><option value='10800'>3 hrs</option><option value='11700'>3.25 hrs</option><option value='12600'>3.5 hrs</option><option value='13500'>3.75 hrs</option><option value='14400'>4 hrs</option><option value='15300'>4.25 hrs</option><option value='16200'>4.5 hrs</option><option value='17100'>4.75 hrs</option><option value='18000'>5 hrs</option><option value='18900'>5.25 hrs</option><option value='19800'>5.5 hrs</option><option value='20700'>5.75 hrs</option><option value='21600'>6 hrs</option><option value='22500'>6.25 hrs</option><option value='23400'>6.5 hrs</option><option value='24300'>6.75 hrs</option><option value='25200'>7 hrs</option><option value='26100'>7.25 hrs</option><option value='27000'>7.5 hrs</option><option value='27900'>7.75 hrs</option><option value='28800'>8 hrs</option><option value='29700'>8.25 hrs</option><option value='30600'>8.5 hrs</option><option value='31500'>8.75 hrs</option><option value='32400'>9 hrs</option></select></td><td><input type='text' name='price["+actualstate+"]' value='$' size='5'></td><td align='center'><input type='text' name='rank["+actualstate+"]' value='' size='3'><input type='radio' value='0' name='selected'></td><td><select name='forcecall["+actualstate+"]' size='1'><option value='1' selected=''>Book using size/age</option><option value='2'>Book as standalone</option><option value='0'>Require phone call</option><option value='3'>Use as Label</option></select></td><td><a href='#' class='note_link' id="+actualstate+">Remove</a></td></tr>");
    });

   $("body").on('click', '.note_link', function(event) {
        /* Act on the event */
        var getid = $(this).attr('id');
        $('.trtable_'+getid).remove();
    });
});