angular.module('myAccount-shortlist', [
    'ui.router',
    'ngResource',
    'resources.flats',
    'pagination',
    'resources.shortlist',
    'numfmt-error-module',
    'ngSanitize',

]);


angular.module('myAccount-shortlist').config(['$stateProvider', '$urlRouterProvider',
    function($stateProvider, $urlRouterProvider) {

        $stateProvider
            .state('shortlist', {
                url: "/shortlist",
                templateUrl: 'app/client/src/myAccount/shortlist/shortlist-list.tpl.html',
                controller: 'ShortlistListController'
            })
    }
]);


angular.module('myAccount-shortlist').controller('ShortlistListController', ['$scope', 'Shortlist',
    function($scope, Shortlist) {

        /**
         * fetch login user.
         */
        $scope.getShortlists = function() {
            Shortlist.get({

            }, function(response) {
                if (response.success == true) {
                    $scope.shortlists = response.data;
                }
            }, function(err) {
                console.log('error in fetch' + err);
            });
        };
        /**
         * Shortlist the post
         */
        $scope.makeShortlist = function(id) {
            Shortlist.save({}, {
                data: {
                    shortlistable_id: id,
                }
            }, function(response) {

                if (response.success) {
                    $scope.getShortlists();
                }
            }, function(error) {
                if (error.status = 422) {
                    console.log('validation errors.');
                }
            });
        };


        $scope.getShortlists();
    }
]);
