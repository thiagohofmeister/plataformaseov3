<?php

namespace App\Controllers;

use App\Models\Lead;

class LeadController extends Controller {
    /** @var Lead */
    private $Lead;

    public function __construct(Lead $lead = null) {
    	$this->Lead = $lead;
    }
   	
   	public function index() {
   		return view(TM . 'admin/leads/index');
   	}
}
