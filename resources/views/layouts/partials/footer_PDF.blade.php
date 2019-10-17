<!DOCTYPE html>
<html lang="es">
<head>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>
<body style="border:0; margin: 0; background: white;">
    <table style="border-top: 1px solid black; width: 100%">
        <tr>
            <td style="text-align:left">
				<?php
				if( $semestre !=0 ){
					echo('Para uso exclusivo de los alumnos matriculados en el  semestre ' . $semestre . '.');
				}else{
					echo('.');
				}
				?>
			</td>
            <td style="text-align:right"></td>
        </tr>
    </table>
</body>
</html>