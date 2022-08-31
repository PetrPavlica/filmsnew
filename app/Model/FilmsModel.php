<?php

namespace App\Model;

class FilmsModel extends BaseModel{
    
    public function addStoryBoard($data){
        return $this->database->table('storyboards')->insert($data);
    }
    
    public function addStoryBoardPicture($data){
        return $this->database->table('storyboards_pictures')->insert($data);
    }
    
    public function allStoryBoardPictures($storyboard_id){
        return $this->database->table('storyboards_pictures')->where('storyboards_id',$storyboard_id)->fetchAll();
    }
    
    public function allStoryBoard(){
        return $this->database->table('storyboards')->fetchAll();
    }
    
    public function getLastIdStoryBoard(){
        return $this->database->lastInsertId('storyboards');
    }
    
    public function updatePicture($id,$data){
        $select = $this->database->table('storyboards_pictures')->where('id',$id)->fetch();
        $select->update($data);
    }
}