App.service('ScheduleService', ['ApiService', function (ApiService) 
{
	this.search = function(data, callback) {
		var response = ApiService.get('schedules/search', data, callback);
	};

	return this;
}])