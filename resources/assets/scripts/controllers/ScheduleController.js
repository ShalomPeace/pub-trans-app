App.controller('ScheduleController',

['$scope', '$timeout', '$filter', 'ScheduleFactory', 

function($scope, $timeout, $filter, ScheduleFactory) 
{
	$scope.create = function(event) {
		event.preventDefault();

		$scope.loading = true;

		var data = angular.copy($scope.form);

		data.departure_date = $filter('date')(data.departure_date, 'yyyy-MM-dd');
		data.arrival_date   = $filter('date')(data.arrival_date, 'yyyy-MM-dd');

		data.departure_time = $filter('date')(data.departure_time, 'HH-mm-ss');
		data.arrival_time = $filter('date')(data.arrival_time, 'HH-mm-ss');

		ScheduleFactory.create($scope.form, function(response) {
			if (response.status) {
				$scope.messages.add('success', response.message);

				$timeout(function() {
					window.location = response.redirect;
				}, 1000);
			} else {
				$scope.loading = false;

				$scope.messages.add('error', response.message);
			}
		});
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

	$scope.getCurrentDate = function() {
		return new Date();
	};

	window.scope = $scope;
}]);