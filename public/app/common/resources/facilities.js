angular.module('resources.facilities', ['ngResource', 'ngRoute'])
    .factory('Facility', function($resource) {

        return $resource('/admin/facility/:id', {
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
