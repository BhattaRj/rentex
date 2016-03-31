angular.module('myAccount-shortlist', [
    'ui.router',
    'ngResource',
    'resources.flats',
    'pagination',
    'resources.shortlist',
    'numfmt-error-module',
    'ngSanitize',
    'resources.reports',
]);

angular.module('myAccount-shortlist').config(['$stateProvider', '$urlRouterProvider',
    function($stateProvider, $urlRouterProvider) {

        $stateProvider
            .state('myAccount.shortlist', {
                url: "/shortlist",
                templateUrl: 'app/frontend/myAccount/shortlist/shortlist-list.tpl.html',
                controller: 'ShortlistListController'
            })
    }
]);

angular.module('myAccount-shortlist').controller('ShortlistListController', ['$scope', 'Shortlist', 'Report',
    function($scope, Shortlist, Report) {
        /**
         * Fetch shortlists of login user.
         */
        $scope.getShortlists = function() {
            Shortlist.get({

            }, function(response) {
                if (response.success == true) {
                    $scope.flats = response.data;
                }
            }, function(err) {
                console.log('error in fetch' + err);
            });
        };

        /**
         * Shortlist the post
         */
        $scope.shortlist = function(flat_id) {
            if ($scope.login) {
                Shortlist.save({}, {
                    data: {
                        shortlistable_id: flat_id,
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
            } else {
                $scope.confirmLogin();
            }

        };

        /**
         * Report the post
         */
        $scope.report = function(flat_id) {
            if ($scope.login) {
                Report.save({}, {
                    data: {
                        reportable_id: flat_id,
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
            } else {
                $scope.confirmLogin();
            }
        };
        
        $scope.getShortlists();
    }
]);