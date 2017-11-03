<!DOCTYPE html>
<html xmlns:ng="http://angularjs.org" ng-app="app" xml:lang="zh-TW" lang="zh-TW">
<head>
<meta charset="utf-8" />
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
<title></title>

<!--[if lt IE 9]><script src="/js/html5shiv.js"></script><![endif]-->
<script src="/js/angular/1.5.8/angular.min.js"></script>
<script src="/js/angular/1.5.8/angular-sanitize.min.js"></script>
<script src="/js/angular/1.5.8/angular-cookies.min.js"></script>
<script src="/js/angular/1.5.8/angular-animate.min.js"></script>
<script src="/js/angular/1.5.8/angular-aria.min.js"></script>
<script src="/js/angular/1.5.8/angular-messages.min.js"></script>
<script src="/js/angular_material/1.1.1/angular-material.min.js"></script>
<script src="/js/dist/orders.js"></script>

<!--<link rel="stylesheet" href="/css/Semantic-UI/2.2.4/semantic.min.css" />-->
<link rel="stylesheet" href="/js/angular_material/1.1.1/angular-material.min.css">

<script>
(function() {
    'use strict';
    angular.module('app', ['ngSanitize', 'ngCookies', 'ngMaterial', 'breakfast'])

        .config(function ($compileProvider, $mdIconProvider, $mdThemingProvider) {
            $compileProvider.debugInfoEnabled(true);
            $mdIconProvider.defaultIconSet('/js/angular_material/core-icons.svg', 24);
        }).controller('mainController', function($scope) {
            $scope.isOpen = true;
        });
})();
</script>
<style>
md-grid-tile-footer figcaption {
    width: 100%;
}
md-grid-tile-footer figcaption h1 {
    text-align: center;
}
</style>
</head>
<body layout="column" ng-controller="mainController">

<md-toolbar class="md-hue-2">
      <div class="md-toolbar-tools">
      </div>
</md-toolbar>

<div layout="row" flex>
    <md-sidenav
        class="md-sidenav-left"
        md-component-id="left"
        md-is-locked-open="isOpen"
        md-whiteframe="4">
        <md-list flex>
            <md-list-item ng-click="null">訂單</md-list-item>
            <md-list-item ng-click="null">菜單</md-list-item>
        </md-list>
    </md-sidenav>
    <md-content flex>
        @yield('content')
    </md-content>
</div>
</body>
</html>