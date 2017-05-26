<?php

// Funções Globais
Route::group(['prefix' => ''], function() {
    createConstants();
});

// Index
Route::get('/', 'AppController@index');


//Auth::routes();

Route::get('/home', 'HomeController@index');
Route::get('/envia', 'AppController@envia');

/**
 * Login Colaborador
 */
Route::group(['middleware' => 'usuario'], function() {

    Route::group(['middleware' => 'usuario:usuario'], function() {
        // Perfil usuario
        Route::get('/admin', 'UsuarioController@index');

        /**
         * Páginas que apenas um usuário pode acessar
         */
        /**
         * Postagens
         */
        Route::get('/admin/posts', 'PostController@index');
        Route::get('/admin/posts/edit/{id}', 'PostController@edit')->where(['id' => '[0-9]+']);
        Route::post('/admin/posts/edit/{id}', 'PostController@postEdit')
            ->where(['id' => '[0-9]+']);
        Route::get('/admin/posts/add', 'PostController@add');
        Route::post('/admin/posts/add', 'PostController@postAdd');
        Route::get('/admin/posts/rascunhos', 'PostController@drafts');
        Route::post('/admin/posts/upload_arquivo', 'PostController@uploadImage');
        Route::get('/admin/posts/delete/{id}', 'PostController@delete')
            ->where(['id' => '[0-9]+']);

        /**
         * Categorias
         */
        Route::get('/admin/categorias', 'CategoriaController@index');
        Route::get('/admin/categorias/add', 'CategoriaController@add');
        Route::post('/admin/categorias/add', 'CategoriaController@postAdd');
        Route::get('/admin/categorias/edit/{id}', 'CategoriaController@edit')
            ->where(['id' => '[0-9]+']);
        Route::post('/admin/categorias/edit/{id}', 'CategoriaController@postEdit')
            ->where(['id' => '[0-9]+']);
        Route::get('/admin/categorias/delete/{id}', 'CategoriaController@delete')
            ->where(['id' => '[0-9]+']);
        Route::get('/admin/categorias/status/{id}', 'CategoriaController@status')
            ->where(['id' => '[0-9]+']);

        /**
         * Tags
         */
        Route::get('/admin/tags', 'PostTagController@index');
        
        /**
         * Áreas de Conteúdo
         */
        Route::get('/admin/tipoconteudos', 'TipoConteudoController@index');
        Route::get('/admin/tipoconteudos/add', 'TipoConteudoController@add');
        Route::post('/admin/tipoconteudos/add', 'TipoConteudoController@postAdd');
        Route::get('/admin/tipoconteudos/edit/{id}', 'TipoConteudoController@edit')
            ->where(['id' => '[0-9]+']);
        Route::post('/admin/tipoconteudos/edit/{id}', 'TipoConteudoController@postEdit')
            ->where(['id' => '[0-9]+']);
        Route::get('/admin/tipoconteudos/delete/{id}', 'TipoConteudoController@delete')
            ->where(['id' => '[0-9]+']);

        /**
         * Conteúdos
         */
        Route::get('/admin/conteudos', 'ConteudoController@index');
        Route::get('/admin/conteudos/add', 'ConteudoController@add');
        Route::post('/admin/conteudos/add', 'ConteudoController@postAdd');
        Route::get('/admin/conteudos/edit/{id}', 'ConteudoController@edit')
            ->where(['id' => '[0-9]+']);
        Route::post('/admin/conteudos/edit/{id}', 'ConteudoController@postEdit')
            ->where(['id' => '[0-9]+']);
        Route::get('/admin/conteudos/delete/{id}', 'ConteudoController@delete')
            ->where(['id' => '[0-9]+']);
        

        /**
         * Comentários
         */
        Route::get('/admin/comentarios', 'ComentarioController@index');

        /**
         * Páginas de SEO
         */
        Route::get('/admin/seo-site', 'TagSeoController@index');
        Route::get('/admin/paginas-seo', 'PaginaSeoController@index');
        Route::get('/admin/paginas-seo/add', 'PaginaSeoController@add');
        Route::post('/admin/paginas-seo/add', 'PaginaSeoController@postAdd');
        Route::get('/admin/paginas-seo/edit/{id}', 'PaginaSeoController@edit')
            ->where(['id' => '[0-9]+']);
        Route::post('/admin/paginas-seo/edit/{id}', 'PaginaSeoController@postEdit')
            ->where(['id' => '[0-9]+']);
        Route::get('/admin/paginas-seo/delete/{id}', 'PaginaSeoController@delete')
            ->where(['id' => '[0-9]+']);

        /**
         * Guia SEO
         */
        Route::get('/admin/seo-guia', 'SeoController@index');

        /**
         * Leads
         */
        Route::get('/admin/leads', 'LeadController@index');
    });

    Route::get('/admin/login', 'UsuarioController@login');
    Route::post('/admin/login', 'UsuarioController@postLogin');
    Route::get('/admin/logout', 'UsuarioController@logout');
    Route::get('/admin/reset', 'UsuarioController@reset_passwords');
    Route::post('/admin/email', 'UsuarioController@email');
    Route::get('/admin/reset/{token}', 'UsuarioController@reset');
    Route::post('/admin/reset', 'UsuarioController@reset_password');

    Route::post('/contato', 'FaleConoscoController@mail');

    Route::get('/{url}', 'TagSeoController@router');

    Route::get('/{categoria}/{post}', 'PostController@single');
    Route::post('/{categoria}/{post}', 'ComentarioController@add');
});




