App.controller('ScheduleController',

['$scope', '$timeout', '$filter', 'ScheduleFactory', 

function($scope, $timeout, $filter, ScheduleFactory) 
{
	$scope.submit = function(event, type) {
		event.preventDefault();
		
		$scope.loading = true;

		var data = $scope.filterDateTime($scope.form);

		ScheduleFactory[type](data);	
	};

	$scope.search = function(event) {
		event.preventDefault();

		$scope.loading = true;

		ScheduleFactory.search($scope.form, function(data) {
			$scope.loading = false;
			$scope.schedules = data.schedules;
		});
	};

	$scope.canSearch = function() {
		return (! $scope.form.departure && ! $scope.form.arrival) || $scope.loading ? 'disabled' : '';
	};

	$scope.getDateTime = function(date_time) {
		return (typeof date_time !== 'undefined') ? new Date(date_time) : new Date();
	};

	$scope.filterDateTime = function(data) {
		var copy = angular.copy(data);

		copy.departure_date = $filter('date')(copy.departure_date, 'yyyy-MM-dd');
		copy.arrival_date   = $filter('date')(copy.arrival_date, 'yyyy-MM-dd');

		copy.departure_time = $filter('date')(copy.departure_time, 'HH:mm:ss');
		copy.arrival_time = $filter('date')(copy.arrival_time, 'HH:mm:ss');
	
		return copy;
	};

	window.scope = $scope;
}]);