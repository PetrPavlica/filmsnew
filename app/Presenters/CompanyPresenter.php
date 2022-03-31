<?php

declare(strict_types=1);

namespace App\Presenters;

use Nette;


final class CompanyPresenter extends Nette\Application\UI\Presenter
{
   /** @var \ICreateCompanyFormComponent @inject */
    public $createCompanyFormControl;
    
    protected function createComponentCreateCompanyForm(): \CreateCompanyFormComponent {
        
        $component = $this->createCompanyFormControl->create();
        $component->onCreateCompanyFormSave[] = function ($data) {
            
		};
        return $component;
    }
}
