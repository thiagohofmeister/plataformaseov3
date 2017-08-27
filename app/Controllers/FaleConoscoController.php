<?php

namespace App\Controllers;

use Illuminate\Http\Request;
use App\Mail\FaleConosco;
use Mail;
use App\Models\TagSeo;

class FaleConoscoController extends Controller {
    /**
     * Envia o E-mail de Contato
     *
     * @param Request $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function mail(Request $request) {
    	$Tag = new TagSeo();
    	$Tag = $Tag->select('email')->first();

    	$req = $request->except('_token');

    	$opts = [
    		'nome' => 'required',
    		'email' => 'required',
			'assunto' => 'required|not_in:-1',
			'mensagem' => 'required|min:10|max:255'
    	];

    	$validator = validator($req, $opts);

    	if ($validator->fails()) {
    		return redirect('/contato')->withErrors($validator)->withInput();
    	}

    	Mail::to($Tag->email)->send(new FaleConosco($req));

    	return redirect('/contato')->with(['msg' => 'E-mail enviado com sucesso. Entraremos em contato em breve.']);
    }
}
