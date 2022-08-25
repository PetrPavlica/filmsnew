<?php declare(strict_types = 1);

use Nette\Application\UI\Form;

final class StoryBoardComponent extends Nette\Application\UI\Control
{
    public $onStoryBoardSave;
    
    public $id;
    
    public function __construct() 
    {

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
    public function create();
}

