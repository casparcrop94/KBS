<script type="text/javascript" src="/scripts/agenda.js"></script>
<?php 
$result = getAgendaMonth();
?>


<a href="#" id="previous_month">&lt; vorige maand</a><br />
<a href="#" id="next_month">Volgende maand &gt;</a>
<h3 id="current_date"><?php echo $result['month_name'];?> <?php echo $result['year'];?></h3>
	<div id="ag-page">
		<table id="ag-days">
				<tr>
					<th class="ag-day">Maandag</th>
					<th class="ag-day">Dinsdag</th>
					<th class="ag-day">Woensdag</th>
					<th class="ag-day">Donderdag</th>
					<th class="ag-day">Vrijdag</th>
					<th class="ag-day">Zaterdag</th>
					<th class="ag-day">Zondag</th>
				</tr>
		</table>
		<div id="ag-container">
			<?php echo $result['data'];?>
		</div>
	</div>
<input type="hidden" value="<?php echo $result['month']?>" id="current_month" />
<input type="hidden" value="<?php echo $result['year']?>" id="current_year" />
<div id="bubble-main">
	<div id="bubble-content">
		<form>
			<h3>Afspraak</h3>
			<table>
				<tr>
					<td>Wanneer:</td>
					<td id="selected-date"></td>
				</tr>
				<tr>
					<td>Wat:</td>
					<td><input type="text" name="wat" id="bubble-what" /> </td>
				</tr>
				<tr><td>&nbsp;</td></tr>
				<tr>
					<td><input type="button" value="Afspraak maken" /></td>
				</tr>
			</table>
		</form>
	</div>
	<div class="bottom-prong">
		<div class="prong-dk"></div>
		<div class="prong-lt"></div>
	</div>
</div>