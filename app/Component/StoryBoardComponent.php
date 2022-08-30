<?php declare(strict_types = 1);

use Nette\Application\UI\Form;

final class StoryBoardComponent extends Nette\Application\UI\Control
{
    public $onStoryBoardSave;
    private $filmsData;
    public $storyboards_id;
    public $id=0;
    
    
    public function __construct(App\Model\FilmsModel $filmsData,$storyboards_id) 
    {
        $this->filmsData = $filmsData;
        $this->storyboards_id = $storyboards_id;
    }
    
    public function newstoryboard(){
        $this->id = $this->filmsData->addStoryboardPicture($this->storyboards_id);  
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
        
        $form->addHidden('id',$this->id);
        $form->addHidden('storyboards_id',$this->storyboards_id);
         
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
        $this->template->storyboard_id = $this->storyboards_id;
        $this->template->render(__DIR__ . '/storyboard.latte');
    }
}

interface IStoryBoardComponent
{
    /** @return \StoryBoardComponent */
    public function create($storyboards_id);
}

