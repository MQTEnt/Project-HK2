@extends('organization.layout.master')
@section('css.section')
@stop
@section('body.content')
<section class="content">
	<div class="container-fluid">
		<p><a href="{{route('organization.requirements.index')}}"><i class="fa fa-chevron-left" aria-hidden="true"></i> Trở lại danh sách</a></p>
		<form class="form-horizontal" role="form" method="POST" action="">
			{{ csrf_field() }}
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

			<div class="form-group">
				<label for="date" class="col-md-3 control-label">Thời gian từ</label>
				<div class="col-md-2">
					<input id="name" type="date" class="form-control" name="from_date" value="">
				</div>
				<label for="date" class="col-md-1 control-label">đến</label>
				<div class="col-md-2">
					<input id="name" type="date" class="form-control" name="to_date" value="">
				</div>
			</div>

			<div class="form-group{{ $errors->has('items') ? ' has-error' : '' }}">
				<label for="items" class="col-md-3 control-label">Danh sách vật phẩm</label>
				<div class="col-md-5">
					<textarea id="items" type="text" class="form-control" name="items" rows="5" cols="50">{{old('info')}}
					</textarea>
					@if ($errors->has('items'))
					<span class="help-block">
						<strong>{{ $errors->first('items') }}</strong>
					</span>
					@endif
				</div>
			</div>

			<div class="form-group{{ $errors->has('desc') ? ' has-error' : '' }}">
				<label for="desc" class="col-md-3 control-label">Ghi chú</label>

				<div class="col-md-5">
					<textarea id="desc" type="text" class="form-control" name="desc" rows="5" cols="50">{{old('desc')}}</textarea>
					@if ($errors->has('desc'))
					<span class="help-block">
						<strong>{{ $errors->first('desc') }}</strong>
					</span>
					@endif
				</div>
			</div>
			
			<div class="form-group{{ $errors->has('desc') ? ' has-error' : '' }}">
				<label for="desc" class="col-md-3 control-label">Bản kế hoạch</label>
				<div class="col-sm-5">
					<label class="btn btn-default btn-file">
						<i class="fa fa-cloud-upload" aria-hidden="true"></i> Browse <input type="file" class="hidden">
					</label>
					<span>File <i>.doc</i> hoặc <i>.pdf</i></span>
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