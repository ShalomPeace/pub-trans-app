App.controller('StationController', 

['$scope', '$timeout', 'StationFactory', 

function ($scope, $timeout, StationFactory) 
{
	$scope.submit = function(event, type) {
		event.preventDefault();

		$scope.loading = true;

		var method = StationFactory[type];

		method($scope.form, function(response) {
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
	
	window.scope = $scope;
}]);