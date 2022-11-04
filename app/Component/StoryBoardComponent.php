<?php declare(strict_types = 1);

use Nette\Application\UI\Form;
use \Joseki\Application\Responses\PdfResponse;

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
    
    public function handlePdf($storyboard_id = null): void
    {   
        $template = $this->createTemplate();
	$template->setFile(__DIR__ . '/storyboardprint.latte');
        $all_pictures = $this->filmsData->allStoryBoardPictures($storyboard_id);
        $tc_seconds = 0;
        $last_tc = 0;
        $all_tc_seconds_gm = [];
        $all_seconds_gm = [];
        $all_message = [];
        $picture_all_text = '';
        $storyboard = $this->filmsData->getStoryBoardById($storyboard_id);
        foreach($all_pictures as $picture){
         
            $minutes = floor($picture['seconds']  / 60);
            $seconds = ($picture['seconds'])-$minutes*60;
            if($minutes < 10){
               $minutes = '0'.$minutes;
               
           }
           if($seconds < 10){
               $seconds = '0'.$seconds;
               
           }
           if($seconds - intval($seconds) == 0){
               $seconds = $seconds.',0';
           }
            $all_seconds_gm[$picture['id']] = str_replace('.',',',$minutes.':'.$seconds);
            
           $minutes_tc = floor($tc_seconds  / 60);
           $seconds_tc = ($tc_seconds)-$minutes*60;
           if($minutes_tc < 10){
               $minutes_tc = '0'.$minutes_tc;
               
           }
           if($seconds_tc < 10){
               $seconds_tc = '0'.$seconds_tc;
               
           }
           if($seconds_tc - intval($seconds_tc) == 0){
               $seconds_tc = $seconds_tc.',0';
           }
           $all_tc_seconds_gm[$picture['id']] = str_replace('.',',',$minutes_tc.':'.$seconds_tc);
           
           $tc_seconds = $tc_seconds + $picture['seconds'];
           
           $minutes_l = floor($tc_seconds  / 60);
           $seconds_l = ($tc_seconds)-$minutes*60;
           if($minutes_l < 10){
               $minutes_l = '0'.$minutes_l;
               
           }
           if($seconds_l < 10){
               $seconds_l = '0'.$seconds_l;
               
           }
           if($seconds_l - intval($seconds_l) == 0){
               $seconds_l = $seconds_l.',0';
           }
           $last_tc =  str_replace('.',',',$minutes_l.':'.$seconds_l);
           
           $picture_all_text = $picture_all_text.' '.$picture['text'];
           if($picture['text'] != null){
            $text_array = explode(' ',$picture['text']);
                if(count($text_array)<($picture['seconds']*3)){
                    $all_message[$picture['id']] = '';
                }
                else{
                   $all_message[$picture['id']] = 'Pozor dlouhý text';  
                }
           }
           else{
                   $all_message[$picture['id']] = '';  
           }
       }
        
        $template->last_tc = $last_tc;
        $template->storyboard = $storyboard;
        $template->all_seconds_gm = $all_seconds_gm;
        $template->all_tc_seconds_gm = $all_tc_seconds_gm;
        $template->all_pictures = $all_pictures;
        $template->storyboard_id = $storyboard_id;
        $template->action = $this->action;
        $template->all_message = $all_message;
         $pdf = new PdfResponse($template);
         $pdf->setPageFormat('A2');
         $pdf->setPageOrientation('L');
         //$pdf->setSaveMode(PdfResponse::DOWNLOAD); // stažení
         $pdf->setSaveMode(PdfResponse::INLINE); // zobrazit jako stránku, lepší pro test
         $this->presenter->sendResponse($pdf);
    }
    
    public function handlenewstoryboard(){
        $count_pictures = $this->filmsData->countPictures($this->storyboards_id);
        $position = $count_pictures + 1;
        $save = $this->filmsData->addStoryboardPicture(array('storyboards_id'=>$this->storyboards_id,
                                                            'position'=>$position));
        $this->id = $save['id'];  
        $this->action = 'new';
    }
    
    public function handleedit($id){
        $picture = $this->filmsData->pictureById($id);
        $data_default = array('seconds'=>$picture['seconds'],
                      'text'=>$picture['text'],
                       'text_aboute'=>$picture['text_aboute']);
        bdump($data_default);
        $this->id = $id;
        $this->storyboards_id = $picture['storyboards_id'];
        $this->action = 'edit';
         $this['storyBoardForm']->setDefaults($data_default);
    }
    
    public function handledelete($id){
        $this->filmsData->deletePicture($id);
    }
    
    public function createComponentStoryBoardForm(): Form

    {
        $form = new Form();
       
        $form->addInteger('seconds','Sekundy:');
        
        $form->addTextArea('text_aboute','Text:');
        
        $form->addTextArea('text','Text:');
  
        $form->addUpload('image','obr:');
        
        $form->addHidden('picture_id',$this->id);
        $form->addHidden('storyboards_id',$this->storyboards_id);
        $form->addHidden('action',$this->action);
         
        $form->addSubmit('send', 'Uložit')
            ->setAttribute('class', 'btn btn-info btn-sm');   

       
        $form->onSuccess[] = [$this, 'processForm'];

        return $form;
    }
    
    public function createComponentPlayTextForm(): Form

    {   
        $form = new Form();
        $form->addTextArea('play_text','Text:'); 
         $form->addSelect('voices','Voices:');
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
        $last_tc = 0;
        $all_tc_seconds_gm = [];
        $all_seconds_gm = [];
        $all_message = [];
        $picture_all_text = '';
        $storyboard = $this->filmsData->getStoryBoardById($this->storyboards_id);
        foreach($all_pictures as $picture){
         
            $minutes = floor($picture['seconds']  / 60);
            $seconds = ($picture['seconds'])-$minutes*60;
            if($minutes < 10){
               $minutes = '0'.$minutes;
               
           }
           if($seconds < 10){
               $seconds = '0'.$seconds;
               
           }
           if($seconds - intval($seconds) == 0){
               $seconds = $seconds.',0';
           }
            $all_seconds_gm[$picture['id']] = str_replace('.',',',$minutes.':'.$seconds);
            
           $minutes_tc = floor($tc_seconds  / 60);
           $seconds_tc = ($tc_seconds)-$minutes*60;
           if($minutes_tc < 10){
               $minutes_tc = '0'.$minutes_tc;
               
           }
           if($seconds_tc < 10){
               $seconds_tc = '0'.$seconds_tc;
               
           }
           if($seconds_tc - intval($seconds_tc) == 0){
               $seconds_tc = $seconds_tc.',0';
           }
           $all_tc_seconds_gm[$picture['id']] = str_replace('.',',',$minutes_tc.':'.$seconds_tc);
           
           $tc_seconds = $tc_seconds + $picture['seconds'];
           
           $minutes_l = floor($tc_seconds  / 60);
           $seconds_l = ($tc_seconds)-$minutes*60;
           if($minutes_l < 10){
               $minutes_l = '0'.$minutes_l;
               
           }
           if($seconds_l < 10){
               $seconds_l = '0'.$seconds_l;
               
           }
           if($seconds_l - intval($seconds_l) == 0){
               $seconds_l = $seconds_l.',0';
           }
           $last_tc =  str_replace('.',',',$minutes_l.':'.$seconds_l);
           
           $picture_all_text = $picture_all_text.' '.$picture['text'];
           if($picture['text'] != null){
            $text_array = explode(' ',$picture['text']);
                if(count($text_array)<($picture['seconds']*3)){
                    $all_message[$picture['id']] = '';
                }
                else{
                   $all_message[$picture['id']] = 'Pozor dlouhý text';  
                }
           }
           else{
                   $all_message[$picture['id']] = '';  
           }
       }
        $this['playTextForm']->setDefaults(['play_text' => $picture_all_text]);
        
        $this->template->id = $this->id;
        $this->template->last_tc = $last_tc;
        $this->template->storyboard = $storyboard;
        $this->template->all_seconds_gm = $all_seconds_gm;
        $this->template->all_tc_seconds_gm = $all_tc_seconds_gm;
        $this->template->all_pictures = $all_pictures;
        $this->template->storyboard_id = $this->storyboards_id;
        $this->template->action = $this->action;
        $this->template->all_message = $all_message;
        $this->template->render(__DIR__ . '/storyboard.latte');
    }
}

interface IStoryBoardComponent
{
    /** @return \StoryBoardComponent */
    public function create($storyboards_id);
}

