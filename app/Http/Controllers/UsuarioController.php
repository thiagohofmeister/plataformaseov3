<?php

namespace App\Http\Controllers;

use App\Enum\Post\Status;
use Mail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Usuario;
use App\Models\Post;
use App\Models\Comentario;
use App\Models\TagSeo;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;
use App\Mail\RecuperarSenha;

class UsuarioController extends Controller {

    private $Usuario;

    public function __construct(Usuario $usuario) {
        parent::__construct();

        $this->Usuario = $usuario;
    }

    public function index() {
        $Post = new Post;
        $Comentario = new Comentario;
        $Seo = new TagSeo;

        $Seo = $Seo->getSeo((object) ['seo_title' => 'Dashboard'], false);
        $Posts = $Post->getPosts();
        $Comentarios = $Comentario->getTotal();
        $TotalPosts = $Post->getTotalPosts(Status::PUBLISHED());

        return view(TM . 'admin/index', compact('Posts', 'Comentarios', 'Seo', 'TotalPosts'));
    }

    public function add() {
        
    }

    public function login() {
        return view(TM . 'admin/login');
    }

    public function postLogin(Request $request) {
        $credentials = ['email' => $request->get('email'), 'password' => $request->get('password')];
        if (auth()->guard('usuario')->attempt($credentials)) {
            return redirect('/admin');
        } else {
            return redirect('/admin/login')->withErrors([
                        'errors' => 'O e-mail ou a senha estão inválidos. Tente novamente.'
                    ])->withInput();
        }
    }

    public function servicos() {
        return view(TM . 'index');
    }

    public function logout() {
        auth()->guard('usuario')->logout();

        return redirect('/');
    }

    public function reset_passwords() {
        return view(TM . 'auth.passwords.email');
    }

    public function email(Request $request) {
        $req = $request->all();


        $reset_token = strtolower(str_random(64));
        DB::table('password_resets')->insert([
            'email' => $req['email'],
            'token' => $reset_token,
            'created_at' => Carbon::now(),
        ]);
        
        Mail::to($request->only('email'))->send(new RecuperarSenha($reset_token));
    }
    
    public function reset($token)
    {
        return view(TM . 'auth/passwords/reset', compact('token'));
    }
    
    public function reset_password(Request $request)
    {
        $req = $request->all();
        $validar = DB::table('password_resets')->where('token', $req['token'])->where('email', $req['email'])->first();
        if (!empty($validar->email)) {
            $this->Usuario = $this->Usuario->where('email', $req['email'])->first();
            $this->Usuario->password = Hash::make($req['password']);
            
            $up = ['password' => $this->Usuario->password];
            
            $update = $this->Usuario->update($up);
            
            if ($update) {
                DB::table('password_resets')->where('token', $req['token'])->where('email', $req['email'])->delete();
                dd("Atualizado");
            } else {
                dd("erro");
            }
        } else {
            dd("Token já utilizado ou inválido!");
        }
        
    }
}
