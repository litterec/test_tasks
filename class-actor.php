<?php

class Actor {
    private $id=false;  // An actor id
    private $name=false;  // An actor name
    private $dob=false;  // An actor date of birth
    private $mem_mysql=false;  // A mysql object
    public function __construct($id=false,$actor_name=false,$date_of_birth=false){
        $this->mem_mysql=new MemoryMysql();
        if(is_integer($id)){
            $this->fetch_existing($id);
        } else if($actor_name && $date_of_birth){
            $this->create_new($actor_name,$date_of_birth);
//            myvar_dump($this,'$this_sdasdas_after_create');
        }
    }
    public function fetch_existing($id=false){
        if(is_integer($id)){
            if(!is_integer($id)){
                return;
            }
            $existing_actor_record=$this->mem_mysql->get_actor_by_id($id);
            if(!is_array($existing_actor_record)){
                return;
            }
            $this->id=$id;
            $this->name=$existing_actor_record['name'];
            $this->dob=$existing_actor_record['dob'];
        }
    }
    public function create_new($actor_name=false,$date_of_birth=false){
        $new_actor_id=null;
        if($actor_name && $date_of_birth){
            $new_actor_id=$this->mem_mysql->create_new_actor($actor_name,$date_of_birth);
//            myvar_dump($mem_mysql,'$mem_mysql');
//            global $memory_mysql;
//            myvar_dump($memory_mysql,'$memory_mysql');
//            myvar_dd($new_actor_id,'$new_actor_id');
            if(is_integer($new_actor_id)){
                $this->id=$new_actor_id;
                $this->set_name($actor_name);
                $this->set_dob($date_of_birth);
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
    public function set_name($name){
        // Validation to be appeared
        $this->name=$name;
    }
    public function set_dob($dob){
        // Validation to be appeared
        $this->dob=$dob;
    }
    public function get_id(){
        return $this->id;
    }
    public function get_dob(){
        return $this->dob;
    }
    public function get_json(){
        if(!is_integer($this->id)){
            return false;
        }
        return json_encode(array(
            'id'=>$this->id,
            'name'=>$this->name,
            'dob'=>$this->dob,
        ));
    }
}