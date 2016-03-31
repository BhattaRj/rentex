/**
 * Falt module for common user.
 */
angular.module('flat', [
    'ui.router',
    'ngResource',
    'resources.flats',
    'pagination',
    'resources.facilities',
    'resources.shortlist',
    'resources.reports',
    'numfmt-error-module',
    'ngSanitize',
    'ui.select'
]);

angular.module('flat').config(['$stateProvider', '$urlRouterProvider',
    function($stateProvider, $urlRouterProvider) {

        $stateProvider
            .state('flats', {
                url: "/flats",
                templateUrl: 'app/frontend/flat/flat-list.html',
                controller: 'FlatListController'
            })
            .state('showFlat', {
                url: '/flat/show/:flatId',
                templateUrl: 'app/frontend/flat/flat.html',
                controller: 'ShowFlatController'
            });
    }
]);


angular.module('flat').controller('FlatListController', ['$scope', '$location', 'Flat', 'Shortlist', 'Report', '$http', '$timeout', '$sanitize',
    function($scope, $location, Flat, Shortlist, Report, $http, $timeout, $sanitize) {

        $scope.filter = {};
        $scope.loading = true;
        
        /*
         * fetch all flats.
         */
        $scope.getFlats = function(params) {

            $scope.loading = true;
            Flat.query(params, function(resp) {
                    $scope.flats = resp.data;
                    $scope.totalItems = resp.total;
                    $scope.loading = false;
                },
                function(err) {});
        };

        /**
         * Returns data to filter the flats.
         * @return {array} district and citys with count.
         */
        $scope.getFilterData = function() {

            return $http.get('/filterData', {}).then(function(response) {
                $scope.districtsWithCount = response.data.districtsWithCount;
                $scope.cityWithCount = response.data.cityWithCount;
            });
        };

        /**
         * Search the flats
         * @param  {string} key key to search
         * @param  {any} val value to search
         *
         */
        $scope.searchFlats = function(key, val) {

            $scope.filter[key] = val;

            $scope.getFlats($scope.filter);
        };

        $scope.getFilterData();
        /**
         * reload flats when page changed.
         */
        $scope.pageChanged = function() {
            $scope.filter.current_page = $scope.currentPage;
            $scope.getFlats($scope.filter);
        };

        /**
         * Reset the filters
         * @param  {object} filter
         * @return
         */
        $scope.resetFlters = function(filter) {
            $scope.filter = {};
            $scope.getFlats();
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
                        $scope.getFlats();
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
                        $scope.getFlats();
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
         * return locality for typeahead
         * @param  {string} val search key
         * @return {object}     return array for type ahead.
         */
        $scope.getLocality = function(val) {
            return $http.get('/locality', {
                params: {
                    locality: val,
                    sensor: false
                }
            }).then(function(response) {
                return response.data.map(function(item) {
                    return item.locality;
                });

            });
        };

        /**
         * return vdc or town for fitler type ahead.
         * @param  {string} val search key
         * @return {array}     array for type ahead.
         */
        $scope.getVdc = function(val) {

            return $http.get('/vdc', {
                params: {
                    vdc: val,
                    sensor: false
                }
            }).then(function(response) {
                return response.data.map(function(item) {
                    return item.vdc;
                });
            });
        };

    }
]);

angular.module('flat').controller('LoginModalController', ['$scope',
    function($scope) {}
]);

/**
 * Show details of the flat.
 */
angular.module('flat').controller('ShowFlatController', ['$scope', '$location', 'Flat', '$stateParams',
    function($scope, $location, Flat, $stateParams) {

        $scope.flat_id = $stateParams.flatId;

        $scope.getFlat = function() {

            Flat.get({
                id: $scope.flat_id,
            }, function(response) {
                if (response.success == true) {
                    $scope.flat = response.data;
                    $scope.filterFacilities(response.data.facilities);                    
                }
            }, function(err) {
                console.log('error in fetch' + err);
            });
        };
        $scope.getFlat();

        $scope.slides = [{
            src: '/uploads/300.jpg'
        }, {
            src: '/uploads/301.jpg'
        }, {
            src: '/uploads/302.jpg'
        }, {
            src: '/uploads/1KathmanduSaarc.jpg'
        }];

        /**
         * Send message to the owner or agent.
         */
        $scope.sendMessage = function(data) {            
            var template = 'app/common/component/message/message.html',
                controller = 'SendMessageController',
                size = 'm';

            if ($scope.login) {
                $scope.showModal(template, controller, size, data);
            } else {
                $scope.confirmLogin();
            }
        };
        
        /**
         * Divide facilities into three array.
         * to disaply it in three column.
         */
        $scope.filterFacilities=function(facilities){
            $scope.facilities1=[];
            $scope.facilities2=[];
            $scope.facilities3=[];
            for(var i=0; i<facilities.length;i+=3){                
                $scope.facilities1.push(facilities[i]);
            }
            for(var i=1; i<facilities.length;i+=3){                
                $scope.facilities2.push(facilities[i]);
            }
            for(var i=2; i<facilities.length;i+=3){                
                $scope.facilities3.push(facilities[i]);
            }                                    
        };
    }
]);