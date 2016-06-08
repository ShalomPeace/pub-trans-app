App.directive('btnSubmit', [function () {
	return {
		template: '<button type="submit" class="btn btn-success waves-effect waves-light"></button>',
		replace: true,
		transclude: true,
		restrict: 'E',
		link: function postLink(scope, iElement, iAttrs) {

		}
	};
}]);

App.directive('btnLink', [function () {
	return {
		template: '<a class="btn btn-info waves-effect waves-light" ng-transclude></a>',
		replace: true,
		transclude: true,
		restrict: 'E',
		link: function postLink(scope, iElement, iAttrs) {

		}
	};
}]);
