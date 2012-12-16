$(document).ready(function()
{
	$('#next_month').click(function(e)
	{
		hideBubble();
		
		e.preventDefault();
		var year = parseInt($('#current_year').val());
		var month = parseInt($('#current_month').val());
		
		month += 1;
		
		if(month == 13)
		{
			month = 1;
			year += 1;
		}

		$.get("/admin/ajax/agenda_months.php", { 'year': year, 'month': month },
		function(result)
		{
			var json = $.parseJSON(result);

			$('#ag-container').html(json.data);
			
			$('#current_month').val(month);
			$('#current_year').val(year);
			$('#current_date').html(json.month_name + ' ' + year);
		});
	});
	
	$('#previous_month').click(function(e)
	{
		hideBubble();
		
		e.preventDefault();
		var year = parseInt($('#current_year').val());
		var month = parseInt($('#current_month').val());
		
		month -= 1;
		
		if(month == 0)
		{
			month = 12;
			year -= 1;
		}

		$.get("/admin/ajax/agenda_months.php", { 'year': year, 'month': month },
		function(result)
		{
			var json = $.parseJSON(result);

			$('#ag-container').html(json.data);
			
			$('#current_month').val(month);
			$('#current_year').val(year);
			$('#current_date').html(json.month_name + ' ' + year);
		});
	});
	
	$('.ag-day').live('click', function(e)
	{
		if($(this).hasClass('active'))
		{
			hideBubble();
		}
		else {
			hideBubble();
			
			var clicked_block = $(this);
			var parent = $(this).parents('.ag-month-row');
			
			var current_month = clicked_block.children('.ag-date-month').val();
			var current_year = clicked_block.children('.ag-date-year').val();
			var current_day = clicked_block.children('.ag-date-day').val();
			var selected_date = current_year + '-' + current_month + '-' + current_day;
			var display_date = clicked_block.children('.ag-date-display').val();
			
			$('#bubble-main #selected-date-value').val(selected_date);
			$('#bubble-main #selected-date').html(display_date);
			
			showBubble('#bubble-main', clicked_block, parent, false);
			$('#bubble-what').focus();
		}
	});
	
	$('#make-appointment').click(function()
	{
		var appointment_name = $('#bubble-what').val()
		if(appointment_name == '')
		{
			alert('U heeft geen titel opgegeven');
		}
		else {
			date = $('#selected-date-value').val();
			$.post("/admin/ajax/save_appointment.php", { 'option': 'add_apointment', 'name': appointment_name, 'date': date },
				function(data) 
				{
					if(data == 'true')
					{
						refreshMonth();
					}
				}
			);
		}
	});
	
	function refreshMonth()
	{
		hideBubble();
		
		var year = parseInt($('#current_year').val());
		var month = parseInt($('#current_month').val());

		$.get("/admin/ajax/agenda_months.php", { 'year': year, 'month': month },
		function(result)
		{
			var json = $.parseJSON(result);

			$('#ag-container').html(json.data);
		});
	}
	
	function hideBubble()
	{
		$('.active').each(function(){
			$(this).removeClass('active');
		});

		$('#bubble-main').hide();
		$('#bubble-what').val('');
		
		$('#bubble-edit-appointment').hide();
	}
	
	function showBubble(id, clicked_block, parent, appointment)
	{
		hideBubble();

		
		var top = parent.position().top - 35;
		var left = clicked_block.position().left - 30;
		var window_width = $(window).width();
		var bubble_width = $(id).width();
		
		if(left < 0)
		{
			left -= (left - 5);
		}

		if((left + bubble_width) > window_width)
		{
			new_left = (left + bubble_width) - window_width;
			left -= (new_left + 20);
		}
		
		if(appointment)
		{
			top -= 15;
			clicked_block.children('.ag-day-appointment').addClass('active');
		}
		else {
			clicked_block.addClass('active');
		}
		
		$(id).show();
		$(id).css({
			'left' : left + 'px',
			'top' : top + 'px'
	    });
	}
	
	$('.ag-day-appointment').live('click', function(e)
	{
		e.stopPropagation();
		if($(this).hasClass('active'))
		{
			hideBubble();
		}
		else {
			hideBubble();
			var clicked_block = $(this).parent();
			var parent = $(this).parents('.ag-month-row');
			var date = clicked_block.children('.ag-date-display').val();
			
			$('#appointment-date').html(date);
			$('#appointment-name').html($(this).children('.ag-appointment-name').val());
			$('#appointment-id').val($(this).children('.ag-appointment-id').val());
			
			showBubble('#bubble-edit-appointment', clicked_block, parent, true);
		}
	});
	
	$('#delete-appointment').live('click', function()
	{
		var id = $('#appointment-id').val();
		$.post("/admin/ajax/delete_appointment.php", { 'option': 'delete_apointment', 'id': id},
			function(data) 
			{
				if(data == 'true')
				{
					refreshMonth();
				}
			}
		);
	});
	
	
});