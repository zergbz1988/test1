'use strict';

var controllers = angular.module('controllers', []);

controllers.controller('UserController', ['$scope', 'UserService',
    function ($scope, UserService) {
        $scope.users = [];
        UserService.get().then(function (data) {
            if (data.status == 200) {
                $scope.users = data.data;
            }
        }, function (err) {
            console.log(err);
        })
    }
]);