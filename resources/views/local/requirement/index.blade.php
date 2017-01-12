@extends('local.layout.master')
@section('css.section')
@stop
@section('body.content')
<section class="content">
	<div class="container-fluid">
		<div class="row">
			<div class="col-sm-12">
				<a href="{{route('local.requirements.create')}}" class="btn btn-success"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Yêu cầu cứu trợ</a>
			</div>
		</div>
		<br>
		@if(Session::has('new_requirement_id'))
		<div class="row">
			<div class="col-sm-12">
				<div class="alert alert-success">
					<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
					<strong>Thông báo: </strong>Bạn vừa mới thêm một yêu cầu cứu trợ, click để xem chi tiết <a href="{{route('local.requirements.show', Session::get('new_requirement_id'))}}"><i class="fa fa-newspaper-o" aria-hidden="true"></i></a>
				</div>
			</div>
		</div>
		@endif
		@if(Session::has('update_requirement_id'))
		<div class="row">
			<div class="col-sm-12">
				<div class="alert alert-warning">
					<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
					<strong>Thông báo: </strong>Bạn vừa mới cập nhật một yêu cầu cứu trợ, click để xem chi tiết <a href="{{route('local.requirements.show', Session::get('update_requirement_id'))}}"><i class="fa fa-newspaper-o" aria-hidden="true"></i></a>
				</div>
			</div>
		</div>
		@endif
		@if(Session::has('delete_requirement_id'))
		<div class="row">
			<div class="col-sm-12">
				<div class="alert alert-danger">
					<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
					<strong>Thông báo: </strong>Bạn vừa xóa yêu cầu cứu trợ với ID {{Session::get('delete_requirement_id')}}
				</div>
			</div>
		</div>
		@endif
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
								@foreach($town->requirements as $requirement)
								<tr meta-requirement_id="{{$requirement->id}}" style="cursor:pointer">
									<td>{{$requirement->id}}</td>
									<td>{{$requirement->name}}</td>
									<td>{{$town->name}}</td>
									<td>{{$district->name}}</td>
									<td>
										@if($requirement->stat==0)
											<i class="fa fa-question-circle-o" aria-hidden="true"></i> <i>Chưa xác nhận</i>
										@else
											@if($requirement->stat==1)
											<i class="fa fa-check-square-o" aria-hidden="true"></i> <b>Đã xác nhận</b>
											@else
											<i class="fa fa-times" aria-hidden="true"></i> <b>Đã từ chối</b>
											@endif
										@endif
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
</section>
<script>
	$(document).ready(function(){
		$('tr').click(function(){
			var requirement_id = $(this).attr('meta-requirement_id');
			window.location.replace("/local/requirements/"+requirement_id);
		})
	});
</script>
@stop