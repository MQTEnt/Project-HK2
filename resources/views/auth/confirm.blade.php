@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Xác minh số điện thoại</div>
                <div class="panel-body">
                    <form class="form-horizontal" role="form" method="POST" action="{{ url('/postConfirm') }}">
                        {{ csrf_field() }}

                        <input type="hidden" class="form-control" name="email" value="{{$email}}">
                        @if(!is_null($message))
                        <div class="alert alert-danger">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                            <strong>Lỗi</strong> {{$message}}
                        </div>
                        @endif
                        <div class="form-group">
                            <label class="col-md-12"><i class="fa fa-key" aria-hidden="true"></i> Nhập mã xác minh được gửi về số điện thoại đã đăng kí</label>
                        </div>
                        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                            <label for="key" class="col-md-4 control-label">Mã xác minh</label>

                            <div class="col-md-6">
                                <input id="key" type="text" class="form-control" name="key" value="{{ old('name') }}">

                                @if ($errors->has('key'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('key') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    <i class="fa fa-btn fa-user"></i> Confirm
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
