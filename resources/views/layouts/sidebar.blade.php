
<div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
	<div class="menu_section"><br>
		<h3>{{ Auth::user()->level }}</h3>

		<ul class="nav side-menu">
			<li><a href="/home"><i class="fa fa-home"></i> Home</a></li>
			@if( Auth::user()->level == 'pegawai' || Auth::user()->level == 'developer' )
			<li><a href="/biodata"><i class="fa fa-user"></i> Biodata </a></li>
			@endif
			<li><a href="/permohonan"><i class="fa fa-newspaper-o"></i> Data Permohonan</a></li>
			<li><a href="/absensi"><i class="fa fa-clock-o"></i> Absensi</a></li>
			<li><a href="/report"><i class="fa fa-clock-o"></i> Daily Report</a></li>
			<li><a href="/gaji"><i class="fa fa-dollar"></i> Data Gaji</a></li>
			
			@if( Auth::user()->level == 'hrd' || Auth::user()->level == 'developer' )
				<li>
					<a><i class="fa fa-cog"></i>Aplikasi<span class="fa fa-chevron-down"></span></a>
				  	<ul class="nav child_menu">
				  		<li><a href="/sliders"><i class="fa fa-sliders"></i> Sliders</a></li>
				    	@if( Auth::user()->level == 'developer' )
				    	  	<li><a href="/aplikasi"><i class="fa fa-cog"></i> Aplikasi</a></li>
				    	@endif
					     
				  	</ul>
				</li>
			  	
			  	<li><a href="/pegawai"><i class="fa fa-users"></i> Pegawai</a></li>
			  	{{-- <li><a href="/tower"><i class="fa fa-building"></i> Tower</a></li> --}}
			  	<li><a href="/kantor"><i class="fa fa-building"></i> Kantor</a></li>
			  	<li><a href="/laporan/gaji"><i class="fa fa-bar-chart"></i> Laporan Gaji </a></li>
			  	<!-- <li>
			  		<a><i class="fa fa-bar-chart"></i>Laporan<span class="fa fa-chevron-down"></span></a>
			  	  	<ul class="nav child_menu">
			  	  		<li><a href="/laporan/gaji"><i class="fa fa-dollar"></i> Gaji</a></li>
		  	    	  	<li><a href="/laporan_absensi"><i class="fa fa-th"></i> Absensi</a></li>
			  	  	</ul>
			  	</li> -->
			@else
			  	
			@endif
			
		</ul>
	</div>
</div>