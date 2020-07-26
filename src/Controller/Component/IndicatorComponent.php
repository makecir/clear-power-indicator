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

    public $version_info=[
         0 => "UNKNOWN",
         5 => "5th style",
         6 => "6th style",
         7 => "7th style",
         8 => "8th style",
         9 => "9th style",
        10 => "10th style",
        11 => "IIDX RED",
        12 => "HAPPY SKY",
        13 => "DistorteD",
        14 => "GOLD",
        15 => "DJ TROOPERS",
        16 => "EMPRESS",
        17 => "SIRIUS",
        18 => "Resort Anthem",
        19 => "Lincle",
        20 => "tricoro",
        21 => "SPADA",
        22 => "PENDUAL",
        23 => "copula",
        24 => "SINOBUZ",
        25 => "CANNON BALLERS",
        26 => "Rootage",
        27 => "HEROIC VERSE",
    ];

    public $pred_target=[
        3 => "easy",
        4 => "clear",
        5 => "hard",
        6 => "exhard",
        7 => "fc",
    ];
    
    public function getLampCounts(&$my_lamps){
        $Scores = TableRegistry::getTableLocator()->get('Scores');
        $scores = $Scores->find('available');
        $lamp_num = sizeof($this->lamp_info);
        $ret = array_fill(0, $lamp_num, 0);
        foreach($scores as $score){
            $ret[$my_lamps[$score->id] ?? 0]+=1;
        }
        return $ret;
    }

    public function getRecommendResults(&$my_lamps, $rating){
        if(is_null($rating))return null;
        $Scores = TableRegistry::getTableLocator()->get('Scores');
        $scores = $Scores->find('rated')->toArray();
        $lamp_num = sizeof($this->lamp_info);
        $preds=array();
        foreach($scores as $score){
            for( $tar = max($my_lamps[$score['id']]??0,2)+1 ; $tar < $lamp_num ; $tar++ ){
                //predict
                $pred['version'] = $this->version_info[$score['version_num']??0];
                $pred['name'] = $score['title'];
                $pred['cur_lamp'] = $this->lamp_info[$my_lamps[$score['id']]??0];
                $pred['tar_lamp'] = $this->lamp_info[$tar];
                $intercept = $score[$this->pred_target[$tar]."_intercept"];
                $coefficient = $score[$this->pred_target[$tar]."_coefficient"];
                $pred['probability'] = 100 * $this->predict($rating,$intercept,$coefficient);
                $preds[] = $pred;
            }
        }
        return $preds;
    }

    public function predict(&$rating, &$intercept, &$coefficient){
        return 1/(1+M_E**(-($intercept+$coefficient*$rating)));
    }

    public function saveLamps($user, &$input_lines){
        // 1, array -> dict['title']['diff']=lamp;
        // 2, dict['title']['diff']=lamp -> save(u_id,s_is,lamp);
        // 
    }

    public function allClearLamps($user){
        // 間違えて登録した時用に全てのランプを削除
        $my_lamps = $user->user_detail->my_lamps->toArray();
    }

    public function getRating($user, &$input_lines){
        // 1, 自身のランプをすべて持ってくる
        $my_lamps = $user->user_detail->my_lamps->toArray();
        // 2, たたかう
        
        return 1750.20;
    }
}
