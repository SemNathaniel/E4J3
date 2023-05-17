<?php
class content{
    public $dbObj = null;
    public $result = null;

    public function __construct(){
        $this->dbObj = new db;
    }

    public function turnDataToHtml($selectedModule = null, $selectedTeam = null){
        if($selectedModule != null){
            $this->result = $this->dbObj->selectFunction("SELECT * FROM `paginadata` WHERE paginaTitel = BINARY('" . $selectedModule . "');");
            if($this->result[1] == true){
                return array('title'=>$this->result[1]['paginaTitel'], 'tekstvak1'=>'<p class="tekstvak1Template' . $this->result[1]['templateType'] . '">' . $this->result[1]['tekstvak1'] . '</p>', 'afbeelding1'=>'<img class="afbeelding1Template' . $this->result[1]['templateType'] . '" src="' . $this->result[1]['afbeelding1'] . '">', 'tekstvak2'=>'<p class="tekstvak2Template' . $this->result[1]['templateType'] . '">' . $this->result[1]['tekstvak2'] . '</p>', 'afbeelding2'=>'<img class="afbeelding2Template' . $this->result[1]['templateType'] . '" src="' . $this->result[1]['afbeelding2'] . '">');
            } else {
                return '<strong>ERROR 404</strong><br>Klik <a href="index.php?module=home">hier!</a> om terug te keren naar de hoofdpagina';
            }
        } elseif ($selectedTeam != null){
            
        }
    }
}
?>