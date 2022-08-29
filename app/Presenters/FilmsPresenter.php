<?php declare(strict_types = 1);

namespace App\Presenters;

use Nette;


final class FilmsPresenter extends Nette\Application\UI\Presenter
{
    /** @var \IStoryBoardComponent @inject */
    public $storyBoard;
    
    /** @var \IStoryBoardFormComponent @inject */
    public $storyBoardForm;
    
    /** @var \App\Model\FilmsModel @inject */
    public $filmsData;
    
     public function handleUploadimage($data) 
    {
         bdump($data);
    }
    
    public function handleupdatetime($hours) 
    {
         bdump($hours);
    }
    
    protected function createComponentStoryBoard(): \StoryBoardComponent
    {
        $component = $this->storyBoard->create($this->presenter->getParameter('board_id'));
        return $component;
    }
    
    protected function createComponentStoryBoardForm(): \StoryBoardFormComponent
    {
        $component = $this->storyBoardForm->create();
        return $component;
    }
    
    public function renderDefault($board_id = null): void
    {
        $all_boards = $this->filmsData->allStoryBoard();
        $this->template->all_boards = $all_boards;
        $this->template->board_id = $board_id;
    }
    
}
