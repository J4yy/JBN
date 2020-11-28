<!-- BEGIN: main -->
<button type="button" class="btn btn-outline-primary btn-sm" title="{LANG.viewstats}" data-toggle="ftip" data-target=".view-stats" data-click="y"><i class="fa fa-eye"></i>&nbsp;{LANG.online}: {COUNT_ONLINE}</button>

<div class="view-stats hidden">
	<ul class="counter list-none display-table">
		<li><span><i class="fa fa-eye fa-lg fa-horizon"></i>{LANG.online}</span><span>{COUNT_ONLINE}</span></li>
		<!-- BEGIN: users --><li><span><i class="fa fa-user fa-lg fa-horizon"></i>{LANG.users}</span><span>{COUNT_USERS}</span></li><!-- END: users -->
		<!-- BEGIN: bots --><li><span><i class="fa fa-magic fa-lg fa-horizon"></i>{LANG.bots}</span><span>{COUNT_BOTS}</span></li><!-- END: bots -->
		<!-- BEGIN: guests --><li><span><i class="fa fa-bullseye fa-lg fa-horizon"></i>{LANG.guests}</span><span>{COUNT_GUESTS}</span></li><!-- END: guests -->
	    <li><span><i class="icon-today icon-lg icon-horizon margin-top-lg"></i>{LANG.today}</span><span class="margin-top-lg">{COUNT_DAY}</span></li>
		<li><span><i class="fa fa-calendar-o fa-lg fa-horizon"></i>{LANG.current_month}</span><span>{COUNT_MONTH}</span></li>
		<li><span><i class="fa fa-bars fa-lg fa-horizon"></i>{LANG.hits}</span><span>{COUNT_ALL}</span></li>
	</ul>
</div>
<!-- END: main -->