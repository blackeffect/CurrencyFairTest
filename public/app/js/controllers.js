(function() {
    var as = angular.module('myApp.controllers', []);
    as.controller('AppCtrl', function($scope, $rootScope, $http, $location) {

        $scope.activeWhen = function(value) {
            return value ? 'active' : '';
        };

        $scope.path = function() {
            return $location.url();
        };

        $rootScope.appUrl = "http://" + document.domain;
    });

    as.controller('MessageListCtrl', function($scope, $rootScope, $http, $location) {
        var load = function() {
            console.log('call load()...');
            $http.get($rootScope.appUrl + '/messages')
                .success(function(data, status, headers, config) {
                    $scope.messages = data.data;
                    angular.copy($scope.messages, $scope.copy);
                });
        }

        load();

        $scope.addMessage = function() {
            console.log('call addMessage');
            $location.path("/new");
        }
    });

    as.controller('NewMessageCtrl', function($scope, $rootScope, $http, $location, $filter) {

    	$scope.currency = ['USD','GBP','EUR'];
        $scope.message = {};
    	// dummy data to complete the correct request format
    	// should be replaced in real application
    	$scope.message.userId = 123000;
    	$scope.message.rate = 0.1111;
    	$scope.message.originatingCountry = "UK";
        
        $scope.saveMessage = function() {
            console.log('call saveMessage');
            
            $scope.message.timePlaced = $filter('date')(new Date(),'dd-MM-yyyy HH:mm:ss');

            $http.post($rootScope.appUrl + '/messages', $scope.message)
                .success(function(data, status, headers, config) {
                    console.log('success...');
                    $location.path('/messages');
                })
                .error(function(data, status, headers, config) {
                    console.log(config);
                    console.log('error...');
                });
        }
    });
}());
