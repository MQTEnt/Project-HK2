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
							<th>Địa phương</th>
							<th>Trạng thái</th>
						</tr>
					</thead>
					<tbody>
						@foreach($cities as $city)
							@foreach($city->districts as $district)
								@foreach($district->towns as $town)
									@foreach($town->requirementsActive as $requirement)
									<tr class="requirement-row" meta-requirement_id="{{$requirement->id}}" style="cursor:pointer">
										<td>{{$requirement->id}}</td>
										<td>{{$requirement->name}}</td>
										<td>{{$town->name}}/{{$district->name}}/{{$city->name}}</td>
										<td>
											<i class="fa fa-check-square-o" aria-hidden="true"></i> <b>Đã xác nhận</b>	
										</td>
									</tr>
									@endforeach
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
					<form>
						{{ csrf_field() }}
						<div class="row">
							<div class="col-sm-10 col-sm-offset-2">
								<p><b>Nguyên nhân cứu trợ</b></p>
								<div>
								<div class="radio">
									<label><input type="radio" name="reason" value="1">Lũ lụt</label>
								</div>
								<div class="radio">
									<label><input type="radio" name="reason" value="2">Hạn hán</label>
								</div>
								<div class="radio">
									<label><input type="radio" name="reason" value="3">Động đất</label>
								</div>
								<div class="radio">
									<label><input type="radio" name="reason" value="4">Sạt lở đất</label>
								</div>
								<div class="radio">
									<label><input type="radio" name="reason" value="5">Nguyên nhân khác</label>
								</div>
								<p><b>Đánh giá mức độ</b></p>
								<div class="radio">
									<label><input type="radio" name="level" value="1">Bình thường</label>
								</div>
								<div class="radio">
									<label><input type="radio" name="level" value="2">Nghiêm trọng</label>
								</div>
								<div class="radio">
									<label><input type="radio" name="level" value="3">Cực kì nghiêm trọng</label>
								</div>
							</div>
						</div>
					</form>
				</div>
				<div class="modal-footer">
					<button id="btnSave" class="btn btn-success"><i class="fa fa-floppy-o" aria-hidden="true"></i> Lưu</button>
					<button type="button" class="btn btn-default" data-dismiss="modal">Đóng</button>
				</div>
			</div>
		</div>
	</div>
	<!-- End #listOrgModal -->
</section>
<script>
	$(document).ready(function(){
		var requirement_id;
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
				if(requirement.reason != 0)
					$('input[name=reason][value='+requirement.reason+']').attr('checked', true);
				else
					$('input[name=reason]').attr('checked', false);
				if(requirement.level != 0)
					$('input[name=level][value='+requirement.level+']').attr('checked', true);
				else
					$('input[name=level]').attr('checked', false);
				$("#detail").modal();
			})
		});
		$('#btnSave').click(function(){
			token = $("input[name=_token]").val();
			//reason
			if($("input[name=reason]:checked").val() == undefined)
				reason = 0;
			else
				reason = $("input[name=reason]:checked").val();
			//level
			if($("input[name=level]:checked").val() == undefined)
				level = 0;
			else
				level = $("input[name=level]:checked").val();
			data = {
				'_token': token,
				'level': level,
				'reason': reason
			}
			//console.log(data);
			$.post("/admin/requirements/"+requirement_id+"/evaluateRequirement", data, function(data){
				//console.log(data);
				location.reload();
			});
		});
	});
</script>
@stop
