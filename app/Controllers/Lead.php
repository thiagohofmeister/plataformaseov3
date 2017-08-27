<?php

namespace App\Controllers;

use App\Models\Lead as Model;

class Lead extends Controller {
    /** @var Model */
    private $Lead;

    public function __construct(Model $lead = null) {
    	$this->Lead = $lead;
    }
   	
   	public function index() {
   		return view(TM . 'admin/leads/index');
   	}
}
