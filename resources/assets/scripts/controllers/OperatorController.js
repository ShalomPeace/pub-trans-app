App.controller('OperatorController', 

['$scope', '$timeout', 'OperatorFactory',

function ($scope, $timeout, OperatorFactory) 
{
	$scope.submit = function(event, type) {
		event.preventDefault();

		$scope.loading = true;

		OperatorFactory[type]($scope.form);
	};

	window.scope = $scope;
}]);