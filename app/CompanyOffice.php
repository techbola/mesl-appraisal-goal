<?php

namespace MESL;

use Illuminate\Database\Eloquent\Model;

class CompanyOffice extends Model
{
    /*
    |-----------------------------------------
    | GET ALL COMPANY OFFICES
    |-----------------------------------------
    */
    public function loadAll(){
    	// body
    	$company_office = CompanyOffice::orderBy('name', 'ASC')->get();

    	// return
    	return $company_office;
    }

    /*
    |-----------------------------------------
    | GET ALL STATES 
    |-----------------------------------------
    */
    public function getStates(){
    	// body
    	
    }
}
