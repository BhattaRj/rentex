/**
 *
 *  Auth module for login, register and forget password.
 *
 */
angular.module('header', []);


angular.module('header').controller('HeaderController', ['$scope', '$modal', '$location',
    function($scope, $modal, $location) {

        $scope.checkAuth = function(path) {
            if (login) {
                $location.path(path);
            } else {
                $scope.confirmLogin();
            }
        };
    }
]);