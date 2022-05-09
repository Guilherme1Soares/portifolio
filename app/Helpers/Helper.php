<?php

namespace App\Helpers;

Class Helper
{

    private $sslForce = false;

    function sslForce($url)
    {
        if($this->sslForce)
        {
            return str_replace('http','https', $url);
        }

        else
        {
            return $url;
        }
    }

    public static function getPage(){

        $url = $_SERVER['REQUEST_URI'];
        $explode = explode('/',$url);
        $page = end($explode);
    
        return $page;
    
    }

    // FUNÇÃO PARA RETORNAR DADOS CONSTANTES NO SITE
    public static function getItem($data)
    {
        $array = array(
        
            //client
            'email-client' => '',
            'email-link' => '',
            'subjectMail' => 'Subject',

            // whats number
            'link-whats1' => "https://api.whatsapp.com/send?phone=5511959771304",
            'whats1' =>  "(11) 95977-1304",

            // telefones numner 
            'link-number1' => 'tel::+551112334455',
            'number1' => '(11) 1233-4455',

            // social medias 
            'linkedin' => 'https://www.linkedin.com/in/guilherme-soares-cordeoli-081a6016b/',
            'instagram' => '',
            'behance' => 'https://www.behance.net/guilhermesoares31',
            'github' => 'https://github.com/Guilherme1Soares',
            'email' => '',
            'acomp-image-resolution' => '200 x 200' ,
            'equipe-image-resolution' => '200 x 200' ,
        );

        if (isset($array[$data])){
            return $array[$data];
        }else {
           return "nada encontrado";
        }
    }

    // FUNÇÃO PARA MOSTRAR O MES EM STRING
    public static function showMonth($mes) 
    {
        switch($mes)
        {
            case 1:
                $dateValue = "Janeiro";
                break;

            case 2:
                $dateValue = "Fevereiro";
                break;

            case 3:
                $dateValue = "Março";
                break;
                
            case 4:
                $dateValue = "Abril";
                break;

            case 5:
                $dateValue = "Maio";
                break;

            case 6:
                $dateValue = "Junho";
                break;

            case 7:
                $dateValue = "Julho";
                break;

            case 8:
                $dateValue = "Agosto";
                break;

            case 9:
                $dateValue = "Setembro";
                break;

            case 10:
                $dateValue = "Outubro";
                break;

            case 11:
                $dateValue = "Novembro";
                break;

            case 12:
                $dateValue = "Dezembro";
                break;
        }
        if($mes != null)
        {
            return $dateValue;
        }
        else
        {
            return "A váriavel está vazia";
        }
    }

    // FUNÇÃO PARA MOSTRAR O DIA EM STRING
    public static function showDay($day)
    {
        $date = $day;
        $dateFinal = substr($date, 0, 2);
        return $dateFinal;
    }

    public static function showYear($day)
    {
        $date = $day;
        $dateFinal = substr($date, 6, 4);
        return $dateFinal;
    }

    // FUNÇÃO PARA FORMATAR URL PARA URL AMIGÁVEL
    public static function cleanUrl($string) 
    {
        $table = array(

            '/'=>'', '('=>'', ')'=>'',

        );

        $string = strtr($string, $table);

        $string = preg_replace(array("/(á|à|ã|â|ä)/","/(Á|À|Ã|Â|Ä)/","/(é|è|ê|ë)/","/(É|È|Ê|Ë)/","/(í|ì|î|ï)/","/(Í|Ì|Î|Ï)/","/(ó|ò|õ|ô|ö)/","/(Ó|Ò|Õ|Ô|Ö)/","/(ú|ù|û|ü)/","/(Ú|Ù|Û|Ü)/","/(ñ)/","/(Ñ)/"),explode(" ","a A e E i I o O u U n N"),$string);
        
        $string= preg_replace('/[,.;:`´^~\'"]/', null, iconv('UTF-8','ASCII//TRANSLIT',$string));

        $string= strtolower($string);

        $string= str_replace("ç", "c", $string);

        $string= str_replace("?", " ", $string);

        $string= str_replace(" ", "-", $string);

        $string= str_replace("---", "-", $string);

        return $string;
    }

    // FUNÇÃO PARA TIRAR OS SEGUNDOS DA HORA
    public static function noSeg($time)
    {
        $time = explode(":", $time);
        list($hora, $min, $seg) = $time;

        return $hora.':'.$min;
    }

    // FUNÇÕES PARA EXIBIR TIPOS DIFERENTES DE DATAS
    public static function formatDate($data, $tipo)
    {

        $data = explode("/", $data);
        list($dia, $mes, $ano) = $data;
    
        
        if($tipo == 1){

            return $ano.'-'.$mes.'-'.$dia;

        }elseif($tipo == 2){

            return $dia.'-'.$mes.'-'.$ano;

        }elseif($tipo == 3){
    
            $mes = static::showMonth($mes);

            return $dia.' '.substr($mes, 0, 3).' '.$ano;
    
        }
        elseif($tipo == 4){
    
            $mes = static::showMonth($mes);
        
            return $dia.' '.$mes.' '.$ano;
    
        }
        elseif($tipo == 5){
    
            $mes = static::showMonth($mes);

            return $dia.' de '.$mes.' de '.$ano;
    
        }
    
    }

    // FUNÇÃO PARA LIMITAR QUANTIDADE DE CARACTERES NA PÁGINA //
    public static function limitString($string,$limit)
    {

        $count_string = strlen($string);
        $str = '';

        if($count_string < $limit){
        $str = $string;
        }else{

            for($index = 0; $index <= $limit; $index++){
        
                if($index == $limit){
                $str = $str.'...';
                }else{
                $str = $str.$string[$index];
                }

            }

        }

        return $str;

    }

    // FUNÇÃO PARA CONVERTER DATA E HORA PARA TIMESTAP
    public static function toTimestamp($date, $time) 
    {

        $dataForm = static::formatDate($date,1);
        
        return strtotime($dataForm. " ".$time);

    }

    // FUNÇÃO PARA EXIBIR O TEMPO CORRIDO
    public static function runningTime($dateTime) 
    {
        // data e hora atual
        $now = strtotime(date('Y/m/d H:i:s'));
        $time = strtotime($dateTime);
        $diff = $now - $time;

        // quebrando 
        $seconds = $diff;
        $minutes = round($diff / 60);
        $hours = round($diff / 3600);
        $days = round($diff / 86400);
        $weeks = round($diff / 604800);
        $months = round($diff / 2419200);
        $years = round($diff / 29030400);

        // exibindo a diferencia de tempo
        if ($seconds <= 60) return"1 min atrás";
        else if ($minutes <= 60) return $minutes==1 ?'1 min atrás':$minutes.' min atrás';
        else if ($hours <= 24) return $hours==1 ?'1 hrs atrás':$hours.' hrs atrás';
        else if ($days <= 7) return $days==1 ?'1 dia atras':$days.' dias atrás';
        else if ($weeks <= 4) return $weeks==1 ?'1 semana atrás':$weeks.' semanas atrás';
        else if ($months <= 12) return $months == 1 ?'1 mês atrás':$months.' meses atrás';
        else return $years == 1 ? 'um ano atrás':$years.' anos atrás';
    }

}