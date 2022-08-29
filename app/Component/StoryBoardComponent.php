<?php declare(strict_types = 1);

use Nette\Application\UI\Form;

final class StoryBoardComponent extends Nette\Application\UI\Control
{
    public $onStoryBoardSave;
    private $filmsData;
    public $board_id;
    
    
    public function __construct(App\Model\FilmsModel $filmsData,$board_id) 
    {
        $this->filmsData = $filmsData;
        $this->board_id = $board_id;
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
        
        $form->addHidden('board_id',$this->board_id);
         
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
        $this->template->render(__DIR__ . '/storyboard.latte');
    }
}

interface IStoryBoardComponent
{
    /** @return \StoryBoardComponent */
    public function create($board_id);
}

