<div class="header">
	<div class="left-icons"></div>
	<div class="middle-icons"><h5>{{ $title or 'Dashboard' }}</h5></div>
	<div class="right-icons">
		@if(isset($silos))
			@if($silos->first())
			<a href="#" id="newNotification"><img src="img/notification-1.svg" alt="New notification">
				<script type="text/javascript">
					document.getElementById("newNotification").addEventListener("click", function(event){
						swal({
							title: "De volgende silo's zijn bijna vol:",
							text: [@foreach($silos as $silo)
								"<span style='font-size:1.5em'>\n{{$silo->type . ' ' . $silo->number . ' is ' . $silo->volume . ' procent vol'}}</span>",
							@endforeach ],
							type: "error",
							html: true,
							confirmButtonText: "Begrepen"
						});
					});
				</script>
			</a>
			@else
			<a href="#" id="noNotification">
				<i class="icon icon-bell"></i>
			<script type="text/javascript">
					document.getElementById("noNotification").addEventListener("click", function(event){
						swal({
							title: "De silo's zijn nog niet vol.",
							type: "success",
							confirmButtonText: "Geweldig"
						});
					});
				</script>
			</a>
			@endif
		@endif
		<a href="/profiel"><i class="icon icon-user"></i></a>
		<a href="/logout"><i class="icon icon-share-square-o"></i></a>
	</div>
</div>
