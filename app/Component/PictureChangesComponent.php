<?php declare(strict_types = 1);

use Nette\Application\UI\Form;

final class PictureChangesComponent extends Nette\Application\UI\Control
{
    public $onPictureChangesSave;
    private $filmsData;
    public $storyboards_id=0;
    public $picture_id=0;
    public $action = NULL;
  
    
    public function __construct(App\Model\FilmsModel $filmsData,$picture_id,$storyboards_id) 
    {
        $this->filmsData = $filmsData;
        $this->picture_id = $picture_id;
        $this->storyboards_id = $storyboards_id;
    }
     
    
     public function render(): void
    {   
         $picture = $this->filmsData->pictureById($this->picture_id);
         $this->template->picture_id = $this->picture_id;
         $this->template->picture = $picture;
         $this->template->storyboards_id = $this->storyboards_id;
         $this->template->render(__DIR__ . '/picturechanges.latte');
         
    }

        public function createComponentImageResizeForm(): Form

    {
        $form = new Form();
        
        $picture = $this->filmsData->pictureById($this->picture_id);
        $form->addInteger('new_width','Sirka:')
            ->setRequired('Zadejte cislo')
            ->setDefaultValue($picture['max_width']);
        
        $form->addInteger('new_height','Sirka:')
            ->setRequired('Zadejte cislo');
        
        
        $form->addSubmit('send', 'Uložit')
            ->setAttribute('class', 'btn btn-info btn-sm');   

       
        $form->onSuccess[] = [$this, 'processForm'];

        return $form;
    }
    
    public function processForm($form): void
    {
        $data = $form->getValues(true);
        $this->onPictureChangesSave($data);
    }
}

interface IPictureChangesComponent
{
    /** @return \PictureChangesComponent */
    public function create($picture_id,$storyboards_id);
}
