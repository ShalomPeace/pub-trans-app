App.service('ScheduleFactory', 

['ApiService', 

function (ApiService) 
{
	var schedule = {};

	schedule.create = function(data, callback) {
		ApiService.post('schedules', data, callback);	
	};

	schedule.update = function(data, callback) {
		data._method = 'PUT';

		ApiService.post('schedules/' + data.id , data, callback);	
	};

	schedule.search = function(data, callback) {
		var response = ApiService.get('schedules/search', data, callback);
	};

	return schedule;
}])