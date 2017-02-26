@extends('admin.layout.master')
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
			<!-- <div class="col-lg-6">
				<div class="panel panel-default">
					<div class="panel-heading">
						<b>Thống kê nguyên nhân cứu trợ các tháng trong năm</b>
					</div>
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
				</div>
			</div> -->

			<div class="col-lg-6">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <b>Thống kê nguyên nhân cứu trợ trong năm</b>
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                        	<div style="overflow: hidden; margin-bottom: 20px;">
                        		<div class="col-sm-6">
                        			<input id="year" type="number" class="form-control">
                        		</div>
                        		<div class="col-sm-6">
                        			<button id="btnSelectYear" class="btn btn-primary pull-right">Chọn</button>
                        		</div>
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
					<b>Top 5 dự án có giá trị cứu trợ nhiều nhất</b>
					</div>
					<!-- /.panel-heading -->
					<div class="panel-body">
						<div class="rank">
							<table class="table">
								<thead>
									<tr>
										<th>Số thứ tự</th>
										<th>Tên dự án</th>
										<th>Số tiền</th>
									</tr>
								</thead>
								<tbody>
									@foreach($projectEval as $index => $item)
									@if($index == 0)
										<tr class="success">
									@else
										<tr>
									@endif
											@if($index == 0)
												<td>{{$index+1}}<i style="color: #e28a2b;" class="fa fa-diamond"></i></td>
											@else
												<td>{{$index+1}}</td>
											@endif
											<td>{{$item->name}}</td>
											<td>{{$item->money}}</td>
										</tr>
									@endforeach
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
					<b>Top 5 dự án được đánh giá cao nhất</b>
					</div>
					<!-- /.panel-heading -->
					<div class="panel-body">
						<div class="rank">
							<table class="table">
								<thead>
									<tr>
										<th>Số thứ tự</th>
										<th>Tên dự án</th>
										<th>Điểm đánh giá</th>
									</tr>
								</thead>
								<tbody>
									@foreach($projectRating as $index => $item)
									@if($index == 0)
										<tr class="success">
									@else
										<tr>
									@endif
											@if($index == 0)
												<td>{{$index+1}}<i style="color: #e28a2b;" class="fa fa-diamond"></i></td>
											@else
												<td>{{$index+1}}</td>
											@endif
											<td>{{$item->name}}</td>
											<td>
												<?php for ($i=0; $i < $item->rating ; $i++) { 
													echo "<i style='color: #ada016;' class='fa fa-star'></i>";
												} ?>
											</td>
										</tr>
									@endforeach
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
<script>
	$(document).ready(function(){
		$('#year').val(new Date().getFullYear());
		$('#btnSelectYear').click(function(){
			year = $('#year').val();
			$.get('/requirements/reason/'+year,function(recievedData){
		        data = recievedData;
		        if(data.length == 0)
		        {
		        	$('.flot-chart').hide();
		        	return	
		        }
		        $('.flot-chart').show();
		        var plotObj = $.plot($("#flot-pie-chart"), data, {
		            series: {
		                pie: {
		                    show: true
		                }
		            },
		            grid: {
		                hoverable: true
		            },
		            tooltip: true,
		            tooltipOpts: {
		                content: "%p.0%, %s", // show percentages, rounding to 2 decimal places
		                shifts: {
		                    x: 20,
		                    y: 0
		                },
		                defaultTheme: false
		            }
		        });
		   	});
		});
	});
</script>
@stop