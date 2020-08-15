<?php
namespace App\Controller\Component;
 
use Cake\Controller\Component;
use Cake\ORM\TableRegistry;

class LampComponent extends Component
{

    public $lamp_class_info=[
        0 => "NOPLAY",
        1 => "FAILED",
        2 => "ASSISTED",
        3 => "EASY",
        4 => "CLEAR",
        5 => "HARD",
        6 => "EXHARD",
        7 => "FULLCOMBO",
    ];
    public $lamp_short_info=[
        0 => "NP",
        1 => "FA",
        2 => "AC",
        3 => "EC",
        4 => "CL",
        5 => "HC",
        6 => "EX",
        7 => "FC",
    ];

    public function getNewLampDict($user, &$lines){
        // 1, array -> dict['title']['diff']=lamp;
        

        $clear_str2num=[
            "NO PLAY"=>0,
            "FAILED"=>1,
            "ASSIST CLEAR"=>2,
            "EASY CLEAR"=>3,
            "CLEAR"=>4,
            "HARD CLEAR"=>5,
            "EX HARD CLEAR"=>6,
            "FULLCOMBO CLEAR"=>7,
            "ASSIST EASY"=>2,
        ];

        $ret=array();
        foreach($lines as $i => $line){
            $elements = explode( ',', $line);
            if($i === 0 ){
                if(sizeof($elements) != 41) return null;
                else continue;
            }
            else{
                if(sizeof($elements) == 1) continue;
                else{
                    $title = $elements[1];
                    for($j=2 ; $j<5 ; $j++){
                        $tar = $j*7 + 5;
                        if($elements[$tar] == 12){
                            $ret[$title][$j]=$clear_str2num[$elements[$tar+5]];
                        }
                    }
                }
            } 
        }
        return $ret;

    }
    
    public function saveLamps($user, &$new_lamps){
        // 2, dict['title']['diff']=lamp -> save(u_id,s_is,lamp);
        $UserLamps = TableRegistry::getTableLocator()->get('UserLamps');
        $UserHistories = TableRegistry::getTableLocator()->get('UserHistories');
        $LampChanges = TableRegistry::getTableLocator()->get('LampChanges');

        $my_lamps_dict = $UserLamps->find('list',['keyField'=>'score_id','valueField'=>'lamp','conditions'=>['user_id'=>$user->id]])->toArray();
        
        $dict = $this->getFetchTitleDict();
        //check
        $invalid = false;
        $new_scores = array();
        $lamp_changes = array();
        $no_match_scores  = array();
        foreach($new_lamps as $title => $lamps){
            if(!array_key_exists($title, $dict)){
                $no_match_scores[] = $title;
                continue;
            }
            foreach($lamps as $diff => $lamp){
                if(!array_key_exists($diff, $dict[$title])){
                    $no_match_scores[] = $title.":diff=".$diff;
                    continue;
                }
                $s_id = $dict[$title][$diff];
                if($lamp == 0)continue;
                if(array_key_exists($s_id, $my_lamps_dict))$before_lamp = $my_lamps_dict[$s_id];
                else $before_lamp = 0;
                if($before_lamp > $lamp) $invalid = true;
                if($before_lamp < $lamp) {
                    $lamp_changes[] = ['score_id'=>$s_id, 'before_lamp'=>$before_lamp, 'after_lamp'=>$lamp];
                }
                $new_scores[] = ['user_id'=>$user->id, 'score_id'=>$s_id, 'lamp'=>$lamp];
            }
        }
        if($invalid || count($lamp_changes) === 0)return null;

        $this->allClearLamps($user);

        $user_history = $UserHistories->newEmptyEntity();
        $user_history->user_id = $user->id;
        $UserHistories->save($user_history);

        if(count($new_scores) !== 0){
            $query = $UserLamps->query();
            $query->insert(['user_id', 'score_id', 'lamp']);
            foreach ($new_scores as $new_score) {
                $query->values($new_score);
            }
            $query->execute();
        }

        if(count($lamp_changes) !== 0){
            $query = $LampChanges->query();
            $query->insert(['score_id', 'before_lamp', 'after_lamp', 'user_history_id']);
            foreach ($lamp_changes as $lamp_change) {
                $lamp_change['user_history_id'] = $user_history->id;
                $query->values($lamp_change);
            }
            $query->execute();
        }

        return $user_history;
    }

    public function allClearLamps($user){
        // 全てのランプを削除
        $Users = TableRegistry::getTableLocator()->get('Users');
        $Scores = TableRegistry::getTableLocator()->get('Scores');
        $my_lamps = $Scores->find()->matching(
            'Users' , function ($q) use ($user) {
            return $q->where(['Users.id' => $user->id]);
         })->toList();
        $Users->Scores->unlink($user, $my_lamps);
        return $my_lamps;
    }

    public function getFetchTitleDict(){
        $Scores = TableRegistry::getTableLocator()->get('Scores');
        $scores = $Scores->find('available');
        $ret = array();
        foreach($scores as $score){
            if($score->title==="Innocent Walls[H]" 
            || $score->title==="Innocent Walls[A]"
            || $score->title==="gigadelic[H]"
            || $score->title==="gigadelic[A]"){
                $ret[substr($score->title, 0, strlen($score->title)-3)][$score->difficulty] = $score->id;
            }
            else if($score->difficulty == 4){
                $ret[substr($score->title, 0, strlen($score->title)-3)][$score->difficulty] = $score->id;
            }
            else if($score->difficulty == 5){
                $ret[substr($score->title, 0, strlen($score->title)-14)][$score->difficulty-1] = $score->id;
            }
            else{
                $ret[$score->title][$score->difficulty]=$score->id;
            }
        }
        return $ret;
    }

    public function getLampChangeCounts(&$user_history){
        $lamp_num = sizeof($this->lamp_class_info);
        $ret = array_fill(0, $lamp_num, 0);
        foreach($user_history->lamp_changes as $change){
            $ret[$change->after_lamp ?? 0]+=1;
        }
        return $ret;
    }

}

