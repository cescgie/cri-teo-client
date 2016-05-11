app.factory('Criteo', function($http) {
    return {
      getAllAuftrag: function(){
        return $http.get('api/criteo/getAuftrag');
      },
      getOneKampagneDatum:function(setParams){
        return $http.get('api/criteo/getKampagneDatum/'+setParams.Auftragsnummer+'/'+setParams.Auftragsposition);
      },
      getOneKampagneMonat:function(setParams){
        return $http.get('api/criteo/getKampagneMonat/'+setParams.Auftragsnummer+'/'+setParams.Auftragsposition);
      }
    }
  });
