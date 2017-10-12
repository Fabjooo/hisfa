@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="container">
            <div class="row">
                <div class="col-sm-6">
                    <div class="block">
                        <h2 class="block__title">Prime logs</h2>
                        <div class="table">
                            @include('logs.partials.header')
                            @foreach($prime_logs as $prime_log)
                                <div class="tr table-data">
                                    <div class="flex1">{{$prime_log->user}}</div>
                                    <div class="flex1">{{$prime_log->action}}</div>
                                    <div class="flex2">{{ucfirst($prime_log->details)}}</div>
                                    <div class="flex1">{{$prime_log->date}}</div>
                                </div>
                            @endforeach

                            {!!$prime_logs->appends(Request::except('primeLogs'))->render()!!}
                        </div>
                    </div>
                </div>

                <div class="col-sm-6">
                    <div class="block">
                        <h2 class="block__title">Waste logs</h2>
                        <div class="table">
                            @include('logs.partials.header')
                            @foreach($waste_logs as $waste_log)
                                <div class="tr table-data">
                                    <div class="flex1">{{$waste_log->user}}</div>
                                    <div class="flex1">{{$waste_log->action}}</div>
                                    <div class="flex2">{{ucfirst($waste_log->details)}}</div>
                                    <div class="flex1">{{$waste_log->date}}</div>
                                </div>
                            @endforeach

                            {!!$waste_logs->appends(Request::except('wasteLogs'))->render()!!}
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-sm-6">
                    <!-- START STOCK -->
                    <div class="block">
                        <h2 class="block__title">Stock logs</h2>
                        <div class="table">
                            @include('logs.partials.header')
                            @foreach($stock_logs as $stock_log)
                                <div class="tr table-data">
                                    <div class="flex1">{{$stock_log->user}}</div>
                                    <div class="flex1">{{$stock_log->action}}</div>
                                    <div class="flex2">{{ucfirst($stock_log->details)}}</div>
                                    <div class="flex1">{{$stock_log->date}}</div>
                                </div>
                            @endforeach

                            {!!$stock_logs->appends(Request::except('stockLogs'))->render()!!}
                        </div>
                    </div>
                    <!-- END STOCK -->
                </div>

                <div class="col-sm-6">
                    <!-- START STOCK -->
                    <div class="block">
                        <h2 class="block__title">Block logs</h2>
                        <div class="table">
                            @include('logs.partials.header')
                            @foreach($block_logs as $block_log)
                                <div class="tr table-data">
                                    <div class="flex1">{{$block_log->user}}</div>
                                    <div class="flex1">{{$block_log->action}}</div>
                                    <div class="flex2">{{ucfirst($block_log->details)}}</div>
                                    <div class="flex1">{{$block_log->date}}</div>
                                </div>
                            @endforeach

                            {!!$block_logs->appends(Request::except('blockLogs'))->render()!!}
                        </div>
                    </div>
                    <!-- END STOCK -->
                </div>
            </div>

            <div class="row">
                
            </div>

        </div>
    </div>
@endsection
