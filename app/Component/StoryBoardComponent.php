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
    
    public function createComponentStoryBoardForm(): Form

    {
        $form = new Form();
        
        $form->addInteger('hours','Hodiny:');
        
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
    
    public function processForm($form): void
    {
        $data = $form->getValues(true);
        $this->onStoryBoardSave($data);
    }
    
    public function render(): void
    {   
        $all_pictures = $this->filmsData->allStoryBoardPictures($this->storyboards_id);
        $tc_seconds = 0;
        $after_floor = 0;
        $all_tc_minutes = [];
        $all_tc_seconds = [];
        foreach($all_pictures as $picture){
           $all_tc_seconds[$picture['id']] = $after_floor * 60;
           $all_tc_minutes[$picture['id']] = round($tc_seconds/60,2); 
           $picture_seconds = $picture['minutes']*60 + $picture['seconds'];
           $tc_seconds = $tc_seconds + $picture_seconds;
           bdump($tc_seconds);
           $tc_minutes = round($tc_seconds/60);
            bdump($tc_minutes);
           $after_floor = $tc_seconds/60 - round($tc_minutes,2);
           bdump($after_floor);
        }
        $this->template->id = $this->id;
        $this->template->all_tc_minutes = $all_tc_minutes;
        $this->template->all_tc_seconds = $all_tc_seconds;
        $this->template->all_pictures = $all_pictures;
        $this->template->storyboard_id = $this->storyboards_id;
        $this->template->action = $this->action;
        $this->template->render(__DIR__ . '/storyboard.latte');
    }
}

interface IStoryBoardComponent
{
    /** @return \StoryBoardComponent */
    public function create($storyboards_id);
}

