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
            .state('myAccount.profile', {
                url: "/profile",
                templateUrl: 'app/frontend/myAccount/profile/profile-show.tpl.html',
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

        /**
         *  Update the user object.
         */
        $scope.save = function() {
            debugger;
            User.update({
                id: $scope.userData.id,
                data: $scope.userData
            }, function(response) {
                if (response.success) {
                    debugger;
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

        $scope.submit=function(){
            debugger;
        };
    }
]);
