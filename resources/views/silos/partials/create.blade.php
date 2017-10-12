@section('content')
	<div class="container full-height center">
		@if( isset($method) && $method == 'edit' )
		<form method="post" class="row flex-row edit-silo silo-edit" action="{{ action('SilosController@update', $silo->id) }}">
		<input type="hidden" id="id" value="{{ $silo->id }}">
		@else
		{!! Form::open(['action' => 'SilosController@store']) !!}
		@endif

			{{ csrf_field() }}
			<div class="col-xs-12 col-sm-4 block">
				<div class="silo__image">
					@if( intval($silo->volume) >= 90 )
						<div class="silo__image__top full"></div>
						<div class="silo__image__middle full"></div>
						<div class="silo__image__bottom full"></div>

					@elseif( intval($silo->volume) >= 50 )
						<div class="silo__image__top default"></div>
						<div class="silo__image__middle medium"></div>
						<div class="silo__image__bottom medium"></div>
					@else
						<div class="silo__image__top default"></div>
						<div class="silo__image__middle default"></div>
						<div class="silo__image__bottom empty"></div>
					@endif
					<div class="silo__percentage">{{ intval($silo->volume) }}%</div>
				</div>
			</div>
			<div class="col-xs-12 col-sm-8 block">

				<div class="input-control">
					{!! Form::label('name', 'Silo contents?') !!}

					{!! Form::text('content', (isset($silo->content->content)) ? $silo->content->content : '', array('id' => 'name')); !!}
				</div>

				<div class="input-control">
					{!! Form::label('number', 'Silo number') !!}

					{!! Form::number('number', (isset($silo->number)) ? $silo->number : '', array('id' => 'number')); !!}
				</div>

				<div class="input-control">
					{!! Form::label('type', 'Silo type') !!}

					{!! Form::select('type', ['prime' => 'Prime', 'waste' => 'Waste'], $type, array('id' => 'type')) !!}
				</div>

				<div class="input-control">
					{!! Form::label('volume', 'Silo volume') !!}

					{!! Form::number('volume', (isset($silo->volume)) ? $silo->volume : '', array('id' => 'volume')); !!}
				</div>

				@if( isset($button) )
					{!! Form::submit($button, array('class' => 'btn btn-success btn-edit-silo')) !!}
				@else
					{!! Form::submit('Add silo', array('class' => 'btn btn-success btn-edit-silo')) !!}
				@endif
			</div>
	{!! Form::close() !!}
	</div>
@endsection
