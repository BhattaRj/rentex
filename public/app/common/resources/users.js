/**
 *  Resourse for flat creates read update delte request for flat.
 */
angular.module('resources.users', ['ngResource', 'ngRoute'])
    .factory('User', function($resource) {
        return $resource('/user/:id', {
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
