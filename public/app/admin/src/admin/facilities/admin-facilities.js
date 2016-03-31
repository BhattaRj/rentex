/**
 * Facilities Module.
 */

angular.module('admin-facilities', [
    'ngRoute',
    'ngResource',
    'resources.facilities',
    'numfmt-error-module',
]);

angular.module('admin-facilities').config(['$routeProvider', function($routeProvider) {
    $routeProvider.
    when('/facilities', {
        templateUrl: 'app/admin/src/admin/facilities/facilities-list.tpl.html',
        controller: 'FacilitiesListController'
    });

}]);

/**
 * List Facilities.
 */
angular.module('admin-facilities').controller('FacilitiesListController', ['$scope', '$location', 'Facility', '$modal',

    function($scope, $location, Facility, $modal) {


        Facility.query(function(resp) {
            $scope.facilities = resp;
            $scope.totalItems = resp.length;
        }, function(err) {
            console.log('error in fetch. ' + err);
        });

        $scope.sortField = 'title';

        $scope.isSelected = function(modal) {
            return $scope.modal === modal;
        };

        /**
         * Delete update and create.
         */

        $scope.delete = function(facility, $index, $event) {

            $event.stopPropagation();

            Facility.remove({}, {
                id: facility.id
            }, function(response) {

                if (response.success == true) {
                    $scope.facilities.splice($index, 1);
                    $scope.alerts.push({
                        type: 'success',
                        msg: 'Facility successfully deleted !!   '
                    });
                }

            }, function(error) {
                console.log('error in delete' + error);
            });
        };

        $scope.edit = function(id, $event) {

            $event.stopPropagation();

            var template = 'app/admin/src/admin/facilities/facilities-edit.tpl.html',
                controller = 'FacilitiesEditController',
                size = 'm';

            Facility.get({
                id: id
            }, function(response) {
                if (response.success) {
                    $scope.showModal(template, controller, size, response.data);
                }
            }, function(error) {
                console.log('Error Occoured !!!')
            });
        };

        $scope.new = function() {

            var template = 'app/admin/src/admin/facilities/facilities-new.tpl.html',
                controller = 'FacilitiesNewController',
                size = 'm';

            $scope.showModal(template, controller, size);
        };
    }
]);


/**
 * Add new Facility.
 */
angular.module('admin-facilities').controller('FacilitiesNewController', ['$scope', '$resource', '$location', 'Facility', '$route',

    function($scope, $resource, $location, Facility, $route) {

        // Save new model.
        $scope.save = function(data) {
            Facility.save({}, {
                data
            }, function(response) {
                if (response.success) {
                    $scope.modalInstance.close();
                    $route.reload();
                    $scope.alerts.push({
                        type: 'success',
                        msg: 'Facility successfully added !!   '
                    });
                }
            }, function(error) {
                if (error.status = 422) {
                    console.log('validation errors.');
                }
            });
        };
    }
]);


/**
 * Update Facility.
 */

angular.module('admin-facilities').controller('FacilitiesEditController', ['$scope', '$routeParams', '$location', 'Facility', 'items', '$route',
    function($scope, $routeParams, $location, Facility, items, $route) {

        $scope.facility = items;

        // Update the facility.
        $scope.update = function(data) {

            Facility.update({
                id: data.id,
                data: data
            }, function(response) {
                if (response.success) {
                    $scope.modalInstance.close();
                    $route.reload();
                    $scope.alerts.push({
                        type: 'success',
                        msg: 'Facility successfully Udated !!   '
                    });
                }
            }, function(error) {
                if (422 == error.status) {
                    console.log('validation error occoured!!');
                }
            });
        };
    }
]);
