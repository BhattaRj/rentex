/**
 *  Resourse for flat creates read update delte request for flat.
 */
angular.module('resources.message', ['ngResource', 'ngRoute'])
    .factory('Message', function($resource) {
        return $resource('/message/:id', {
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
