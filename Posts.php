<?php 
require "./model/Articles.php";

class Posts{
    function GetPosts($postId){
        $postObj = new Articles();
        if(!empty($postId)){
            return $postObj->Article($postId);
        }
        else{
            return $postObj->Article("");
        }
    }
    function JustNowTiming($datetime, $full = false) {
        $now = new DateTime;
        $ago = new DateTime($datetime);
        $diff = $now->diff($ago);

        $diff->w = floor($diff->d / 7);
        $diff->d -= $diff->w * 7;

        $string = array(
            'y' => 'year',
            'm' => 'month',
            'w' => 'week',
            'd' => 'day',
            'h' => 'hour',
            'i' => 'minute',
            's' => 'second',
        );
        foreach ($string as $k => &$v) {
            if ($diff->$k) {
                $v = $diff->$k . ' ' . $v . ($diff->$k > 1 ? 's' : '');
            } else {
                unset($string[$k]);
            }
        }

        if (!$full) $string = array_slice($string, 0, 1);
        return $string ? implode(', ', $string) . ' ago' : 'just now';
    }
    function ReadingTime($content) {
        $word_count = str_word_count(strip_tags($content));
        $contLen = strlen(strip_tags($content));//200
        $minutes = floor($word_count / $contLen);
        $seconds = floor($word_count % $contLen / ($contLen / 60));

        $str_minutes = ($minutes == 1) ? "min" : "mins";
        $str_seconds = ($seconds == 1) ? "sec" : "secs";

        if ($minutes == 0) {
            return "{$seconds} {$str_seconds}";
        }
        else {
            return "{$minutes} {$str_minutes}, {$seconds} {$str_seconds}";
        }
    }
    function AlterNateName($name){
        $returnName = $name;
        $propName = explode(' ',$name);
        if(sizeof($propName) > 1){
            $firstLetter = substr($propName[0],0,1);
            $secondLetter = substr($propName[1],0,1);
            $returnName = strtoupper($firstLetter.$secondLetter);
        }
        else{
            $returnName = $name;
        } 
        return $returnName;
    }
    function NewPost($post = array()){
        $postObj = new Articles();
        return $postObj->AddPost($post);
    }
    function GetFeatured(){
        $postObj = new Articles();
        return $postObj->FeaturedArticle();
    }
}
?>