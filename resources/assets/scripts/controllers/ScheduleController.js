App.controller('ScheduleController',

['$scope', 'ScheduleService', 

function($scope, ScheduleService) 
{
	$scope.loader = false;

	$scope.search = function(event) {
		event.preventDefault();
		event.stopPropagation();

		$scope.loader = true;

		ScheduleService.search($scope.form, function(data) {
			$scope.loader = false;
			$scope.schedules = data.schedules;
		});
	}

	$scope.canSearch = function() {
		return (! $scope.form.departure && ! $scope.form.arrival) || $scope.loader ? 'disabled' : '';
	};

	$scope.getCurrentDate = function() {
		return new Date();
	};

	window.scope = $scope;
}]);