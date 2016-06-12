App.service('ResponseService', 

['$rootScope', '$timeout', 

function ($rootScope, $timeout) 
{
	this.handle = function(response, callback) {
		console.log(response);

		if (response.status) {
			$rootScope.messages.add('success', response.message);

			if (typeof callback === 'function') callback(response);

			if (response.redirect) {
				$timeout(function() {
					window.location = response.redirect;
				}, 1000);
			}
		} else {
			$rootScope.loading = false;

			$rootScope.messages.add('error', response.message);
		}
	};
}]);