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