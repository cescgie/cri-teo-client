<?php

class Criteo extends Controller {

   public function __construct() {
      parent::__construct();
   }

   public function index() {
      $data['title'] = 'Home';

      $this->_view->render('header', $data);
      $this->_view->render('welcome', $data);
      $this->_view->render('footer');
   }

   public function getAuftrag(){
     $groupby = "GROUP BY Auftragsnummer,Auftragsposition";
     $select = "Auftragsnummer,Auftragsposition";
     $data["data"] = $this->_model->selectClauseGroupByOrderBy("gregtool_erfuellung",$select,null,$groupby,null);

     $array = [];
     foreach ($data["data"] as $key => $value) {
       $auftragsnummer = $value['Auftragsnummer'];
       $auftragsposition = $value['Auftragsposition'];
       $select2 = "Auftragsnummer,Auftragsposition,kampagne";
       $clause = "WHERE Auftragsnummer = '$auftragsnummer' AND Auftragsposition = '$auftragsposition'";
       $data["data2"] = $this->_model->selectClauseGroupByOrderBy("gregtool_auftrag_position",$select2,$clause,null,null);
       $array[$key] = $data["data2"][0];
     }
     return print_r(json_encode($array));
   }

   public function getKampagneDatum($auftragsnummer,$auftragsposition){
     $select = "*";
     $clause = "WHERE Auftragsnummer = '$auftragsnummer' AND Auftragsposition= '$auftragsposition'";
     $data["data"] = $this->_model->selectClauseGroupByOrderBy("gregtool_erfuellung",$select,$clause,null,null);

     $array = [];
     $default_imp_iq = 0;
     $default_view_iq = 0;
     $default_click_iq = 0;
     $default_imp_ad = 0;
     $default_click_ad = 0;
     foreach ($data["data"] as $key => $value) {
       $array[$key]['datum'] = date('Y-m-d', strtotime('-1 day', strtotime($value['datum'])));
       $array[$key]['Auftragsnummer'] = $value['Auftragsnummer'];
       $array[$key]['Auftragsposition'] = $value['Auftragsposition'];
       //imp_iq
       $array[$key]['imp_iq'] = $value['imp_iq'];
       $array[$key]['imp_iq_diff'] =  $value['imp_iq'] - $default_imp_iq;
       $default_imp_iq = $array[$key-1]['imp_iq'] + $array[$key]['imp_iq_diff'];
       //view_iq
       $array[$key]['view_iq'] = $value['view_iq'];
       $array[$key]['view_iq_diff'] =  $value['view_iq'] - $default_view_iq;
       $default_view_iq = $array[$key-1]['view_iq'] + $array[$key]['view_iq_diff'];
       //click_iq
       $array[$key]['click_iq'] = $value['click_iq'];
       $array[$key]['click_iq_diff'] =  $value['click_iq'] - $default_click_iq;
       $default_click_iq = $array[$key-1]['click_iq'] + $array[$key]['click_iq_diff'];
       //ctr_iq
       $array[$key]['ctr_iq'] = ($array[$key]['click_iq_diff']/$array[$key]['view_iq_diff'])*100;
       //imp_ad
       $array[$key]['imp_ad'] = $value['imp_ad'];
       $array[$key]['imp_ad_diff'] =  $value['imp_ad'] - $default_imp_ad;
       $default_imp_ad = $array[$key-1]['imp_ad'] + $array[$key]['imp_ad_diff'];
       //click_ad
       $array[$key]['click_ad'] = $value['click_ad'];
       $array[$key]['click_ad_diff'] =  $value['click_ad'] - $default_click_ad;
       $default_click_ad = $array[$key-1]['click_ad'] + $array[$key]['click_ad_diff'];
       //ctr_ad
       $array[$key]['ctr_ad'] = ($array[$key]['click_ad_diff']/$array[$key]['imp_ad_diff'])*100;
     }
     return print_r(json_encode($array));
   }

   public function getKampagneMonat($auftragsnummer,$auftragsposition){
     $select = "*";
     $clause = "WHERE Auftragsnummer = '$auftragsnummer' AND Auftragsposition= '$auftragsposition' AND Month(datum) != 01";
     $groupby = "GROUP BY Month(datum)";
     $data["data"] = $this->_model->selectClauseGroupByOrderBy("gregtool_erfuellung",$select,$clause,$groupby,null);

     $array = [];
     $default_imp_iq = 0;
     $default_view_iq = 0;
     $default_click_iq = 0;
     $default_imp_ad = 0;
     $default_click_ad = 0;
     $vales = [];
     foreach ($data["data"] as $key => $value) {
       $array[$key]['datum'] = date('m-Y', strtotime($value['datum']." -1 month"));
       $array[$key]['Auftragsnummer'] = $value['Auftragsnummer'];
       $array[$key]['Auftragsposition'] = $value['Auftragsposition'];
       //imp_iq
       $array[$key]['imp_iq'] = $value['imp_iq'];
       $array[$key]['imp_iq_diff'] =  $value['imp_iq'] - $default_imp_iq;
       $default_imp_iq = $array[$key-1]['imp_iq'] + $array[$key]['imp_iq_diff'];
       //view_iq
       $array[$key]['view_iq'] = $value['view_iq'];
       $array[$key]['view_iq_diff'] =  $value['view_iq'] - $default_view_iq;
       $default_view_iq = $array[$key-1]['view_iq'] + $array[$key]['view_iq_diff'];
       //click_iq
       $array[$key]['click_iq'] = $value['click_iq'];
       $array[$key]['click_iq_diff'] =  $value['click_iq'] - $default_click_iq;
       $default_click_iq = $array[$key-1]['click_iq'] + $array[$key]['click_iq_diff'];
       //ctr_iq
       $array[$key]['ctr_iq'] = ($array[$key]['click_iq_diff']/$array[$key]['view_iq_diff'])*100;
       //imp_ad
       $array[$key]['imp_ad'] = $value['imp_ad'];
       $array[$key]['imp_ad_diff'] =  $value['imp_ad'] - $default_imp_ad;
       $default_imp_ad = $array[$key-1]['imp_ad'] + $array[$key]['imp_ad_diff'];
       //click_ad
       $array[$key]['click_ad'] = $value['click_ad'];
       $array[$key]['click_ad_diff'] =  $value['click_ad'] - $default_click_ad;
       $default_click_ad = $array[$key-1]['click_ad'] + $array[$key]['click_ad_diff'];
       //ctr_ad
       $array[$key]['ctr_ad'] = ($array[$key]['click_ad_diff']/$array[$key]['imp_ad_diff'])*100;
     }

     /**
     * get latest month wert
     */
     $select = "*";
     $current_month = date('m-Y');
     $clause = "WHERE Auftragsnummer = '$auftragsnummer' AND Auftragsposition= '$auftragsposition' AND Month(datum) = '$current_month'";
     $data["data2"] = $this->_model->selectClauseGroupByOrderBy("gregtool_erfuellung",$select,$clause,null,null);
     $lastid = count($data["data2"])-1;
     $newarray_id = count($array);

     $array[$newarray_id]['datum'] = $current_month;
     $array[$newarray_id]['Auftragsnummer'] = $data["data2"][$lastid]['Auftragsnummer'];
     $array[$newarray_id]['Auftragsposition'] = $data["data2"][$lastid]['Auftragsposition'];
     //imp_iq
     $array[$newarray_id]['imp_iq'] = $data["data2"][$lastid]['imp_iq'];
     $array[$newarray_id]['imp_iq_diff'] =  $data["data2"][$lastid]['imp_iq']-$array[$newarray_id-1]['imp_iq'];
     //view_iq
     $array[$newarray_id]['view_iq'] = $data["data2"][$lastid]['view_iq'];
     $array[$newarray_id]['view_iq_diff'] =  $data["data2"][$lastid]['view_iq']-$array[$newarray_id-1]['view_iq'];
     //click_iq
     $array[$newarray_id]['click_iq'] = $data["data2"][$lastid]['click_iq'];
     $array[$newarray_id]['click_iq_diff'] =  $data["data2"][$lastid]['click_iq']-$array[$newarray_id-1]['click_iq'];
     //ctr_iq
     $array[$newarray_id]['ctr_iq'] = ($array[$newarray_id]['click_iq_diff']/$array[$newarray_id]['view_iq_diff'])*100;
     //imp_ad
     $array[$newarray_id]['imp_ad'] = $data["data2"][$lastid]['imp_ad'];
     $array[$newarray_id]['imp_ad_diff'] =  $data["data2"][$lastid]['imp_ad'] - $array[$newarray_id-1]['imp_ad'];
     //click_ad
     $array[$newarray_id]['click_ad'] = $data["data2"][$lastid]['click_ad'];
     $array[$newarray_id]['click_ad_diff'] =  $data["data2"][$lastid]['click_ad'] - $array[$newarray_id-1]['click_ad'];
     //ctr_ad
     $array[$newarray_id]['ctr_ad'] = ($array[$newarray_id]['click_ad_diff']/$array[$newarray_id]['imp_ad_diff'])*100;

     return print_r(json_encode($array));
   }

}
