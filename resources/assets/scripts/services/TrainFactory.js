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