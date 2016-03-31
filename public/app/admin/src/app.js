/**
 * Admin module starts here.
 */
var app = angular.module('app', ['ngRoute', 'ngResource', 'admin', 'ui.bootstrap', 'customeFilters']);

angular.module('app').config(['$routeProvider', '$locationProvider',
    function($routeProvider, $locationProvider) {

        $routeProvider.otherwise({
            redirectTo: '/dashboard'
        });
    }
]);

angular.module('app').constant('DB_CONFIG', {

    baseUrl: configData.baseUrl,

});

angular.module('app').controller('appCtrl', ['$scope', 'DB_CONFIG', '$modal',
    function($scope, DB_CONFIG, $modal) {

        /**
         * Grid related function.
         * Sort table in assending and descending after cliked in header.
         */
        $scope.sortField = undefined;
        $scope.reverse = false;
        $scope.sort = function(fieldName) {
            if ($scope.sortField === fieldName) {
                $scope.reverse = !$scope.reverse;
            } else {
                $scope.sortField = fieldName;
                $scope.reverse = false;
            }
        };

        $scope.isSortUp = function(fieldName) {
            return $scope.sortField === fieldName && !$scope.reverse;
        };

        $scope.isSortDown = function(fieldName) {
            return $scope.sortField === fieldName && $scope.reverse;
        };


        //Make extra rows visible.
        $scope.model;
        $scope.selectModal = function(model) {

            if ($scope.model == model) {
                $scope.model = null;
            } else {
                $scope.model = model;
            }
        };

        // Setting for pagination.
        $scope.maxSize = 10;
        $scope.currentPage = 1;
        $scope.itemsPerPage = 10;

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
                    items: function() {
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


        /**
         * Validation related functions.
         */
        $scope.getCssClasses = function(ngModelController) {
            return {
                validationError: ngModelController.$invalid && ngModelController.$dirty,
                validationSuccess: ngModelController.$valid && ngModelController.$dirty
            }
        };

        $scope.showError = function(ngModelController, error) {
            return ngModelController.$error[error];
        };

        $scope.canSave = function(form, edit) {

            return angular.isDefined(edit) ? form.$valid : form.$dirty && form.$valid;
        };

        /**
         * Alert related function..
         *
         */
        $scope.alerts = [];

        $scope.closeAlert = function(index) {
            $scope.alerts.splice(index, 1);
        };
    }
]);
