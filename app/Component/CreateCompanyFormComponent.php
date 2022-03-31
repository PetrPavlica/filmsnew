<?php
declare(strict_types=1);

use Nette\Application\UI\Form;

class CreateCompanyFormComponent extends Nette\Application\UI\Control
{
    
    public $onCreateCompanyFormSave;
    
    public function __construct() 
    {

    }
    
    public function handleAres($ico) 
    {
       bdump($ico); 
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

