<?php declare(strict_types = 1);

namespace App\Presenters;

use Nette;


final class CompanyPresenter extends Nette\Application\UI\Presenter
{
    /** @var \ICreateCompanyFormComponent @inject */
    public $createCompanyFormControl;
    
    protected function createComponentCreateCompanyForm(): \CreateCompanyFormComponent
    {
        $component = $this->createCompanyFormControl->create();
        $component->onCreateCompanyFormSave[] = function ($data) {
            $this->redirect('Company:default',$data['ico'],
                                              $data['dic'],
                                              $data['company_name'],
                                              $data['company_adress'],
                                              $data['company_person_name'],
                                              $data['company_person_email']);
        };

        return $component;
    }
    
    public function renderDefault($ico = null,
                                  $dic = null,
                                  $company_name = null, 
                                  $company_adress=null,
                                  $company_person_name=null,
                                  $company_person_email=null
                                 ) 
    {
        $this->template->ico = $ico;
        $this->template->dic = $dic;
        $this->template->company_name = $company_name;
        $this->template->company_adress = $company_adress;
        $this->template->company_person_name = $company_person_name;
        $this->template->company_person_email = $company_person_email;
    }
}
