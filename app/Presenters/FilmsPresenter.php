<?php declare(strict_types = 1);

namespace App\Presenters;

use Nette;
use Nette\Utils\Image;

final class FilmsPresenter extends Nette\Application\UI\Presenter
{
    /** @var \IStoryBoardComponent @inject */
    public $storyBoard;
    
     /** @var \IPictureChangesComponent @inject */
    public $pictureChanges;
    
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
           $file_name_r = $picture_id.'resize'.$file_ext;
           $file->move(__DIR__ . '../../../www/'.'/'.$storyboards_id.'/'.$file_name);
           $image_gd = imagecreatefromjpeg(__DIR__ . '../../../www/'.'/'.$storyboards_id.'/'.$file_name);
           $ratio = 1024 / imagesx($image_gd);
           $height = imagesy($image_gd) * $ratio;
           $new_image = imagecreatetruecolor(1024, intval($height));
           imagecopyresampled($new_image, $image_gd, 0, 0, 0, 0, 1054, intval($height), imagesx($image_gd), imagesy($image_gd));
           imagejpeg($new_image, __DIR__ . '../../../www/'.'/'.$storyboards_id.'/' . $file_name_r, 90);
           //$image_resize = imagescale ( $image_gd , 1024 , 768 );
           //$image_resize->save(__DIR__ . '../../../www/'.'/'.$storyboards_id.'/'.$file_name_r);
           $this->filmsData->updatePicture($picture_id, array('picture'=>$file_name,
                                                              'file_ext'=>$file_ext));
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
    $this->filmsData->updatePicture($picture_id,['text'=>$text]);
    }
    
    public function handlenewpositions($positions) 
    {    
        $this->filmsData->updatePositions(explode(',',$positions));
    }
    
    public function handleupdateposition($left,$top) 
    {
        $picture_id = $this->getParameter('picture_id');
        $picture = $this->filmsData->pictureById($picture_id);
        $this->filmsData->updatePicture($picture_id,['pos_left'=>$left,
                                                     'pos_top'=>$top]);
        $file_name = $picture_id.$picture['file_ext'];
        $image_gd = imagecreatefromjpeg(__DIR__ . '../../../www/'.'/'.$picture['storyboards_id'].'/'.$file_name);
        $size = min(imagesx($image_gd), imagesy($image_gd));
        $im2 = imagecrop($image_gd, ['x' => $left, 'y' => $top, 'width' => $size, 'height' => $size]);
        if ($im2 !== FALSE) {
            bdump('jelo');
            imagepng($im2, 'example-cropped.png');
            imagedestroy($im2);
        }
        imagedestroy($image_gd);
    }
    
    protected function createComponentStoryBoard(): \StoryBoardComponent
    {
        $component = $this->storyBoard->create($this->presenter->getParameter('board_id'));
        return $component;
    }
    
    protected function createComponentPictureChanges(): \PictureChangesComponent
    {   
        $component = $this->pictureChanges->create($this->presenter->getParameter('picture_id'),$this->presenter->getParameter('storyboard_id'));
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
    
    public function renderPictureChange($picture_id = null,$storyboard_id = null): void
    {
        $this->template->storyboard_id = $storyboard_id;
        $this->template->id = $picture_id;
    }
    
}
