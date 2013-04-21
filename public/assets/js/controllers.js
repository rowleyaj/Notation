(function(){

    'use strict';
    window.angular.module('notation', ['ngResource'])
    .config(['$interpolateProvider', function($interpolateProvider){
        $interpolateProvider.startSymbol('[[').endSymbol(']]');
    }])
    .controller('AppCtl', ['$scope', '$resource', '$location', '$filter', function($scope, $resource, $location, $filter){

        $scope.posts = $resource('/api/posts');
        $scope.posts.query(function(data){
            $scope.posts = data;
            $scope.currentPost = ($location.$$path) ? $filter('filter')($scope.posts, {slug: $location.$$path.substring(1)})[0] : $scope.posts[0];
        });
        $scope.showPost = function(post){
            $scope.currentPost = post;
        };
    }]);

})();