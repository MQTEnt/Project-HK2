@extends('admin.layout.master')
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
				        <th>Mã tổ chức</th>
				        <th>Tên tổ chức</th>
				        <th>Email</th>
				        <th>SĐT</th>
				        <th>Trạng thái</th>
				      </tr>
				    </thead>
				    <tbody>
					    <tr class="activeOrg" data-toggle="modal" data-target="#detail">
					        <td>ORG001</td>
					        <td>Tổ chức từ thiện A</td>
					        <td>tca@gmail.com</td>
					        <td>0123456789</td>
					        <td><i class="fa fa-smile-o" aria-hidden="true"></i> Hoạt động</td>
					    </tr>
					    <tr class="activeOrg" data-toggle="modal" data-target="#detail">
					        <td>ORG002</td>
					        <td>Tổ chức từ thiện B</td>
					        <td>tcb@gmail.com</td>
					        <td>0123456790</td>
					        <td><i class="fa fa-smile-o" aria-hidden="true"></i> Hoạt động</td>
					    </tr>
					    <tr class="banOrg" data-toggle="modal" data-target="#detail">
					        <td>ORG003</td>
					        <td>Tổ chức từ thiện c</td>
					        <td>tcc@gmail.com</td>
					        <td>0123456791</td>
					        <td><i class="fa fa-ban" aria-hidden="true"></i> Ngưng hoạt động</td>
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
								<li>Mã tổ chức: ORG001</li>
								<li>Tên tổ chức: Tổ chức từ thiện A</li>
								<li>Người khởi tạo: Nguyễn Văn A</li>
								<li>Ngày khởi tạo: 11/01/2016</li>
								<li>Email: tca@gmail.com</li>
								<li>SĐT: 0123456789</li>
								<li>Địa chỉ: Xã X, huyện Y, tỉnh Z</li>
								<li>Trạng thái: <span id="statActive"><b><i class="fa fa-smile-o" aria-hidden="true"></i> Hoạt động</b></span> <span id="statBan"><b><i class="fa fa-ban" aria-hidden="true"></i> Ngưng hoạt động</b></span></li>
								<li>Tổng số tiền cứu trợ: 100.000.000 VNĐ</li>
								<li>Điểm dánh giá: 100 điểm <i style="color: #bdbd1c" class="fa fa-star" aria-hidden="true"></i></li>
								<li><a href="#"><i class="fa fa-list" aria-hidden="true"></i> Danh sách dự án cứu trợ tham gia</a></li>
							</ul>
							
						</div>
						<div class="modal-footer">
							<a id="btnBan" href="#" class="btn btn-danger" data-toggle="modal" data-target="#note"><i class="fa fa-ban" aria-hidden="true"></i> Ngừng hoạt động</a>
							<a id="btnActive" href="#" class="btn btn-success"><i class="fa fa-smile-o" aria-hidden="true"></i> Hoạt động trở lại</a>
							<button type="button" class="btn btn-default" data-dismiss="modal">Đóng</button>
						</div>
					</div>
				</div>
			</div>

			<div id="note" class="modal fade" role="dialog">
				<div class="modal-dialog modal-sm">
					<!-- Modal content-->
					<div class="modal-content">
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal">&times;</button>
							<h4 class="modal-title">Lý do ngưng hoạt động</h4>
						</div>
						<div class="modal-body">
							<textarea name="" id="" cols="30" rows="10" class="form-control"></textarea>
						</div>
						<div class="modal-footer">
							<a href="#" class="btn btn-success"><i class="fa fa-floppy-o" aria-hidden="true"></i> Lưu</a>
							<button type="button" class="btn btn-default" data-dismiss="modal">Đóng</button>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>
<script>
	$(document).ready(function(){
		$('#btnActive').hide();
		$('#btnBan').hide();
		$('#statActive').hide();
		$('#statBan').hide();

		$('.activeOrg').click(function(){
			$('#btnActive').hide();
			$('#btnBan').show();
			$('#statActive').show();
			$('#statBan').hide();
		});

		$('.banOrg').click(function(){
			$('#btnActive').show();
			$('#btnBan').hide();
			$('#statActive').hide();
			$('#statBan').show();
		});
	});
</script>
@stop