<!DOCTYPE html>
<html lang="es">
<head>
	<link rel="stylesheet" href="{{ asset('css/app.css') }}">
	<script>
		function subst() {
		  var vars = {};
		  var query_strings_from_url = document.location.search.substring(1).split('&');
		  for (var query_string in query_strings_from_url) {
		      if (query_strings_from_url.hasOwnProperty(query_string)) {
		          var temp_var = query_strings_from_url[query_string].split('=', 2);
		          vars[temp_var[0]] = decodeURI(temp_var[1]);
		      }
		  }
		  var css_selector_classes = ['page', 'frompage', 'topage', 'webpage', 'section', 'subsection', 'date', 'isodate', 'time', 'title', 'doctitle', 'sitepage', 'sitepages'];
		  for (var css_class in css_selector_classes) {
		      if (css_selector_classes.hasOwnProperty(css_class)) {
		          var element = document.getElementsByClassName(css_selector_classes[css_class]);
		          for (var j = 0; j < element.length; ++j) {
		              element[j].textContent = vars[css_selector_classes[css_class]];
		          }
		      }
		  }
		}
	</script>
</head>
<body style="border:0; margin: 0; background: white" onload="subst()">
	<img src="{{asset('images/logo-ucss.jpg')}}" width="15%">
	<h3 style="text-align:center">SYLLABUS</h3>
	<table style="border-bottom: 1px solid black; width: 100%">
		<tr>
			<td style="text-align:left">
				<?php
				if( $semestre !=0 ){
					echo('Para uso exclusivo de los alumnos matriculados en el  semestre ' . $semestre . '.');
				}
				?>
			</td>
			<td style="text-align:right">
			Página <span class="page"></span> de <span class="topage"></span>
			</td>
		</tr>
	</table>
</body>
</html>