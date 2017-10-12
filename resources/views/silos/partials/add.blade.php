@section('content')
    <div class="container full-height center">
        @if($type == "waste")
            <form id="silo--toevoegen" class="row flex-row edit-silo" action="{{ URL('/silos/waste/add')}}" method="post">
        @elseif($type == "prime")
            <form id="silo--toevoegen" class="row flex-row edit-silo" action="{{ URL('/silos/prime/add')}}" method="post">
        @endif
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <div class="col-xs-12 col-sm-4 block"> 
                <div class="silo__image">
                    <div class="silo__image__top empty"></div>
                    <div class="silo__image__middle empty"></div>
                    <div class="silo__image__bottom empty"></div>
                </div>
            </div>


            <div class="col-xs-12 col-sm-8 block">
                <div class="input-control">
                    <label for="contents">Silo contents</label>
                    <input type="text" name="contents" class="silo-add-contents" value="">
                </div>

                <div class="input-control">
                    <label for="number">Silo number</label>
                    <input type="number" name="number" class="silo-add-number" value="">
                </div>

                <div class="input-control">
                    <label for="type">Silo Type</label>
                    <label>{{$type}}</label>
				</div>

				<div class="input-control">
                    <label for="volume">Silo volume</label>
                    <input type="number" max="100" class="silo-add-volume" name="volume" value="">
				</div>

                <input type="submit" name="submit" class="btn btn-success" id="siloAdd_submit" value="Add silo">
            </div>
        </form>
    </div>
@endsection
