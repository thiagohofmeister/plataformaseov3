<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Lead;

class LeadController extends Controller
{
    private $Lead;

    public function __construct(Lead $lead = null) {
    	$this->Lead = $lead;
    }
   	
   	public function index() {
   		return view(TM . 'admin/leads/index');
   	}
}
