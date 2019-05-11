<nav>
	<div class="menu">
		<ul>
		<li><div class="menu_elem"><a href="index.php" class="<?php if(!strcmp(basename($_SERVER['PHP_SELF']),"index.php")) {echo 'active';}?>">Home</a></div></li>
		<li><div class="menu_elem" ><a href="jarat.php" class="<?php if(!strcmp(basename($_SERVER['PHP_SELF']),"jarat.php")) {echo 'active';}?>">Járat kereső</a></div></li>
		<li><div class="menu_elem" ><a href="hozzaad.php" class="<?php if(!strcmp(basename($_SERVER['PHP_SELF']),"hozzaad.php")) {echo 'active';}?>">Hozzáadás</a></div></li>
		<li><div class="menu_elem" ><a href="delete.php" class="<?php if(!strcmp(basename($_SERVER['PHP_SELF']),"delete.php")) {echo 'active';}?>">Törlés</a></div></li>
		<li><div class="menu_elem" ><a href="update.php" class="<?php if(!strcmp(basename($_SERVER['PHP_SELF']),"update.php")) {echo 'active';}?>">Módosítás</a></div></li>
		<li><div class="menu_elem" ><a href="stat.php" class="<?php if(!strcmp(basename($_SERVER['PHP_SELF']),"stat.php")) {echo 'active';}?>">Statisztika</a></div></li>
		
		
		
	</div>

</nav>