<?php
declare(strict_types=1);

use Nette\Application\UI\Form;

class CreateCompanyFormComponent extends Nette\Application\UI\Control
{
    
    public $onCreateCompanyFormSave;
    
    public $ares_firma_fin;
    
    public function __construct() 
    {

    }
    
    public function handleAres($ico) 
    {
        $ares_ico_fin = "";
        $ares_dic_fin = "";
        $ares_firma_fin = "";
        $ares_ulice_fin = "";
        $ares_cp1_fin   = "";
        $ares_cp2_fin   = "";
        $ares_mesto_fin = "";
        $ares_psc_fin   = "";
        $ares_stav_fin = "";
        $file = @file_get_contents("http://wwwinfo.mfcr.cz/cgi-bin/ares/darv_bas.cgi?ico=".$ico);

        if($file)
          {
            $xml = @simplexml_load_string($file);
          }

        if($xml) 
          {
            $ns = $xml->getDocNamespaces();
            $data = $xml->children($ns['are']);
            $el = $data->children($ns['D'])->VBAS;

            if (strval($el->ICO) == $ico) 
              {
                $ares_ico_fin = strval($el->ICO);
                $ares_dic_fin = strval($el->DIC);
                $ares_firma_fin = strval($el->OF);
                $ares_ulice_fin = strval($el->AA->NU);
                $ares_cp1_fin   = strval($el->AA->CD);
                $ares_cp2_fin   = strval($el->AA->CO);
                
                if($ares_cp2_fin != "")
                { 
                    $ares_cp_fin = $ares_cp1_fin."/".$ares_cp2_fin; 
                }
                else
                { 
                    $ares_cp_fin = $ares_cp1_fin; 
                
                }
                
                $ares_mesto_fin = strval($el->AA->N);
                $ares_psc_fin   = strval($el->AA->PSC);
                $ares_stav_fin = 1;
              } 
            else
              {
                $ares_stav_fin  = 'IČO firmy nebylo nalezeno';
              } 
          }
        else
          {
            $ares_stav_fin  = 'Databáze ARES není dostupná';
          }
          
          $form = $this->getComponent('createCompanyForm');
          $form->setDefaults(['dic'=>$ares_dic_fin,
                              'company_name'=>$ares_firma_fin,
                              'company_adress'=>$ares_cp1_fin
                             ]);
         $this->redrawControl('snippet-createCompanyForm-form');
         
          }
    
     public function createComponentCreateCompanyForm() 

    {
        $form = new Form;
        
        $form->addText('ico','IČO:')
             ->setRequired('Zadejte IČO')
              ->setHtmlAttribute('id', 'ico')
             ->setHtmlAttribute('onchange', 'ares()');
        
        $form->addText('dic','DIČ:')
             ->setRequired('Zadejte DIČ');
                
        $form->addText('company_name','Název firmy:')
            ->setRequired('Zadejte název firmy');
          
        $form->addText('company_adress','Adresa firmy:')
            ->setRequired('Zadejte adresu firmy');
        
        $form->addText('company_person_name','Adresa firmy:')
                        ->setRequired('Zadejte jméno');
        
        $form->addText('company_person_email','Adresa firmy:');
         
        $form->addSubmit('send', 'Uložit')
        ->setAttribute('class', 'btn btn-info btn-sm');   

       
        $form->onSuccess[] = [$this, 'processForm'];
        return $form;
    }
    
    public function processForm($form)
    {
             
        $data = $form->getValues();
        $this->presenter->flashMessage('Uloženo');
        $this->onCreateCompanyFormSave($data);
    }
    
    public function render(){
       
       $this->template->render(__DIR__ .'/createcompanyform.latte');
    }
}

interface ICreateCompanyFormComponent
{
    /** @return \CreateCompanyFormComponent */
    function create();
}

