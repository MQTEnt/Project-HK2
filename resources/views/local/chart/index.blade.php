@extends('local.layout.master')
@section('css.section')
<!-- Charts -->
<link rel="stylesheet" href="/css/morris.css">
@stop
@section('js.section')
@stop
@section('body.content')
<section class="content">
	<div class="container-fluid">
		<div class="row">
			<h2 class="text-center"><i class="fa fa-bar-chart-o fa-fw"></i>Thống kê</h2>
		</div>
		<br>
		<div class="row">
			<div class="col-lg-6">
				<div class="panel panel-default">
					<div class="panel-heading">
						<b>Thống kê nguyên nhân cứu trợ các tháng trong năm</b>
					</div>
					<!-- /.panel-heading -->
					<div class="panel-body">
						<div class="form-horizontal">
							<p>Chọn năm:</p>
							<select name="" class="form-control">
								<option value="">2014</option>
								<option value="">2015</option>
								<option value="">2016</option>
							</select>
						</div>
						<div id="morris-bar-chart"></div>
					</div>
					<!-- /.panel-body -->
				</div>
				<!-- /.panel -->
			</div>

			<div class="col-lg-6">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <b>Thống kê nguyên nhân cứu trợ trong năm</b>
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                        	<div class="form-horizontal">
                        		<p>Chọn năm:</p>
                        		<select name="" class="form-control">
                        			<option value="">2014</option>
                        			<option value="">2015</option>
                        			<option value="">2016</option>
                        		</select>
                        	</div>
                        	<div class="flot-chart">
                                <div class="flot-chart-content" id="flot-pie-chart"></div>
                            </div>
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
        	</div>
		</div>
		<!-- /.row -->
		<div class="row">
			<div class="col-lg-6">
				<div class="panel panel-default">
					<div class="panel-heading">
					<b>Thống kê giá trị cứu trợ của các tổ chức cứu trợ trong năm</b>
					</div>
					<!-- /.panel-heading -->
					<div class="panel-body">
						<div class="form-horizontal">
							<p>Chọn năm:</p>
							<select name="" class="form-control">
								<option value="">2014</option>
								<option value="">2015</option>
								<option value="">2016</option>
							</select>
						</div>
						<div class="rank">
							<table class="table">
								<thead>
									<tr>
										<th>Số thứ tự</th>
										<th>Tên tổ chức</th>
										<th>Số tiền</th>
									</tr>
								</thead>
								<tbody>
									<tr>
										<td>1</td>
										<td>Tổ chức A</td>
										<td>100.000.000 VNĐ</td>
									</tr>      
									<tr class="success">
										<td>2</td>
										<td>Tổ chức B</td>
										<td>90.000.000 VNĐ</td>
									</tr>
									<tr class="danger">
										<td>3</td>
										<td>Tổ chức C</td>
										<td>80.000.000 VNĐ</td>
									</tr>
									<tr class="info">
										<td>4</td>
										<td>Tổ chức D</td>
										<td>70.000.000 VNĐ</td>
									</tr>
									<tr class="warning">
										<td>5</td>
										<td>Tổ chức E</td>
										<td>60.000.000 VNĐ</td>
									</tr>
								</tbody>
							</table>
						</div>
					</div>
					<!-- /.panel-body -->
				</div>
				<!-- /.panel -->
			</div>

			<div class="col-lg-6">
				<div class="panel panel-default">
					<div class="panel-heading">
					<b>Thống kê số điểm các tổ chức cứu trợ đạt được trong năm</b>
					</div>
					<!-- /.panel-heading -->
					<div class="panel-body">
						<div class="form-horizontal">
							<p>Chọn năm:</p>
							<select name="" class="form-control">
								<option value="">2014</option>
								<option value="">2015</option>
								<option value="">2016</option>
							</select>
						</div>
						<div class="rank">
							<table class="table">
								<thead>
									<tr>
										<th>Số thứ tự</th>
										<th>Tên tổ chức</th>
										<th>Số tiền</th>
									</tr>
								</thead>
								<tbody>
									<tr>
										<td>1</td>
										<td>Tổ chức A</td>
										<td>100 điểm</td>
									</tr>      
									<tr class="success">
										<td>2</td>
										<td>Tổ chức B</td>
										<td>80 điểm</td>
									</tr>
									<tr class="danger">
										<td>3</td>
										<td>Tổ chức C</td>
										<td>70 điểm</td>
									</tr>
									<tr class="info">
										<td>4</td>
										<td>Tổ chức D</td>
										<td>50 điểm</td>
									</tr>
									<tr class="warning">
										<td>5</td>
										<td>Tổ chức E</td>
										<td>30 điểm</td>
									</tr>
								</tbody>
							</table>
						</div>
					</div>
					<!-- /.panel-body -->
				</div>
				<!-- /.panel -->
			</div>
		</div>
    </div>
</section>
@stop
@section('js.end-section')
<!-- Charts -->
<script src="/js/raphael.min.js"></script>
<script src="/js/morris.min.js"></script>

<script src="/js/flot/excanvas.min.js"></script>
<script src="/js/flot/jquery.flot.js"></script>
<script src="/js/flot/jquery.flot.pie.js"></script>
<script src="/js/flot/jquery.flot.resize.js"></script>
<script src="/js/flot/jquery.flot.time.js"></script>
<script src="/js/flot/jquery.flot.tooltip.min.js"></script>

<script src="/js/data/morris-data.js"></script>
@stop