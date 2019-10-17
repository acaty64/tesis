<?php 
	$sFile = "progreso.txt";
	file_put_contents($sFile, 0);
	for ($nIndex=0; $nIndex < 30; $nIndex++) { 
		file_put_contents($sFile, ($nIndex / 30) *100);
		usleep(rand(1000, 1000000));
	}
	file_put_contents($sFile, "finish");
 ?>