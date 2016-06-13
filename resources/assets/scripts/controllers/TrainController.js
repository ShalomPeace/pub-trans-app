App.controller('TrainController', 

['$scope', '$timeout', 'TrainFactory', 

function ($scope, $timeout, TrainFactory) 
{
	$scope.submit = function(event, type) {
		event.preventDefault();

		$scope.loading = true;

		TrainFactory[type]($scope.form);
	};

	window.scope = $scope;
}]);