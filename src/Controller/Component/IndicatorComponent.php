<?php
namespace App\Controller\Component;
 
use Cake\Controller\Component;
use Cake\ORM\TableRegistry;

class IndicatorComponent extends Component
{
    public $lamp_info=[
        0 => "NO PLAY",
        1 => "FAILED",
        2 => "ASSISTED",
        3 => "EASY",
        4 => "CLEAR",
        5 => "HARD",
        6 => "EXHARD",
        7 => "FULLCOMBO",
    ];
    
    public function getLampCounts(&$my_lamps){
        $ret = array_fill(0, sizeof($this->lamp_info), 0);
        $Scores = TableRegistry::getTableLocator()->get('Scores');
        $scores = $Scores->find('available');
        foreach($scores as $score){
            $ret[$my_lamp[$score->id] ?? 0]+=1;
        }
        return $ret;
    }
}