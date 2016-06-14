App.controller('AuthController', 

['$scope', '$timeout', 'AuthFactory', 

function ($scope, $timeout, AuthFactory) {
	$scope.form = {
		username : '', 
		password : '',
	};
	
	$scope.login = function(event) {
		event.preventDefault();

		$scope.loading = true;

		AuthFactory.login($scope.form);
	};

	window.scope = $scope;
}])