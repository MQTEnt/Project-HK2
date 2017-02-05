@extends('organization.layout.master')
@section('css.section')
@stop
@section('body.content')
<section class="content">
	<div class="container-fluid">
		<p><a href="{{route('organization.requirements.index')}}"><i class="fa fa-chevron-left" aria-hidden="true"></i> Trở lại danh sách</a></p>
		<form class="form-horizontal" role="form" method="POST" action="{{route('organization.project.store')}}" enctype="multipart/form-data">
			{{ csrf_field() }}
			<input type="hidden" name="requirement_id" value="{{$requirement_id}}">
			<div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
				<label for="" class="col-md-3 control-label">Tên dự án cứu trợ</label>
				<div class="col-md-5">
					<input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}">
					@if ($errors->has('name'))
					<span class="help-block">
						<strong>{{ $errors->first('name') }}</strong>
					</span>
					@endif
				</div>
			</div>

			<div class="form-group{{ $errors->has('from_date')||$errors->has('to_date') ? ' has-error' : '' }}">
				<label for="date" class="col-md-3 control-label">Thời gian từ</label>
				<div class="col-md-2">
					<input type="date" class="form-control" name="from_date" value="{{old('from_date')}}">
					@if ($errors->has('from_date'))
					<span class="help-block">
						<strong>{{ $errors->first('from_date') }}</strong>
					</span>
					@endif
				</div>
				<label for="date" class="col-md-1 control-label">đến</label>
				<div class="col-md-2">
					<input type="date" class="form-control" name="to_date" value="{{old('to_date')}}">
					@if ($errors->has('to_date'))
					<span class="help-block">
						<strong>{{ $errors->first('to_date') }}</strong>
					</span>
					@endif
				</div>
			</div>

			<div class="form-group{{ $errors->has('items') ? ' has-error' : '' }}">
				<label for="items" class="col-md-3 control-label">Danh sách vật phẩm</label>
				<div class="col-md-5">
					<textarea id="items" type="text" class="form-control" name="items" rows="5" cols="50">{{old('items')}}</textarea>
					@if ($errors->has('items'))
					<span class="help-block">
						<strong>{{ $errors->first('items') }}</strong>
					</span>
					@endif
				</div>
			</div>

			<div class="form-group{{ $errors->has('note') ? ' has-error' : '' }}">
				<label for="note" class="col-md-3 control-label">Ghi chú</label>

				<div class="col-md-5">
					<textarea id="desc" type="text" class="form-control" name="note" rows="5" cols="50">{{old('note')}}</textarea>
					@if ($errors->has('note'))
					<span class="help-block">
						<strong>{{ $errors->first('note') }}</strong>
					</span>
					@endif
				</div>
			</div>
			
			<div class="form-group{{ $errors->has('plan') ? ' has-error' : '' }}">
				<label for="plan" class="col-md-3 control-label">Bản kế hoạch</label>
				<div class="col-sm-5">
					<label class="btn btn-default btn-file">
						<i class="fa fa-cloud-upload" aria-hidden="true"></i> Browse <input type="file" name="plan" class="hidden" value="{{old('plan')}}">
					</label>
					<span>File <i>.doc</i> hoặc <i>.pdf</i></span>
					@if ($errors->has('plan'))
					<span class="help-block">
						<strong>{{ $errors->first('plan') }}</strong>
					</span>
					@endif
				</div>
			</div>

			<div class="form-group">
				<div class="col-md-8">
					<input type="submit" value="Đăng ký" class="btn btn-success pull-right">
				</div>
			</div>
		</form>
	</div>
</section>
@stop