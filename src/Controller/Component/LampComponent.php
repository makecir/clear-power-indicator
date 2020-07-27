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
        $my_lamps = $user->user_detail->my_lamps->toArray();
    }

    public function allClearLamps($user){
        // 間違えて登録した時用に全てのランプを削除
        $my_lamps = $user->user_detail->my_lamps->toArray();
    }
}

