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
					    <tr data-toggle="modal" data-target="#detail">
					        <td>YC001</td>
					        <td>Xã A, huyện B, tỉnh C</td>
					        <td>Cứu trợ lũ lụt 2016</td>
					        <td>11/01/2017</td>
					        <td><i class="fa fa-check-square-o" aria-hidden="true"></i> <b>Đã xác nhận</b></td>
					    </tr>
					    <tr>
					        <td>YC002</td>
					        <td>Xã X, huyện Y, tỉnh Z</td>
					        <td>Cứu trợ Xã X 2016</td>
					        <td>10/01/2016</td>
					        <td><i class="fa fa-question-circle-o" aria-hidden="true"></i> <i>Chưa xác nhận</i></td>
					    </tr>
					    <tr>
					        <td>YC003</td>
					        <td>Xã M, huyện P, tỉnh Q</td>
					        <td>Cứu trợ 2016</td>
					        <td>10/01/2016</td>
					        <td><i class="fa fa-question-circle-o" aria-hidden="true"></i> <i>Chưa xác nhận</i></td>
					    </tr>
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
								<li>Mã yêu cầu: YC001</li>
								<li>Tên địa phương: Xã A, huyện B, tỉnh C</li>
								<li>Ngày nhập yêu cầu: 11/01/2016</li>
								<li>Trạng thái yêu cầu: <i class="fa fa-check-square-o" aria-hidden="true"></i> <b>Đã xác nhận</b></li>
								<li>Thiệt hại ...</li>
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
								        <td><i class="fa fa-check-square-o" aria-hidden="true"></i> <b>Đã xác nhận</b></td>
								    </tr>
								    <tr>
								        <td>Org001</td>
								        <td>Cứu trợ lũ lụt 2016</td>
								        <td>11/01/2017</td>
								        <td><i class="fa fa-question-circle-o" aria-hidden="true"></i> <i>Chưa xác nhận</i></td>
								    </tr>
							    </tbody>
							</table>
						</div>
						<div class="modal-footer">
							<a href="{{route('organization.projects.create')}}" class="btn btn-success"><i class="fa fa-share" aria-hidden="true"></i> Đăng kí</a>
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
  var marker;
  function initMap() {
    var map = new google.maps.Map(document.getElementById('map'), {
      zoom: 13,
      center: {lat: 21.401933838235188, lng: 104.78759765625}
    });

    marker = new google.maps.Marker({
      map: map,
      draggable: true,
      animation: google.maps.Animation.DROP,
      position: {lat: 21.401933838235188, lng: 104.78759765625}
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
@stop