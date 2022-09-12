<?php declare(strict_types = 1);

namespace App\Presenters;

use Nette;
use Nette\Utils\Image;

final class FilmsPresenter extends Nette\Application\UI\Presenter
{
    /** @var \IStoryBoardComponent @inject */
    public $storyBoard;
    
    /** @var \IStoryBoardFormComponent @inject */
    public $storyBoardForm;
    
    /** @var \App\Model\FilmsModel @inject */
    public $filmsData;
    
     public function handleuploadimage() 
    {  
       $files = $this->getHttpRequest()->getFiles();
       $file = $files['fileimage'];
       $picture_id = $this->getHttpRequest()->getPost('picture_id');
       $storyboards_id = $this->getHttpRequest()->getPost('storyboards_id');
       if($file->isImage() and $file->isOk()) {
           $file_ext=strtolower(mb_substr($file->getSanitizedName(), strrpos($file->getSanitizedName(), ".")));
           $file_name = $picture_id.$file_ext;
           $file->move(__DIR__ . '../../../www/'.'/'.$storyboards_id.'/'.$file_name);
           $this->filmsData->updatePicture($picture_id, array('picture'=>$file_name));
       }
    }
    
    public function handleupdatetime($minutes,$seconds,$picture_id, $storyboards_id) 
    {
         $data = array('minutes'=>$minutes,
                        'seconds' => $seconds,
                       );   
         $this->filmsData->updatePicture($picture_id, $data);
    }
    
    public function handleupdatetext($picture_id,$text) 
    {    
    $this->filmsData->updatePicture($picture_id,['text'=>$text],);
    }
    
    public function handlenewpositions($positions) 
    {    
        $this->filmsData->updatePositions(explode(',',$positions));
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
