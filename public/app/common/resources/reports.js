/**
 *  Resourse for flat creates read update delte request for flat.
 */
angular.module('resources.reports', ['ngResource', 'ngRoute'])
    .factory('Report', function($resource) {
        return $resource('/report/:id', {
            id: '@id'
        } ,{
            update: {
                method: 'PUT',
                transformResponse: function(data, headerFn) {
                    // Return modified data for the response
                    return JSON.parse(data);
                }
            }
        });

    });
