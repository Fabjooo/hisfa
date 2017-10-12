@extends('layouts.app')

@section('content')

{{-- dd( $blocks ) --}}

<a href="{{ action('BlockController@create') }}" class="btn btn-danger pull-right">+ Add Block</a>

<br><br>


<div class="col-md-12 blocksVUE">

<?php $i=0; ?>
@foreach( $blocks as $block )

	<?php $i++ ?>
	<div class="col-md-3 hm" >
		<div class="inner">
		<h4>{{  $block->name  }} <a href="{{ action('BlockController@edit', $block->id) }}">Edit</a> <a href="{{ url('blocks/delete', ['id' => $block->id]) }}">Delete</a><a href="{{ action('BlockController@create_length', $block->id) }}" class="pull-right">+</a></h4>

		@foreach( $block->length as $length)
		
		<div class="row"> 
			<div class="col-md-6">
				{{ $length->length/1000 }}m (<span class="stock_{{$length->id}}">{{ $length->stock }}</span>) <span class="cubic_{{$length->id}}"><?php echo round((1030/1000*1290/1000*($length->length*$length->stock)/ 1000),2); ?></span>m3

				<a class="btn btn-xs btn-success" v-on:click="plusBlock({{$length->id}})">+</a> <a class="btn btn-xs btn-success" v-on:click="minusBlock({{$length->id}})">-</a>
			</div>
			<div class="col-md-6" style="text-align: right">
				<a href="{{ action('BlockController@edit_length', $length->id) }}">Edit</a> <a href="{{ action('BlockController@destroy_length', $length->id) }}">Delete</a>
			</div>
		</div>
		@endforeach
		</div>
	</div>
	@if( $i % 4 == 0)
	</div>
	<div class="col-md-12">
	@endif
@endforeach
</div>

@endsection
