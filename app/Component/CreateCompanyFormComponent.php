<?php declare(strict_types = 1);

use Nette\Application\UI\Form;

final class CreateCompanyFormComponent extends Nette\Application\UI\Control
{
    public $onCreateCompanyFormSave;
    
    public $ares_firma_fin;
    
    public function __construct() 
    {

    }
    
    public function handleAres($ico) 
    {
        $ares_dic = "";
        $ares_company = "";
        $ares_street = "";
        $ares_housenum   = "";
        $ares_housenum1   = "";
        $ares_housenum2   = "";
        $ares_city = "";
        $ares_citycode   = "";
        $ares_stav = "";
        $file = @file_get_contents("http://wwwinfo.mfcr.cz/cgi-bin/ares/darv_bas.cgi?ico=" . $ico);

        if($file)
          {
            $xml = @simplexml_load_string($file);
        }

        if($xml) 
          {
            $ns = $xml->getDocNamespaces();
            $data = $xml->children($ns['are']);
            $el = $data->children($ns['D'])->VBAS;

            if (strval($el->ICO) === $ico) 
              {
                $ares_dic = strval($el->DIC);

                if("" === $ares_dic)
                { 
                    $ares_dic = 'neni'; 
                }
                
                $ares_company = strval($el->OF);
                $ares_street = strval($el->AA->NU);
                $ares_housenum1 = strval($el->AA->CD);
                $ares_housenum2 = strval($el->AA->CO);
                
                if("" !== $ares_housenum2)
                { 
                    $ares_housenum = $ares_housenum1 . "/" . $ares_housenum2; 
                }
                else
                { 
                    $ares_housenum = $ares_housenum1; 
                
                }
                
                $ares_city = strval($el->AA->N);
                $ares_citycode   = strval($el->AA->PSC);
                $ares_stav = 1;
            } 
            else
              {
                $ares_stav  = 'IČO firmy nebylo nalezeno';
            } 
        }
        else
          {
            $ares_stav  = 'Databáze ARES není dostupná';
        }
         
            $this->presenter->sendJson(['dic' => $ares_dic,
                             'company_name' => $ares_company,
                             'company_adress' => $ares_street . ' ' . $ares_housenum . ', ' . $ares_city . ' ' . $ares_citycode,
                             'ares' => $ares_stav,   
                            ]);
        
    }
    
    public function createComponentCreateCompanyForm(): Form

    {
        $form = new Form();
        
        $form->addText('ico','IČO:')
            ->setRequired('Zadejte IČO')
            ->setHtmlAttribute('id', 'ico')
            ->setHtmlAttribute('onchange', 'ares()');
        
        $form->addText('dic','DIČ:')
            ->setRequired('Zadejte DIČ')
            ->setHtmlAttribute('id', 'dic');
                
        $form->addText('company_name','Název firmy:')
            ->setRequired('Zadejte název firmy')
            ->setHtmlAttribute('id', 'company_name');
          
        $form->addText('company_adress','Adresa firmy:')
            ->setRequired('Zadejte adresu firmy')
            ->setHtmlAttribute('id', 'company_adress');
        
        $form->addText('company_person_name','Jméno statutárního zástupce:')
            ->setRequired('Zadejte jméno');
        
        $form->addText('company_person_email','Email statutárního zástupce:');
         
        $form->addSubmit('send', 'Uložit')
            ->setAttribute('class', 'btn btn-info btn-sm');   

       
        $form->onSuccess[] = [$this, 'processForm'];

        return $form;
    }
    
    public function processForm($form): void
    {
        $data = $form->getValues(true);
        $this->onCreateCompanyFormSave($data);
    }
    
    public function render(): void
    {
        $this->template->render(__DIR__ . '/createcompanyform.latte');
    }
}

interface ICreateCompanyFormComponent
{
    /** @return \CreateCompanyFormComponent */
    public function create();
}

