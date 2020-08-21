<?php
declare(strict_types=1);

namespace App\Model\Entity;
use Cake\ORM\TableRegistry;
use Cake\ORM\Entity;

/**
 * UserDetail Entity
 *
 * @property string $user_id
 * @property string|null $iidx_id
 * @property string|null $dj_name
 * @property int $class_sp
 * @property int $class_dp
 * @property int $arena_sp
 * @property int $arena_dp
 * @property string|null $bio
 * @property string|null $twitter_id
 * @property float|null $rating
 * @property \Cake\I18n\FrozenTime $update_at
 * @property \Cake\I18n\FrozenTime $created_at
 * @property \Cake\I18n\FrozenTime $modified_at
 *
 * @property \App\Model\Entity\Iidx $iidx
 * @property \App\Model\Entity\Twitter $twitter
 */
class UserDetail extends Entity
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
        'iidx_id' => true,
        'dj_name' => true,
        'grade_sp' => true,
        'grade_dp' => true,
        'arena_sp' => true,
        'arena_dp' => true,
        'bio' => true,
        'twitter_id' => true,
        'standing' => true,
        'rating' => true,
        'season' => true,
        'update_at' => true,
        'created_at' => true,
        'modified_at' => true,
    ];

    public function getTable(){
        return TableRegistry::getTableLocator()->get('UserDetails');
    }

    protected function _getRatingInfo(){
        return $this->rating?sprintf('%.2f',$this->rating):'';
    }
    
    protected function _getGradeSpDict(){
        $sp_grade_dict = [
            0 => "-",
            11 => "七級",
            12 => "六級",
            13 => "五級",
            14 => "四級",
            15 => "三級",
            16 => "二級",
            17 => "一級",
            18 => "初段",
            19 => "二段",
            20 => "三段",
            21 => "四段",
            22 => "五段",
            23 => "六段", 
            24 => "七段", 
            25 => "八段", 
            26 => "九段", 
            27 => "十段", 
            31 => "中伝", 
            33 => "皆伝"
        ];
        return $sp_grade_dict;
    }

    protected function _getGradeDpDict(){
        $dp_grade_dict = [
            0 => "-",
            //11 => "七級",
            //12 => "六級",
            13 => "五級",
            14 => "四級",
            15 => "三級",
            16 => "二級",
            17 => "一級",
            18 => "初段",
            19 => "二段",
            20 => "三段",
            21 => "四段",
            22 => "五段",
            23 => "六段", 
            24 => "七段", 
            25 => "八段", 
            26 => "九段", 
            27 => "十段", 
            31 => "中伝", 
            33 => "皆伝"
        ];
        return $dp_grade_dict;
    }

    protected function _getArenaSpDict(){
        $sp_Arena_dict = [
            0 => "-",
            11 => "D5",
            12 => "D4",
            13 => "D3",
            14 => "D2",
            15 => "D1",
            16 => "C5",
            17 => "C4",
            18 => "C3",
            19 => "C2",
            20 => "C1",
            21 => "B5",
            22 => "B4",
            23 => "B3", 
            24 => "B2", 
            25 => "B1", 
            26 => "A5", 
            27 => "A4", 
            28 => "A3", 
            29 => "A2",
            30 => "A1",
        ];
        return $sp_Arena_dict;
    }

    protected function _getArenaDpDict(){
        $dp_Arena_dict = [
            0 => "-",
            11 => "D5",
            12 => "D4",
            13 => "D3",
            14 => "D2",
            15 => "D1",
            16 => "C5",
            17 => "C4",
            18 => "C3",
            19 => "C2",
            20 => "C1",
            21 => "B5",
            22 => "B4",
            23 => "B3", 
            24 => "B2", 
            25 => "B1", 
            26 => "A5", 
            27 => "A4", 
            28 => "A3", 
            29 => "A2",
            30 => "A1",
        ];
        return $dp_Arena_dict;
    }

    protected function _getGradeSpInfo(){
        return $this->grade_sp_dict[$this->grade_sp ?? 0];
    }

    protected function _getGradeDpInfo(){
        return $this->grade_dp_dict[$this->grade_dp ?? 0];
    }

    protected function _getArenaSpInfo(){
        return $this->arena_sp_dict[$this->arena_sp ?? 0];
    }

    protected function _getArenaDpInfo(){
        return $this->arena_dp_dict[$this->arena_dp ?? 0];
    }

    protected function _getPredStandingDict(){
        $pred_standing_dict = [
            1170 => 50,
            1180 => 49.4,
            1190 => 48.84,
            1200 => 48.25,
            1210 => 47.6,
            1220 => 46.89,
            1230 => 46.11,
            1240 => 45.6,
            1250 => 45,
            1260 => 44.44,
            1270 => 43.89,
            1280 => 43.33,
            1290 => 42.72,
            1300 => 42.13,
            1310 => 41.52,
            1320 => 40.91,
            1330 => 40.22,
            1340 => 39.55,
            1350 => 38.88,
            1360 => 38.17,
            1370 => 37.38,
            1380 => 36.68,
            1390 => 35.9,
            1400 => 35.17,
            1410 => 34.42,
            1420 => 33.61,
            1430 => 32.85,
            1440 => 32.09,
            1450 => 31.31,
            1460 => 30.53,
            1470 => 29.77,
            1480 => 29.03,
            1490 => 28.2,
            1500 => 27.38,
            1510 => 26.62,
            1520 => 25.8,
            1530 => 25.04,
            1540 => 24.24,
            1550 => 23.47,
            1560 => 22.72,
            1570 => 21.94,
            1580 => 21.22,
            1590 => 20.47,
            1600 => 19.72,
            1610 => 19.03,
            1620 => 18.35,
            1630 => 17.64,
            1640 => 16.97,
            1650 => 16.33,
            1660 => 15.68,
            1670 => 15.04,
            1680 => 14.41,
            1690 => 13.8,
            1700 => 13.23,
            1710 => 12.66,
            1720 => 12.1,
            1730 => 11.56,
            1740 => 11.04,
            1750 => 10.56,
            1760 => 10.05,
            1770 => 9.61,
            1780 => 9.15,
            1790 => 8.74,
            1800 => 8.31,
            1810 => 7.92,
            1820 => 7.52,
            1830 => 7.18,
            1840 => 6.83,
            1850 => 6.49,
            1860 => 6.18,
            1870 => 5.85,
            1880 => 5.56,
            1890 => 5.28,
            1900 => 5,
            1910 => 4.75,
            1920 => 4.51,
            1930 => 4.27,
            1940 => 4.05,
            1950 => 3.83,
            1960 => 3.64,
            1970 => 3.45,
            1980 => 3.28,
            1990 => 3.11,
            2000 => 2.92,
            2010 => 2.77,
            2020 => 2.63,
            2030 => 2.48,
            2040 => 2.36,
            2050 => 2.22,
            2060 => 2.08,
            2070 => 1.98,
            2080 => 1.88,
            2090 => 1.78,
            2100 => 1.67,
            2110 => 1.59,
            2120 => 1.52,
            2130 => 1.43,
            2140 => 1.35,
            2150 => 1.26,
            2160 => 1.19,
            2170 => 1.11,
            2180 => 1.06,
            2190 => 1.01,
            2200 => 0.94,
            2210 => 0.9,
            2220 => 0.84,
            2230 => 0.79,
            2240 => 0.75,
            2250 => 0.71,
            2260 => 0.68,
            2270 => 0.64,
            2280 => 0.6,
            2290 => 0.57,
            2300 => 0.53,
            2310 => 0.5,
            2320 => 0.47,
            2330 => 0.45,
            2340 => 0.43,
            2350 => 0.4,
            2360 => 0.37,
            2370 => 0.35,
            2380 => 0.33,
            2390 => 0.32,
            2400 => 0.29,
            2410 => 0.28,
            2420 => 0.26,
            2430 => 0.25,
            2440 => 0.23,
            2450 => 0.22,
            2460 => 0.21,
            2470 => 0.2,
            2480 => 0.19,
            2490 => 0.18,
            2500 => 0.17,
            2510 => 0.16,
            2520 => 0.15,
            2530 => 0.14,
            2540 => 0.13,
            2550 => 0.13,
            2560 => 0.12,
            2570 => 0.11,
            2580 => 0.11,
            2590 => 0.1,
            2600 => 0.09,
            2610 => 0.09,
            2620 => 0.09,
            2630 => 0.08,
            2640 => 0.08,
            2650 => 0.07,
            2660 => 0.07,
            2670 => 0.06,
            2680 => 0.06,
            2690 => 0.05,
            2700 => 0.05,
            2710 => 0.05,
            2720 => 0.05,
            2730 => 0.04,
            2740 => 0.04,
            2750 => 0.04,
            2760 => 0.04,
            2770 => 0.03,
            2780 => 0.03,
            2790 => 0.03,
            2800 => 0.03,
            2810 => 0.03,
            2820 => 0.03,
            2830 => 0.02,
            2840 => 0.02,
            2850 => 0.02,
            2860 => 0.02,
            2870 => 0.02,
            2880 => 0.02,
            2890 => 0.02,
            2900 => 0.02,
            2910 => 0.02,
            2920 => 0.01,
            2930 => 0.01,
            2940 => 0.01,
            2950 => 0.01,
            2960 => 0.01,
            2970 => 0.01,
            2980 => 0.01,
        ];
        return $pred_standing_dict;
    }

    protected function _getPredStandRate(){
        $rating = $this->rating??0;
        $ret = 100;
        foreach($this->pred_standing_dict as $key => $val){
            if($rating > $key) $ret = $val;
        }
        return $ret;
    }

    protected function _getPredStanding(){
        $player = 61000;
        $rate = $this->pred_stand_rate;
        return $rate!=100?intval($rate*$player/100):"-";
    }

    protected function _getStandingInfo(){
        return  (isset($this->standing)?$this->standing:"-");
    }

    // result['s_id']="(int)lamp"
    public function _getMyLamps()
    {
        $UserLamps = TableRegistry::getTableLocator()->get('UserLamps');
        return $query = $UserLamps->find('ownedBy', ['user_id' => $this->user_id]);
    }

    public function _getMyLampsArray()
    {
        $UserLamps = TableRegistry::getTableLocator()->get('UserLamps');
        return $query = $this->my_lamps->find('list', [
            'keyField' => 'score_id',
            'valueField' => 'lamp'
        ])->toArray();
    }


}
