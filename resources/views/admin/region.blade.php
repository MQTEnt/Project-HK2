@extends('admin.layout.master')
@section('css.section')
<style>
	.li-city{
		cursor:pointer;
		font-size: 0.8em;
	}
	.li-district{
		cursor:pointer;
		font-size: 0.8em;
	}
	.li-town{
		cursor:pointer;
		font-size: 1em;
	}
	ul#list li{
		margin-bottom: 2%;
	}
	.li-none{
		list-style-type:none;
	}
	.label-district{
		background: #395771;
	}
	.label-town{
		background: #a1a5a9;
	}
</style>
@stop
@section('body.content')
<section class="content" ng-app="regionApp" ng-controller="regionCtrl">
	<div class="container-fluid">
		<div class="row">
			<div class="col-sm-4">
				<ul>
					<li class="li-none"><button type="button" class="btn btn-success"><span class="glyphicon glyphicon-plus"></span> Thêm mới</button></li>
					<li class="li-none"><loading></loading></li>
				</ul>
				<ul id="list" ng-repeat="city in cities" on-finish-render>
					<li>
						<span class="li-city label label-primary"> <% city.name %> </span>
					</li>
					<ul class="ul-district">
						<li ng-repeat="district in city.districts">
							<span class="li-district label label-district"> <% district.name %></span>
						</li>
						<!-- <ul class="ul-town">
							<li class="li-town"><span class="label label-town">abc</span></li>
							<li class="li-town"><span class="label label-town">abc</span></li>
							<li class="li-town"><span class="label label-town">abc</span></li>
						</ul> -->
					</ul>
				</ul>
			</div>
			<div class="col-sm-8">
				<div class="row">
					<div class="col-sm-12">
						<button type="button" class="btn btn-warning"><span class="glyphicon glyphicon-wrench"></span> Sửa</button>
						<button type="button" class="btn btn-danger"><span class="glyphicon glyphicon-trash"></span> Xóa</button>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>
<script>
</script>
<script>
	var app = angular.module('regionApp', [], function($interpolateProvider){
        $interpolateProvider.startSymbol('<%');
        $interpolateProvider.endSymbol('%>');
    });
    //Wait Angular Render
	app.directive('onFinishRender', function ($timeout) {
		return {
			link: function (scope, element, attr) {
				if (scope.$last === true) {
					$timeout(function () {
						scope.$emit('ngRepeatFinished');
					});
				}
			}
		}
	});
	app.directive('loading', function () {
		return {
			restrict: 'E',
			replace:true,
			template: '<div class="loading"><img src="/imgs/loading.gif" width="50" height="50" />LOADING...</div>',
			link: function (scope, element, attr) {
				scope.$watch('loading', function (val) {
					if (val)
						$(element).show();
					else
						$(element).hide();
				});
			}
		}
	});
    app.controller('regionCtrl',function($scope, $http){
    	$scope.loading = true;
    	$scope.getRegion = function(){
	    	$http.get("/get-cities-districts")
	    	.then(function(response) {
	    		$scope.cities = response.data;
	    		$scope.loading = false;
	    		$scope.$on('ngRepeatFinished', function(ngRepeatFinishedEvent){
					$('.ul-district').hide();
					$('.li-city').click(function(){
						$(this).parent().next().toggle();
					});
	    		});
	    	});
    	}
    	$scope.getRegion();
    });
</script>
@stop