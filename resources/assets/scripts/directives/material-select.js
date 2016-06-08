App.directive('materialSelect', ['$timeout', function ($timeout) {
	return {
		template: '<select></select>',
		transclude: true,
		replace: true,
		restrict: 'E',
		link: function postLink(scope, iElement, iAttrs) {
			$timeout(function() {
				iElement.material_select();
			});
		}
	};
}]);