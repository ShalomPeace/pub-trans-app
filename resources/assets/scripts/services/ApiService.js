App.service('ApiService', 

['$rootScope', '$http', '$timeout', 

function ($rootScope, $http, $timeout) 
{
	this.url = $rootScope.baseUrl + 'api/v1/';

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
}]);