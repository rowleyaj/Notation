(function(angular){

    'use strict';

    angular.module('notation', ['ngResource'])
    .config(['$interpolateProvider', '$routeProvider', function($interpolateProvider, $routeProvider){
        $interpolateProvider.startSymbol('[[').endSymbol(']]');

        $routeProvider.when('/', {
            templateUrl: '/assets/admin/templates/postList.html'
        });

        $routeProvider.when('/edit/:postId', {
            templateUrl: '/assets/admin/templates/editor.html',
            controller: 'editorCtl'
        }).otherwise({redirectTo: '/'});

        $routeProvider.when('/add',{
            templateUrl: '/assets/admin/templates/editor.html',
            controller: 'editorCtl'
        });

    }])

    /*-----------------------------------
    | Truncation Filter
    ------------------------------------*/

    .filter('truncate', function(){
        return function(input,limit){
            return (input.length > limit) ? input.substring(0, limit)+'…' : input;
        };
    })

    /*-----------------------------------
    | Clean Filter
    ------------------------------------*/

    .filter('clean', function(){
        return function(input){
            return input.replace(/&/g, 'and').replace(/[^a-zA-Z0-9 -]+/g, '').replace(/\s+/g, '-').toLowerCase();
        };
    })

    /*-----------------------------------
    | App Controller
    ------------------------------------*/

    .controller('appCtl', ['$scope', '$resource', function(scope, resource){
        scope.resource = resource('/api/posts/:filename', {filename: '@filename'}, {save: {method: 'PUT'}, create: {method: 'POST'}});
        scope.resource.query(function(data){
            scope.posts = data;
        });
    }])

    /*-----------------------------------
    | Editor Controller
    ------------------------------------*/

    .controller('editorCtl', ['$scope', '$routeParams', '$location', '$filter', function(scope, routeParams, location, filter){

        scope.newPost = (routeParams.postId) ? scope.posts[routeParams.postId-1] : new scope.resource({});
        var saveBtn = angular.element('#saveBtn');

        scope.setChanged = function(){
            saveBtn.removeAttr('disabled').text('Publish Changes');
        };

        scope.deletePost = function(){
            if(window.confirm('Are you sure you want to delete this post?')){
                var i = scope.posts.indexOf(scope.newPost);
                scope.posts.splice(i, 1);
                scope.newPost.$delete(function(){
                    location.path('/');
                });
            }
        };

        scope.setSlug = function(){
            scope.setChanged();
            scope.newPost.slug = filter('clean')(scope.newPost.title);
        };

        scope.cleanSlug = function(){
            scope.setChanged();
            scope.newPost.slug = filter('clean')(scope.newPost.slug);
        };

        scope.savePost = function(){
            if(scope.newPost.filename){
                scope.newPost.$save(function(){
                    saveBtn.attr('disabled', true).text('Saved');
                });
            } else {
                scope.newPost.$create(function(){
                    scope.posts.splice(0, 0, scope.newPost);
                    location.path('/edit/1');
                });
            }
        };

    }]);

})(window.angular);