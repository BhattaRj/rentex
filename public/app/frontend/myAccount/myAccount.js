

angular.module('myAccount', ['myAccount-profile','myAccount-dashboard','myAccount-message','myAccount-shortlist','myPost']);

angular.module('myAccount').config(['$stateProvider', '$urlRouterProvider',
    function($stateProvider, $urlRouterProvider) {

        $stateProvider
            .state('myAccount', {
                url: "/my-account",
                templateUrl: 'app/frontend/myAccount/my-account.tpl.html',
                controller: 'DashboardController'
            })
    }
]);