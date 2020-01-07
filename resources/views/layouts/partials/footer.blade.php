<div class="container">
<div class="row">
<!--div class="col-xs4"-->
<br>
	<span  class="nav navbar-nav list-group-item list-inline" style="color:blue; font-size:75%">
		<div>Universidad Católica Sedes Sapientiae</div>
		<div>Facultad de Ciencias Económicas y Comerciales</div>
		<div>Tfno. 533-0008 anexo 250</div>
	</span>	
	<span  class="nav navbar-nav list-group-item list-inline" style="color:blue; font-size:75%">
		<div>Laravel v5.5</div>
		<div>Vue js v2.5</div>
		<div>Npm v5.6.0</div>
	</span>	
	@guest
	@else
	<span  class="nav navbar-nav list-group-item list-inline" style="color:blue; font-size:75%">
		<div>User Id: "{{ \Auth::user()->id }}"</div>
		<div>Tipo: "{{ \Auth::user()->tuser }}"</div>
	</span>	
	@endguest
</div>
<div class="row">
    <div class="nav navbar-nav list-group-item list-inline" id="userType" style="color:red; font-size:75%">
    	Vista: @yield('view')
	</div>
<!--/div-->
</div>
</div>