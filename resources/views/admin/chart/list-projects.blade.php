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
				    	@foreach($projects as $project)
				    	<tr class="approval-project project-row" data-project_id="{{$project->id}}">
			    			<td>{{$project->id}}</td>
			    			<td>{{$project->name}}</td>
			    			<td>Org001</td>
			    			<td><i class="fa fa-check-square-o" aria-hidden="true"></i> <b>Đã xác nhận</b></td>
				    	</tr>
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
							{{ csrf_field() }}
						</div>
						<div class="modal-body">
							<ul>
								<li id="requirement_id"></li>
								<li id="requirement_name"></li>
								<li id="town_name"></li>
								<li id="requirement_info"></li>
							</ul>
							<div class="form-horizontal">
								<div class="form-group">
									<label for="" class="col-md-4 control-label">Mã dự án cứu trợ</label>
									<div class="col-md-7">
										<p id="project_id" class="form-control"></p>
									</div>
								</div>

								<div class="form-group">
									<label for="" class="col-md-4 control-label">Tên tổ chức tình nguyện</label>
									<div class="col-md-7">
										<p id="project_user_id" class="form-control">Org001</p>
									</div>
								</div>

								<div class="form-group">
									<label for="" class="col-md-4 control-label">Tên dự án cứu trợ</label>
									<div class="col-md-7">
										<p id="project_name" class="form-control"></p>
									</div>
								</div>

								<div class="form-group">
									<label for="date" class="col-md-4 control-label">Thời gian từ</label>
									<div class="col-md-3">
										<p id="project_from_date" class="form-control"></p>
									</div>
									<label for="date" class="col-md-1 control-label">đến</label>
									<div class="col-md-3">
										<p id="project_to_date" class="form-control"></p>
									</div>
								</div>

								<div class="form-group">
									<label for="items" class="col-md-4 control-label">Danh sách vật phẩm</label>
									<div class="col-md-7">
										<textarea id="project_items" type="text" class="form-control" name="items" rows="5" cols="50" disabled>
										</textarea>
									</div>
								</div>

								<div class="form-group">
									<label for="desc" class="col-md-4 control-label">Ghi chú</label>
									<div class="col-md-7">
										<p id="project_note" class="form-control"></p>
									</div>
								</div>

								<div class="form-group">
									<label class="col-md-4 control-label">Mức độ hoàn thành</label>
									<div class="col-md-7">
										<div class="progress">
											<div id="progress-bar" class="progress-bar progress-bar-success progress-bar-striped" role="progressbar"
											aria-valuemin="0" aria-valuemax="100">
											</div>
										</div>
									</div>
								</div>

								<div class="form-group" id="stat">
									<label for="stat" class="col-md-4 control-label">Tình trạng</label>

									<div class="col-md-7">
										<p id="project_stat" class="form-control" style="font-family: FontAwesome, sans-serif;">&#xf274; Kết thúc</p>
									</div>
								</div>


								<div class="form-group">
									<label for="stat" class="col-md-4 control-label">Giá trị ước tính</label>

									<div class="col-md-7">
										<input id="project_money" type="number"> <span><i>Đơn vị VNĐ</i></span>
									</div>
								</div>

								<div class="form-group">
									<label for="stat" class="col-md-4 control-label">Đánh giá</label>

									<div class="col-md-7">
										<input id="rating-input" type="number"/>
									</div>
								</div>
							</div>
						</div>
						<div class="modal-footer">
							<button id="btnRating" class="btn btn-success">Đánh giá</button>
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

		/*
		Modal
		*/
		$('.project-row').click(function(){
			project_id = $(this).attr('data-project_id');
			$.get("/project/"+project_id, function(data, status){
				project = data[0];
				//console.log(project);
				$('#project_id').text(project.id);
				$('#project_name').text(project.name);
				$('#project_items').text(project.items);
				$('#project_note').text(project.note);
				$('#project_from_date').text(project.from_date);
				$('#project_to_date').text(project.to_date);
				$('#project_to_date').text(project.to_date);
				$('#project_plan').attr("href", "/"+project.plan);
				$('#requirement_id').html('Mã yêu cầu cứu trợ: <b>'+project.requirements.id+'</b>');
				$('#requirement_name').html('Tên yêu cầu cứu trợ: <b>'+project.requirements.name+'</b>');
				$('#town_name').html('Địa phương: <b>'+project.requirements.towns.name+'</b>');
				$('#requirement_info').html('Thiệt hại: <b>'+project.requirements.info+'</b>');
				$('#progress-bar').text(project.progress+'%').attr('style', 'width: '+project.progress+'%;');
				$('#project_money').val(project.money);
				//Rating
				$('#rating-input').rating('update', project.rating);
				$("#detail").modal();
			});
		})
		//Init Rating
		$('#rating-input').rating({
              min: 0,
              max: 5,
              step: 1,
              size: 'sm',
              showClear: false,
              showCaption: false
        });

        $('#btnRating').click(function(){
        	project_id = $('#project_id').text();
        	rating = $('#rating-input').val();
        	money = $('#project_money').val();
        	_token = $("input[name='_token']").val();
        	data = {
        		'rating': rating,
        		'money': money,
        		'_token': _token
        	}
        	$.post("/admin/projects/"+project_id+"/rating", data, function(data){
        		//console.log(data);
				//refesh page
				location.reload();
			});
        });
	});
</script>
@stop
