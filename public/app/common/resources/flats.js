/**
 *  Resourse for flat creates read update delte request for flat.
 */
angular.module('resources.flats', ['ngResource', 'ngRoute'])
    .factory('Flat', function($resource) {
        return $resource('/flat/:id', {
            id: '@id'
        } ,{
            update: {
                method: 'PUT',
                transformResponse: function(data, headerFn) {
                    // Return modified data for the response
                    return JSON.parse(data);
                }
            },
            query:{
                method:'GET',
                isArray:false,
            }
        });

    });
