<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Score Entity
 *
 * @property int $id
 * @property string|null $title
 * @property int|null $version_num
 * @property int|null $level
 * @property int $difficulty
 * @property int|null $notes
 * @property int|null $predicted_easy_rank
 * @property int|null $predicted_clear_rank
 * @property int|null $predicted_hard_rank
 * @property int|null $predicted_exhard_rank
 * @property int|null $predicted_fc_rank
 * @property int|null $predicted_aaa_rank
 * @property int $is_deleted
 * @property int $is_rated
 * @property float|null $easy_intercept
 * @property float|null $easy_coefficient
 * @property float|null $clear_intercept
 * @property float|null $clear_coefficient
 * @property float|null $hard_intercept
 * @property float|null $hard_coefficient
 * @property float|null $exhard_intercept
 * @property float|null $exhard_coefficient
 * @property float|null $fc_intercept
 * @property float|null $fc_coefficient
 * @property \Cake\I18n\FrozenTime $created_at
 * @property \Cake\I18n\FrozenTime $modified_at
 *
 * @property \App\Model\Entity\User[] $users
 */
class Score extends Entity
{
    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * Note that when '*' is set to true, this allows all unspecified fields to
     * be mass assigned. For security purposes, it is advised to set '*' to false
     * (or remove it), and explicitly make individual fields accessible as needed.
     *
     * @var array
     */
    protected $_accessible = [
        'title' => true,
        'version_num' => true,
        'version_info' => true,
        'level' => true,
        'difficulty' => true,
        'notes' => true,
        'textage_url_1p' => true,
        'textage_url_2p' => true,
        'predicted_easy_rank' => true,
        'predicted_clear_rank' => true,
        'predicted_hard_rank' => true,
        'predicted_exhard_rank' => true,
        'predicted_fc_rank' => true,
        'predicted_aaa_rank' => true,
        'is_deleted' => true,
        'is_rated' => true,
        'easy_intercept' => true,
        'easy_coefficient' => true,
        'clear_intercept' => true,
        'clear_coefficient' => true,
        'hard_intercept' => true,
        'hard_coefficient' => true,
        'exhard_intercept' => true,
        'exhard_coefficient' => true,
        'fc_intercept' => true,
        'fc_coefficient' => true,
        'created_at' => true,
        'modified_at' => true,
        'users' => true,
        'title_info' => true,
        'title_info_for_tweet' => true,
        'fifty_rating_easy'=>true,
        'fifty_rating_clear'=>true,
        'fifty_rating_hard'=>true,
        'fifty_rating_exhard'=>true,
        'fifty_rating_fc'=>true,
        'probability_easy'=>true,
    ];

    protected function _getTitleInfo(){
        $suffix = "";
        if($this->difficulty >= 4) $suffix = " [L]";
        elseif($this->title == "gigadelic" || $this->title == "Innocent Walls"){
            if($this->difficulty == 2) $suffix = " [H]";
            if($this->difficulty >= 3) $suffix = " [A]";
        }
        return $this->title.$suffix;
    }

    protected function _getTitleInfoForTweet(){
        $suffix = "";
        if($this->difficulty >= 4) $suffix = " [L]";
        elseif($this->title == "gigadelic" || $this->title == "Innocent Walls"){
            if($this->difficulty == 2) $suffix = " [H]";
            if($this->difficulty >= 3) $suffix = " [A]";
        }
        if($this->title=="We're so Happy (P*Light Remix) IIDX ver."){
            return "We`re so Happy (P*Light Remix) IIDX ver.".$suffix;
        }
        else if($this->title=="Thor's Hammer"){
            return "Thor`s Hammer".$suffix;
        }
        else if($this->title=="ra'am"){
            return "ra`am".$suffix;
        }
        else if($this->title=="Devil's Gear"){
            return "Devil`s Gear".$suffix;
        }
        else if($this->title=="PLEASE DON'T GO"){
            return "PLEASE DON`T GO".$suffix;
        }
        else if($this->title=="Dans la nuit de l'eternite"){
            return "Dans la nuit de l`eternite".$suffix;
        }
        else{
            return $this->title.$suffix;
        }
    }

    protected function _getVersionDict(){
        $version_dict = [
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
           28 => "BISTROVER",
           29 => "CastHour",
           30 => "RESIDENT",
        ];
        return $version_dict;
    }

    protected function _getDifficultyInfo(){
        $difficulty_info = "";
        if($this->difficulty == 2) $difficulty_info = "HYPER";
        if($this->difficulty == 3) $difficulty_info = "ANOTHER";
        if($this->difficulty == 4) $difficulty_info = "LEGGENDARIA";
        return $difficulty_info;
    }

    protected function _getVersionInfo(){
        return $this->version_dict[$this->version_num]??"";
    }

    protected function _getDifficultyInfoWithColor(){
        $color_code = "000000";
        if($this->difficulty == 2) $color_code = "FFD700";
        if($this->difficulty == 3) $color_code = "FF0000";
        if($this->difficulty == 4) $color_code = "CC66FF";
        return "<font color='".$color_code."'>".$this->difficulty_info."</font>";
    }

    protected function _getFiftyRatingEasy(){
        $ret = $this->getFiftyRating($this->easy_intercept, $this->easy_coefficient);
        if($ret == -1)return "-";
        else return sprintf('%.2f',$ret);
    }

    protected function _getFiftyRatingClear(){
        $ret = $this->getFiftyRating($this->clear_intercept, $this->clear_coefficient);
        if($ret == -1)return "-";
        else return sprintf('%.2f',$ret);
    }

    protected function _getFiftyRatingHard(){
        $ret = $this->getFiftyRating($this->hard_intercept, $this->hard_coefficient);
        if($ret == -1)return "-";
        else return sprintf('%.2f',$ret);
    }

    protected function _getFiftyRatingExhard(){
        $ret = $this->getFiftyRating($this->exhard_intercept, $this->exhard_coefficient);
        if($ret == -1)return "-";
        else return sprintf('%.2f',$ret);
    }

    protected function _getFiftyRatingFc(){
        $ret = $this->getFiftyRating($this->fc_intercept, $this->fc_coefficient);
        if($ret == -1)return "-";
        else if($ret > 5000 || $ret < -5000)return "Infinity";
        else return sprintf('%.2f',$ret);
    }

    protected function getFiftyRating(&$intercept, &$coefficient){
        if($this->is_rated == 0 || $coefficient === 0) return -1;
        return - ($intercept / $coefficient);
    }

    public function getProbabilityEasy(&$rating){
        return 1/(1+M_E**(-($this->easy_intercept + $this->easy_coefficient*$rating)));
    }

    public function getProbabilityClear(&$rating){
        return 1/(1+M_E**(-($this->clear_intercept + $this->clear_coefficient*$rating)));
    }

    public function getProbabilityHard(&$rating){
        return 1/(1+M_E**(-($this->hard_intercept + $this->hard_coefficient*$rating)));
    }

    public function getProbabilityExhard(&$rating){
        return 1/(1+M_E**(-($this->exhard_intercept + $this->exhard_coefficient*$rating)));
    }

    public function getProbabilityFc(&$rating){
        return 1/(1+M_E**(-($this->fc_intercept + $this->fc_coefficient*$rating)));
    }

}
