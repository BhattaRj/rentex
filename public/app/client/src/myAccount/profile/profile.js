angular.module('myAccount-profile', [
    'ui.router',
    'ngResource',
    'resources.flats',
    'pagination',
    'resources.users',
    'numfmt-error-module',
    'ngSanitize',
    'ui.select'
]);


angular.module('myAccount-profile').config(['$stateProvider', '$urlRouterProvider',
    function($stateProvider, $urlRouterProvider) {

        $urlRouterProvider.otherwise("/home-list");
        $stateProvider
            .state('profile', {
                url: "/profile",
                templateUrl: 'app/client/src/myAccount/profile/profile-show.tpl.html',
                controller: 'ShowProfileController'
            })
    }
]);


angular.module('myAccount-profile').controller('ShowProfileController', ['$scope', '$location', 'User', '$http',
    function($scope, $location, User, $http) {

        /**
         * fetch login user.
         */
        User.get({
            id: $scope.user.id,
        }, function(response) {
            if (response.success == true) {
                $scope.userData = response.data;
            }
        }, function(err) {
            console.log('error in fetch' + err);
        });

        $scope.update = function(value) {
            $scope.updateValue = value;
        };

        /**
         *  Update the user object.
         */
        $scope.save = function() {
            User.update({
                id: $scope.userData.id,
                data: $scope.userData
            }, function(response) {
                if (response.success) {
                    $scope.updateValue = null;
                }
            }, function(error) {
                if (422 == error.status) {
                    console.log('validation error occoured!!');
                }
            });
        };


        /**
         * Reset password.
         */
        $scope.resetPassword = function() {

            $http.post('/resetPassword', {
                data: $scope.passwordData
            }).
            then(function(response) {
                if (response.data.  success) {
                    $scope.passwordData=null;
                    $scope.alerts.push({
                        type: 'success',
                        msg: 'Passowrd successfully changed !!   '
                    });
                }
            }, function(error) {
                if (422 == error.status) {
                    console.log('validation error occoured!!');
                }
            });
        };
    }
]);
