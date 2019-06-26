@if(count($errors) > 0)

	<ul class=“list-group”>

		@foreach($errors->all() as $error)

			<li class=“list-group-item”>

				<span style="color: red;">{{ $error }}</span>

			</li>

		@endforeach

	</ul>

@endif