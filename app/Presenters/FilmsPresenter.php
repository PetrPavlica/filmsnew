<?php declare(strict_types = 1);

namespace App\Presenters;

use Nette;


final class FilmsPresenter extends Nette\Application\UI\Presenter
{
    /** @var \IStoryBoardComponent @inject */
    public $storyBoard;
    
     public function handleUploadimage($data) 
    {
         bdump($data);
    }
    
    protected function createComponentStoryBoard(): \StoryBoardComponent
    {
        $component = $this->storyBoard->create();
        return $component;
    }
    
    public function renderDefault(): void
    {
        
    }
}
