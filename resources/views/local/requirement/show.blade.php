@extends('local.layout.master')
@section('css.section')
@stop
@section('body.content')
<section class="content">
	<div class="container-fluid">
		<p><a href="{{route('local.requirements.index')}}"><i class="fa fa-chevron-left" aria-hidden="true"></i> Trở lại danh sách</a></p>
		<div class="row">
			<div class="col-sm-8 col-sm-offset-2">
				<div id="map" style="width:auto; height:300px"></div>
			</div>
		</div>
		<div class="row">
			<label class="col-sm-3 col-sm-offset-2">Địa phương</label>
			<div class="col-sm-5">
				<p>{{$requirement->towns->name}}</p>
				<p>{{'Huyện '.$requirement->towns->districts->name}}</p>
				<p>{{'Tỉnh/Thành phố '.$requirement->towns->districts->cities->name}}</p>
			</div>
		</div>
		<br>
		<div class="row">
			<label class="col-sm-3 col-sm-offset-2">Tên yêu cầu cứu trợ</label>
			<div class="col-sm-5">
				<p>{{$requirement->name}}</p>
			</div>
		</div>
		<div class="row">
			<label class="col-sm-3 col-sm-offset-2">Thông tin thiệt hại</label>
			<div class="col-sm-5">
				<p>{{$requirement->info}}</p>
			</div>
		</div>
		<div class="row">
			<label class="col-sm-3 col-sm-offset-2">Ghi chú</label>
			<div class="col-sm-5">
				<p>{{$requirement->desc}}</p>
			</div>
		</div>
		<div class="row">
			<label class="col-sm-3 col-sm-offset-2">Ngày lập yêu cầu:</label>
			<div class="col-sm-5">
				<p>{{$requirement->created_at->format('d-m-Y')}}</p>
			</div>
		</div>
		<div class="row">
			<label class="col-sm-3 col-sm-offset-2">Tình trạng</label>
			<div class="col-sm-5">
				<p>
					@if($requirement->stat==0)
						<i class="fa fa-question-circle-o" aria-hidden="true"></i> <i>Chưa xác nhận</i>
					@else
						@if($requirement->stat==1)
						<i class="fa fa-check-square-o" aria-hidden="true"></i> <b>Đã xác nhận</b>
						@else
						<i class="fa fa-times" aria-hidden="true"></i> <b>Đã từ chối</b>
						@endif
					@endif
				</p>
			</div>
		</div>
		<div class="row" style="margin-bottom: 50px;">
			<div class="col-sm-5 pull-right">
				<a href="{{route('local.requirements.edit',$requirement->id)}}" class="btn btn-warning"><span class="glyphicon glyphicon-wrench"></span> Cập nhật</a>
				<a id="btn-delete" href="{{route('local.requirements.destroy', $requirement->id)}}" class="btn btn-danger"><span class="glyphicon glyphicon-trash"></span> Xóa</a>
			</div>
		</div>
	</div>
</section>
<script>
  var marker;
  function initMap() {
    var map = new google.maps.Map(document.getElementById('map'), {
      zoom: 13,
      center: {lat: {{$requirement->towns->lat}}, lng: {{$requirement->towns->lon}}}
    });

    marker = new google.maps.Marker({
      map: map,
      draggable: true,
      animation: google.maps.Animation.DROP,
      position: {lat: {{$requirement->towns->lat}}, lng: {{$requirement->towns->lon}}}
    });
    marker.addListener('click', toggleBounce);
  }

  function toggleBounce() {
    if (marker.getAnimation() !== null) {
      marker.setAnimation(null);
    } else {
      marker.setAnimation(google.maps.Animation.BOUNCE);
    }
  }
  google.maps.event.addDomListener(window, 'load', initMap());
</script>
<script>
	$(document).ready(function(){
		$('#btn-delete').click(function(){
			return confirm('Bạn có chắc muốn xóa yêu cầu cứu trợ này?');
		});
	});
</script>
@stop