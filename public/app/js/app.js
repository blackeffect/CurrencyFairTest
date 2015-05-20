(function() {

    var
	    //the HTTP headers to be used by all requests
	    httpHeaders,
	    //the message to be shown to the user
	    message,
	    app = angular.module('myApp', ['myApp.controllers']);

    app.config(function($routeProvider, $httpProvider) {
        $routeProvider
                .when('/messages', {templateUrl: 'partials/messages.html', controller: 'MessageListCtrl'})
                .when('/new', {templateUrl: 'partials/new.html', controller: 'NewMessageCtrl'})
                .otherwise({redirectTo: '/'});
    });

    app.config(function($httpProvider) {
        //configure $http to catch message responses and show them
        $httpProvider.responseInterceptors.push(
            function($q) {
                console.log('call response interceptor and set message...');
                var setMessage = function(response) {
                    //console.log('@data'+response.data);
                    if (response.data.message) {
                        message = {
                            text: response.data.message.text,
                            type: response.data.message.type,
                            show: true
                        };
                    }
                };
                return function(promise) {
                    return promise.then(
                            //this is called after each successful server request
                            function(response) {
                                setMessage(response);
                                return response;
                            },
                            //this is called after each unsuccessful server request
                            function(response) {
                                setMessage(response);
                                return $q.reject(response);
                            }
                            );
                        };
                    });
            });
        }());