<?php declare(strict_types = 1);

use Nette\Application\UI\Form;

final class StoryBoardComponent extends Nette\Application\UI\Control
{
    public $onStoryBoardSave;
    private $filmsData;
    public $storyboards_id;
    public $id=0;
    public $action = NULL;
  
    
    public function __construct(App\Model\FilmsModel $filmsData,$storyboards_id) 
    {
        $this->filmsData = $filmsData;
        $this->storyboards_id = $storyboards_id;
    }
    
    public function handlenewstoryboard(){
        $count_pictures = $this->filmsData->countPictures($this->storyboards_id);
        $position = $count_pictures + 1;
        $save = $this->filmsData->addStoryboardPicture(array('storyboards_id'=>$this->storyboards_id,
                                                            'position'=>$position));
        $this->id = $save['id'];  
        $this->action = 'new';
    }
    
    public function handleedit($id){
        $picture = $this->filmsData->pictureById($id);
        $data_default = array('minutes'=>$picture['minutes'],
                      'seconds'=>$picture['seconds'],
                      'text'=>$picture['text']);
        $this->id = $id;
        $this->storyboards_id = $picture['storyboards_id'];
        $this->action = 'edit';
         $this['storyBoardForm']->setDefaults($data_default);
    }
    
    public function handledelete($id){
        $this->filmsData->deletePicture($id);
    }
    
    public function createComponentStoryBoardForm(): Form

    {
        $form = new Form();
      
        $form->addInteger('minutes','Minuty:');
        //    ->setHtmlAttribute('onchange', 'ares()');
        
        $form->addInteger('seconds','Sekundy:');
        
        $form->addText('text','Text:');
         
        $form->addUpload('image','obr:');
        
        $form->addHidden('picture_id',$this->id);
        $form->addHidden('storyboards_id',$this->storyboards_id);
        $form->addHidden('action',$this->action);
         
        $form->addSubmit('send', 'Uložit')
            ->setAttribute('class', 'btn btn-info btn-sm');   

       
        $form->onSuccess[] = [$this, 'processForm'];

        return $form;
    }
    
    public function createComponentPlayTextForm(): Form

    {   
        $form = new Form();
        $form->addTextArea('play_text','Text:'); 
         $form->addSelect('voices','Voices:');
         return $form;
    }
    public function processForm($form): void
    {
        $data = $form->getValues(true);
        $this->onStoryBoardSave($data);
    }
    
    public function render(): void
    {   
        $all_pictures = $this->filmsData->allStoryBoardPictures($this->storyboards_id);
        $tc_seconds = 0;
        $tc_minutes = 0;
        $all_tc_minutes = [];
        $all_tc_seconds = [];
        $all_message = [];
        $picture_all_text = '';
        $storyboard = $this->filmsData->getStoryBoardById($this->storyboards_id);
        foreach($all_pictures as $picture){
           $all_tc_seconds[$picture['id']] = $tc_seconds;
           $all_tc_minutes[$picture['id']] = $tc_minutes; 
           $tc_seconds = $tc_seconds + $picture['seconds'];
           if($tc_seconds > 60){
              $up_to = $tc_seconds - 60;
              $tc_seconds = $tc_seconds + $up_to;
              $tc_minutes = $tc_minutes + 1; 
           }
           $tc_minutes = $tc_minutes + $picture['minutes'];
           $picture_all_text = $picture_all_text.' '.$picture['text'];
           $text_array = explode(' ',$picture['text']);
           if(count($text_array)*3<($picture['minutes']*60 + $picture['seconds'])){
               $all_message[$picture['id']] = '';
           }
           else{
              $all_message[$picture['id']] = 'Pozor dlouhý text';  
           }
       }
        $this['playTextForm']->setDefaults(['play_text' => $picture_all_text]);
        
        $this->template->id = $this->id;
        $this->template->storyboard = $storyboard;
        $this->template->all_tc_minutes = $all_tc_minutes;
        $this->template->all_tc_seconds = $all_tc_seconds;
        $this->template->all_pictures = $all_pictures;
        $this->template->storyboard_id = $this->storyboards_id;
        $this->template->action = $this->action;
        $this->template->all_message = $all_message;
        $this->template->render(__DIR__ . '/storyboard.latte');
    }
}

interface IStoryBoardComponent
{
    /** @return \StoryBoardComponent */
    public function create($storyboards_id);
}

