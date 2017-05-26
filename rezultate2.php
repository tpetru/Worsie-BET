<!DOCTYPE HTML>
<html>
<head>
	<title>Rezultate - WorsieBet</title>
	<link rel="stylesheet" type="text/css" href="css/style.css">
	<link rel="stylesheet" type="text/css" href="css/style-header.css">
	<link rel="stylesheet" type="text/css" href="css/popup-style.css">
</head>

<body>

<?php
	require('pages/header.php');
?>

<div id="main-results">

	<div class="search-bar">
		<form  method="POST">
			<input name="search" placeholder="Search...">
			<div class="search-img">
				<img src="images/search.png" alt="search">
			</div>
		</form>
	</div>


	<div class="show-bets-day">
		<ul>
			<?php
				$num_day = getdate();
				$days = array(0 => "Luni", 1 => "Marti", 2 => "Miercuri", 3 => "Joi", 4 => "Vineri", 5 => "Sambata", 6 => "Duminica");

				$day = date("Y-m-d", time() - 4 * 86400);
				echo "<li><a href =\"rezultate.php?date=$day\">".$days[($num_day['wday'] + 9) % 7 ]."</a></li>";

				$day = date("Y-m-d", time() - 3 * 86400);
				echo "<li><a href =\"rezultate.php?date=$day\">".$days[($num_day['wday'] + 10) % 7 ]."</a></li>";

				$day = date("Y-m-d", time() - 2 * 86400);
				echo "<li><a href =\"rezultate.php?date=$day\">".$days[($num_day['wday'] + 11) % 7 ]."</a></li>";

				$day = date("Y-m-d", time() - 86400);
				echo "<li><a href =\"rezultate.php?date=$day\">Ieri</a></li>";

				$day = date("Y-m-d", time());
				echo "<li class=\"active\"><a href =\"rezultate.php?date=$day\">Azi</a></li>";


			?>
		</ul>
	</div>

	<div class ="bet-details">
	<?php
		if(isset($_GET['date'])) {
			$data_meci = $_GET['date'];
			$meciuri_azi = 0;
			unset($stmt);
			$sql_query = "SELECT id, nume, id_cai, id_jochei, ora FROM CURSE WHERE date_format(data, '%Y-%m-%d') like ? ";
			if($stmt =  $conn->prepare($sql_query)) {
				$stmt->bind_param('s', $data_meci);
				$stmt->execute();
				$stmt->bind_result($id, $nume, $id_cai, $id_jochei, $ora);
				while($stmt->fetch()) {
					$meciuri_azi = $meciuri_azi + 1;
					$cai = explode(" ", $id_cai);
					$jochei = explode(" ", $id_jochei);
					?>
					
						<div class="results-bar">
							<span><?php echo $nume; ?></span>
							<div class="results-times">
								<div class="active-time">
									<a href="">13:20</a>
								</div>
								<a href="">14:20</a>
								<a href="">15:20</a>
								<a href="">16:20</a>
								<a href="">17:10</a>
								<a href="">18:20</a>
								<a href="">19:20</a>
							</div>
						</div>
						<div class="results-head">
							<div class="dim50">
								<span>#</span>
							</div>
							<div class="dim200">
								<span>Cal</span>
							</div>
							<div class="dim200">
								<span>Jocheu / Antrenor</span>
							</div>
							<div class="dim50">
								<span>Ani</span>
							</div>
							<div class="dim100">
								<span>WR Cal</span>
							</div>
							<div class="dim100">
								<span>WR Jocheu</span>
							</div>
						</div>
							<div class="results-body">
								<div class="results-team">
									<div class="dim50">
										<span><?php echo $meciuri_azi; ?>.</span>
									</div>
									<div class="dim200">
										<span><?php //echo $cai[$j]; ?></span>
									</div>
									<div class="dim200">
										<span><?php //echo $johei[$j] . "/" . $antrenor;?></span>
									</div>
									<div class="dim50">
										<span><?php //echo $varsta; ?></span>
									</div>
									<div class="dim100">
										<div class="win-chance">
											<span><?php //echo $cal_meciuri_castigate / $cal_meciuri_pierdute;?></span>
										</div>
									</div>
									<div class="dim100">
										<div class="win-chance">
											<span><?php //echo $jocheu_meciuri_castigate / $jocheu_meciuri_pierdute;?></span>
										</div>
									</div>
								</div>
							</div>
					<?php
				}
			}
		} else {
			echo "Pentru a afisa cursele, selectati o zi.";
		}
	?>
	</div>


</div>


<!--			<div class="results-team">
				<div class="dim50">
					<span>2.</span>
				</div>
				<div class="dim200">
					<span>Pushkin Museum</span>
				</div>
				<div class="dim200">
					<span>D M Loughnane / David Egan</span>
				</div>
				<div class="dim50">
					<span>4</span>
				</div>
				<div class="dim100">
					<div class="win-chance">
						<span>65%</span>
					</div>
				</div>
				<div class="dim100">
					<div class="win-chance">
						<span>73%</span>
					</div>
				</div>
			</div>
			<div class="results-team">
				<div class="dim50">
					<span>3.</span>
				</div>
				<div class="dim200">
					<span>Mr Chuckles</span>
				</div>
				<div class="dim200">
					<span>D M Loughnane / David Egan</span>
				</div>
				<div class="dim50">
					<span>5</span>
				</div>
				<div class="dim100">
					<div class="win-chance">
						<span>86%</span>
					</div>
				</div>
				<div class="dim100">
					<div class="win-chance">
						<span>75%</span>
					</div>
				</div>
			</div>
			<div class="results-team">
				<div class="dim50">
					<span>4.</span>
				</div>
				<div class="dim200">
					<span>Burtonwood</span>
				</div>
				<div class="dim200">
					<span>P Morris/Kieran Schofield</span>
				</div>
				<div class="dim50">
					<span>6</span>
				</div>
				<div class="dim100">
					<div class="win-chance">
						<span>30%</span>
					</div>
				</div>
				<div class="dim100">
					<div class="win-chance">
						<span>80%</span>
					</div>
				</div>
			</div>
			<div class="results-team">
				<div class="dim50">
					<span>NR.</span>
				</div>
				<div class="dim200">
					<span>Pushkin Museum</span>
				</div>
				<div class="dim200">
					<span>D M Loughnane / David Egan</span>
				</div>
				<div class="dim50">
					<span>4</span>
				</div>
				<div class="dim100">
					<div class="win-chance">
						<span>65%</span>
					</div>
				</div>
				<div class="dim100">
					<div class="win-chance">
						<span>73%</span>
					</div>
				</div>
			</div>
			<div class="results-team">
				<div class="dim50">
					<span>NR.</span>
				</div>
				<div class="dim200">
					<span>Mr Chuckles</span>
				</div>
				<div class="dim200">
					<span>D M Loughnane / David Egan</span>
				</div>
				<div class="dim50">
					<span>5</span>
				</div>
				<div class="dim100">
					<div class="win-chance">
						<span>86%</span>
					</div>
				</div>
				<div class="dim100">
					<div class="win-chance">
						<span>75%</span>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
-->
<?php
	require('pages/footer.php');
?>
</body>
</html>