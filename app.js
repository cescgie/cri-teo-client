var app = angular.module('MyApp', ['ngResource', 'ngMessages', 'ngAnimate', 'toastr', 'ui.router', 'angularSpinner', '720kb.datepicker', 'datatables']);

app.config(function($stateProvider, $urlRouterProvider,$anchorScrollProvider) {

    $anchorScrollProvider.disableAutoScrolling();

    $stateProvider
      .state('home', {
        url: '/',
        templateUrl: 'partials/home.html'
      })
      .state('auftrag', {
        url: '/auftrag/:auftragsnummer/:auftragsposition',
        templateUrl: 'partials/auftrag.html'
      });

      $urlRouterProvider.otherwise('/');
  });
