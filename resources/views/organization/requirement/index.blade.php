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
				<a href="#" class="btn btn-success"><i class="fa fa-share" aria-hidden="true"></i> Đăng kí cứu trợ</a>
			</div>
		</div>
		<div class="row">
			<div class="col-sm-12">
				<table class="table table-hover">
				    <thead>
				      <tr>
				        <th>Mã yêu cầu</th>
				        <th>Tên địa phương</th>
				        <th>Ngày nhập yêu cầu</th>
				        <th>Trạng thái yêu cầu</th>
				        <th>Thiệt hại</th>
				        <th>Danh sách TCTN</th>
				      </tr>
				    </thead>
				    <tbody>
					    <tr>
					        <td>YC001</td>
					        <td>Xã A, huyện B, tỉnh C</td>
					        <td>11/01/2017</td>
					        <td><b>Đã xác nhận</b></td>
					        <td>Thiệt hại...</td>
					        <td><i class="fa fa-list-ul" aria-hidden="true" data-toggle="modal" data-target="#listOrgModal"></i></td>
					    </tr>
					    <tr>
					        <td>YC002</td>
					        <td>Xã X, huyện Y, tỉnh Z</td>
					        <td>10/01/2017</td>
					        <td><i>Chưa xác nhận</i></td>
					        <td>Thiệt hại...</td>
					        <td><i class="fa fa-list-ul" aria-hidden="true" data-toggle="modal" data-target="#listOrgModal"></i></td>
					    </tr>
					    <tr>
					        <td>YC003</td>
					        <td>Xã M, huyện P, tỉnh Q</td>
					        <td>10/01/2017</td>
					        <td><i>Chưa xác nhận</i></td>
					        <td>Thiệt hại...</td>
					        <td><i class="fa fa-list-ul" aria-hidden="true" data-toggle="modal" data-target="#listOrgModal"></i></td>
					    </tr>
				    </tbody>
				 </table>
			</div>
			<!-- Modal -->
			<div id="listOrgModal" class="modal fade" role="dialog">
				<div class="modal-dialog">
					<!-- Modal content-->
					<div class="modal-content">
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal">&times;</button>
							<h4 class="modal-title">Danh sách các tổ chức tình nguyện được cấp phép cứu trợ</h4>
						</div>
						<div class="modal-body">
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
								        <td><b>Đã xác nhận</b></td>
								    </tr>
								    <tr>
								        <td>Org001</td>
								        <td>Cứu trợ lũ lụt 2016</td>
								        <td>11/01/2017</td>
								        <td><b>Đã xác nhận</b></td>
								    </tr>
								    <tr>
								        <td>Org001</td>
								        <td>Cứu trợ lũ lụt 2016</td>
								        <td>11/01/2017</td>
								        <td><b>Đã xác nhận</b></td>
								    </tr>
							    </tbody>
							</table>
						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-default" data-dismiss="modal">Đóng</button>
						</div>
					</div>
				</div>
			</div>
			<!-- End #listOrgModal -->
		</div>
	</div>
</section>
@stop