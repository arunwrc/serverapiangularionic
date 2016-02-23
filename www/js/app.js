// Ionic Starter App

// angular.module is a global place for creating, registering and retrieving Angular modules
// 'starter' is the name of this angular module example (also set in a <body> attribute in index.html)
// the 2nd parameter is an array of 'requires'
var base_url = "http://ionic-angular-api.local/";
angular.module('starter', ['ionic'])
 
.run(function($ionicPlatform) {
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
 
.controller('AppCtrl', function($scope, $http) {
  $scope.user = {};  
    $scope.Manage_enterdata = function(user,UserInsertionForm){
        $http.post(base_url+'api/v1/addusername', user).then(function(response){
            $scope.response = response.data.msg;    
            $scope.user.username ="";
        })
    };    
});