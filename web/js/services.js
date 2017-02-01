'use strict';

var usersApp = angular.module('usersApp');

usersApp.service('UserService', function($http) {
    this.get = function() {
        return $http.get('/users');
    };
    this.post = function (data) {
        return $http.post('/users', data);
    };
    this.put = function (id, data) {
        return $http.put('/users/' + id, data);
    };
    this.delete = function (id) {
        return $http.delete('/users/' + id);
    };
});