<?php

namespace App\Model;

class FilmsModel extends BaseModel{
    
     public function addStoryBoard($data){
        return $this->database->table('storyboards')->insert($data);
    }
    
    public function allStoryBoard(){
        return $this->database->table('storyboards')->fetchAll();
    }
    
}