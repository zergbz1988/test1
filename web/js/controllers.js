'use strict';

var controllers = angular.module('controllers', []);

controllers.controller('UserController', ['$scope', 'UserService', '$timeout', '$filter',
    function ($scope, UserService, $timeout, $filter) {
        $scope.users = [];
        UserService.get().then(function (data) {
            if (data.status == 200) {
                $scope.users = data.data;
            }
        }, function (err) {
            console.log(err);
        });

        $scope.filterAndSortUsers = function () {
            UserService.get($scope.filter, $scope.sort).then(function (data) {
                if (data.status == 200) {
                    $scope.users = data.data;
                }
            }, function (err) {
                console.log(err);
            });
        };

        $scope.updateUser = function (id, fio, phone, country_id, oldVals) {
            if (typeof phone != 'undefined' && phone.length == 11) {
                UserService.update(id, fio, phone, country_id).then(function (data) {
                    if (data.status == 200) {
                        if (data.data.status == 'success') {
                            $scope.errorMessage = '';
                            $scope.message = data.data.message;
                            $timeout(function () {
                                $scope.message = '';
                            }, 1000);
                        } else if (data.data.status == 'error') {
                            $scope.message = '';
                            $scope.errorMessage = data.data.message;
                            $timeout(function () {
                                $scope.errorMessage = '';
                            }, 1000);
                            if ('fio' in oldVals) {
                                $scope.users[oldVals.index].fio = oldVals.fio;
                            }
                            if ('country' in oldVals) {
                                $scope.users[oldVals.index].country = oldVals.country;
                            }
                        }
                    }
                }, function (err) {
                    console.log(err);
                });
            }
        };
    }
]);