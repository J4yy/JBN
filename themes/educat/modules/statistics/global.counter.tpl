<!-- BEGIN: main -->
<ul class="counter list-none display-table">
	<li>
		<span><i class="fa fa-bolt fa-lg fa-horizon"></i>{LANG.online}</span>
		<span class="pull-right">{COUNT_ONLINE}</span>
	</li>
	<!-- BEGIN: users -->
		<li>
			<span><i class="fa fa-user fa-lg fa-horizon"></i>{LANG.users}</span>
			<span class="pull-right">{COUNT_USERS}</span>
		</li>
	<!-- END: users -->
	<!-- BEGIN: bots -->
		<li>
			<span><i class="fa fa-magic fa-lg fa-horizon"></i>{LANG.bots}</span>
			<span class="pull-right">{COUNT_BOTS}</span>
		</li>
	<!-- END: bots -->
	<!-- BEGIN: guests -->
		<li>
			<span><i class="fa fa-bullseye fa-lg fa-horizon"></i>{LANG.guests}</span>
			<span class="pull-right">{COUNT_GUESTS}</span>
		</li>
	<!-- END: guests -->
    <li>
    	<span><i class="fa fa-filter fa-lg fa-horizon margin-top-lg"></i>{LANG.today}</span>
    	<span class="pull-right" class="margin-top-lg">{COUNT_DAY}</span>
    </li>
	<li>
		<span><i class="fa fa-calendar-o fa-lg fa-horizon"></i>{LANG.current_month}</span>
		<span class="pull-right">{COUNT_MONTH}</span>
	</li>
	<li>
		<span><i class="fa fa-bars fa-lg fa-horizon"></i>{LANG.hits}</span>
		<span class="pull-right">{COUNT_ALL}</span>
	</li>
</ul>
<!-- END: main -->