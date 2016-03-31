/**
 *   Starting point for rentex client app.
 */
angular.module('client', ['ngRoute', 'ngResource', 'ui.bootstrap', 'angularMoment','flat', 'myAccount','myPost','customeFilters','component']);

/**
 *  Application level configuration.
 */
angular.module('client').config(['$routeProvider', '$locationProvider', '$interpolateProvider',
    function($routeProvider, $locationProvider, $interpolateProvider) {

        // Change the default expression layout style.
        $interpolateProvider.startSymbol('<%');
        $interpolateProvider.endSymbol('%>');
    }
]);

/**
 *  Application level Constant Variable.
 *  configData is in home page.
 *  dataFactory is in dataFactory.
 */
angular.module('client').constant('CONFIG', {
    baseUrl: base_url,
    dataFactory: dataFactory,
    user: user,
    login: login
});


/**
 *  Application Level controller.
 */
angular.module('client').controller('appCtrl', ['$scope', 'CONFIG', '$modal',
    function($scope, CONFIG, $modal) {

        /**
         * Define apllication level variable.
         */
        $scope.dataFactory = CONFIG.dataFactory;
        $scope.user = CONFIG.user;
        $scope.login = CONFIG.login;

        /**
         * Validation related function.
         */
        $scope.canSave = function(form, edit) {

            return angular.isDefined(edit) ? form.$valid : form.$dirty && form.$valid;
        };


        // Setting for pagination.
        $scope.maxSize = 10;
        $scope.currentPage = 4;
        $scope.itemsPerPage = 15;


        /**
         * Alert related function..
         *
         */
        $scope.alerts = [];

        $scope.closeAlert = function(index) {
            $scope.alerts.splice(index, 1);
        };
        /**
         * Show modal and assign it in modalInstance.
         */
        $scope.showModal = function(template, controller, size, data) {
            $scope.modalInstance = $modal.open({
                animation: true,
                templateUrl: template,
                controller: controller,
                size: size,
                scope: $scope,
                resolve: {
                    data: function() {
                        return angular.isDefined(data) ? data : null;
                    }
                }
            });
        };
        /**
         * Close modal
         */
        $scope.cancel = function() {
            $scope.modalInstance.dismiss('cancel');
        };
    }
]);
