@extends('admin.layout.master')
@section('css.section')
<style>
	.li-city{
		cursor:pointer;
		font-size: 0.8em;
	}
	.li-district{
		cursor:pointer;
		font-size: 0.8em;
	}
	.li-town{
		cursor:pointer;
		font-size: 1em;
	}
	ul#list li{
		margin-bottom: 2%;
	}
	#li-btn{
		list-style-type:none;
	}
	.label-district{
		background: #395771;
	}
	.label-town{
		background: #a1a5a9;
	}
</style>
@stop
@section('body.content')
<section class="content">
	<div class="container-fluid">
		<div class="row">
			<div class="col-sm-4">
				<ul id="list">
					<li id="li-btn"><button type="button" class="btn btn-success"><span class="glyphicon glyphicon-plus"></span> Thêm mới</button></li>
					@foreach($cities as $city)
					<li>
						<span class="li-city label label-primary">{{$city->name}}</span>
					</li>
					<ul class="ul-district">
						@foreach($city->districts as $district)
						<li>
							<span class="li-district label label-district">{{$district->name}}</span>
						</li>
						<ul class="ul-town">
							<li class="li-town"><span class="label label-town">abc</span></li>
							<li class="li-town"><span class="label label-town">abc</span></li>
							<li class="li-town"><span class="label label-town">abc</span></li>
						</ul>
						@endforeach
					</ul>
					@endforeach
				</ul>
			</div>
			<div class="col-sm-8">
				<div class="row">
					<div class="col-sm-12">
						<button type="button" class="btn btn-warning"><span class="glyphicon glyphicon-wrench"></span> Sửa</button>
						<button type="button" class="btn btn-danger"><span class="glyphicon glyphicon-trash"></span> Xóa</button>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>
<script>
	$('document').ready(function(){
		$('.ul-district').hide();
		$('.ul-town').hide();

		$('.li-city').click(function(){
			$(this).parent().next().toggle();
		});
		$('.li-district').click(function(){
			$(this).parent().next().toggle();
		});
	});
</script>
@stop