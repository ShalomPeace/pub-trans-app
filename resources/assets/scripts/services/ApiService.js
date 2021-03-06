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