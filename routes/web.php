<?php

// Funções Globais
Route::group(['prefix' => ''], function() {
    createConstants();
});

// Index
Route::get('/', 'Site@index');

Route::get('/home', 'Home@index');
Route::get('/envia', 'App@envia');

Route::group(['middleware' => 'usuario'], function() {

    Route::group(['middleware' => 'usuario:usuario'], function() {
        // Perfil usuario
        Route::get('/admin', 'Usuario@index');

        /**
         * Páginas que apenas um usuário pode acessar
         */
        /**
         * Postagens
         */
        Route::get('/admin/posts', 'Post@index');
        Route::get('/admin/posts/edit/{id}', 'Post@edit')->where(['id' => '[0-9]+']);
        Route::post('/admin/posts/edit/{id}', 'Post@postEdit')
            ->where(['id' => '[0-9]+']);
        Route::get('/admin/posts/add', 'Post@add');
        Route::post('/admin/posts/add', 'Post@postAdd');
        Route::get('/admin/posts/rascunhos', 'Post@drafts');
        Route::post('/admin/posts/upload_arquivo', 'Post@uploadImage');
        Route::get('/admin/posts/delete/{id}', 'Post@delete')
            ->where(['id' => '[0-9]+']);

        /**
         * Categorias
         */
        Route::get('/admin/categorias', 'Categoria@index');
        Route::get('/admin/categorias/add', 'Categoria@add');
        Route::post('/admin/categorias/add', 'Categoria@postAdd');
        Route::get('/admin/categorias/edit/{id}', 'Categoria@edit')
            ->where(['id' => '[0-9]+']);
        Route::post('/admin/categorias/edit/{id}', 'Categoria@postEdit')
            ->where(['id' => '[0-9]+']);
        Route::get('/admin/categorias/delete/{id}', 'Categoria@delete')
            ->where(['id' => '[0-9]+']);
        Route::get('/admin/categorias/status/{id}', 'Categoria@status')
            ->where(['id' => '[0-9]+']);

        /**
         * Tags
         */
        Route::get('/admin/tags', 'PostTag@index');
        
        /**
         * Áreas de Conteúdo
         */
        Route::get('/admin/tipoconteudos', 'TipoConteudo@index');
        Route::get('/admin/tipoconteudos/add', 'TipoConteudo@add');
        Route::post('/admin/tipoconteudos/add', 'TipoConteudo@postAdd');
        Route::get('/admin/tipoconteudos/edit/{id}', 'TipoConteudo@edit')
            ->where(['id' => '[0-9]+']);
        Route::post('/admin/tipoconteudos/edit/{id}', 'TipoConteudo@postEdit')
            ->where(['id' => '[0-9]+']);
        Route::get('/admin/tipoconteudos/delete/{id}', 'TipoConteudo@delete')
            ->where(['id' => '[0-9]+']);

        /**
         * Conteúdos
         */
        Route::get('/admin/conteudos', 'Conteudo@index');
        Route::get('/admin/conteudos/add', 'Conteudo@add');
        Route::post('/admin/conteudos/add', 'Conteudo@postAdd');
        Route::get('/admin/conteudos/edit/{id}', 'Conteudo@edit')
            ->where(['id' => '[0-9]+']);
        Route::post('/admin/conteudos/edit/{id}', 'Conteudo@postEdit')
            ->where(['id' => '[0-9]+']);
        Route::get('/admin/conteudos/delete/{id}', 'Conteudo@delete')
            ->where(['id' => '[0-9]+']);
        

        /**
         * Comentários
         */
        Route::get('/admin/comentarios', 'Comentario@index');

        /**
         * Páginas de SEO
         */
        Route::get('/admin/seo-site', 'TagSeo@index');
        Route::get('/admin/paginas-seo', 'PaginaSeo@index');
        Route::get('/admin/paginas-seo/add', 'PaginaSeo@add');
        Route::post('/admin/paginas-seo/add', 'PaginaSeo@postAdd');
        Route::get('/admin/paginas-seo/edit/{id}', 'PaginaSeo@edit')
            ->where(['id' => '[0-9]+']);
        Route::post('/admin/paginas-seo/edit/{id}', 'PaginaSeo@postEdit')
            ->where(['id' => '[0-9]+']);
        Route::get('/admin/paginas-seo/delete/{id}', 'PaginaSeo@delete')
            ->where(['id' => '[0-9]+']);

        /**
         * Guia SEO
         */
        Route::get('/admin/seo-guia', 'Seo@index');

        /**
         * Leads
         */
        Route::get('/admin/leads', 'Lead@index');
    });

    Route::get('/admin/login', 'Usuario@login');
    Route::post('/admin/login', 'Usuario@postLogin');
    Route::get('/admin/logout', 'Usuario@logout');
    Route::get('/admin/reset', 'Usuario@reset_passwords');
    Route::post('/admin/email', 'Usuario@email');
    Route::get('/admin/reset/{token}', 'Usuario@reset');
    Route::post('/admin/reset', 'Usuario@reset_password');

    Route::post('/contato', 'FaleConosco@mail');

    Route::get('/{url}', 'Action\Config@router');

    Route::get('/{categoria}/{post}', 'Post@single');
    Route::post('/{categoria}/{post}', 'Comentario@add');
});




