<?php
/* @var $this yii\web\View */

$this->title = 'Users';
?>

<div class="users-index" data-ng-controller="UserController">
    <div>
        <h1>All users</h1>
        <div data-ng-show="users.length > 0">
            <table class="table table-striped table-hover">
                <thead>
                <th>FIO</th>
                <th>Phone</th>
                <th>Country</th>
                </thead>
                <tbody>
                <tr data-ng-repeat="user in users">
                    <td><input type="text" ng-model="user.fio" data-ng-change="changeItem(user.id)"></td>
                    <td><input type="text" ng-model="user.phone" data-ng-change="changeItem(user.id)"></td>
                    <td>
                        <select data-ng-model="user.country" data-ng-options="country as country.title for country in user.countries track by country.id">
                        </select>
                    </td>
                </tr>
                </tbody>
            </table>
        </div>
        <div data-ng-show="users.length == 0">
            No results
        </div>
    </div>
</div>
