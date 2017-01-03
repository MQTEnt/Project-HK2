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
	ul#list{
		overflow: hidden;
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
	#pn-info{
		margin-bottom: 5%;
	}
</style>
@stop
@section('body.content')
<section class="content" ng-app="regionApp" ng-controller="regionCtrl">
	<input type="hidden" name="_token" value="{{csrf_token()}}">
	<div class="container-fluid">
		<div class="row">
			<div class="col-sm-4">
				<ul>
					<li class="li-none"><button type="button" class="btn btn-success" ng-click="add()"><span class="glyphicon glyphicon-plus"></span> Thêm</button></li>
					<li class="li-none"><loading></loading></li>
				</ul>
				<ul id="list" ng-repeat="city in cities" on-finish-render>
					<li>
						<span class="li-city label label-primary"> <% city.name %> </span>
						<ul class="ul-district">
							<li ng-repeat="district in city.districts">
								<span class="li-district label label-district" data-district_id="<%district.id%>"> <% district.name %></span>
								<ul class="ul-town">
									<li ng-repeat="town in district.towns" class="li-town">
										<span class="label label-town" ng-click="getTown(town.id)"><%town.name%></span>
									</li>
								</ul>
							</li>
						</ul>
					</li>
				</ul>
			</div>
			<div class="col-sm-8">
				<div class="row">
					<div class="col-sm-12">
						<div id="map" style="width:auto; height:400px"></div>
					</div>
				</div>
				<br>
				<div id="btn" class="row">
					<button id="btn-update" type="button" class="btn btn-warning"><span class="glyphicon glyphicon-wrench"></span> Cập nhật</button>
					<button id="btn-delete" type="button" class="btn btn-danger"><span class="glyphicon glyphicon-trash"></span> Xóa</button>
				</div>
				<br>
				<div id="pn-info" class="row">
					<div class="panel panel-info">
						<div class="panel-heading">
							<h3 class="panel-title">Thông tin</h3>
						</div>
						<div class="panel-body">
							<div class="form-horizontal">
								<div id="town-id" class="form-group">
									<label class="col-sm-2 control-label">ID:</label>
									<div class="col-sm-8">
										<input type="text" class="form-control" ng-model="selectedTown.id" ng-disabled="true">
									</div>
								</div>
								<div class="form-group">
									<label class="col-sm-2 control-label">Tên xã:</label>
									<div class="col-sm-8">
										<input type="text" class="form-control" ng-model="selectedTown.name">
									</div>
								</div>
								<div class="form-group">
									<div class="col-sm-10">
										<button id="btn-create" type="button" class="btn btn-success pull-right" ng-click="store()">Tạo</button>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>
<script>
	var mapMode;
	function setMode(mode){
		if(mode == null)
		{
			$('#btn-update').hide();
			$('#btn-delete').hide();
			$('#pn-info').hide()
		}
		else
			if(mode == 'detail')
			{
				$('#btn-update').show();
				$('#btn-delete').show();
				$('#town-id').show()
				$("#pn-info").slideDown("slow");
				$("#btn-create").hide();
			}
			else
				if(mode == 'create'){
					$('#btn-update').hide();
					$('#btn-delete').hide();
					$('#town-id').hide();
					$("#pn-info").slideDown("slow");
					$("#btn-create").show();
				}	
	}
	setMode(null);
	/*
	* Google Map
	*/
	var marker;
	var map;
	var newLocation;
	var selectedDistrict ={}
	var reloadRegion = false;
	function placeMarker(map, location) {
		if(typeof marker !='undefined') //Vì lần đầu tiên marker undefined nên không dùng được setMap()
		{
			marker.setMap(null);
		}
		marker = new google.maps.Marker({
			position: location,
			map: map
		});
		//Set newLocation for add new
		newLocation = location;
		var infowindow = new google.maps.InfoWindow({
			content: 'Chọn một địa điêm cho huyện <b>'+selectedDistrict.name+'</b>'
		});
		infowindow.open(map,marker);
	}
	function initMap() {
		map = new google.maps.Map(document.getElementById('map'), {
			center: {lat: 21.03, lng: 105.84},
			zoom: 7
		});
		if(mapMode == 'create')
			google.maps.event.addListener(map, 'click', function(event) {
				placeMarker(map, event.latLng);
			});
	}
	function initTownMap(lat, lon) {
		var myCenter = new google.maps.LatLng(lat,lon);
		var mapCanvas = document.getElementById("map");
		var mapOptions = {center: myCenter, zoom: 15};
		map = new google.maps.Map(mapCanvas, mapOptions);
		marker = new google.maps.Marker({
			position:myCenter,
			map: map,
          	draggable: true, 
          	animation: google.maps.Animation.DROP
         });
		marker.addListener('click', toggleBounce);
	}
	function toggleBounce() {
        if (marker.getAnimation() !== null) {
          marker.setAnimation(null);
        } else {
          marker.setAnimation(google.maps.Animation.BOUNCE);
        }
    };
	google.maps.event.addDomListener(window, 'load', initMap());

	/*
	* AngularJS
	*/
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
	//Loading
	app.directive('loading', function () {
		return {
			restrict: 'E',
			replace:true,
			template: '<div class="loading"><img src="/imgs/loading.gif" width="50" height="50" />Đang tải...</div>',
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
	    		if(reloadRegion == false)
	    		{
		    		$scope.$on('ngRepeatFinished', function(ngRepeatFinishedEvent){
						$('.ul-district').hide();
						$('.ul-town').hide();
						$('.li-city').click(function(){
							$(this).next().toggle();
						});
						$('.li-district').click(function(){
							$(this).next().toggle();
							selectedDistrict.id = $(this).attr('data-district_id');
							selectedDistrict.name = $(this).text();
						});
		    		});
		    	}
	    	});
    	}
    	$scope.getRegion();
    	$scope.getTown = function(town_id){
    		$http.get("/town/"+town_id)
	    	.then(function(response) {
	    		//console.log(response);
	    		$scope.selectedTown = response.data;
	    		google.maps.event.addDomListener(window, 'load', initTownMap($scope.selectedTown.lat, $scope.selectedTown.lon));
	    		setMode('detail');
	    	});
    	};
    	
    	//Add new
    	$scope.add = function(){
    		if(typeof selectedDistrict.id == 'undefined')
    		{
    			alert('Xin chọn 1 thành phố và huyện trước khi thêm mới')
    			return;
    		}
    		$scope.selectedTown = {};
    		setMode('create');
    		mapMode = 'create';
    		google.maps.event.addDomListener(window, 'load', initMap());
    	};
    	$scope.store = function(){
    		//Set lat and lon for new Town
    		var newTown = {};
    		if(typeof newLocation == 'undefined' )
    		{
    			alert('Xin chọn một điểm trên bản đồ để thêm mới');
    			return;
    		}
    		newTown.lat = newLocation.lat;
    		newTown.lon = newLocation.lng;
    		newTown.name = $scope.selectedTown.name;
    		newTown.district_id = selectedDistrict.id;
    		//newTown._token = $("input[type='hidden']").val();
    		//console.log(newTown);
    		data=$.param(newTown);
    		$http({
    			method: 'POST',
    			url: '/admin/towns',
    			data: data,
    			headers: {'Content-Type': 'application/x-www-form-urlencoded'}
    		})
    		.success(function(response){
    			console.log(response);
    			newLocation = undefined;
    			alert('Đã thêm thành công');
    			//Reload
    			reloadRegion = true;
    			$scope.getRegion();

    			//Reset mode and map
    			setMode(null);
    			google.maps.event.addDomListener(window, 'load', initMap());
    		})
    		.error(function(response){
			//console.log(response);
				alert('Đã xảy ra lỗi, vui lòng thử lại');
			});
    	};
    });
</script>
@stop