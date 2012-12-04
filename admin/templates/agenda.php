<?php 
date_default_timezone_set('Europe/Amsterdam');
//$day = date('d');
$month = date('m');
$year = date('Y');

$total_days = cal_days_in_month(CAL_GREGORIAN, $month, $year);
$total_weeks = ceil($total_days / 7);

$first_day = date("N", mktime(0, 0, 0, $month, 1, $year));
$cal = array();
$curr_day = 1;
$continue = false;

for($week = 0; $week <= $total_weeks; $week++) 
{
	$cal[$week] = array();
	for($day = 1; $day <= 7; $day++)
	{
		$cal[$week][$day] = '';
		if($day == $first_day && $week == 0)
		{
			//$cal[$week][$day] = date("l", mktime(0, 0, 0, $month, 1, $year));
			$cal[$week][$day] = 1;
			$continue = true;
			$curr_day++;
		}
		else if($continue && $curr_day <= $total_days){
			//$cal[$week][$day] = date("l", mktime(0, 0, 0, $month, $curr_day, $year));
			$cal[$week][$day] = $curr_day;
			$curr_day++;
		}
		
	}
}

?>

<div class="agenda">
	<table>
		<tr>
			<th>Maandag</th>
			<th>Dinsdag</th>
			<th>Woensdag</th>
			<th>Donderdag</th>
			<th>Vrijdag</th>
			<th>Zaterdag</th>
			<th>Zondag</th>
		</tr>
		<?php foreach($cal as $week):?>
			<tr>
				<?php foreach($week as $date => $day):?>
					<td><?php echo $day;?></td>
				<?php endforeach;?>
			</tr>
		<?php endforeach;?>
	</table>
</div>