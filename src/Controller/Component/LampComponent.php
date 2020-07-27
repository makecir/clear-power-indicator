<?php
namespace App\Controller\Component;
 
use Cake\Controller\Component;
use Cake\ORM\TableRegistry;

class LampComponent extends Component
{

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
        $new_scores = array();
        $bank = array();
        $this->allClearLamps($user);
        $dict = $this->getFetchTitleDict();
        foreach($new_lamps as $title => $lamps){
            if(!array_key_exists($title, $dict)){
                $bank[] = $title;
                continue;
            }
            foreach($lamps as $diff => $lamp){
                if(!array_key_exists($diff, $dict[$title])){
                    $bank[] = $title.":diff=".$diff;
                    continue;
                }
                $s_id = $dict[$title][$diff];
                $lamp = $lamp;
                $new_scores[] = ['user_id'=>$user->id,'score_id'=>$s_id, 'lamp'=>$lamp];
            }
        }
        $query = $UserLamps->query();
        $query->insert(['user_id', 'score_id', 'lamp']);
        foreach ($new_scores as $new_score) {
            $query->values($new_score);
        }
        $query->execute();
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

}

