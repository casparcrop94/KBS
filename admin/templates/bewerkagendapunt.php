<?php
if(isset($_POST['edit-agenda-point']))
{
	$agenda_point_name = $_POST['agenda-point-name'];
	$date_explode = explode('-', $_POST['agenda-point-date']);
	$start_date = date('d-m-Y', mktime(0, 0, 0, $date_explode[1], $date_explode[2], $date_explode[0]));
}
if(isset($_GET['id']))
{
	$sql = "
		SELECT *
		FROM `agenda`
		WHERE `id` = :id
	";
	
	$parameters = array(
			':id' => $_GET['id'],
	);
	$sth = $db->prepare($sql);
	$sth->execute($parameters);
	$agenda_point = $sth->fetchAll(PDO::FETCH_ASSOC);
}
?>
<script type="text/javascript" src="/scripts/agenda.js"></script>
<form action="post">
	<table class="simple-table">
		<tr>
			<td colspan="2"><input type="submit" value="Opslaan" /></td>
		</tr>
		<tr>
			<td colspan="2"><input type="text" name="title" value="<?php echo isset($agenda_point_name)?$agenda_point_name:'';?>" /></td>
		</tr>
		<tr>
			<td colspan="2">
				<input type="text" id="start-date" name="start-date" value="<?php echo isset($start_date)?$start_date:date('d-m-Y');?>" />
				<input type="text" id="start-time" name="start-time" />
				tot en met
				<input type="text" id="end-time" name="end-time" />
				<input type="text" id="end-date" name="end-date" value="<?php echo isset($end_date)?$end_date:date('d-m-Y');?>" />
			</td>
		</tr>
		<tr>
			<td colspan="2">
				<input id="whole_day" type="checkbox" name="whole_day" value="yes" />
				<label for="whole_day">Hele dag</label>
			</td>
		</tr>
		<tr>
			<td colspan="2"><span>Afspraakgegevens</span></td>
		</tr>
		<tr>
			<td>Waar:</td>
			<td><input type="text" name="where" /></td>
		</tr>
		<tr>
			<td valign="top">Beschrijving:</td>
			<td><textarea class="no-editor" name="description"></textarea></td>
		</tr>
	</table>
</form>
<div id="start-time-list">
	<?php for($i = 0; $i <= 47; $i += 1):?>
		<?php $half = ($i % 2 != 0)?'30':'00';?>
		<?php $hour = floor($i / 2);?>
		<?php $hour = date('H', mktime($hour,0,0, 1, 1, 1970));?>
		<div><?php echo $hour . ':' . $half; ?></div>
	<?php endfor;?>
</div>