<?php

class Movie {
    private $id=false;  // A movie id
    private $title=false;  // A movie title
    private $runtime=false;  // A movie runtime
    private $release=false;  // A movie release sate
    private $actors=array();  // A movie release sate
    private $characters=array();  // A movie release sate
    private $mem_mysql=false;  // A mysql object
    public function __construct($id=false,$movie_title=false,$runtime=false,$reldate=false){
        $this->mem_mysql=new MemoryMysql();
        if($id){
            $this->fetch_existing($id);
        } else if($movie_title && $runtime && $reldate){
            $this->create_new($movie_title,$runtime,$reldate);
//            myvar_dump($this,'$this_sdasdas_after_create');
        }
    }
    public function fetch_existing($id=false){
        if(is_integer($id)){
            if(!is_integer($id)){
                return;
            }
            $existing_movie_record=$this->mem_mysql->get_movie_by_id($id);
            $this->id=$id;
            $this->title=$existing_movie_record['title'];
            $this->release=$existing_movie_record['release'];
            $this->runtime=$existing_movie_record['runtime'];
        }
    }
    public function create_new($movie_title=false,$runtime=false,$reldate=false){
        $new_movie_id=null;
        if($movie_title && $runtime && $reldate){
            $new_movie_id=$this->mem_mysql->create_new_movie($movie_title,$runtime,$reldate);
//            myvar_dump($mem_mysql,'$mem_mysql');
//            global $memory_mysql;
//            myvar_dump($memory_mysql,'$memory_mysql');
//            myvar_dd($new_actor_id,'$new_actor_id');
            if(is_integer($new_movie_id)){
                $this->id=$new_movie_id;
                $this->set_title($movie_title);
                $this->set_runtime($runtime);
                $this->set_reldate($reldate);
            }
        }
//        myvar_dump($this,'this_create_end');
//        myvar_dump(compact('new_actor_id','actor_name','date_of_birth'));
    }
    public function is_valid(){
        // Validation to be appeared
        if(!is_integer($this->id)){
            return false;
        }
        return true;
    }
    public function set_title($movie_title){
        // Validation to be appeared
        $this->title=$movie_title;
    }
    public function set_runtime($movie_runtime){
        // Validation to be appeared
        $this->runtime=$movie_runtime;
    }
    public function set_reldate($movie_reldate){
        // Validation to be appeared
        $this->release=$movie_reldate;
    }
    public function add_actor($actor_instance,$characters){
        $new_id=$actor_instance->get_id();
        if(!is_integer($new_id)){
            return;
        }
        $this->actors[]=$new_id;
        if(is_array($characters)){
            $this->characters[$new_id]=$characters;
        } else {
            $this->characters[$new_id]=array($characters);
        }
    }
    public function get_json(){
        if(!is_integer($this->id)){
            return false;
        }
        return json_encode(array(
            'id'=>$this->id,
            'title'=>$this->title,
            'runtime'=>$this->runtime,
            'release'=>$this->release,
            'actors'=>$this->actors,
            'characters'=>$this->characters,
        ));
    }
    public function get_youngest_list(){
        $dobs=array();
        $output=array();
        foreach($this->actors as $nth_actor_id){
            $nth_actor_instance=new Actor($nth_actor_id);
            $crnt_id=$nth_actor_instance->get_id();
            if(!is_integer($crnt_id)){
                continue;
            }
            $dobs[]=$nth_actor_instance->get_dob();
            $output[]=$nth_actor_instance->get_json();
        }
        if(empty($output)){
            return false;
        }
        if(1==count($output)){
            return $output;
        }
        array_multisort($dobs,SORT_DESC,$output);
        return $output;
    }
}