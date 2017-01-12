@extends('local.layout.master')
@section('css.section')
@stop
@section('body.content')
<section class="content">
	<div class="container-fluid">
		<p><a href="{{route('local.requirements.index')}}"><i class="fa fa-chevron-left" aria-hidden="true"></i> Trở lại danh sách</a></p>
		<form class="form-horizontal" role="form" method="POST" action="{{route('local.requirements.store')}}">
			{{ csrf_field() }}
			<div class="form-group{{ $errors->has('town_id') ? ' has-error' : '' }}">
				<label for="town_id" class="col-md-3 control-label">Địa phương</label>

				<div class="col-md-5">
					<select class="form-control" name="town_id">
						<option selected>Chọn một địa phương</option>
						@foreach($districts as $district)
							<optgroup label="{{'Huyện '.$district->name}}">
							@foreach($district->towns as $town)
								<option value="{{$town->id}}">{{$town->name}}</option>
							@endforeach
							</optgroup>
						@endforeach
					</select>
					@if ($errors->has('town_id'))
					<span class="help-block">
						<strong>{{ $errors->first('town_id') }}</strong>
					</span>
					@endif
				</div>
			</div>
			
			<div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
				<label for="name" class="col-md-3 control-label">Tên dự án cứu trợ</label>

				<div class="col-md-5">
					<input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}">

					@if ($errors->has('name'))
					<span class="help-block">
						<strong>{{ $errors->first('name') }}</strong>
					</span>
					@endif
				</div>
			</div>

			<div class="form-group{{ $errors->has('info') ? ' has-error' : '' }}">
				<label for="info" class="col-md-3 control-label">Thông tin thiệt hại</label>

				<div class="col-md-5">
					<textarea id="info" type="text" class="form-control" name="info" rows="5" cols="50">{{old('info')}}
					</textarea>

					@if ($errors->has('info'))
					<span class="help-block">
						<strong>{{ $errors->first('info') }}</strong>
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
			<div class="form-group">
				<div class="col-md-8">
					<input type="submit" value="Đăng ký" class="btn btn-success pull-right">
				</div>
			</div>
		</form>
	</div>
</section>
@stop