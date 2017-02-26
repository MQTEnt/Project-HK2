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
									<label for="desc" class="col-md-4 control-label">Bản kế hoạch cứu trợ</label>
									<div class="col-md-7">
										<p class="form-control"><a id="project_plan" href="#"><i class="fa fa-file-text-o" aria-hidden="true"></i> Kế hoạch cứu trợ</a></p>
									</div>
								</div>

								<div class="form-group" id="stat">
									<label for="stat" class="col-md-4 control-label">Tình trạng</label>

									<div class="col-md-7">
										<p id="project_stat" class="form-control" style="font-family: FontAwesome, sans-serif;"></p>
										<!-- <select name="project_stat" class="form-control" style="font-family: FontAwesome, sans-serif;">
											<option value="">&#xf252; Đang thực hiện</option>
											<option value="">&#xf274; Kết thúc</option>
											<option value="">&#xf06a; Hoãn dự án</option>
										</select> -->
									</div>
								</div>
							</div>
						<div class="modal-footer">
							<button id="btnAccept" type="button" class="btn btn-success"><i class="fa fa-check-square-o" aria-hidden="true"></i> Cấp phép</button>
							<button id="btnDeny" type="button" class="btn btn-danger" data-toggle="modal" data-target="#noteModal"><i class="fa fa-times" aria-hidden="true"></i> Không cấp phép</button>
							<button id="btnClose" type="button" class="btn btn-default" data-dismiss="modal">Đóng</button>
						</div>
					</div>
				</div>
			</div>

			<div class="modal fade" id="noteModal" role="dialog">
				<div class="modal-dialog modal-sm">
					<div class="modal-content">
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal">&times;</button>
							<h4 class="modal-title">Lý do không cấp phép</h4>
						</div>
						<div class="modal-body">
							 {{ csrf_field() }}
							<textarea id="reason" type="text" class="form-control" name="items" rows="5" cols="50">
							</textarea>
						</div>
						<div class="modal-footer">
							<button id="btnDenyOffical" type="button" class="btn btn-success" data-dismiss="modal">Đồng ý</button>
							<button type="button" class="btn btn-default" data-dismiss="modal">Hủy</button>
						</div>
					</div>
				</div>
			</div>
			<!-- End #note-modal -->
		</div>
	</div>
</section>
<script>
	$(document).ready(function(){
		$('.search .panel-body').hide();
		$('.search .panel-title').click(function(){
			$('.search .panel-body').slideToggle("slow");
		});

		$('.approval-project').click(function(){
			$('#btnAccept').hide();
			$('#btnDeny').hide();
			$('#btnClose').show();
			// $('#sltStat').show();
		});
		$('.pending-project').click(function(){
			$('#btnAccept').show();
			$('#btnDeny').show();
			$('#btnClose').hide();
			// $('#sltStat').hide();
		});
		$('.deny-project').click(function(){
			$('#btnAccept').hide();
			$('#btnDeny').hide();
			$('#btnClose').show();
			// $('#sltStat').show();
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
				if(project.stat=='0' ||project.stat=='2')
				{
					$('#stat').css('display', 'none');
				}
				else{
					$('#stat').css('display', 'inline');
					if(project.project_stat == '1')
					{
						$('#project_stat').html('&#xf252; Đang thực hiện');
					}
					if(project.project_stat == '2')
					{
						$('#project_stat').html('&#xf274; Kết thúc');
					}
					if(project.project_stat == '3')
					{
						$('#project_stat').html('&#xf06a; Hoãn dự án');
					}
				}
				$("#detail").modal();
			});
		})

		/*
		Accept Project
		*/
		$('#btnAccept').click(function(){
			project_id = $('#project_id').text();
			$.get("/admin/projects/"+project_id+"/approve", function(data, status){
				//refesh page
				location.reload();
			});
		});

		/*
		Deny Project
		*/
		$('#btnDenyOffical').click(function(){
			project_id = $('#project_id').text();
			reason = $('#reason').val();
			_token = $("input[name='_token']").val();
			console.log(reason);
			//reset
			$('#reason').val('');
			$.post("/admin/projects/"+project_id+"/deny", {reason: reason, _token: _token}, function(data){
				//refesh page
				location.reload();
			});
		});
	});
</script>
@stop