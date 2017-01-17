@extends('admin.layout.master')
@section('css.section')
<style>
	table{
		cursor: pointer;
	}
	.search .panel-title{
		cursor: pointer;
	}
	.search .control-label{
		text-align: left;
	}
</style>
<link rel="stylesheet" href="/css/star-rating.min.css" media="all" rel="stylesheet" type="text/css"/>
@stop
@section('js.section')
<!-- Star Rating -->
<script src="/js/star-rating.min.js" type="text/javascript"></script>
@stop
@section('body.content')
<section class="content">
	<div class="container-fluid">
		<div class="row">
			<p style="font-size: 150%" class="text-center">Danh sách các dự án cứu trợ</p>
		</div>
		<div class="row search">
			<div class="col-sm-12">
				<div class="panel panel-primary">
					<div class="panel-heading">
					<h3 class="panel-title">Tìm kiếm <i class="fa fa-chevron-down" aria-hidden="true"></i></h3>
					</div>
					<div class="panel-body">
						<form action="#" class="form-horizontal">
							<div class="form-group">
								<label for="" class="col-sm-2 control-label">Tên dự án cứu trợ</label>
								<div class="col-sm-9">
									<input type="text" class="form-control">
								</div>
							</div>
							<div class="form-group">
								<label for="" class="col-sm-2 control-label">Tổ chức</label>
								<div class="col-sm-9">
									<input type="text" class="form-control">
								</div>
							</div>
							<div class="form-group">
								<label for="" class="col-sm-2 control-label">Địa phương</label>
								<div class="col-sm-9">
									<input type="text" class="form-control">
								</div>
							</div>
							<div class="form-group">
								<label for="" class="col-sm-2 control-label">Từ ngày</label>
								<div class="col-sm-4">
									<input type="date" class="form-control">
								</div>
								<label for="" class="col-sm-1 control-label">đến</label>
								<div class="col-sm-4">
									<input type="date" class="form-control">
								</div>
							</div>
							<div class="form-group">
								<div class="col-sm-11">
									<a href="#" class="btn btn-primary pull-right"><i class="fa fa-search" aria-hidden="true"></i> Tìm kiếm</a>
								</div>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-sm-12">
				<table class="table table-hover">
				    <thead>
				      <tr>
				        <th>Mã dự án cứu trợ</th>
				        <th>Tên dự án cứu trợ</th>
				        <th>Tổ chức</th>
				        <th>Trạng thái yêu cầu</th>
				      </tr>
				    </thead>
				    <tbody>
					    <tr data-toggle="modal" data-target="#detail">
					        <td>DA001</td>
					        <td>Cứu trợ lũ lụt 2016</td>
					        <td>Org001</td>
					        <td><i class="fa fa-check-square-o" aria-hidden="true"></i> <b>Đã xác nhận</b></td>
					    </tr>
					    <tr data-toggle="modal" data-target="#detail">
					       	<td>DA002</td>
					        <td>Cứu trợ lũ lụt 5/2016</td>
					        <td>Org003</td>
					        <td><i class="fa fa-check-square-o" aria-hidden="true"></i> <b>Đã xác nhận</b></td>
					    </tr>
					    <tr>
					        <td>DA003</td>
					        <td>Cứu trợ lũ lụt 1/2016</td>
					        <td>Org002</td>
					        <td><i class="fa fa-check-square-o" aria-hidden="true"></i> <b>Đã xác nhận</b></td>
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

								<div class="form-group">
									<label for="" class="col-md-4 control-label">Tổ chức</label>
									<div class="col-md-7">
										<p class="form-control">Org001</p>
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
								
								<div class="form-group{{ $errors->has('desc') ? ' has-error' : '' }}">
									<label for="desc" class="col-md-4 control-label">Bản kế hoạch cứu trợ</label>
									<div class="col-md-7">
										<p class="form-control"><a href="/temp/temp.docx"><i class="fa fa-file-text-o" aria-hidden="true"></i> Kế hoạch cứu trợ - Org001.doc</a></p>
									</div>
								</div>

								<div class="form-group" id="sltStat">
									<label for="stat" class="col-md-4 control-label">Tình trạng</label>

									<div class="col-md-7">
										<p class="form-control"><i class="fa fa-check-circle-o" aria-hidden="true"></i> Đã hoàn thành</p>
									</div>
								</div>

								<div class="form-group" id="total">
									<label for="stat" class="col-md-4 control-label">Giá trị ước tính</label>

									<div class="col-md-7">
										<input type="number" name="total"> <span><i>Đơn vị VNĐ</i></span>
									</div>
								</div>

								<div class="form-group">
									<label for="stat" class="col-md-4 control-label">Đánh giá</label>

									<div class="col-md-7">
										<input id="rating-input" type="number"/>
									</div>
								</div>
							</form>
						<div class="modal-footer">
							<button id="btnAccept" type="button" class="btn btn-success"><i class="fa fa-floppy-o" aria-hidden="true"></i> Lưu</button>
							<button id="btnClose" type="button" class="btn btn-default" data-dismiss="modal">Đóng</button>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>
<script>
	$(document).ready(function(){
		$('.search .panel-body').hide();
		$('.search .panel-title').click(function(){
			$('.search .panel-body').slideToggle("slow");
		});

		$('#rating-input').rating({
              min: 0,
              max: 5,
              step: 1,
              size: 'sm',
              showClear: false,
              showCaption: false
           });
	});
</script>
@stop