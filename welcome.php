<? ob_start(); ?>
<?php
include "include/session.php";
include "include/z_db.php";
$monthNames = array("Jan", "Feb", "Mär", "Apr", "Mai", "Jun",   
                    "Jul", "Aug", "Sept", "Okt", "Nov", 
                    "Dez"); 
?>
<?php require("header.php");?>
<div class="row" id ="contentIndex">
	<h1>News</h1>
	<div class="col-md-12">
	
	<?php 
		$sql = "SELECT * FROM t_news ORDER BY news_datum DESC";
		$result=mysql_query($sql);
		while ($row=mysql_fetch_array($result)) : ?>
			<?php 
				list($yr,$mon,$day) = preg_split('/-/',$row['news_datum']); 
				if ($day[0] == 0)
					$b=$day[1].".".$monthNames[($mon-1)].". ".$yr;
				else
					$b=$day.".".$monthNames[($mon-1)].". ".$yr;
			?>
			<div class="row">
			<div class="col-md-3 col"><?php echo $b; ?></div>
			<div class="col-md-8 col-md-offset-1 col"><?php echo $row['news_text']; ?></div>
			</div>
		<?php endwhile; ?>
		<div class="row" id="embedSwf">
			<div class="col-md-12">
				<center>
					<?php
					$total = "3"; 
					$start = "1";  
					$random = mt_rand($start, $total);  

					if ($random==1) { ?>
						<div class="embed-responsive embed-responsive-16by9">
							<video class="responsive-video" controls autoplay>
								<source src="startpage-anims/young_and_old.mp4" type="video/mp4">  
							</video>  							
						</div>
					<?php } if ($random==2) { ?>
						<div class="embed-responsive embed-responsive-16by9">						
							<video class="responsive-video" controls autoplay>
									<source src="startpage-anims/manimano_holiday.mp4" type="video/mp4">  
							</video>  													
						</div>
					<?php } if ($random==3) { ?>
						<div class="embed-responsive" style="height:500px !important;">
							<iframe src="startpage-anims/swiper.html"></iframe>							
						</div>
					<?php } ?>
				</center>
			</div>
		</div>
	</div>
</div>
</body>
</html>
