@extends('layouts.app')
<!-- Indien de user een admin is OF als het een "normal" user is met optie 1 ingeschakeld wordt deze content getoond. -->

@if(Auth::user()->account_type == "admin" || Auth::user()->account_type == "normal" && strpos($account_options, "1") && $account_id = "[".Auth::user()->id."]")

@section('content')
<div class="container">
    <div class="container">
       <script src="js/sweetalert.min.js"></script>
  <link rel="stylesheet" href="css/sweetalert.css">
        <div class="row">
            <div class="col-sm-6">
                @include('silos.partials.prime')
            </div>

            <div class="col-sm-6">
                @include('silos.partials.waste')
            </div>
        </div>

        <div class="row">
            <div class="col-sm-12">
                <!-- START STOCK -->
                <div class="block">
                    <h1 class="block__title">Blocks</h1>

                    <div class="block__body">
                        <div class="row" style="width: 100%;">

                            <?php $i=0; ?>
                            @foreach( $blocks as $block )
                                <?php $i++ ?>
                                <div class="col-md-3 hm" >
                                    <div class="inner">
                                    <h4>{{  $block->name  }} <a href="{{ action('BlockController@edit', $block->id) }}">Edit</a> <a href="{{ url('blocks/delete', ['id' => $block->id]) }}">Delete</a><a href="{{ action('BlockController@create_length', $block->id) }}" class="pull-right">+</a></h4>

                                    @foreach( $block->length as $length)
                                    <div class="row">
                                        <div class="col-md-6">
                                            {{ $length->length/1000 }}m ({{ $length->stock }})
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
                                <div class="row" style="width: 100%;">
                                @endif
                            @endforeach

                        </div>
                    </div>
                </div>
                <!-- END STOCK -->
            </div>

            <div class="col-sm-6">
                <!-- START ADVANCED_DATA -->
                <div class="block">
                    <h1 class="block__title">Advanced Data</h1>
                    <div class="table">
            			<div class="tr table-header">
            				<div class="flex1">User</div>
            				<div class="flex1">Action</div>
            				<div class="flex2">Details</div>
            				<div class="flex1">Date and Time</div>
            			</div>

                        @foreach($logs as $log)
                            <div class="tr table-data">
                                <div class="flex1">{{$log->user}}</div>
                                <div class="flex1">{{$log->action}}</div>
                                <div class="flex2">{{ucfirst($log->details)}}</div>
                                <div class="flex1">{{$log->date}}</div>
                            </div>
                        @endforeach

                    </div>
                    <div class="block-body">
                        <div class="row"></div>
                    </div>
                </div>
                <!-- END ADVANCED_DATA -->
            </div>
        </div>
    </div>
</div>
@endsection
@else
    @include('layouts.noaccess')
@endif