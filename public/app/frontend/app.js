'use strict';

angular.module('app', [
    'ngResource',
    'ngSanitize',
    'ngTouch',
    'ui.router',
    'ui.utils',
    'ui.jq',
    'ngRoute',
    'ngResource',
    'ui.bootstrap',
    'angularMoment',
    'flat',
    'header',
    'myAccount',
    'customeFilters',
    'component'
]);
var app = angular.module('app').config(
    ['$controllerProvider', '$compileProvider', '$filterProvider', '$provide', '$interpolateProvider',
        function($controllerProvider, $compileProvider, $filterProvider, $provide, $interpolateProvider) {

            app.controller = $controllerProvider.register;
            app.directive = $compileProvider.directive;
            app.filter = $filterProvider.register;
            app.factory = $provide.factory;
            app.service = $provide.service;
            app.constant = $provide.constant;
            app.value = $provide.value;
            // $interpolateProvider.startSymbol('::');
            // $interpolateProvider.endSymbol('::');
            // Change the default expression layout style.
            $interpolateProvider.startSymbol('<%');
            $interpolateProvider.endSymbol('%>');
        }
    ]);
angular.module('app').controller('AppCtrl', ['$scope', '$state', '$modal',
    function($scope, $state, $modal) {
        var htmlClass = {
            website: 'transition-navbar-scroll top-navbar-xlarge bottom-footer',
            websitePricing: 'top-navbar-xlarge bottom-footer app-desktop',
            websiteSurvey: 'top-navbar-xlarge bottom-footer app-desktop app-mobile',
            websiteLogin: 'hide-sidebar ls-bottom-footer',
            websiteTakeQuiz: 'transition-navbar-scroll top-navbar-xlarge bottom-footer app-desktop app-mobile',
            appl3: 'st-layout ls-top-navbar-large ls-bottom-footer show-sidebar sidebar-l3',
            appl1r3: 'st-layout ls-top-navbar-large ls-bottom-footer show-sidebar sidebar-l1 sidebar-r3'
        };
        $scope.app = {
            settings: {
                htmlClass: '',
                bodyClass: ''
            }
        };
        $scope.app.settings.htmlClass = htmlClass.website;
        $scope.app.settings.bodyClass = '';
        $scope.$state = $state;
        
        /**
         * Define apllication level variable.
         */
        $scope.dataFactory = dataFactory;
        $scope.user = user;
        $scope.login = login;

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


        $scope.confirmLogin = function() {
            var confirmLoginTemplate = 'app/frontend/partials/confirmLogin.html',
                confirmLoginController = 'ConfirmLoginController',
                confirmLoginModelSize = 'xs';

            $scope.showModal(confirmLoginTemplate, confirmLoginController, confirmLoginModelSize);
        };
    }
]);
angular.module('app').run(['$rootScope', '$state', '$stateParams',
    function($rootScope, $state, $stateParams) {
        $rootScope.$state = $state;
        $rootScope.$stateParams = $stateParams;
    }
]);
angular.module('app').config(['$stateProvider', '$urlRouterProvider', function($stateProvider, $urlRouterProvider) {
    $urlRouterProvider.otherwise('home');
    $stateProvider.state('home', {
        url: '/home',
        templateUrl: 'app/frontend/home/home.html',
        controller: ['$scope', function($scope) {}]
    });
}]);

angular.module('app').controller('ConfirmLoginController', ['$scope', function($scope) {
    debugger
}])