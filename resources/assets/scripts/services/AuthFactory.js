App.factory('AuthFactory', 

['$rootScope', '$http', '$timeout', 'ResponseService',

function ($rootScope, $http, $timeout, ResponseService) {
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
			ResponseService.handle(response.data, callback);
		});
	};

	return auth;
}]);