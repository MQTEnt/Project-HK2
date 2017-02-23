@extends('organization.layout.master')
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
<link rel="stylesheet" href="/css/bootstrap-slider.min.css">
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
					    <!-- <tr class="approval-project" data-toggle="modal" data-target="#detail">
					        <td>DA001</td>
					        <td>Cứu trợ lũ lụt 2016</td>
					        <td>Org001</td>
					        <td><i class="fa fa-check-square-o" aria-hidden="true"></i> <b>Đã xác nhận</b></td>
					    </tr> -->
					   <!--  <tr class="pending-project" data-toggle="modal" data-target="#detail">
					       	<td>DA002</td>
					        <td>Cứu trợ lũ lụt 5/2016</td>
					        <td>Org003</td>
					        <td><i class="fa fa-question-circle-o" aria-hidden="true"></i> <i>Chưa xác nhận</i></td>
					    </tr> -->
					    @foreach($projects as $project)
					   	@if($project->stat==1)
					    <tr class="approval-project project-row" data-project_id="{{$project->id}}">
					    @else
					    	@if($project->stat==0)
					    	<tr class="pending-project project-row" data-project_id="{{$project->id}}">
					    	@else
					    	<tr class="deny-project project-row" data-project_id="{{$project->id}}">
					    	@endif
					    @endif
					    	<td>{{$project->id}}</td>
					    	<td>{{$project->name}}</td>
					    	<td>Org001</td>
					    	@if($project->stat==1)
					    		<td><i class="fa fa-check-square-o" aria-hidden="true"></i> <b>Đã xác nhận</b></td>
					    	@else
					    		@if($project->stat==0)
					    			<td><i class="fa fa-question-circle-o" aria-hidden="true"></i> <i>Chưa xác nhận</i></td>
					    		@else
					    			<td><i class="fa fa-ban" aria-hidden="true"></i> <i>Đã từ chối</i></td>
					    		@endif
					    	@endif
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
									<label for="" class="col-md-4 control-label">Tên dự án cứu trợ</label>
									<div class="col-md-7">
										<input type="text" id="project_name" class="form-control"></p>
										<p id="validName" style="color: red;"></p>
									</div>
								</div>

								<div class="form-group">
									<label for="date" class="col-md-4 control-label">Thời gian từ</label>
									<div class="col-md-3">
										<input type="date" id="project_from_date" class="form-control"></p>
									</div>
									<label for="date" class="col-md-1 control-label">đến</label>
									<div class="col-md-3">
										<input type="date" id="project_to_date" class="form-control"></p>
									</div>
								</div>

								<div class="form-group">
									<label for="items" class="col-md-4 control-label">Danh sách vật phẩm</label>
									<div class="col-md-7">
										<textarea id="project_items" type="text" class="form-control" name="items" rows="5" cols="50">
										</textarea>
									</div>
								</div>

								<div class="form-group">
									<label for="desc" class="col-md-4 control-label">Ghi chú</label>
									<div class="col-md-7">
									<input type="text" id="project_note" class="form-control"></p>
									</div>
								</div>
								
								<!-- <div class="form-group">
									<label for="desc" class="col-md-4 control-label">Bản kế hoạch cứu trợ</label>
									<div class="col-md-7">
										<p class="form-control"><a id="project_plan" href="#"><i class="fa fa-file-text-o" aria-hidden="true"></i> Kế hoạch cứu trợ</a></p>
									</div>
								</div> -->

								<div class="form-group" id="stat">
									<label for="stat" class="col-md-4 control-label">Tình trạng</label>
									<div class="col-md-7">
										<select id="project_stat" class="form-control" style="font-family: FontAwesome, sans-serif;">
											<option value="1">&#xf252; Đang thực hiện</option>
											<option value="2">&#xf274; Kết thúc</option>
											<option value="3">&#xf06a; Hoãn dự án</option>
										</select>
									</div>
								</div>

								<div class="form-group" id="progress">
									<label for="progress" class="col-md-4 control-label">Tiến độ đã hoàn thành</label>
									<div class="col-md-7">
										<div class="form-control" style="border: none;">
											<input id="progress-bar" type="text"/> <i style="padding-left: 5%; color: red;  font-size: 150%;" class="fa fa-flag" aria-hidden="true"></i>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="modal-footer">
							<button id="btnUpdate" type="button" class="btn btn-success"><i class="fa fa-refresh" aria-hidden="true"></i> Cập nhật</button>
							<button id="btnClose" type="button" class="btn btn-default" data-dismiss="modal">Đóng</button>
						</div>
					</div>
				</div>
			</div>
			<!-- End Modal-->
		</div>
	</div>
</section>
<script src="/js/bootstrap-slider.min.js"></script>
<script>
	$(document).ready(function(){
		$('.search .panel-body').hide();
		$('.search .panel-title').click(function(){
			$('.search .panel-body').slideToggle("slow");
		});

		//Progress bar
		var progressBar = new Slider("input#progress-bar", {
			// initial options object
			'ticks': [0, 25, 50, 75, 100]
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
				$('#project_name').val(project.name);
				$('#project_items').val(project.items);
				$('#project_note').val(project.note);
				$('#project_from_date').val(project.from_date);
				$('#project_to_date').val(project.to_date);
				//$('#project_plan').attr("href", "/"+project.plan);
				$('#requirement_id').html('Mã yêu cầu cứu trợ: <b>'+project.requirements.id+'</b>');
				$('#requirement_name').html('Tên yêu cầu cứu trợ: <b>'+project.requirements.name+'</b>');
				$('#town_name').html('Địa phương: <b>'+project.requirements.towns.name+'</b>');
				$('#requirement_info').html('Thiệt hại: <b>'+project.requirements.info+'</b>');

				$('#validName').hide();
				if(project.stat=='0' || project.stat=='2')
				{
					$('#stat').css('display', 'none');
					$('#progress').css('display', 'none');
					$('#btnUpdate').css('display', 'none');
				}
				else{
					//Reset
					$("select option").removeAttr('selected');
					$('#btnUpdate').css('display', 'inline');

					$("select option[value='"+project.project_stat+"']").attr('selected','selected');
					$('#stat').css('display', 'block');
					$('#progress').css('display', 'block');
					progressBar.setValue(project.progress);
				}
				$("#detail").modal();
			});
		})

		/*
		Deny Project
		*/
		$('#btnUpdate').click(function(){
			//Valid
			if($('#project_stat').val() == 2)
			{
				alert('Không thể cập nhật cho dự án đã hoàn thành');
				return;
			}
			if($('#project_name').val() == '')
			{
				$('#validName').text('Không được để trống tên dự án')
				$('#validName').show();
				return;
			}

			//Update
			project_id = $('#project_id').text();
			token = $("input[name='_token']").val();
			data = {
				name: $('#project_name').val(),
				items: $('#project_items').val(),
				note: $('#project_note').val(),
				from_date: $('#project_from_date').val(),
				to_date: $('#project_to_date').val(),
				project_stat: $('#project_stat').val(),
				progress: progressBar.getValue(),
				_token: token
			}
			//console.log(data);
			$.post("/organization/projects/"+project_id+"/update", data, function(data){
				console.log(data);
				location.reload();
			});
		});
	});
</script>
@stop