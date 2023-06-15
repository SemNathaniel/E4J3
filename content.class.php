<?php
class content{
    public $dbObj = null;
    public $result = null;

    public function __construct(){
        $this->dbObj = new db;
    }

    public function turnDataToHtml($selectedModule = null, $selectedTeam = null){
        if($selectedModule != null && $selectedModule != 'teams'){
            $this->result = $this->dbObj->selectFunction("SELECT * FROM `paginadata` WHERE paginaTitel = BINARY('" . $selectedModule . "');");
            if($this->result[0] != false){
                if($this->result[0][3] != ''){
                    return array(0 => true, 'title' => $this->result[0][1], 'text' => '<p class="textTemplate' . $this->result[0][4] . '">' . $this->result[0][2] . '</p>', 'image' => '<img src="/images/' . $this->result[0][3] . '">');
                } else {
                    return array(0 => true, 'title' => $this->result[0][1], 'text' => '<p class="textTemplate' . $this->result[0][4] . '">' . $this->result[0][2] . '</p>');
                }
            } else {
                return array(0 => false, 'text' => '<strong>ERROR 404</strong><br>Klik <a href="index.php?modules=home">hier!</a> om terug te keren naar de hoofdpagina', 'title' => 'ERROR');
            }
        } elseif ($selectedTeam != null && $selectedModule == null || $selectedTeam != null && $selectedModule = 'teams'){
            $this->result = $this->dbObj->selectFunction("");
        }
    }
}
?>
