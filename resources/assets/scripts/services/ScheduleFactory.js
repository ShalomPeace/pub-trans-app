App.service('ScheduleFactory', 

['ApiService', 

function (ApiService) 
{
	var schedule = {};

	schedule.create = function(data, callback) {
		ApiService.post('schedules', data, callback);	
	};

	schedule.search = function(data, callback) {
		var response = ApiService.get('schedules/search', data, callback);
	};

	return schedule;
}])