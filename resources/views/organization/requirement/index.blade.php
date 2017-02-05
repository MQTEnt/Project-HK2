@extends('organization.layout.master')
@section('css.section')
<style>
	table{
		cursor: pointer;
	}
</style>
@stop
@section('body.content')
<section class="content">
	<div class="container-fluid">
		<div class="row">
			<div class="col-sm-12">
				<table class="table table-hover">
				    <thead>
				      <tr>
				        <th>Mã yêu cầu</th>
				        <th>Tên địa phương</th>
				        <th>Tên yêu cầu</th>
				        <th>Ngày nhập yêu cầu</th>
				        <th>Trạng thái yêu cầu</th>
				      </tr>
				    </thead>
				    <tbody>
					    @foreach($cities as $city)
						    @foreach($city->districts as $district)
						    	@foreach($district->towns as $town)
						    		@foreach($town->requirements as $requirement)
						    		<tr class="requirement-row" data-requirement-id="{{$requirement->id}}">
						    			<td>{{$requirement->id}}</td>
						    			<td>Xã {{$town->name}}, huyện {{$district->name}}, tỉnh {{$city->name}}</td>
						    			<td>{{$requirement->name}}</td>
						    			<td>{{date_format($requirement->created_at,"d/m/Y")}}</td>
						    			@if($requirement->stat==1)
						    				<td><i class="fa fa-check-square-o" aria-hidden="true"></i> <b>Đã xác nhận</b></td>
						    			@else
					        				<td><i class="fa fa-question-circle-o" aria-hidden="true"></i> <i>Chưa xác nhận</i></td>
						    			@endif
						    		</tr>
						    		@endforeach
						    	@endforeach
						    @endforeach
						@endforeach
				    </tbody>
				 </table>
			</div>
			<!-- Modal -->
			<div id="detail" class="modal fade" role="dialog">
				<div class="modal-dialog">
					<!-- Modal content-->
					<div class="modal-content">
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal">&times;</button>
							<h4 class="modal-title">Thông tin chi tiết</h4>
						</div>
						<div class="modal-body">
							<div>
								<div id="map" style="width:auto; height:200px"></div>
							</div>
							<ul>
								<li id="requirement_id"></li>
								<li id="requirement_name"></li>
								<li id="requirement_date"></li>
								<!-- <li id="requirement_stat">Trạng thái yêu cầu: <i class="fa fa-check-square-o" aria-hidden="true"></i> <b>Đã xác nhận</b></li> -->
								<li id="requirement_info"></li>
							</ul>
							<p class="text-center"><b>Danh sách các tổ chức tình nguyện đã đăng kí</b></p>
							<table class="table table-hover">
							    <thead>
							    	<tr>
							    		<th>Tên TCTN</th>
							    		<th>Tên dự án cứu trợ</th>
							    		<th>Ngày cứu trợ</th>
							    		<th>Trạng thái cứu trợ</th>
							    	</tr>
							    </thead>
							    <tbody>
								    <!-- <tr>
								        <td>Org001</td>
								        <td>Cứu trợ lũ lụt 2016</td>
								        <td>11/01/2017</td>
								        <td><i class="fa fa-check-square-o" aria-hidden="true"></i> <b>Đã xác nhận</b></td>
								    </tr>
								    <tr>
								        <td>Org001</td>
								        <td>Cứu trợ lũ lụt 2016</td>
								        <td>11/01/2017</td>
								        <td><i class="fa fa-check-square-o" aria-hidden="true"></i> <b>Đã xác nhận</b></td>
								    </tr>
								    <tr>
								        <td>Org001</td>
								        <td>Cứu trợ lũ lụt 2016</td>
								        <td>11/01/2017</td>
								        <td><i class="fa fa-question-circle-o" aria-hidden="true"></i> <i>Chưa xác nhận</i></td>
								    </tr> -->
							    </tbody>
							</table>
						</div>
						<div class="modal-footer">
							<a id="btnReg" href="#" class="btn btn-success"><i class="fa fa-share" aria-hidden="true"></i> Đăng kí</a>
							<button type="button" class="btn btn-default" data-dismiss="modal">Đóng</button>
						</div>
					</div>
				</div>
			</div>
			<!-- End #listOrgModal -->
		</div>
	</div>
</section>
<script>
	$(document).ready(function(){
		var marker;
		var map;

		$('.requirement-row').click(function(){
			requirement_id = $(this).attr('data-requirement-id');
			$.get("/requirement/"+requirement_id, function(data, status){
				requirement = data[0];
				$('#requirement_id').html('Mã yêu cầu cứu trợ: <b>'+requirement.id+'</b>');
				$('#requirement_name').html('Tên yêu cầu cứu trợ: <b>'+requirement.name+'</b>');
				$('#requirement_date').html('Ngày yêu cầu: <b>'+requirement.created_at+'</b>');
				$('#requirement_info').html('Thiệt hại: <b>'+requirement.info+'</b>');
				if(requirement.stat==1)
				{
					$('#btnReg').attr('href', '/organization/projects/create/'+requirement_id);
					$('#btnReg').show();
				}
				else
				{
					$('#btnReg').hide();
				}
				$("#detail").modal();
				google.maps.event.addDomListener(window, 'load', initMap(parseFloat(requirement.towns.lat), parseFloat(requirement.towns.lon)));
	   		});
		});
		function initMap(lat, lon) {
			map = new google.maps.Map(document.getElementById('map'), {
				zoom: 13,
				center: {lat: lat+0.02, lng: lon-0.05}
			});
			marker = new google.maps.Marker({
				map: map,
				draggable: true,
				animation: google.maps.Animation.DROP,
				position: {lat: lat, lng: lon}
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

		/*
		* Solution when show Google Map on Bootstrap Modal
		*/
		$('#detail').on('shown.bs.modal',function(){
			google.maps.event.trigger(map, "resize");
		});
	});
</script>
@stop