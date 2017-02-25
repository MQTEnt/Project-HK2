@extends('local.layout.master')
@section('css.section')
@stop
@section('body.content')
<section class="content">
	<div class="container-fluid">
		<div class="row">
			<div class="col-sm-12">
				<p><i class="fa fa-bookmark" aria-hidden="true"></i> <b>Lưu ý:</b> <i>Những yêu cầu cứu trợ đã được phê duyệt và chấp thuận sẽ được hiển thị tại danh sách dưới đây</i></p>
			</div>
		</div>
		<br>
		<div class="row">
			<div class="col-sm-12">
				<table class="table table-hover">
					<thead>
						<tr>
							<th>Mã yêu cầu</th>
							<th>Tên yêu cầu</th>
							<th>Xã</th>
							<th>Huyện</th>
							<th>Trạng thái</th>
						</tr>
					</thead>
					<tbody>
						@foreach($districts as $district)
							@foreach($district->towns as $town)
								@foreach($town->requirementsActive as $requirement)
								<tr class="requirement-row" meta-requirement_id="{{$requirement->id}}" style="cursor:pointer">
									<td>{{$requirement->id}}</td>
									<td>{{$requirement->name}}</td>
									<td>{{$town->name}}</td>
									<td>{{$district->name}}</td>
									<td>
										<i class="fa fa-check-square-o" aria-hidden="true"></i> <b>Đã xác nhận</b>	
									</td>
								</tr>
								@endforeach
							@endforeach
						@endforeach
					</tbody>
				</table>
			</div>
		</div>
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
						<li id="requirement_town"></li>
						<li id="requirement_created_at"></li>
						<li id="requirement_info"></li>
					</ul>
					<p class="text-center"><b>Danh sách các dự án cứu trợ đã được phê duyệt</b></p>
					<table class="table table-hover">
						<thead>
							<tr>
								<th>Tên dự án cứu trợ</th>
								<th>Cứu trợ từ ngày</th>
								<th>Trạng thái cứu trợ</th>
							</tr>
						</thead>
						<tbody id="projects">
						</tbody>
						<td>
							<p>Chú thích: </p>
							<i class="fa fa-circle" style="color: #337ab7;"></i><span> Đang thực hiện</span>
							<br>
							<i class="fa fa-circle" style="color: #d9534f;"></i><span> Hoãn dự án</span>
							<br>
							<i class="fa fa-circle" style="color: #5cb85c;"></i><span> Thực hiện xong</span>
							<br>
						</td>
					</table>
					<p><b>Trung bình tiến độ dự án</b></p>
					<div class="progress">
						<div id="avg-progress" class="progress-bar progress-bar-warning progress-bar-striped active" role="progressbar" aria-valuemin="0" aria-valuemax="100">
						</div>
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">Đóng</button>
				</div>
			</div>
		</div>
	</div>
	<!-- End #listOrgModal -->
</section>
<script>
	$(document).ready(function(){
		$('.requirement-row').click(function(){
			requirement_id = $(this).attr('meta-requirement_id');
			$.get("/requirement/"+requirement_id, function(data, status){
				requirement = data[0];
				//console.log(requirement);
				//Requirement info
				$('#requirement_id').html('<b>Mã yêu cầu cứu trợ: </b>'+requirement.id);
				$('#requirement_name').html('<b>Tên yêu cầu cứu trợ: </b>'+requirement.name);
				$('#requirement_town').html('<b>Địa phương: </b>'+requirement.towns.name+'/'+requirement.towns.districts.name);
				$('#requirement_created_at').html('<b>Ngày yêu cầu: </b>'+requirement.created_at);
				$('#requirement_info').html('<b>Thông tin thiệt hại: </b>'+requirement.info);
				//Projects info
				$('#projects tr').remove(); //Remove old table
				projects = requirement.projects;
				projects.forEach(function(project, index){
					if(project.stat != 2){
						row = '<tr>';
						row = row + '<td>'+project.name+'</td>';
						row = row + '<td>'+project.from_date+'</td>';
						if(project.stat == 0)
							row = row + '<td><i class="fa fa-question-circle-o" aria-hidden="true"></i> <i>Chưa xác nhận</i></td>';
						if(project.stat == 1 && project.project_stat == 1){
							row = row + '<td>';
							div_progress = $('<div></div>').addClass('progress');
							div_progress.attr({
								'style': 'margin-bottom: 0;'
							});
							div_progressBar = $('<div>'+project.progress+'%</div>').addClass('progress-bar progress-bar-striped active');
							div_progressBar.attr({
								'role': 'progressbar',
								'aria-valuenow': '0',
								'aria-valuemin': '0',
								'aria-valuemax': '100',
								'style': 'width: '+project.progress+'%;'
							});
							div_progress.append(div_progressBar);
							row = row + div_progress.prop('outerHTML') + '</div>';
						}
						if(project.stat == 1 && project.project_stat == 2){
							row = row + '<td>';
							div_progress = $('<div></div>').addClass('progress');
							div_progress.attr({
								'style': 'margin-bottom: 0;'
							});
							div_progressBar = $('<div>'+project.progress+'%</div>').addClass('progress-bar progress-bar-success progress-bar-striped');
							div_progressBar.attr({
								'role': 'progressbar',
								'aria-valuenow': '0',
								'aria-valuemin': '0',
								'aria-valuemax': '100',
								'style': 'width: '+project.progress+'%;'
							});
							div_progress.append(div_progressBar);
							row = row + div_progress.prop('outerHTML') + '</div>';
						}
						if(project.stat == 1 && project.project_stat == 3){
							row = row + '<td>';
							div_progress = $('<div></div>').addClass('progress');
							div_progress.attr({
								'style': 'margin-bottom: 0;'
							});
							div_progressBar = $('<div>'+project.progress+'%</div>').addClass('progress-bar progress-bar-danger progress-bar-striped');
							div_progressBar.attr({
								'role': 'progressbar',
								'aria-valuenow': '0',
								'aria-valuemin': '0',
								'aria-valuemax': '100',
								'style': 'width: '+project.progress+'%;'
							});
							div_progress.append(div_progressBar);
							row = row + div_progress.prop('outerHTML') + '</div>';
						}
						row = row + '</tr>';
						$('#projects').append(row);
					}
				})

				//Avg progress
				if(requirement.avgProgress != null)
					$('#avg-progress').text(requirement.avgProgress.toFixed(2)+'%').attr('style', 'width: '+requirement.avgProgress+'%;');
				else
					$('#avg-progress').text('0%').attr('style', 'width: 0%;');
				$("#detail").modal();
			})
		});
	});
</script>
@stop