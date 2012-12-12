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
			//alert("Data Loaded: " + data);
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
			
			$(this).addClass('active');
			var clicked_block = $(this);
			var parent = $(this).parents('.ag-month-row');
			
			var top = parent.position().top - 35;
			var left = clicked_block.position().left - 30;
			
			var date = clicked_block.children('.ag-date').val();

			$('#bubble-main #selected-date').html(date);
			
			$('#bubble-main').show();
			$('#bubble-main').css({
				'left' : left + 'px',
				'top' : top + 'px'
		    });
		}
		
	});
	
	function hideBubble()
	{
		$('.active').each(function(){
			$(this).removeClass('active');
		});

		$('#bubble-main').hide();
	}
});