/**
 * Created by samsuj on 29/10/15.
 */


'use strict';

/* App Module */

var pbs_landing = angular.module('pbs_landing', ['ui.router','angularValidator','ngCookies','ui.bootstrap','ngFileUpload']);

pbs_landing.run(['$rootScope', '$state',function($rootScope, $state){

    $rootScope.$on('$stateChangeStart',function(){
        $rootScope.stateIsLoading = true;
    });


    $rootScope.$on('$stateChangeSuccess',function(){
        $rootScope.stateIsLoading = false;
    });

}]);

pbs_landing.config(function($stateProvider, $urlRouterProvider,$locationProvider) {

// For any unmatched url, redirect to /state1
    $urlRouterProvider
        .otherwise("/index");

//
    // Now set up the states
    $stateProvider
        .state('index',{
            url:"/index",
            views: {

                'loader': {
                    controller: 'index'
                },

            }
        }
    )
        .state('home',{
            url:"/home",
            views: {

                'header': {
                    templateUrl: 'partial/header.html' ,
                    //controller: 'header'
                },
                'footer': {
                    templateUrl: 'partial/footer.html' ,
                    //controller: 'footer'
                },
                'content': {
                    templateUrl: 'partial/home.html' ,
                    controller: 'home'
                },

            }
        }
    )
        .state('checkout',{
            url:"/checkout",
            views: {

                'header': {
                    templateUrl: 'partial/header.html' ,
                    //controller: 'header'
                },
                'footer': {
                    templateUrl: 'partial/footer.html' ,
                    //controller: 'footer'
                },
                'content': {
                    templateUrl: 'partial/checkout.html' ,
                    controller: 'checkout'
                },

            }
        }
    )
        .state('thankyou',{
            url:"/thankyou",
            views: {

                'header': {
                    templateUrl: 'partial/header.html' ,
                    //controller: 'header'
                },
                'footer': {
                    templateUrl: 'partial/footer.html' ,
                    //controller: 'footer'
                },
                'content': {
                    templateUrl: 'partial/thankyou.html' ,
                    controller: 'thankyou'
                },

            }
        }
    )


    $locationProvider.html5Mode({
        enabled: true,
        requireBase: false,
        hashPrefix:'!'
    });

});




pbs_landing.controller('index', function($scope,$state,$cookieStore) {
    $state.go('home');
    return
});

pbs_landing.controller('home', function($scope,$state,$cookieStore,$http,$rootScope) {

    $scope.step1 = function(){
        $rootScope.stateIsLoading = true;
        $http({
            method  : 'POST',
            async:   false,
            url     : $scope.adminUrl+'/step1',
            data    : $.param($scope.form),  // pass in data as strings
            headers : { 'Content-Type': 'application/x-www-form-urlencoded' }
        }) .success(function(data) {
            $rootScope.stateIsLoading = false;

            $cookieStore.put('userid',data);
            $cookieStore.put('fname',$scope.form.fname);
            $cookieStore.put('lname',$scope.form.lname);

            $state.go('checkout');
            return
        });
    }

});

pbs_landing.controller('checkout', function($scope,$state,$cookieStore,$rootScope,$http) {
    $scope.fname = '';
    $scope.lname = '';

    if(typeof($cookieStore.get('fname')) != 'undefined'){
        $scope.fname = $cookieStore.get('fname');
    }

    if(typeof($cookieStore.get('lname')) != 'undefined'){
        $scope.lname = $cookieStore.get('lname');
    }

    if(typeof($cookieStore.get('userid')) != 'undefined' && $cookieStore.get('userid')>0){
        $scope.form = {
            id :$cookieStore.get('userid'),
            fname : $scope.fname,
            lname : $scope.lname,
        }
    }else{
        $state.go('home');
        return
    }

    $scope.step2 = function(){
        $rootScope.stateIsLoading = true;
        $http({
            method  : 'POST',
            async:   false,
            url     : $scope.adminUrl+'/step2',
            data    : $.param($scope.form),  // pass in data as strings
            headers : { 'Content-Type': 'application/x-www-form-urlencoded' }
        }) .success(function(data) {
            $rootScope.stateIsLoading = false;

            $cookieStore.remove('userid');
            $cookieStore.remove('fname');
            $cookieStore.remove('lname');

            $state.go('thankyou');
            return
        });
    }

});
pbs_landing.controller('thankyou', function($scope,$state,$cookieStore,$rootScope,$http) {

});