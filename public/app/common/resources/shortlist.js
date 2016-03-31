/**
 *  Resourse for flat creates read update delte request for flat.
 */
angular.module('resources.shortlist', ['ngResource', 'ngRoute'])
    .factory('Shortlist', function($resource) {
        return $resource('/shortlist/:id', {
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
