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

    public function getRating($user){
        $ghost_num = 34204;

        // ここから
        $my_lamps = $user->user_detail->my_lamps_array;
        foreach($my_lamps as $my_lamp){
            if($my_lamp==2)$my_lamp=1;
        }
        $GhostLamps = TableRegistry::getTableLocator()->get('GhostLamps');
        $ghost_lamps = $GhostLamps->find();
        $battle_counts = array_fill(0, $ghost_num, 0);
        foreach($ghost_lamps as $i => $ghost_lamp){
            if(!array_key_exists($ghost_lamp->score_id, $my_lamps))continue;
            if($my_lamps[$ghost_lamp->score_id] > $ghost_lamp->lamp) $battle_counts[$ghost_lamp->ghost_id - 1]++;
            else if($my_lamps[$ghost_lamp->score_id] < $ghost_lamp->lamp) $battle_counts[$ghost_lamp->ghost_id - 1]--;
            unset($ghost_lamp);
        }
        $win = 0;
        foreach($battle_counts as $battle_count){
            if($battle_count > 0) $win++;
            if($battle_count < 0) $win--;
        }
        $reswin = ($win + $ghost_num + 1)/2.0;
        return 400.00*log10( $reswin / ($ghost_num + 1 - $reswin) )+1500.0000;
    }
}
