<?php
/* @var $this yii\web\View */

$this->title = 'Users';
?>

<div class="users-index" data-ng-controller="UserController">
    <div>
        <div class="message" ng-show="message">
            <span>{{message}}</span>
        </div>
        <div class="error-message" ng-show="errorMessage">
            <span>{{errorMessage}}</span>
        </div>
        <h1>Users</h1>
        <div class="options-block">
            <div class="form-group">
                <label for="searchInput">Filter by FIO: </label>
                <input id="searchInput" type="text" data-ng-model="filter" data-ng-change="filterAndSortUsers()"
                       class="form-control search-input">
            </div>
            <div class="form-group">
                <label for="sortInput">Sort: </label>
                <select id="sortInput" data-ng-model="sort" class="form-control search-input"
                        data-ng-change="filterAndSortUsers()">
                    <option value="fio">FIO ASC</option>
                    <option value="-fio">FIO DESC</option>
                </select>
            </div>
        </div>
        <div data-ng-show="users.length > 0" class="users-list">
            <table class="table table-striped table-hover">
                <thead>
                <th>FIO</th>
                <th>Country</th>
                <th>Phone</th>
                </thead>
                <tbody>
                <tr data-ng-repeat="user in users">
                    <td><input type="text" ng-model="user.fio"
                               data-ng-change="updateUser(user.id, user.fio, user.phone, user.country.id, {fio: '{{user.fio}}', index: $index})"
                               class="form-control"></td>
                    <td>
                        <select data-ng-change="updateUser(user.id, user.fio, user.phone, user.country.id, {country: '{{user.country}}', index: $index})"
                                data-ng-model="user.country"
                                data-ng-options="country as country.title for country in user.countries track by country.id"
                                class="form-control">
                        </select>
                    </td>
                    <td><input type="text" ng-model="user.phone"
                               data-ng-change="updateUser(user.id, user.fio, user.phone, user.country.id)"
                               class="form-control" data-ui-mask="+9(999)9999999"></td>
                </tr>
                </tbody>
            </table>
        </div>
        <div data-ng-show="users.length == 0">
            No results
        </div>
    </div>
</div>
