var App = angular.module('App', []);

App.config(['$httpProvider', function($httpProvider) {
	$httpProvider.defaults.headers.post['Content-Type']       = 'application/x-www-form-urlencoded;charset=utf-8';
	$httpProvider.defaults.headers.post['X-CSRF-TOKEN'] 	  = angular.element('meta[name="_token"]').attr('content');
	$httpProvider.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';
}]);

App.run(['$rootScope', 'MessageFactory', function ($rootScope, MessageFactory) {
	$rootScope.baseUrl = angular.element('base').attr('href');

	$rootScope.loading = false;

	$rootScope.messages = MessageFactory;
}]);
App.service('ApiService', 

['$rootScope', '$http', '$timeout', 'ResponseService', 

function ($rootScope, $http, $timeout, ResponseService) 
{
	this.url = $rootScope.baseUrl + 'api/v1/';

	this.get = function(url, data, callback) {
		this.request('GET', url, data, callback);
	};

	this.post = function(url, data, callback) {
		this.request('POST', url, data, callback);
	};

	this.patch = function(url, data, callback) {
		this.request('PATCH', url, data, callback);
	};

	this.put = function(url, data, callback) {
		this.request('PUT', url, data, callback);
	};

	this.request = function(method, url, data, callback) {
		var config = {
			url : this.url + url, 
			method: method, 
		};

		switch (method) {
			case 'GET':
			case 'get':
				config.params = data;
			break;

			case 'POST':
			case 'post':
			case 'PUT': 
			case 'put': 
			case 'PATCH': 
			case 'patch':
				config.data = $.param(data);
			break;
		}

		$http(config).then(function(response) {
			$timeout(function() {
				ResponseService.handle(response.data, callback);
			}, 1000);
		});
	};

	return this;
}]);
App.factory('AuthFactory', 

['$rootScope', '$http', '$timeout',

function ($rootScope, $http, $timeout) {
	var baseUrl = $rootScope.baseUrl;

	var auth = {};

	auth.login = function(credentials, callback) {
		var config = {
			url : baseUrl + 'login/attempt', 
			method: 'POST', 
			data: $.param(credentials),
		};

		auth.request(config, callback);
	};

	auth.request = function(config, callback) {
		$http(config).then(function(response) {
			$timeout(function() {
				callback(response);
			}, 1000);
		});
	};

	return auth;
}]);
App.factory('MessageFactory', [function () 
{
	var service = {};

	var messages = [];

	service.add = function(type, message) {
		messages.push({
			type: type, 
			message: message,
		});
	}

	service.get = function() {
		return messages;
	}

	service.clear = function() {
		messages = [];	
	};

	return service;
}]);
App.factory('OperatorFactory', 

['ApiService', 

function (ApiService) 
{
	var operator = {};

	operator.create = function(data, callback) {
		ApiService.post('operators', data, callback);
	}; 

	operator.update = function(data, callback) {
		ApiService.post('operators/' + data.id, data, callback);	
	};

	return operator;
}]);
App.service('ResponseService', 

['$rootScope', '$timeout', 

function ($rootScope, $timeout) 
{
	this.handle = function(response, callback) {
		console.log(response);

		if (response.status) {
			$rootScope.messages.add('success', response.message);

			if (typeof callback === 'function') callback(response);

			if (response.redirect) {
				$timeout(function() {
					window.location = response.redirect;
				}, 1000);
			}
		} else {
			$rootScope.loading = false;

			$rootScope.messages.add('error', response.message);
		}
	};
}]);
App.service('ScheduleFactory', 

['ApiService', 

function (ApiService) 
{
	var schedule = {};

	schedule.create = function(data, callback) {
		ApiService.post('schedules', data, callback);	
	};

	schedule.update = function(data, callback) {
		ApiService.post('schedules/' + data.id , data, callback);	
	};

	schedule.search = function(data, callback) {
		var response = ApiService.get('schedules/search', data, callback);
	};

	return schedule;
}])
App.factory('StationFactory', 

['ApiService', 

function (ApiService) {
	var station = {};

	station.create = function(data, callback) {
		ApiService.post('stations', data, callback);	
	};

	station.update = function(data, callback) {
		ApiService.post('stations/' + data.id, data, callback);
	};

	return station;
}]);
App.factory('TrainFactory', 

['ApiService', 

function (ApiService) 
{
	var train = {};	

	train.create = function(data, callback) {
		ApiService.post('trains', data, callback);	
	};

	train.update = function(data, callback) {
		ApiService.post('trains/' + data.id, data, callback);
	};

	return train;
}]);
App.directive('btnSubmit', [function () {
	return {
		template: '<button type="submit" class="btn btn-success waves-effect waves-light"></button>',
		replace: true,
		transclude: true,
		restrict: 'E',
		link: function postLink(scope, iElement, iAttrs) {

		}
	};
}]);

App.directive('btnLink', [function () {
	return {
		template: '<a class="btn btn-info waves-effect waves-light" ng-transclude></a>',
		replace: true,
		transclude: true,
		restrict: 'E',
		link: function postLink(scope, iElement, iAttrs) {

		}
	};
}]);

App.directive('materialSelect', ['$timeout', function ($timeout) {
	return {
		template: '<select></select>',
		transclude: true,
		replace: true,
		restrict: 'E',
		link: function postLink(scope, iElement, iAttrs) {
			$timeout(function() {
				iElement.material_select();
			});
		}
	};
}]);
App.directive('preloaderCircle', [function () {
	return {
		templateUrl: 'templates/preloader-circle.html',
		replace: true,
		restrict: 'E',
		link: function postLink(scope, iElement, iAttrs) {

		}
	};
}])
App.controller('AuthController', 

['$scope', '$timeout', 'AuthFactory', 

function ($scope, $timeout, AuthFactory) {
	$scope.form = {
		username : '', 
		password : '',
	};
	
	$scope.login = function(event) {
		event.preventDefault();

		$scope.loading = true;
		$scope.messages = [];
		AuthFactory.login($scope.form, function(response) {
			if (response.data.status) {
				$scope.messages.push({
					type: 'success', 
					message: response.data.message,
				});

				$timeout(function() {
					window.location = $scope.baseUrl;
				}, 1000);
			} else {
				$scope.loading = false;

				$scope.messages.push({
					type: 'error', 
					message: response.data.message,
				});
			}
		});
	};

	window.scope = $scope;
}])
App.controller('HomeController',

['$scope',

function($scope) {

}]);
App.controller('OperatorController', 

['$scope', '$timeout', 'OperatorFactory',

function ($scope, $timeout, OperatorFactory) 
{
	$scope.submit = function(event, type) {
		event.preventDefault();

		$scope.loading = true;

		OperatorFactory[type]($scope.form);
	};

	window.scope = $scope;
}]);
App.controller('ScheduleController',

['$scope', '$timeout', '$filter', 'ScheduleFactory', 

function($scope, $timeout, $filter, ScheduleFactory) 
{
	$scope.submit = function(event, type) {
		event.preventDefault();
		
		$scope.loading = true;

		var data = $scope.filterDateTime($scope.form);

		ScheduleFactory[type](data);	
	};

	$scope.search = function(event) {
		event.preventDefault();

		$scope.loading = true;

		ScheduleFactory.search($scope.form, function(data) {
			$scope.loading = false;
			$scope.schedules = data.schedules;
		});
	};

	$scope.canSearch = function() {
		return (! $scope.form.departure && ! $scope.form.arrival) || $scope.loading ? 'disabled' : '';
	};

	$scope.getDateTime = function(date_time) {
		return (typeof date_time !== 'undefined') ? new Date(date_time) : new Date();
	};

	$scope.filterDateTime = function(data) {
		var copy = angular.copy(data);

		copy.departure_date = $filter('date')(copy.departure_date, 'yyyy-MM-dd');
		copy.arrival_date   = $filter('date')(copy.arrival_date, 'yyyy-MM-dd');

		copy.departure_time = $filter('date')(copy.departure_time, 'HH:mm:ss');
		copy.arrival_time = $filter('date')(copy.arrival_time, 'HH:mm:ss');
	
		return copy;
	};

	window.scope = $scope;
}]);
App.controller('StationController', 

['$scope', '$timeout', 'StationFactory', 

function ($scope, $timeout, StationFactory) 
{
	$scope.submit = function(event, type) {
		event.preventDefault();

		$scope.loading = true;

		var method = StationFactory[type];

		method($scope.form, function(response) {
			if (response.status) {
				$scope.messages.add('success', response.message);
			
				$timeout(function() {
					window.location = response.redirect;
				}, 1000);
			} else {
				$scope.loading = false;

				$scope.messages.add('error', response.message);
			}
		});
	};
	
	window.scope = $scope;
}]);
App.controller('TrainController', 

['$scope', '$timeout', 'TrainFactory', 

function ($scope, $timeout, TrainFactory) 
{
	$scope.submit = function(event, type) {
		event.preventDefault();

		$scope.loading = true;

		TrainFactory[type]($scope.form, function(response) {
			if (response.status) {
				$scope.messages.add('success', response.message);

				$timeout(function() {
					window.location = response.redirect;
				}, 1000);
			} else {
				$scope.loading = false;

				$scope.messages.add('error', response.message);
			}
		});
	};

	window.scope = $scope;
}]);