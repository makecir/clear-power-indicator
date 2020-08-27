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

    public $tar_lamp_info=[
        3 => "EASY",
        4 => "CLEAR",
        5 => "HARD",
        6 => "EXHARD",
        7 => "FULLCOMBO",
    ];

    public $version_info=[
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

    public $color_info=[
        0 => "#FFFFFF",
        1 => "#CCCCCC",
        2 => "#FF66CC",
        3 => "#99FF99",
        4 => "#99CCFF",
        5 => "#FF6666",
        6 => "#FFFF99",
        7 => "#FF9966",
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

    public function getLampList(&$my_lamps){
        $Scores = TableRegistry::getTableLocator()->get('Scores');
        $scores = $Scores->find('available')->toArray();
        $lamp_num = sizeof($this->lamp_info);
        $results = array();
        foreach($scores as $score){
            $lamp = $my_lamps[$score['id']]??0;
            $result['version'] = $this->version_info[$score['version_num']??5];
            $result['title'] = $score['title_info'];
            $result['lamp'] = $lamp;
            $result['lamp_color'] = $this->color_info[$lamp];
            if($lamp >= 3){
                if($score->is_rated == 1){
                    $intercept = $score[$this->pred_target[$lamp]."_intercept"];
                    $coefficient = $score[$this->pred_target[$lamp]."_coefficient"];
                    $fifty = sprintf('%.2f',$this->fifty($intercept,$coefficient));
                }
                else $fifty = "未対応";
            }
            else $fifty = "-";
            $result['fifty_rating'] = $fifty;
            $result['diff'] = $score['difficulty'];
            $results[] = $result;
        }
        return $results;
    }

    public function getRecommendResults(&$my_lamps, $rating, &$top_tweet_info){
        $top_tweet_info['rec'] = array();
        $top_tweet_info['rec']['cpi'] = 0;
        $top_tweet_info['rec']['title'] = '';
        $top_tweet_info['rec']['lamp'] = 0;
        $top_tweet_info['rec']['prob'] = -1;
        if(is_null($rating))return null;
        $Scores = TableRegistry::getTableLocator()->get('Scores');
        $scores = $Scores->find('rated')->toArray();
        $lamp_num = sizeof($this->lamp_info);
        $preds=array();
        foreach($scores as $score){
            for( $tar = max($my_lamps[$score['id']]??0,2)+1 ; $tar < $lamp_num ; $tar++ ){
                //predict
                $pred['version'] = $this->version_info[$score['version_num']??5];
                $pred['title'] = $score['title_info'];
                $pred['lamp_cur'] = $my_lamps[$score['id']]??0;
                $pred['lamp_cur_color'] = $this->color_info[$my_lamps[$score['id']]??0];
                $pred['lamp_tar'] = $tar;
                $pred['lamp_tar_color'] = $this->color_info[$tar];
                $intercept = $score[$this->pred_target[$tar]."_intercept"];
                $coefficient = $score[$this->pred_target[$tar]."_coefficient"];
                $pred['probability'] = 100 * $this->predict($rating,$intercept,$coefficient);
                $pred['diff'] = $score['difficulty'];
                if($pred['probability'] > $top_tweet_info['rec']['prob']){
                    $top_tweet_info['rec']['cpi'] = $this->fifty($intercept,$coefficient);
                    $top_tweet_info['rec']['title'] = $score['title_info'];
                    $top_tweet_info['rec']['lamp'] = $this->tar_lamp_info[$tar];
                    $top_tweet_info['rec']['prob'] = $pred['probability'];
                }
                $preds[] = $pred;
            }
        }
        return $preds;
    }

    
    public function getBetterThamExpectedResults(&$my_lamps, $rating, &$top_tweet_info){
        $top_tweet_info['bte'] = array();
        $top_tweet_info['bte']['cpi'] = 0;
        $top_tweet_info['bte']['title'] = '';
        $top_tweet_info['bte']['lamp'] = 0;
        $top_tweet_info['bte']['prob'] = 101.00;
        if(is_null($rating))return null;
        $Scores = TableRegistry::getTableLocator()->get('Scores');
        $scores = $Scores->find('rated')->toArray();
        $lamp_num = sizeof($this->lamp_info);
        $preds=array();
        foreach($scores as $score){
            $tar = $my_lamps[$score['id']]??0;
            if($tar < 3) continue;
            $pred['version'] = $this->version_info[$score['version_num']??5];
            $pred['title'] = $score['title_info'];
            $pred['lamp'] = $tar;
            $pred['lamp_color'] = $this->color_info[$tar];
            $intercept = $score[$this->pred_target[$tar]."_intercept"];
            $coefficient = $score[$this->pred_target[$tar]."_coefficient"];
            $pred['probability'] = 100 * $this->predict($rating,$intercept,$coefficient);
            if($pred['probability']>50.0)continue;
            $pred['diff'] = $score['difficulty'];
            if($pred['probability'] < $top_tweet_info['bte']['prob']){
                $top_tweet_info['bte']['cpi'] = $this->fifty($intercept,$coefficient);
                $top_tweet_info['bte']['title'] = $score['title_info'];
                $top_tweet_info['bte']['lamp'] = $this->tar_lamp_info[$tar];
                $top_tweet_info['bte']['prob'] = $pred['probability'];
            }
            $preds[] = $pred;
        }
        return $preds;
    }

    public function getFollowingLampCounts(&$user){
        //$Followings = TableRegistry::getTableLocator()->get('Followings');
        $results = [[
            'id' => $user->id,
            'dj_name' => $user->user_detail->dj_name,
            'rating' => $user->user_detail->rating,
            'lamp_counts' => $this->getLampCounts($user->user_detail->my_lamps_array),
            'update' => $user->user_detail->modified_at,
        ]];
        foreach((array)$user->following_users as $rival){
            $ret['id'] = $rival->id;
            $ret['dj_name'] = $rival->user_detail->dj_name;
            $ret['rating'] = $rival->user_detail->rating;
            $ret['lamp_counts'] = $this->getLampCounts($rival->user_detail->my_lamps_array);
            $ret['update'] = $rival->user_detail->update_at;
            $results[]= $ret;
        }
        return $results;
    }

    public function getLampChangeResults(&$user_history, &$top_change){
        $results = array();
        $top_change['cpi'] = 0;
        $top_change['title'] = '';
        $top_change['lamp'] = 0;
        foreach($user_history->lamp_changes as $change){
            $result['title'] = $change->score->title_info;
            $result['diff'] = $change->score->difficulty;
            $result['before_lamp'] = $change->before_lamp;
            $result['after_lamp'] = $change->after_lamp;
            if($change->after_lamp >= 3 && $change->score->is_rated == 1){
                $intercept = $change->score[$this->pred_target[$change->after_lamp]."_intercept"];
                $coefficient = $change->score[$this->pred_target[$change->after_lamp]."_coefficient"];
                $fifty = $this->fifty($intercept,$coefficient);
                if($fifty > $top_change['cpi']){
                    $top_change['cpi'] = $fifty;
                    $top_change['title'] = $change->score->title_info;
                    $top_change['lamp'] = $change->after_lamp;
                }
            }
            else $fifty = NULL;
            $result['fifty_rating'] = $fifty ?? '-';
            $results[] = $result;
        }
        return $results;
    }

    public function fifty(&$intercept, &$coefficient){
        if($coefficient === 0) return -1;
        return - ($intercept / $coefficient);
    }

    public function predict(&$rating, &$intercept, &$coefficient){
        return 1/(1+M_E**(-($intercept+$coefficient*$rating)));
    }

    public function getGhostNum() {
        return 30206;
    }

    public function getSeason() {
        return 1;
    }

    public function setRating(&$user, $user_history){
        $GHOST_NUM = $this->getGhostNum();
        $SEASON = $this->getSeason();
        // ここから
        $my_lamps = $user->user_detail->my_lamps_array;
        if(count($my_lamps)==0)return false;
        foreach($my_lamps as $my_lamp){
            if($my_lamp==2)$my_lamp=1;
        }
        $GhostLamps = TableRegistry::getTableLocator()->get('GhostLamps');
        $ghost_lamps = $GhostLamps->find();
        $battle_counts = array_fill(0, $GHOST_NUM, 0);
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
        $new_standing = $GHOST_NUM - ($win + $GHOST_NUM)/2.0 + 1;
        $reswin = ($win + $GHOST_NUM + 1)/2.0;
        $new_rating = 400.00*log10( $reswin / ($GHOST_NUM + 1 - $reswin) ) + 1500.0000;

        $UserHistories = TableRegistry::getTableLocator()->get('UserHistories');
        $rating_diff = (isset($user->user_detail->rating)?($new_rating - $user->user_detail->rating):0.00);
        $rating_diff = (($user->user_detail->season??0 == $SEASON)?($new_rating - $user->user_detail->rating):0.00);
        $standing_diff = (($user->user_detail->season??0 == $SEASON)?($new_standing - $user->user_detail->standing):0);
        $user_history = $UserHistories->patchEntity($user_history, [
            'rating_cur' => $new_rating,
            'rating_diff' => $rating_diff,
            'standing_cur' => $new_standing,
            'standing_diff' => $standing_diff,
        ]);
        $UserHistories->save($user_history);

        $user->user_detail->rating = $new_rating;
        $user->user_detail->standing = $new_standing;
        $user->user_detail->season = $SEASON;

        return true;
    }
}
