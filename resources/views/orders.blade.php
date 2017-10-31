@extends('layouts.main')

@section('content')
<div ng-controller="ordersController">
<md-tabs md-dynamic-height md-border-bottom md-selected="area">
    <md-tab label="訂單">
        <orders ng-if="area==0"></orders>
    </md-tab>
    <md-tab label="調理區">
        <materials ng-if="area==1"></materials>
    </md-tab>
</md-tabs>
</div>

<script>
(function() {
    'use strict';

    angular.module('app')
        .controller('ordersController', function($scope, $http, $timeout) {



        });
})();
</script>
@endsection