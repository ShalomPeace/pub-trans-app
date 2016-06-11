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