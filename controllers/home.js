app.controller('HomeCtrl', function($scope, Criteo) {
    /**
    * Get all Auftrags from database
    * @param : -
    */
    Criteo.getAllAuftrag().then(function(response){
      $scope.auftrags = response.data;
    });

});
