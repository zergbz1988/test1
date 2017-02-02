'use strict';

var usersApp = angular.module('usersApp');

usersApp.service('UserService', function ($http) {
    this.get = function (filter, sort) {
        return $http.get('/users', {
            params: {
                "UserSearch[fio]": filter,
                "sort": sort
            }
        });
    };
    this.create = function (data) {
        return $http.post('/users', data);
    };
    this.update = function (id, fio, phone, country_id) {
        return $http.put('/users/' + id, {
            User: {
                fio: fio,
                phone: phone,
                country_id: country_id
            }
        });
    };
    this.delete = function (id) {
        return $http.delete('/users/' + id);
    };
});