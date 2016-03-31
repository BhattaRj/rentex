angular.module('myAccount-dashboard', [
    'ui.router',
]);


angular.module('myAccount-dashboard').config(['$stateProvider', '$urlRouterProvider',
    function($stateProvider, $urlRouterProvider) {

        $stateProvider
            .state('myAccount.dashboard', {
                url: "/dashboard",
                templateUrl: 'app/frontend/myAccount/dashboard/dashboard.tpl.html',
                controller: 'DashboardController'
            })
    }
]);


angular.module('myAccount-dashboard').controller('DashboardController', ['$scope', '$location',
    function($scope, $location) {
        /**
         * Fetch all messages of current user.
         */
        // $scope.getMessages = function() {
        //     Message.get({

        //     }, function(response) {
        //         if (response.success == true) {
        //             $scope.messages = response.data;
        //         }
        //     }, function(err) {
        //         console.log('error in fetch' + err);
        //     });
        // };

        //$scope.getMessages();

    }
]);
