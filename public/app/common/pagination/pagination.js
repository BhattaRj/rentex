/**
 * All directives goes here.
 *
 * Pagination directive eg.
 *
 * In controller.
 * $scope.facilities=[];
 * $scope.facilities=Facility.query();
 * $scope.facilities.$promise.then(function(result){
 *     $scope.facilpaginationities=result;
 *     $scope.numPages=Math.ceil($scope.facilities.length / $scope.pageSize);
 *     $scope.totalRecords=$scope.facilities.length;
 *  })
 *  // Variable for pagination..
 *  $scope.currentPage = 1;
 *  $scope.pageSize = 4;
 *
 *  In Template-
 *
 * <tbody ng-repeat="facility in filteredFacilities= (facilities|paginate:currentPage:pageSize)
 *
 *  <pagination-dir num-pages="numPages" current-page="currentPage" total-records="totalRecords"></pagination-dir>
 *
 */

angular.module('pagination', [])
    .directive('paginationDir', function() {
        return {
            scope: {
                numPages: '=',
                currentPage: '=',
                totalRecords: '='
            },
            templateUrl:'/app/common/pagination/pagination.html',

            replace: true,
            link: function(scope) {
                scope.$watch('numPages', function(value) {
                    scope.pages = [];
                    for (var i = 1; i <= value; i++) {
                        scope.pages.push(i);
                    }
                    if (scope.currentPage > value) {
                        scope.selectPage(value);
                    }
                });
                scope.isActive = function(page) {
                    return scope.currentPage === page;
                };

                scope.selectPage = function(page) {
                    if (!scope.isActive(page)) {
                        scope.currentPage = page;
                    }
                };
                scope.noNext = function() {
                    if (scope.numPages != undefined) {
                        return scope.numPages == scope.currentPage;
                    }
                    return false;
                };

                scope.noPrevious = function() {
                    if (scope.numPages != undefined) {
                        return scope.currentPage == 1
                    }
                };
                scope.selectNext = function() {
                    if (!scope.noNext()) {
                        scope.selectPage(scope.currentPage + 1);
                    }
                };
                scope.selectPrevious = function() {
                    if (!scope.noPrevious()) {
                        scope.selectPage(scope.currentPage - 1);
                    }
                };
            }
        }
    })
    .filter('paginate', function() {
        return function(dataArray, pageNo, pageSize) {
            if (dataArray != undefined && dataArray.length != 0) {
                var end = pageNo * pageSize;
                var start = end - pageSize;
                var dataAR = dataArray.slice(start, end);
                return dataAR;
            }
        }
    })
    .filter("unique", function() {
        return function(data, propertyName) {
            if (angular.isArray(data) && angular.isString(propertyName)) {
                var results = [];
                var keys = {};
                for (var i = 0; i < data.length; i++) {
                    var val = data[i][propertyName];
                    if (angular.isUndefined(keys[val])) {
                        keys[val] = true;
                        results.push(val);
                    }
                }
                return results;
            } else {
                return data;
            }
        }
    })
    .filter("range", function($filter) {
        return function(data, page, size) {
            if (angular.isArray(data) && angular.isNumber(page) && angular.isNumber(size)) {
                var start_index = (page - 1) * size;
                if (data.length < start_index) {
                    return [];
                } else {
                    return $filter("limitTo")(data.splice(start_index), size);
                }
            } else {
                return data;
            }
        }
    })
    .filter("pageCount", function() {
        return function(data, size) {
            if (angular.isArray(data)) {
                var result = [];
                for (var i = 0; i < Math.ceil(data.length / size); i++) {
                    result.push(i);
                }
                return result;
            } else {
                return data;
            }
        }
    });
