
<!--begin: Head -->
<div class="kt-user-card kt-user-card--skin-dark kt-notification-item-padding-x" style="background-image: url(assets/media/misc/bg-1.jpg)">
	<div class="kt-user-card__avatar">
		<img class="kt-hidden" alt="Pic" src="" />

		<!--use below badge element instead the user avatar to display username's first letter(remove kt-hidden class to display it) -->
		<!--<span class="kt-badge kt-badge--lg kt-badge--rounded kt-badge--bold kt-font-success">S</span>-->
	</div>
	<div class="kt-user-card__name">
		{{ Auth::user()->name }}
	</div>
	<div class="kt-user-card__badge">
		<span class="btn btn-success btn-sm btn-bold btn-font-md">23 mensajes</span>
	</div>
</div>

<!--end: Head -->

<!--begin: Navigation -->
<div class="kt-notification">
	<!-- <a href="custom/apps/user/profile-1/personal-information.html" class="kt-notification__item"> -->
	<a href="#" class="kt-notification__item">
		<div class="kt-notification__item-icon">
			<i class="flaticon2-calendar-3 kt-font-success"></i>
		</div>
		<div class="kt-notification__item-details">
			<div class="kt-notification__item-title kt-font-bold">
				Mi Perfil
			</div>
			<div class="kt-notification__item-time">
				Configuración de cuenta
			</div>
		</div>
	</a>
	<!-- <a href="custom/apps/user/profile-3.html" class="kt-notification__item"> -->
		<a href="" class="kt-notification__item"> 
		<div class="kt-notification__item-icon">
			<i class="flaticon2-mail kt-font-warning"></i>
		</div>
		<div class="kt-notification__item-details">
			<div class="kt-notification__item-title kt-font-bold">
				Mis Mensajes
			</div>
			<div class="kt-notification__item-time">
				Buzón
			</div>
		</div>
	</a>
	<!-- <a href="custom/apps/user/profile-2.html" class="kt-notification__item">
		<div class="kt-notification__item-icon">
			<i class="flaticon2-rocket-1 kt-font-danger"></i>
		</div>
		<div class="kt-notification__item-details">
			<div class="kt-notification__item-title kt-font-bold">
				My Activities
			</div>
			<div class="kt-notification__item-time">
				Logs and notifications
			</div>
		</div>
	</a> -->
	<!-- <a href="custom/apps/user/profile-3.html" class="kt-notification__item">
		<div class="kt-notification__item-icon">
			<i class="flaticon2-hourglass kt-font-brand"></i>
		</div>
		<div class="kt-notification__item-details">
			<div class="kt-notification__item-title kt-font-bold">
				My Tasks
			</div>
			<div class="kt-notification__item-time">
				latest tasks and projects
			</div>
		</div>
	</a> -->
	<!-- <a href="custom/apps/user/profile-1/overview.html" class="kt-notification__item">
		<div class="kt-notification__item-icon">
			<i class="flaticon2-cardiogram kt-font-warning"></i>
		</div>
		<div class="kt-notification__item-details">
			<div class="kt-notification__item-title kt-font-bold">
				Billing
			</div>
			<div class="kt-notification__item-time">
				billing & statements <span class="kt-badge kt-badge--danger kt-badge--inline kt-badge--pill kt-badge--rounded">2 pending</span>
			</div>
		</div>
	</a> -->
	<div class="kt-notification__custom kt-space-between">
		<a href="{{ url('/logout') }}" target="_blank" class="btn btn-label btn-label-brand btn-sm btn-bold">Cerrar Sesión</a>
		<!-- <a href="custom/user/login-v2.html" target="_blank" class="btn btn-clean btn-sm btn-bold">Upgrade Plan</a> -->
	</div>
</div>

<!--end: Navigation -->