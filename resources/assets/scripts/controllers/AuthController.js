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
		$scope.messages = [];
		AuthFactory.login($scope.form, function(response) {
			if (response.data.status) {
				$scope.messages.push({
					type: 'success', 
					message: response.data.message,
				});

				$timeout(function() {
					window.location = $scope.baseUrl;
				}, 1000);
			} else {
				$scope.loading = false;

				$scope.messages.push({
					type: 'error', 
					message: response.data.message,
				});
			}
		});
	};

	window.scope = $scope;
}])