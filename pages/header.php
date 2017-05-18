
<?php
	require("php/database/connect2DB.php");
?>

<div id="header">
	<div id="logo">
		<a href="index.php"><img src="images/logo.png"></a>
	</div>

	<?php
		if(isset($_SESSION['id'])) {
	 ?>
		 <div class="account-box">
			 <div class="username-box">
				 <span class="username">daniel269</span>
				 <span class="balance">265.23 Ron</span>
			 </div>
			 <div class="link-box">
				 <a href="profile.php?page=account">Contul meu</a>
				 <a href="profile.php?page=bilete">Bilete</a>
				 <a href="php/logout.php"><img alt="logout" src="images/logout.png"></a>
			 </div>
		 </div>
	<?php } else { ?>
		<div class="log-buttons">
			<button onclick="document.getElementById('id01').style.display='block'">Autentificare</button>
			<button onclick="document.getElementById('id02').style.display='block'">Inregistrare</button>
		</div>
	<?php } ?>

	<div class="links">
		<ul>
			<li><a class="active" href="index.php">Acasa</a></li>
			<li><a href="pariuri.php?date=<?php echo date("Y-m-d", time());?>">Pariuri</a></li>
			<li><a href="rezultate.php">Rezultate</a></li>
			<li><a href="regulament.php">Regulament</a></li>
			<li><a href="desprenoi.php">Despre Noi</a></li>
		</ul>
	</div>
</div>

<div id="id01" class="modal">

	<form class="modal-content animate" method="POST">
		<div class="imgcontainer">
		  <span onclick="document.getElementById('id01').style.display='none'" class="close" title="Close Modal">&times;</span>
		  <img src="images/login-img.png" alt="Avatar" class="avatar">
		</div>

		<div class="container">
			<div class="form-login">
				<label><b>Username</b></label>
				<input type="text" placeholder="Enter Username" name="username" required>
			</div>

			<div  class="form-login">
				<label><b>Parola</b></label>
				<input type="password" placeholder="Enter Password" name="password" required>
			</div>

			<button type="submit">Login</button>
		</div>

	</form>
	<?php
		/*Daca sunt setate datele necesare pentru logare, verificam daca exista contul*/
		if (isset($_POST['username']) and isset($_POST['password'])) {
			/* Scoatem caracterele speciale din username si parola pentru evitarea sql injection*/
			$username = mysql_real_escape_string($_POST['username']);
			$password = mysql_real_escape_string($_POST['password']);

			//echo "username: $username <br> password: $password <br>";
			/* Creeam si executam query-ul pentru a vedea daca exista user-ul in baza de date */
			$stmt =  $conn->stmt_init();
			$sql_query = "SELECT id, conectat FROM utilizatori WHERE username = ? AND parola = ?";
			if($stmt =  $conn->prepare($sql_query)) {
				$stmt->bind_param('ss', $username, $password);
				$stmt->execute();
				$stmt->bind_result($id_user, $conectat);
				$stmt->fetch();

				if(isset($id_user) == TRUE and $conectat == 0) {
				/* Pornim sesiunea si setam parametrii la seiune */
					session_start();
					$_SESSION['id'] = $id_user;
					$_SESSION['username'] = $username;
					//echo "ID: " . $id_user . "<br>";

					/* Facem update la campul "conectat" */
					unset($stmt);
					$stmt =  $conn->stmt_init();
					$sql_query = "UPDATE utilizatori SET conectat = 1 WHERE id = ?";
					if($stmt =  $conn->prepare($sql_query)) {
						$stmt->bind_param('d', $id_user);
						$stmt->execute();
						if($conn->affected_rows == 0)
							echo "Update error";
							//header('Location: index.php');
					}
				}
				else {
					if($conectat === 1)
						echo "Sunteti deja conectat cu acest username!";
					else
						echo "Acest cont nu exista!";
				}
			}

		}
	 ?>
</div>

<script>
// Get the modal
var modal = document.getElementById('id01');

// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
    if (event.target == modal) {
        modal.style.display = "none";
    }
}
</script>


<div id="id02" class="modal">

	<form class="modal-content animate" method="POST">
		<div class="imgcontainer">
		  <span onclick="document.getElementById('id02').style.display='none'" class="close" title="Close Modal">&times;</span>
		  <img src="images/login-img.png" alt="Avatar" class="avatar">
		</div>

		<?php
			if (isset($_POST['username']) and isset($_POST['password'])) {
			/* Scoatem caracterele speciale din username si parola pentru evitarea sql injection*/
				$username = mysql_real_escape_string($_POST['username']);
				$password = mysql_real_escape_string($_POST['password']);

				//echo "username: $username <br> password: $password <br>";
				/* Creeam si executam query-ul pentru a vedea daca exista user-ul in baza de date */
				$stmt =  $conn->stmt_init();
				$sql_query = "SELECT id, conectat FROM utilizatori WHERE username = ? AND parola = ?";
				if($stmt =  $conn->prepare($sql_query)) {
					$stmt->bind_param('ss', $username, $password);
					$stmt->execute();
					$stmt->bind_result($id_user, $conectat);
					$stmt->fetch();
				}
			}

		 ?>

		<div class="container">
			<div class="form-login">
				<label><b>Username</b></label>
				<input type="text" name="name" required>
			</div>

			<div class="form-login">
				<label><b>Nume</b></label>
				<input type="text" name="name" required>
			</div>

			<div class="form-login">
				<label><b>Prenume</b></label>
				<input type="text" name="name" required>
			</div>

			<div class="form-login">
				<label><b>Data nasterii</b></label>
				<div class="select-db">
					<select name="Day">
						<option> Day </option>
						<option value="1">1</option>
						<option value="2">2</option>
						<option value="3">3</option>
						<option value="4">4</option>
						<option value="5">5</option>
						<option value="6">6</option>
						<option value="7">7</option>
						<option value="8">8</option>
						<option value="9">9</option>
						<option value="10">10</option>
						<option value="11">11</option>
						<option value="12">12</option>
						<option value="13">13</option>
						<option value="14">14</option>
						<option value="15">15</option>
						<option value="16">16</option>
						<option value="17">17</option>
						<option value="18">18</option>
						<option value="19">19</option>
						<option value="20">20</option>
						<option value="21">21</option>
						<option value="22">22</option>
						<option value="23">23</option>
						<option value="24">24</option>
						<option value="25">25</option>
						<option value="26">26</option>
						<option value="27">27</option>
						<option value="28">28</option>
						<option value="29">29</option>
						<option value="30">30</option>
						<option value="31">31</option>
					</select>
					
					<select name="Month">
						<option> Month </option>
						<option value="January">January</option>
						<option value="Febuary">Febuary</option>
						<option value="March">March</option>
						<option value="April">April</option>
						<option value="May">May</option>
						<option value="June">June</option>
						<option value="July">July</option>
						<option value="August">August</option>
						<option value="September">September</option>
						<option value="October">October</option>
						<option value="November">November</option>
						<option value="December">December</option>
					</select>

					<select name="Year">
						<option> Year </option>
						<option value="1999">1999</option>
						<option value="1998">1998</option>
						<option value="1997">1997</option>
						<option value="1996">1996</option>
						<option value="1995">1995</option>
						<option value="1994">1994</option>
						<option value="1993">1993</option>
						<option value="1992">1992</option>
						<option value="1991">1991</option>
						<option value="1990">1990</option>
						<option value="1989">1989</option>
						<option value="1988">1988</option>
						<option value="1987">1987</option>
						<option value="1986">1986</option>
						<option value="1985">1985</option>
						<option value="1984">1984</option>
						<option value="1983">1983</option>
						<option value="1982">1982</option>
						<option value="1981">1981</option>
						<option value="1980">1980</option>
						<option value="1979">1979</option>
						<option value="1978">1978</option>
						<option value="1977">1977</option>
						<option value="1976">1976</option>
						<option value="1975">1975</option>
						<option value="1974">1974</option>
						<option value="1973">1973</option>
						<option value="1972">1972</option>
						<option value="1971">1971</option>
						<option value="1970">1970</option>
						<option value="1969">1969</option>
						<option value="1968">1968</option>
						<option value="1967">1967</option>
						<option value="1966">1966</option>
						<option value="1965">1965</option>
						<option value="1964">1964</option>
						<option value="1963">1963</option>
						<option value="1962">1962</option>
						<option value="1961">1961</option>
						<option value="1960">1960</option>
						<option value="1959">1959</option>
						<option value="1958">1958</option>
						<option value="1957">1957</option>
						<option value="1956">1956</option>
						<option value="1955">1955</option>
						<option value="1954">1954</option>
						<option value="1953">1953</option>
						<option value="1952">1952</option>
						<option value="1951">1951</option>
						<option value="1950">1950</option>
						<option value="1949">1949</option>
						<option value="1948">1948</option>
						<option value="1947">1947</option>
					</select>
				</div>
			</div>

			<div class="form-login">
				<label><b>Email</b></label>
				<input type="text" name="email" required>
			</div>

			<div class="form-login">
				<label><b>Parola</b></label>
				<input type="password" name="password" required>
			</div>

			<button type="submit">Register</button>
		</div>

	</form>
</div>

<script>
// Get the modal
var modal = document.getElementById('id02');

// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
    if (event.target == modal) {
        modal.style.display = "none";
    }
}
</script>
