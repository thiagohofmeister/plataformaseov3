<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Tabelas extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('cargos')) {
            Schema::create('cargos', function (Blueprint $table) {
                $table->increments('id');
                $table->string('descricao', 30);
                $table->smallInteger('nivel');
            });
        }

        if (!Schema::hasTable('usuarios')) {
            Schema::create('usuarios', function (Blueprint $table) {
                $table->increments('id');
                $table->string('imagem', 200)->default('public/images/sem-foto.jpg');
                $table->string('nome', 70);
                $table->string('email', 150);
                $table->char('genero', 1);
                $table->string('facebook', 120)->default('');
                $table->string('googleplus', 120)->default('');
                $table->string('twitter', 60)->default('');
                $table->string('password', 60);
                $table->integer('id_cargo')->unsigned();
                $table->foreign('id_cargo')->references('id')->on('cargos');
                $table->rememberToken();
            });
        }

        if (!Schema::hasTable('categorias')) {
            Schema::create('categorias', function (Blueprint $table) {
                $table->increments('id');
                $table->string('nome', 30);
                $table->string('slug', 50);
                $table->text('descricao')->nullable();
                $table->string('seo_title', 180)->nullable();
                $table->string('seo_description', 150)->nullable();
                $table->string('seo_spam_text', 180)->nullable();
                $table->string('seo_open_graph', 200)->nullable();
                $table->boolean('status')->default(1);
            });
        }

        if (!Schema::hasTable('posts')) {
            Schema::create('posts', function (Blueprint $table) {
                $table->increments('id');
                $table->string('titulo', 180);
                $table->string('imagem', 200)->default('public/images/sem-foto.jpg');
                $table->string('slug', 300);
                $table->string('migalha', 250)->nullable();
                $table->text('conteudo');
                $table->dateTime('data_postagem')->default(DB::raw('CURRENT_TIMESTAMP'));
                $table->string('seo_title', 180)->nullable();
                $table->string('seo_description', 150)->nullable();
                $table->string('seo_spam_text', 180)->nullable();
                $table->string('seo_open_graph', 200)->nullable();
                $table->boolean('possui_seo')->default(0);
                $table->boolean('status')->default(1);
                $table->integer('id_usuario')->unsigned();
                $table->integer('id_categoria')->unsigned();
                $table->foreign('id_usuario')->references('id')->on('usuarios');
                $table->foreign('id_categoria')->references('id')->on('categorias');
            });
        }

        if (!Schema::hasTable('tipo_conteudos')) {
            Schema::create('tipo_conteudos', function (Blueprint $table) {
                $table->increments('id');
                $table->string('descricao', 120);
                $table->string('slug', 140);
            });
        }

        if (!Schema::hasTable('conteudos')) {
            Schema::create('conteudos', function (Blueprint $table) {
                $table->increments('id');
                $table->string('imagem', 220);
                $table->string('titulo', 120);
                $table->string('slug', 140);
                $table->text('conteudo');
                $table->string('link', 255)->nullable();
                $table->integer('id_tipo_conteudo')->unsigned();
                $table->foreign('id_tipo_conteudo')->references('id')->on('tipo_conteudos');
            });
        }

        if (!Schema::hasTable('comentarios')) {
            Schema::create('comentarios', function (Blueprint $table) {
                $table->increments('id');
                $table->string('nome_autor', 80);
                $table->string('email', 150);
                $table->string('comentario_texto', 250);
                $table->char('status', 1)->default('n');
                $table->dateTime('data_comentario')->default(DB::raw('CURRENT_TIMESTAMP'));;
                $table->integer('id_comentario_parent')->unsigned()->nullable();
                $table->integer('id_post')->unsigned();
                $table->foreign('id_comentario_parent')->references('id')->on('comentarios');
                $table->foreign('id_post')->references('id')->on('posts');
            });
        }

        if (!Schema::hasTable('tags')) {
            Schema::create('tags', function (Blueprint $table) {
                $table->increments('id');
                $table->string('nome', 70);
                $table->string('slug', 120);
            });
        }

        if (!Schema::hasTable('post_tags')) {
            Schema::create('post_tags', function (Blueprint $table) {
                $table->increments('id');
                $table->integer('id_post')->unsigned();
                $table->integer('id_tag')->unsigned();
                $table->foreign('id_post')->references('id')->on('posts');
                $table->foreign('id_tag')->references('id')->on('tags');
                $table->unique(['id_post', 'id_tag']);
            });
        }

        if (!Schema::hasTable('pagina_seos')) {
            Schema::create('pagina_seos', function (Blueprint $table) {
                $table->increments('id');
                $table->string('url', 200);
                $table->string('seo_title', 180)->nullable();
                $table->string('seo_description', 150)->nullable();
                $table->string('seo_spam_text', 180)->nullable();
                $table->string('seo_open_graph', 200)->nullable();
                $table->unique('url');
            });
        }
        if (!Schema::hasTable('tag_seos')) {
            Schema::create('tag_seos', function (Blueprint $table) {
                $table->increments('id');
                $table->string('slogan', 120)->nullable();
                $table->string('seo_title', 180)->nullable();
                $table->string('seo_description', 180)->nullable();
                $table->string('seo_spam_text', 180)->nullable();
                $table->string('seo_open_graph', 180)->nullable();
                $table->string('tema', 100)->nullable();
                $table->string('email', 120)->nullable();
                $table->string('base_url', 200)->nullable();
                $table->string('facebook', 240)->nullable();
                $table->string('twitter', 100)->nullable();
                $table->string('googleplus', 240)->nullable();
                $table->string('youtube', 240)->nullable();
                $table->text('tags_head')->nullable();
                $table->text('tags_body')->nullable();
                $table->text('tags_foot')->nullable();
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('post_tags');
        Schema::dropIfExists('comentarios');
        Schema::dropIfExists('posts');
        Schema::dropIfExists('conteudos');
        Schema::dropIfExists('tipo_conteudos');
        Schema::dropIfExists('tags');
        Schema::dropIfExists('pagina_seos');
        Schema::dropIfExists('tag_seos');
        Schema::dropIfExists('usuarios');
        Schema::dropIfExists('cargos');
        Schema::dropIfExists('categorias');
    }
}
