/**
 * Send messag to the Agent or Owner.
 */

angular.module('component',[]);



angular.module('component').controller('SendMessageController', ['$scope', '$resource', '$location', 'Message', '$route', 'data',
    function($scope, $resource, $location, Message, $route, data) {

        $scope.recever_id = data.id;
        // Save new model.
        $scope.save = function(data) {
            data.recever_id = $scope.recever_id;
            Message.save({}, {
                data
            }, function(response) {
                if (response.success) {
                    $scope.modalInstance.close();
                    $route.reload();
                    $scope.alerts.push({
                        type: 'success',
                        msg: 'Message successfully Send!!'
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
