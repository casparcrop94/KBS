<script type="text/javascript" src="/scripts/agenda.js"></script>
<?php 
$result = getAgendaMonth();
?>

<div class="agenda">
<a href="#" id="previous_month">&lt; vorige maand</a><br />
<a href="#" id="next_month">Volgende maand &gt;</a>
<h3 id="current_date"><?php echo $result['month_name'];?> <?php echo $result['year'];?></h3>
	<table>
		<thead>
			<tr>
				<th>Maandag</th>
				<th>Dinsdag</th>
				<th>Woensdag</th>
				<th>Donderdag</th>
				<th>Vrijdag</th>
				<th>Zaterdag</th>
				<th>Zondag</th>
			</tr>
		</thead>
		<tbody id="agenda_month">
			<?php echo $result['data'];?>
		</tbody>
	</table>
	<input type="hidden" value="<?php echo $result['month']?>" id="current_month" />
	<input type="hidden" value="<?php echo $result['year']?>" id="current_year" />
</div>