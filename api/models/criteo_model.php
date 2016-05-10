<?php

class Criteo_Model extends Model {

   public function __construct(){
      parent::__construct();
   }

   public function selectClauseGroupByOrderBy($table,$select,$clause=null,$groupby=null,$orderby=null){
    return $this->_db->select("SELECT $select FROM $table $clause $groupby $orderby");
  }

}
