App.service('ScheduleFactory', 

['ApiService', 

function (ApiService) 
{
	var schedule = {};

	schedule.search = function(data, callback) {
		var response = ApiService.get('schedules/search', data, callback);
	};

	return schedule;
}])