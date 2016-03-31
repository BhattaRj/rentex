/**
 *
 *  Auth module for login, register and forget password.
 *
 */
angular.module('auth', [
    'ui.router',
]);


angular.module('auth').config(['$stateProvider', '$urlRouterProvider',
    function($stateProvider, $urlRouterProvider) {

        $stateProvider
            .state('login', {
                url: "/login",
                //templateUrl: 'app/frontend/flat/flat-list.html',
                controller: 'LoginController'
            })
    }
]);


angular.module('auth').controller('LoginController', ['$scope', '$location', '$modal',
    function($scope, $location, $modal) {

        var loginTemplate = 'app/common/template/messageModel.html',
            loginController = 'LoginModalController',
            loginModelSize = 'sm';

        $scope.showModal(loginTemplate, loginController, loginModelSize);


    }
]);

angular.module('auth').controller('LoginModalController', ['$scope',
    function($scope) {}
]);
