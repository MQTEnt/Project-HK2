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
										<input id="name" type="text" class="form-control" name="name" value="Dự án cứu trợ ABC">
										@if ($errors->has('name'))
										<span class="help-block">
											<strong>{{ $errors->first('name') }}</strong>
										</span>
										@endif
									</div>
								</div>

								<div class="form-group">
									<label for="date" class="col-md-4 control-label">Thời gian từ</label>
									<div class="col-md-3">
										<input id="name" type="date" class="form-control" name="from_date" value="2016-01-11">
									</div>
									<label for="date" class="col-md-1 control-label">đến</label>
									<div class="col-md-3">
										<input id="name" type="date" class="form-control" name="to_date" value="2016-05-01">
									</div>
								</div>

								<div class="form-group{{ $errors->has('items') ? ' has-error' : '' }}">
									<label for="items" class="col-md-4 control-label">Danh sách vật phẩm</label>
									<div class="col-md-7">
										<textarea id="items" type="text" class="form-control" name="items" rows="5" cols="50">{{old('info')}}
											- 100 thùng mì tôm
											- 100 yến gạo
											- 20 triệu đồng
										</textarea>
										@if ($errors->has('items'))
										<span class="help-block">
											<strong>{{ $errors->first('items') }}</strong>
										</span>
										@endif
									</div>
								</div>

								<div class="form-group{{ $errors->has('desc') ? ' has-error' : '' }}">
									<label for="desc" class="col-md-4 control-label">Ghi chú</label>

									<div class="col-md-7">
										<textarea id="desc" type="text" class="form-control" name="desc" rows="5" cols="50">{{old('desc')}}</textarea>
										@if ($errors->has('desc'))
										<span class="help-block">
											<strong>{{ $errors->first('desc') }}</strong>
										</span>
										@endif
									</div>
								</div>

								<div class="form-group" id="sltStat">
									<label for="stat" class="col-md-4 control-label">Tình trạng</label>

									<div class="col-md-7">
										<select name="stat" class="form-control" style="font-family: FontAwesome, sans-serif;">
											<option value="">&#xf252; Đang thực hiện</option>
											<option value="">&#xf274; Kết thúc</option>
											<option value="">&#xf06a; Hoãn dự án</option>
										</select>
									</div>
								</div>
							</form>
						<div class="modal-footer">
							<a id="btnDelete" class="btn btn-danger"><i class="glyphicon glyphicon-trash" aria-hidden="true"></i> Xóa</a>
							<a id="btnUpdate" class="btn btn-info"><i class="glyphicon glyphicon-wrench" aria-hidden="true"></i> Cập nhật</a>
							<button type="button" class="btn btn-default" data-dismiss="modal">Đóng</button>
						</div>
					</div>
				</div>
			</div>
			<!-- End #approval-project -->
		</div>
	</div>
</section>
<script>
	$(document).ready(function(){
		$('tr.approval-project').click(function(){
			$('#sltStat').show();
			$('#btnUpdate').show();
			$('#btnDelete').hide();
		});
		$('tr.pending-project').click(function(){
			$('#sltStat').hide();
			$('#btnUpdate').hide();
			$('#btnDelete').show();
		});
	});
</script>
@stop