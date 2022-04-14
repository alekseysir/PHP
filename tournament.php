<?php

class Tournament
{
    private $tourname;
    private $start_date;
    private $allPlayers;
    function __construct($tname, $tdate=null){
        $this->tourname=$tname.",";
        if ($tdate==null){
            $this->start_date=date("Y-m-d");
        }
        else
                $this->start_date=date_format(date_create_from_format('Y.m.j', $tdate), 'Y-m-d');
    }
    function createPairs(){
        $arr = $this->allPlayers;
        $n=count($arr);
        if ($n%2!=0){
            $arr[] = null;// Добавление игрока-заглушки.
            $n++;
            for ($i=1;$i<$n;$i++){
                echo $this->tourname." ".date_format(date_add(date_create($this->start_date), new DateInterval('P'.$i.'D')), 'd.m.Y')."<br>";
                for ($k=1;$k<=$n/2;$k++){
                    if ($arr[$k-1] xor $arr[$n-$k])
                        continue;
                    else
                        echo $arr[$k-1]->getName().$arr[$k-1]->getCity()." - ".$arr[$n-$k]->getName().$arr[$n-$k]->getCity()."<br>";
                }
                $arr = changingPairs($arr);
            }

        }
        else
            for ($i=1;$i<$n;$i++){
                echo $this->tourname." ".date_format(date_add(date_create($this->start_date), new DateInterval('P'.$i.'D')), 'd.m.Y')."<br>";
                for ($k=1;$k<=$n/2;$k++){
                    echo $arr[$k-1]->getName().$arr[$k-1]->getCity()." - ".$arr[$n-$k]->getName().$arr[$n-$k]->getCity()."<br>";
                }
                $arr = changingPairs($arr);
            }

    }
    function addPlayer($team) {
        $this->allPlayers[]=$team;
        return $this;
    }
}

function changingPairs(array $arr):array//Смена пар игроков.
{
    $first[] =array_shift($arr);
    $last = array_pop($arr);
    array_unshift($arr, $last);
    return array_merge($first,$arr);
}
