App.controller('StationController', 

['$scope', '$timeout', 'StationFactory', 

function ($scope, $timeout, StationFactory) 
{
	$scope.submit = function(event, type) {
		event.preventDefault();

		$scope.loading = true;

		StationFactory[type]($scope.form);
	};
	
	window.scope = $scope;
}]);