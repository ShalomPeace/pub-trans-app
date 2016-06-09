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