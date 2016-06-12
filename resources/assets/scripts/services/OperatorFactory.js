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