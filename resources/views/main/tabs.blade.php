<ul class="nav nav-tabs">
	<li class="{{ $active == 'dashboard' ? 'active' : '' }}"><a href="{!! route('home') !!}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
	<li class="{{ $active == 'leaderboard' ? 'active' : '' }}"><a href="{!! route('leaderboard') !!}"><i class="fa fa-signal"></i> Leaderboard</a></li>
	<li class="{{ $active == 'generatereport' ? 'active' : '' }}"><a href="{!! route('generatereport') !!}"><i class="fa fa-bar-chart"></i> Report</a></li>
</ul>
