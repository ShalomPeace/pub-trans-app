var App = angular.module('App', []);

App.config(['$httpProvider', function($httpProvider) {
	$httpProvider.defaults.headers.post['Content-Type']       = 'application/x-www-form-urlencoded;charset=utf-8';
	$httpProvider.defaults.headers.post['X-CSRF-TOKEN'] 	  = angular.element('meta[name="_token"]').attr('content');
	$httpProvider.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';
}]);

App.run(['$rootScope', function ($rootScope) {
	$rootScope.baseUrl = angular.element('base').attr('href');

	$rootScope.loading = false;

	$rootScope.messages = [];
}]);
App.service('ApiService', ['$http', '$timeout', function ($http, $timeout) {
	this.url = 'api/v1/';

	this.get = function(url, data, callback) {
		this.request('GET', url, data, callback);
	};

	this.post = function(url, data, callback) {
		this.request('POST', url, data, callback);
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
				config.data = $.param(data);
			break;
		}

		$http(config).then(function(response) {
			$timeout(function() {
				callback(response.data);
			}, 1000);
		});
	};

	return this;
}])
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
App.service('ScheduleService', ['ApiService', function (ApiService) 
{
	this.search = function(data, callback) {
		var response = ApiService.get('schedules/search', data, callback);
	};

	return this;
}])
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
App.controller('ScheduleController',

['$scope', 'ScheduleService', 

function($scope, ScheduleService) 
{
	$scope.loader = false;

	$scope.search = function(event) {
		event.preventDefault();
		event.stopPropagation();

		$scope.loader = true;

		ScheduleService.search($scope.form, function(data) {
			$scope.loader = false;
			$scope.schedules = data.schedules;
		});
	}

	$scope.canSearch = function() {
		return (! $scope.form.departure && ! $scope.form.arrival) || $scope.loader ? 'disabled' : '';
	};

	$scope.getCurrentDate = function() {
		return new Date();
	};

	window.scope = $scope;
}]);
App.controller('StationController', 

['$scope', 

function ($scope) {
	
	window.scope = $scope;
}]);