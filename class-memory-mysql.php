<?php
class MemoryMysql {
    public function __construct(){
        global $memory_mysql;
        if(empty($memory_mysql['actors_table'])){
            $memory_mysql['actors_table']=array();
        }
        if(empty($memory_mysql['movies_table'])){
            $memory_mysql['movies_table']=array();
        }
        sort($memory_mysql['actors_table']);
        sort($memory_mysql['movies_table']);
    }
    public function create_new_actor($name,$dob){
        global $memory_mysql;
//        $new_actor_id=0;
//        if(!empty($memory_mysql['actors_table'])){
//            $new_actor_id=end($memory_mysql['actors_table'])+1;
//        }
        $memory_mysql['actors_table'][]=array(
            'name'=>$name,
            'dob'=>$dob,
        );
//        myvar_dump($memory_mysql,'$memory_mysql_before');
        end($memory_mysql['actors_table']);
        return key($memory_mysql['actors_table']);
    }
    public function get_actor_by_id($id){
        global $memory_mysql;
        if(!is_integer($id)){
            return false;
        }
        if(empty($memory_mysql['actors_table'][$id])){
            return false;
        }
        return $memory_mysql['actors_table'][$id];
    }

    public function create_new_movie($movie_title,$runtime,$reldate){
        global $memory_mysql;
//        $new_actor_id=0;
//        if(!empty($memory_mysql['actors_table'])){
//            $new_actor_id=end($memory_mysql['actors_table'])+1;
//        }
        $memory_mysql['movies_table'][]=array(
            'title'=>$movie_title,
            'runtime'=>$runtime,
            'reldate'=>$reldate,
        );
//        myvar_dump($memory_mysql,'$memory_mysql_before');
        end($memory_mysql['movies_table']);
        return key($memory_mysql['movies_table']);
    }
    public function get_movie_by_id($id){
        global $memory_mysql;
        if(!is_integer($id)){
            return false;
        }
        if(empty($memory_mysql['movies_table'][$id])){
            return false;
        }
        return $memory_mysql['movies_table'][$id];
    }


}