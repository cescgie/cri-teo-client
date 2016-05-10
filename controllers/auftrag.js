app.controller('AuftragCtrl', function($scope, toastr, Criteo, usSpinnerService, $rootScope, $stateParams) {
    $scope.setParams = {};
    $scope.setParams.Auftragsnummer = $stateParams.auftragsnummer;
    $scope.setParams.Auftragsposition = $stateParams.auftragsposition;
    Criteo.getOneKampagne($scope.setParams).then(function(response){
      $scope.kampagnes = response.data;
    });
});
