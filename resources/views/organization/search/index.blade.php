@extends('organization.layout.master')
@section('css.section')
@stop
@section('body.content')
<section class="content">
	<div class="container-fluid">
		<div class="row search">
			<div class="col-sm-12">
				<div class="panel panel-primary">
					<div class="panel-heading">
					<h3 class="panel-title">Tìm kiếm <i class="fa fa-chevron-down" aria-hidden="true"></i></h3>
					</div>
					<div class="panel-body">
						<form action="#" class="form-horizontal">
							<div class="form-group">
								<label for="" class="col-sm-2 control-label">Từ khóa</label>
								<div class="col-sm-9">
									<input type="text" class="form-control">
								</div>
							</div>
							<div class="form-group">
								<label for="" class="col-sm-2 control-label"><i class="fa fa-filter" aria-hidden="true"></i> Lọc theo</label>
								<div class="col-sm-9">
									<label class="checkbox-inline"><input type="checkbox" value="">Tên dự án cứu trợ</label>
									<label class="checkbox-inline"><input type="checkbox" value="">Tên tổ chức cứu trợ</label>
								</div>
							</div>
							<div class="form-group">
								<div class="col-sm-11">
									<button type="button" id="btnSearch" class="btn btn-primary pull-right"><i class="fa fa-search" aria-hidden="true"></i> Tìm kiếm</button>
								</div>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-sm-12">
				<p class="result-search"><b><i class="fa fa-search" aria-hidden="true"></i> Kết quả tìm kiếm</b></p>
				<p class="result-search"><i>Đã tìm thấy 3 kết quả tìm kiếm cho từ khóa <b>tình nguyện</b></i></p>
				<p class="result-search"><a href="#">Tổ chức <b>tình nguyện</b> A</a></p>
				<p class="result-search"><a href="#">Đội <b>tình nguyện</b> viên trẻ</a></p>
				<p class="result-search"><a href="#">Dự án <b>tình nguyện</b> mùa hè 2016</a></p>
			</div>
		</div>
	</div>
</section>
<script>
	$(document).ready(function(){
		$('.result-search').hide();
		$('#btnSearch').click(function(){
			var results = $('.result-search');
			$.each(results, function(key, value){
				$(this).slideToggle();
				results.delay(50);
			});
		});
	});
</script>
@stop