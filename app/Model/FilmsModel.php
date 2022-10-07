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
        return $this->database->table('storyboards_pictures')->where('storyboards_id',$storyboard_id)->order('position')->fetchAll();
    }
    
    public function countPictures($storyboard_id){
        return $this->database->table('storyboards_pictures')->where('storyboards_id',$storyboard_id)->order('position')->count();
    }
        
    public function allStoryBoard(){
        return $this->database->table('storyboards')->fetchAll();
    }
    
    public function getLastIdStoryBoard(){
        return $this->database->lastInsertId('storyboards');
    }
    
    public function getStoryBoardById($id){
        return $this->database->table('storyboards')->where('id',$id)->fetch();
    }
    
    public function updatePicture($id,$data){
        $select = $this->database->table('storyboards_pictures')->where('id',$id)->fetch();
        $select->update($data);
    }
    
    public function deletePicture($id){
        $select = $this->database->table('storyboards_pictures')->where('id',$id)->fetch();
        $select->delete();
    }
    
    public function updatePositions($positions){
       foreach($positions as $position=>$id){
          if($id !== ''){
            $select = $this->database->table('storyboards_pictures')->where('id',$id)->fetch();
            $select->update(['position'=>$position]);
       
          }
        } 
    }
    
    public function pictureById($id){
        return $this->database->table('storyboards_pictures')->where('id',$id)->fetch();
    }
}