@extends('layouts.reset')

<!-- Main Content -->
@section('content')
            <div class="stock-edit">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form class="stock-edit__form" role="form" method="POST" action="{{ url('/password/email') }}">
                        {{ csrf_field() }}
                        <div class="input-control"><p class="block__title">Reset Password</p></div>
                        <div class="input-control{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label for="email" class="col-md-4 control-label">E-Mail Address</label>
</div>
                            <div class="input-control">
                                <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required>

                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>


                        <div class="input-control">
                                <button type="submit" class="btn btn-success">
                                    Send Password Reset Link
                                </button>
                        </div>
                        <div class="input-control">
                            <a href="/login" class="btn btn-danger">Go back to login</a>
                        </div>
                    </form>
            </div>
@endsection
