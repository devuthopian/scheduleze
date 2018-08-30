
//jQuery time
var current_fs, next_fs, previous_fs; //fieldsets
var left, opacity, scale; //fieldset properties which we will animate
var animating; //flag to prevent quick multi-click glitches

$(".next").click(function(){
	if($('.active').html() == 'Business Details'){
		if($('#contact_firstname').val() == ''){
			$('.contact_firstname').show();
			return false;
		}else{
			$('.contact_firstname').hide();
		}

		if($('#contact_lastname').val() == ''){
			$('.contact_lastname').show();
			return false;
		}else{
			$('.contact_lastname').hide();
		}

		if($('#business_city').val() == ''){
			$('.business_city').show();
			return false;
		}else{
			$('.business_city').hide();
		}

		if($('#business_state').val() == ''){
			$('.business_state').show();
			return false;
		}else{
			$('.business_state').hide();
		}

		if($('#business_zip').val() == ''){
			$('.business_zip').show();
			return false;
		}else{
			$('.business_zip').hide();
		}

		if($('#business_phone').val() == ''){
			$('.business_phone').show();
			return false;
		}else{
			//var phone_pattern = '/([0-9]{10})|(\([0-9]{3}\)\s+[0-9]{3}\-[0-9]{4})/'; 
			var phone_pattern = '[0-9\-\(\)\s]+';
			var input_value = $('#business_phone').val();

			if(phone_pattern.test( input_value )){
				$('.business_phone').hide();
			}else{
				$('.business_phone').show();
				return false;
			}
		}
	}

	if($('.current').html() == 'Additional Information'){
		if($('#additional_phone').val() == ''){
			$('.additional_phone').show();
			return false;
		}else{
			$('.additional_phone').hide();
		}

		if($('#timezone').val() == ''){
			$('.timezone').show();
			return false;
		}else{
			$('.timezone').hide();
		}

		if($('#business_website').val() == ''){
			$('.business_website').show();
			return false;
		}else{
			$('.business_website').hide();
		}

		if($('#requested_email').val() == ''){
			$('.requested_email').show();
			return false;
		}else{
			$('.requested_email').hide();
		}
	}

	if($('.current').html() == 'Account Setup'){
		if($('#Username').val() == ''){
			$('.Username').show();
			return false;
		}else{
			$('.Username').hide();
		}

		if($('#pass').val() == ''){
			$('.pass').show();
			return false;
		}else{
			$('.pass').hide();
		}

		if($('#cpass').val() == ''){
			$('.cpass').show();
			return false;
		}else{
			$('.cpass').hide();
		}
	}
	

	if(animating) return false;
	animating = true;
	
	current_fs = $(this).parent();
	next_fs = $(this).parent().next();
	
	//activate next step on progressbar using the index of next_fs
	$("#progressbar li").eq($("fieldset").index(current_fs)).addClass("active");
	$("#progressbar li").eq($("fieldset").index(current_fs)).removeClass('current');
	$("#progressbar li").eq($("fieldset").index(next_fs)).addClass("active current");
	
	//show the next fieldset
	next_fs.show(); 
	//hide the current fieldset with style
	current_fs.animate({opacity: 0}, {
		step: function(now, mx) {
			//as the opacity of current_fs reduces to 0 - stored in "now"
			//1. scale current_fs down to 80%
			scale = 1 - (1 - now) * 0.2;
			//2. bring next_fs from the right(50%)
			left = (now * 50)+"%";
			//3. increase opacity of next_fs to 1 as it moves in
			opacity = 1 - now;
			current_fs.css({
        'transform': 'scale('+scale+')',
        'position': 'absolute'
      });
			next_fs.css({'left': left, 'opacity': opacity});
		}, 
		duration: 800, 
		complete: function(){
			current_fs.hide();
			animating = false;
		}, 
		//this comes from the custom easing plugin
		easing: 'easeInOutBack'
	});
});

$(".previous").click(function(){
	if(animating) return false;
	animating = true;
	
	current_fs = $(this).parent();
	previous_fs = $(this).parent().prev();
	
	//de-activate current step on progressbar
	$("#progressbar li").eq($("fieldset").index(current_fs)).removeClass("active");
	$("#progressbar li").eq($("fieldset").index(current_fs)).removeClass("current");
	$(".has-error").hide();
	
	//show the previous fieldset
	previous_fs.show(); 
	//hide the current fieldset with style
	current_fs.animate({opacity: 0}, {
		step: function(now, mx) {
			//as the opacity of current_fs reduces to 0 - stored in "now"
			//1. scale previous_fs from 80% to 100%
			scale = 0.8 + (1 - now) * 0.2;
			//2. take current_fs to the right(50%) - from 0%
			left = ((1-now) * 50)+"%";
			//3. increase opacity of previous_fs to 1 as it moves in
			opacity = 1 - now;
			current_fs.css({'left': left});
			previous_fs.css({'transform': 'scale('+scale+')', 'opacity': opacity});
		}, 
		duration: 800, 
		complete: function(){
			current_fs.hide();
			animating = false;
		}, 
		//this comes from the custom easing plugin
		easing: 'easeInOutBack'
	});
});

$(".submit").click(function(e){
	var password = $("#pass").val();
    var confirmPassword = $("#cpass").val();
    if (password != confirmPassword) {
    	e.preventDefault();
    	$('.cpass').show();
        //alert("Passwords do not match.");
        return false;
    }else{
    	$('.cpass').hide();
    }
    return true;
});