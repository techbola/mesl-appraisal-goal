@if(session('success'))
<div class="pgn-wrapper" data-position="top">
	<div class="pgn push-on-sidebar-open pgn-bar">
		<div class="alert alert-info">
			<button type="button" class="close" data-dismiss="alert">
				<span aria-hidden="true">×</span>
				<span class="sr-only">Close</span>
			</button>
			<span>{{session('success')}}</span>
		</div>
	</div>
</div> 
@endif
