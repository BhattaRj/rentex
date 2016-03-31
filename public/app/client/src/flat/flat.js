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

        $urlRouterProvider.otherwise("/home-list");
        $stateProvider
            .state('flats', {
                url: "/flats",
                templateUrl: 'app/client/src/flat/flat-list.tpl.html',
                controller: 'FlatListController'
            })
    }
]);


angular.module('flat').controller('FlatListController', ['$scope', '$location', 'Flat', 'Shortlist', 'Report', '$http', '$timeout',
    function($scope, $location, Flat, Shortlist, Report, $http, $timeout) {


        $scope.filter = {};
        $scope.loading = true;
        // Parameter for login dialog box.
        //
        var loginTemplate = 'app/common/template/messageModel.html',
            loginController = 'LoginModalController',
            loginModelSize = 'sm';

        /*
         * fetch all flats.
         */
        $scope.getFlats = function(params) {
            $scope.loading = true;
            Flat.query({
                params
            }, function(resp) {
                $scope.flats = resp.data;
                $scope.totalItems = resp.total;

                $scope.loading = false;

            }, function(err) {});
        };


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
                $scope.showModal(loginTemplate, loginController, loginModelSize);
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
                $scope.showModal(loginTemplate, loginController, loginModelSize);
            }
        };

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
                $scope.showModal(loginTemplate, loginController, loginModelSize);
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
