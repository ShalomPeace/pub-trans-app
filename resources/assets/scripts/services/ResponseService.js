App.service('ResponseService', 

['$rootScope', '$timeout', 

function ($rootScope, $timeout) 
{
	this.handle = function(response, callback) {
		if (typeof callback === 'function') callback(response);

		if (response.status) {
			$rootScope.messages.add('success', response.message);

			if (response.redirect) {
				$timeout(function() {
					window.location = response.redirect;
				}, 1000);
			}

			return;
		} else {
			$rootScope.loading = false;

			$rootScope.messages.add('error', response.message);
		}
	};
}]);