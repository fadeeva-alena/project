<? ob_start(); ?>
<?php
include "include/session.php";
include "include/z_db.php";
include "include/class.upload.php";
$sql = "SELECT * FROM _site_mode  Where ID=1 LIMIT 0, 30 ";
$result=mysql_query($sql);

while ($row=mysql_fetch_array($result)) {
	if ($row['Mode']=='On')
	{
		header("location:Maintenance.php");
	}
}
?>

<?php require("header.php");?>
<div id="contentIndex" class="row">
	<h1>Bitte wählen Sie Ihre PLZ / Ort aus. </h1>
	<?php
	$da1 =strtotime(date("m.d.y")) ;
	$sql="SELECT * FROM _taccess Where demo='0'  ";
	$result=mysql_query($sql);   
	$count = 0; $location = array();
	while ($row=mysql_fetch_array($result)) {
		$da2 = $row[End];
		$da2 = strtotime($da2);
		if ($da1 < $da2){
			$lo[$count] = $row[Zip].$row[location];
			$zip[$count]=urlencode($row[Zip]);
			$location[$count]=urlencode($row[Location]);
			$count= $count + 1 ;
		}	
	}
	?>
	<div>
		<table  bgcolor='White'  style=width: 600px;>
			<tr>
				<td>
					<div style='height: 110px;'>
						<table>
						<?php
						for ($i = 0; $i < $count; $i++){
							echo"<tr  id=$i  bgcolor='White'   onclick= loadTwo('register1.php?zip=$zip[$i]&location=$location[$i]',$i,$count)>";
								echo"<td width='250px' valign='top'>";
									echo" $zip[$i] $location[$i]";
								echo"</td>";
							echo"</tr>";
						}?>
						</table>
					</div>
				</td>

			</tr>
		</table>
		<div class="paragraph">
			<p>Auswählen und weiter zur Eingabe der persönlichen Daten</p>
			<p>
				Sie können sich nur anmelden, wenn Sie in einer Gemeinde oder Stadt wohnen, die ManiMano freigeschaltet <br>hat. 
				Wenn Ihre Wohn- oder Arbeitsgemeinde ManiMano noch nicht freigeschaltet hat, können Sie sich noch nicht <br> anmelden – aber Sie können uns Bescheid geben, dass Interesse besteht.
			</p>
		</div>
	</div>
</div>
</body>
</html>
<? ob_flush(); ?>
