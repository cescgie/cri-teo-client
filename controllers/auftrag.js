app.controller('AuftragCtrl', function($scope, Criteo, $stateParams) {
    $scope.setParams = {};
    $scope.setParams.Auftragsnummer = $stateParams.auftragsnummer;
    $scope.setParams.Auftragsposition = $stateParams.auftragsposition;

    $scope.init = function(){
      Criteo.getOneKampagneDatum($scope.setParams).then(function(response){
        $scope.datumkampagnes = response.data;
      });
      Criteo.getOneKampagneMonat($scope.setParams).then(function(response){
        $scope.monatkampagnes = response.data;
      });
    };

    $scope.init();

});
