app.factory('Criteo', function($http) {
    return {
      getAllAuftrag: function(){
        return $http.get('api/criteo/getAuftrag');
      },
      getOneKampagne:function(setParams){
        return $http.get('api/criteo/getKampagne/'+setParams.Auftragsnummer+'/'+setParams.Auftragsposition);
      }
    }
  });
