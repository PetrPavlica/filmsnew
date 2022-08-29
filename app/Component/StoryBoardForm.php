<?php declare(strict_types = 1);

use Nette\Application\UI\Form;

final class StoryBoardFormComponent extends Nette\Application\UI\Control
{
    public $onStoryBoardFormSave;
    private $filmsData;
    public $id;
    
    public function __construct(App\Model\FilmsModel $filmsData) 
    {
        $this->filmsData = $filmsData;
    }
    
    public function createComponentStoryBoardForm(): Form

    {
        $form = new Form();
        
        $form->addText('name','Name:')
             ->setRequired('Zadejte Název');
        
        $form->addSubmit('send', 'Uložit')
            ->setAttribute('class', 'btn btn-info btn-sm');   

       
        $form->onSuccess[] = [$this, 'processForm'];

        return $form;
    }
    
    public function processForm($form): void
    {
        $data = $form->getValues();
        $this->filmsData->addStoryBoard($data);
        $this->onStoryBoardFormSave($data);
    }
    
    public function render(): void
    {
        $this->template->render(__DIR__ . '/storyboardform.latte');
    }
}

interface IStoryBoardFormComponent
{
    /** @return \StoryBoardFormComponent */
    public function create();
}

