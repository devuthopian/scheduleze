<script src="{{ asset('js/jquery.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/datepicker.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/datepicker.en.js') }}"></script>
<link rel="stylesheet" type="text/css" href="{{ asset('css/datepicker.css') }}">

@if(!empty($template))
<div class="container">
	<div class="row">
		{!! $template->gjs_html !!}
	</div>
</div>
	<style type="text/css">
		{!! $template->gjs_css !!}
	</style>
@else
	<p>Nothing to show!</p>
@endif

<script type="text/javascript">
	$(document).ready(function() {

		// Create start date
	    var start = new Date(),
	        prevDay,
	        startHours = 9;

	    // 09:00 AM
	    start.setHours(9);
	    start.setMinutes(0);

	    // If today is Saturday or Sunday set 10:00 AM
	    if ([6, 0].indexOf(start.getDay()) != -1) {
	        start.setHours(10);
	        startHours = 10
	    }

	    $('#timepicker-actions').datepicker({
	        timepicker: false,
	        language: 'en',
	        startDate: start,
	        minHours: startHours,
	        maxHours: 18,
	        dateFormat: 'mm/dd/yyyy',
	        timeFormat: 'hh:ii aa',
	        clearButton: true,
	        onSelect: function (fd, d, picker) {
	            // Do nothing if selection was cleared
	            if (!d) return;

	            var day = d.getDay();

	            // Trigger only if date is changed
	            if (prevDay != undefined && prevDay == day) return;
	            prevDay = day;

	            // If chosen day is Saturday or Sunday when set
	            // hour value for weekends, else restore defaults
	            if (day == 6 || day == 0) {
	                picker.update({
	                    minHours: 10,
	                    maxHours: 16
	                })
	            } else {
	                picker.update({
	                    minHours: 9,
	                    maxHours: 18
	                })
	            }
	        }
	    });
	});
</script>


	<link rel="stylesheet" href="https://kendo.cdn.telerik.com/2018.2.620/styles/kendo.common-material.min.css" />
	<link rel="stylesheet" href="https://kendo.cdn.telerik.com/2018.2.620/styles/kendo.material.min.css" />
	<link rel="stylesheet" href="https://kendo.cdn.telerik.com/2018.2.620/styles/kendo.material.mobile.min.css" />

	<script src="https://kendo.cdn.telerik.com/2018.2.620/js/kendo.all.min.js"></script>
	<script type="text/javascript">
		$(document).ready(function() {
			if($('#timepicker-actions').length){
		    	$('<span>').html('<h4>Start time</h4><input id="start" name="txtStart" value="8:00 AM" /><h4 style="margin-top: 2em;">End time</h4><input id="end" name="txtEnd" value="8:30 AM" />').insertAfter('#timepicker-actions');
			}

	        function startChange() {
	            var startTime = start.value();

	            if (startTime) {
	                startTime = new Date(startTime);

	                end.max(startTime);

	                startTime.setMinutes(startTime.getMinutes() + this.options.interval);

	                end.min(startTime);
	                end.value(startTime);
	            }
	        }

	        //init start timepicker
	        var start = $("#start").kendoTimePicker({
	            change: startChange
	        }).data("kendoTimePicker");

	        //init end timepicker
	        var end = $("#end").kendoTimePicker().data("kendoTimePicker");

	        //define min/max range
	        start.min("8:00 AM");
	        start.max("6:00 PM");

	        //define min/max range
	        end.min("8:00 AM");
	        end.max("7:30 AM");
	  
			$('<input>').attr({
			    type: 'hidden',
			    id: 'foo',
			    name: 'txtId',
			    value: '{{ $template->user_id }}'
			}).appendTo('form');
		});
	</script>
<style type="text/css">
	label{
		color: black !Important;
	}
</style>