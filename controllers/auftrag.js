app.controller('AuftragCtrl', function($scope, toastr, Criteo, usSpinnerService, $rootScope, $stateParams) {
    $scope.setParams = {};
    $scope.setParams.Auftragsnummer = $stateParams.auftragsnummer;
    $scope.setParams.Auftragsposition = $stateParams.auftragsposition;
    Criteo.getOneKampagneDatum($scope.setParams).then(function(response){
      $scope.datumkampagnes = response.data;
    });
    Criteo.getOneKampagneMonat($scope.setParams).then(function(response){
      $scope.monatkampagnes = response.data;
    });
});
