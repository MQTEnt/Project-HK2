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
			<p style="font-size: 150%" class="text-center">Danh sách các dự án của tổ chức <b>Org001</b></p>
		</div>
		<div class="row">
			<div class="col-sm-12">
				<table class="table table-hover">
				    <thead>
				      <tr>
				        <th>Mã dự án cứu trợ</th>
				        <th>Tên dự án cứu trợ</th>
				        <th>Trạng thái yêu cầu</th>
				      </tr>
				    </thead>
				    <tbody>
					    <tr class="approval-project" data-toggle="modal" data-target="#detail">
					        <td>DA001</td>
					        <td>Cứu trợ lũ lụt 2016</td>
					        <td><i class="fa fa-check-square-o" aria-hidden="true"></i> <b>Đã xác nhận</b></td>
					    </tr>
					    <tr class="pending-project" data-toggle="modal" data-target="#detail">
					       	<td>DA002</td>
					        <td>Cứu trợ lũ lụt 5/2016</td>
					        <td><i class="fa fa-question-circle-o" aria-hidden="true"></i> <i>Chưa xác nhận</i></td>
					    </tr>
					    <tr>
					        <td>DA003</td>
					        <td>Cứu trợ lũ lụt 1/2016</td>
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
							<ul>
								<li><b>Mã yêu cầu cứu trợ: </b>YC001</li>
								<li><b>Tên yêu cầu cứu trợ: </b>Cứu trợ lũ lụt 2016</li>
								<li><b>Tên địa phương: </b>Xã A, Huyện B, Tỉnh C</li>
								<li><b>Thiệt hại:</b>...</li>
							</ul>
							<form class="form-horizontal" role="form" method="POST" action="">
								{{ csrf_field() }}
								<div class="form-group">
									<label for="" class="col-md-4 control-label">Mã dự án cứu trợ</label>
									<div class="col-md-7">
										<p class="form-control">DA001</p>
									</div>
								</div>
								<div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
									<label for="" class="col-md-4 control-label">Tên dự án cứu trợ</label>
									<div class="col-md-7">
										<p class="form-control">Dự án cứu trợ ABC</p>
									</div>
								</div>

								<div class="form-group">
									<label for="date" class="col-md-4 control-label">Thời gian từ</label>
									<div class="col-md-3">
										<p class="form-control">11/01/2016</p>
									</div>
									<label for="date" class="col-md-1 control-label">đến</label>
									<div class="col-md-3">
										<p class="form-control">01/05/2016</p>
									</div>
								</div>

								<div class="form-group{{ $errors->has('items') ? ' has-error' : '' }}">
									<label for="items" class="col-md-4 control-label">Danh sách vật phẩm</label>
									<div class="col-md-7">
										<textarea id="items" type="text" class="form-control" name="items" rows="5" cols="50" disabled>{{old('info')}}
											- 100 thùng mì tôm
											- 100 yến gạo
											- 20 triệu đồng
										</textarea>
									</div>
								</div>

								<div class="form-group{{ $errors->has('desc') ? ' has-error' : '' }}">
									<label for="desc" class="col-md-4 control-label">Ghi chú</label>

									<div class="col-md-7">
									</div>
								</div>

								<div class="form-group" id="sltStat">
									<label for="stat" class="col-md-4 control-label">Tình trạng</label>

									<div class="col-md-7">
										<p class="form-control"><i class="fa fa-hourglass-half" aria-hidden="true"></i> Đang thực hiện</p>
									</div>
								</div>
							</form>
						<div class="modal-footer">
							<button type="button" class="btn btn-default" data-dismiss="modal">Đóng</button>
						</div>
					</div>
				</div>
			</div>
			<!-- End #approval-project -->
		</div>
	</div>
</section>
@stop