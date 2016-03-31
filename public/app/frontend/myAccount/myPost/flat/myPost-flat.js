angular.module('myPost-flat', [
    'ui.router',
    'ngRoute',
    'ngResource',
    'resources.flats',
    'pagination',
    'resources.facilities',
    'numfmt-error-module',
    'ngSanitize',
    'ui.select',

    'resources.shortlist',
    'resources.reports',
    'numfmt-error-module',

]);


/**
 *  ui-routes for home module.
 */

angular.module('myPost-flat').config(['$stateProvider', '$urlRouterProvider',
    function($stateProvider, $urlRouterProvider) {

        $stateProvider
            .state('myAccount.mypost-flats', {
                url: '/mypost-flats',
                templateUrl: 'app/frontend/myAccount/myPost/flat/flat-list.tpl.html',
                controller: 'MyPostFlatListController',
            })
            .state('myAccount.mypost-flat-new', {
                url: '/mypost-flat-new',
                templateUrl: 'app/frontend/myAccount/myPost/flat/flat-new.tpl.html',
                controller: 'FlatNewController'
            })
            .state('myAccount.mypost-flat-edit', {
                url: '/mypost-flat-edit/:flatId',
                templateUrl: 'app/frontend/myAccount/myPost/flat/flat-edit.tpl.html',
                controller: 'FlatEditController'
            })
    }
]);


angular.module('myPost-flat').controller('MyPostFlatListController', ['$scope', '$location', 'Flat',
    function($scope, $location, Flat) {

        // Variable for pagination..
        $scope.currentPage = 1;
        $scope.pageSize = 4;

        /**
         * fetch all flats.
         */
        $scope.getMyFlats = function(params) {
            Flat.query(params, function(resp) {
                    $scope.flats = resp.data;
                    $scope.numPages = Math.ceil($scope.flats.length / $scope.pageSize);
                    $scope.totalRecords = $scope.flats.length;
                },
                function(err) {});

        }

        /**
         * Remove the record.
         */
        $scope.delete = function(flat, $index, $event) {
            $event.stopPropagation();
            Flat.remove({}, {
                id: flat.id
            }, function(response) {

                if (response.success == true) {
                    $scope.flats.splice($index, 1);

                    $scope.alerts.push({
                        type: 'success',
                        msg: 'Records successfully deleted !!   '
                    });
                }
            }, function(response) {
                console.log('error in delete' + error);
            });
        };

        $scope.getMyFlats({
            'myFlats': true
        });
    }
]);

angular.module('myPost-flat').controller('FlatNewController', ['$scope', '$resource', '$location', '$log', 'Flat', 'Facility',
    function($scope, $resource, $location, $log, Flat, Facility) {

        /**
         * Query facility array.
         */
        $scope.flat = {};
        $scope.flat.facilities = [];

        Facility.query(function(resp) {
            $scope.facilities = resp;
        }, function(err) {
            console.log('error in fetch. ' + err);
        });

        /**
         * Save post.
         */
        $scope.save = function(data) {

            Flat.save({}, {
                data
            }, function(response) {

                if (response.success) {

                    $scope.alerts.push({
                        type: 'success',
                        msg: 'Record successfully added !!'
                    });

                    $location.path('/my-account/mypost-flats');
                }
            }, function(error) {
                if (error.status = 422) {
                    console.log('validation errors.');
                }
            });
        };
    }
]);

angular.module('myPost-flat').controller('FlatEditController', ['$scope', '$stateParams', '$location', 'Flat', 'Facility',
    function($scope, $stateParams, $location, Flat, Facility) {

        $scope.flatId = $stateParams.flatId;

        $scope.flat = {};
        $scope.flat.facilities = [];

        /**
         *  Get all facilities for select box.
         */
        Facility.query(function(response) {
            $scope.facilities = response;
        }, function(err) {
            console.log('error occoured!!')
        });


        /**
         * Get flats
         */
        Flat.get({
            id: $scope.flatId
        }, function(response) {
            if (response.success) {
                $scope.flat = response.data;
                $scope.flat.facilities = $scope.flat.facilities
            }
        }, function(err) {
            console.log('error occoured !!');
        });

        /**
         * Update the flat records.
         */
        $scope.update = function(flat) {
            Flat.update({
                id: flat.id,
                data: flat
            }, function(response) {
                if (response.success) {
                    $scope.alerts.push({
                        type: 'success',
                        msg: 'Record successfully Udated !!   '
                    });
                    $location.path('/my-account/mypost-flats');
                }
            }, function(error) {
                if (422 == error.status) {
                    console.log('validation error occoured!!');
                }
            });

        };
    }
]);