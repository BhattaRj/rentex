angular.module('myAccount-message', [
    'ui.router',
    'ngResource',
    'resources.message',
    'pagination',
    'resources.shortlist',
    'numfmt-error-module',
    'ngSanitize',
]);


angular.module('myAccount-message').config(['$stateProvider', '$urlRouterProvider',
    function($stateProvider, $urlRouterProvider) {

        $stateProvider
            .state('message', {
                url: "/message",
                templateUrl: 'app/client/src/myAccount/message/message.tpl.html',
                controller: 'MessageController'
            })
            .state('message.list', {
                url: "/message-list",
                templateUrl: 'app/client/src/myAccount/message/message-list.tpl.html',
                controller: 'MessageListController'
            })
            .state('message.show', {
                url: '/show/:messageId',
                templateUrl: 'app/client/src/myAccount/message/message-show.tpl.html',
                controller: 'MessageShowController'
            })

    }
]);


angular.module('myAccount-message').controller('MessageController', ['$scope', '$location', 'Message',
    function($scope, $location, Message) {
        /**
         * Fetch all messages of current user.
         */
        $scope.getMessages = function() {
            Message.get({

            }, function(response) {
                if (response.success == true) {
                    $scope.messages = response.data;
                }
            }, function(err) {
                console.log('error in fetch' + err);
            });
        };

        $scope.getMessages();


    }
]);


angular.module('myAccount-message').controller('MessageListController', ['$scope', '$location', 'Message',
    function($scope, $location, Message) {

        /**
         * Make delete button show.
         */
        $scope.showDelete = function() {
            if($scope.getSelectedMessages().length > 0){
                $scope.remove = true;
            }else{
                $scope.remove = false;
            }
        };

        /**
         * Delete messages.
         */
        $scope.deleteMessages = function() {
            Message.remove({}, {
                id: $scope.getSelectedMessages(),
            }, function(response) {

                if (response.success == true) {
                    $scope.getMessages();
                    $scope.alerts.push({
                        type: 'success',
                        msg: 'Message successfully deleted !!   '
                    });
                }
            }, function(response) {
                console.log('error in delete' + error);
            });
        };

        /**
         * Make array of slected messages.
         * @return {array} ids of selected messages.
         */
        $scope.getSelectedMessages = function() {
            var ids = [];
            angular.forEach($scope.messages, function(value, key) {
                if (value.selected == true) {
                    ids.push(value.id);
                }
            });
            return ids;
        };
    }
]);


angular.module('myAccount-message').controller('MessageShowController', ['$scope', 'Message', '$stateParams',
    function($scope, Message, $stateParams) {

        $scope.messageId = $stateParams.messageId;

        /**
         * fetch messages user.
         */
        Message.get({
            id: $scope.messageId,
        }, function(response) {
            if (response.success == true) {
                $scope.message = response.data;
                if ($scope.message.status == 0) {
                    $scope.update();
                }
            }
        }, function(err) {
            console.log('error in fetch' + err);
        });

        /**
         * Make the status of the message as read.
         *
         */
        $scope.update = function(flat) {

            Message.update({
                id: $scope.messageId,
            }, function(response) {
                if (response.success) {

                }
            }, function(error) {
                if (422 == error.status) {
                    console.log('validation error occoured!!');
                }
            });
        };
    }
]);
