// Ionic Starter App

// angular.module is a global place for creating, registering and retrieving Angular modules
// 'starter' is the name of this angular module example (also set in a <body> attribute in index.html)
// the 2nd parameter is an array of 'requires'


/*
|--------------------------------------------------------------------------
*/
var base_url = "http://kot-api.local/";
/*
|-------------------------------------------------------------------------*/

var kot_app=angular.module('starter', ['ionic'])
 
kot_app.run(function($ionicPlatform) {
    $ionicPlatform.ready(function() {
        // Hide the accessory bar by default (remove this to show the accessory bar above the keyboard
        // for form inputs)
        if (window.cordova && window.cordova.plugins.Keyboard) {
            cordova.plugins.Keyboard.hideKeyboardAccessoryBar(true);
        }
        if (window.StatusBar) {
            StatusBar.styleDefault();
        }
    });
})
 
kot_app.controller('AppCtrl', function($scope, $http) {
  $scope.user = {};     
    $http.get(base_url+"/api/v1/users/").then(function(response) {
                $scope.users = response.data.data
                //console.log(response.data.data.username);
            });
    $scope.Manage_enterdata = function(user,UserInsertionForm){
        $http.post(base_url+'api/v1/addusername', user).then(function(response){
            $http.get(base_url+"/api/v1/users/").then(function(response) {
                $scope.users = response.data.data
                //console.log(response.data.data.username);
            });
            $scope.response = response.data.resp_msg;    
            var errors ="";
            for (var key in response.data.resp_error) {
              errors += response.data.resp_error[key]+" ";
            }
            $scope.response_error = errors;
            $scope.user.username =""; 
            
        })
    };    
    
});
