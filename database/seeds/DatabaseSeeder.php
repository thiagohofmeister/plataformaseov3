<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);
        // DB::table('')->insert([]);
        
        DB::table('cargos')->insert([
            'descricao' => 'admin',
            'nivel' => 4
        ]);

        DB::table('tag_seos')->insert([
            'seo_title' => 'Title Default',
            'seo_description' => 'Description Default',
            'tema' => 'magodaweb',
            'base_url' => url('/')
        ]);
        
        DB::table('usuarios')->insert([
            'nome' => 'Thiago Hofmeister',
            'email' => 'thiago.hofmeister@gmail.com',
            'genero' => 'm',
            'password' => Hash::make('540120'),
            'id_cargo' => 1
        ]);
        
        DB::table('categorias')->insert([
            'nome' => 'Categoria de Teste',
            'slug' => 'categoria-de-teste',
            'descricao' => 'Sem descrição',
            'seo_title' => 'Categoria de Teste',
            'status' => 1
        ]);

        DB::table('categorias')->insert([
            'nome' => 'Categoria de Teste 2',
            'slug' => 'categoria-de-teste-2',
            'descricao' => 'Sem descrição',
            'seo_title' => 'Categoria de Teste 2',
            'status' => 1
        ]);
        
        DB::table('posts')->insert([
            'titulo' => 'Post de Teste',
            'slug' => 'post-de-teste',
            'conteudo' => 'Teste de conteudo da postagem',
            'seo_title' => 'Post de Teste',
            'possui_seo' => 1,
            'status' => 1,
            'id_usuario' => 1,
            'id_categoria' => 1
        ]);

        DB::table('posts')->insert([
            'titulo' => 'Post de Teste 2',
            'slug' => 'post-de-teste-2',
            'conteudo' => 'Teste de conteudo da postagem',
            'seo_title' => 'Post de Teste 2',
            'possui_seo' => 1,
            'status' => 1,
            'id_usuario' => 1,
            'id_categoria' => 2
        ]);

        DB::table('posts')->insert([
            'titulo' => 'Post de Teste 3',
            'slug' => 'post-de-teste-3',
            'conteudo' => 'Teste de conteudo da postagem',
            'seo_title' => 'Post de Teste 3',
            'possui_seo' => 1,
            'status' => 1,
            'id_usuario' => 1,
            'id_categoria' => 1
        ]);

        DB::table('posts')->insert([
            'titulo' => 'Post de Teste 4',
            'slug' => 'post-de-teste-4',
            'conteudo' => 'Teste de conteudo da postagem',
            'seo_title' => 'Post de Teste 4',
            'possui_seo' => 1,
            'status' => 1,
            'id_usuario' => 1,
            'id_categoria' => 1
        ]);

        DB::table('posts')->insert([
            'titulo' => 'Post de Teste 5',
            'slug' => 'post-de-teste-5',
            'conteudo' => 'Teste de conteudo da postagem',
            'seo_title' => 'Post de Teste 5',
            'possui_seo' => 1,
            'status' => 1,
            'id_usuario' => 1,
            'id_categoria' => 2
        ]);

        DB::table('tags')->insert([
            'nome' => 'Programação',
            'slug' => 'programacao'
        ]);

        DB::table('tags')->insert([
            'nome' => 'Seo',
            'slug' => 'seo'
        ]);

        DB::table('tags')->insert([
            'nome' => 'Novidades',
            'slug' => 'novidades'
        ]);

        DB::table('post_tags')->insert([
            'id_post' => 1,
            'id_tag' => 1
        ]);

        DB::table('post_tags')->insert([
            'id_post' => 1,
            'id_tag' => 2
        ]);

        DB::table('post_tags')->insert([
            'id_post' => 2,
            'id_tag' => 2
        ]);

        DB::table('post_tags')->insert([
            'id_post' => 3,
            'id_tag' => 3
        ]);

        DB::table('post_tags')->insert([
            'id_post' => 4,
            'id_tag' => 1
        ]);


        DB::table('post_tags')->insert([
            'id_post' => 4,
            'id_tag' => 2
        ]);

        DB::table('tipo_conteudos')->insert([
            'descricao' => 'Serviços',
            'slug' => 'servicos'
        ]);

        DB::table('conteudos')->insert([
            'imagem' => 'uploads/servicos/android-apps.png',
            'titulo' => 'Android Apps',
            'slug' => 'android-apps',
            'conteudo' => 'Desenvolvimento de aplicativos profissionais com custo x benefício jamais visto.',
            'id_tipo_conteudo' => 1
        ]);

        DB::table('conteudos')->insert([
            'imagem' => 'uploads/servicos/php.png',
            'titulo' => 'PHP',
            'slug' => 'php',
            'conteudo' => 'Desenvolvimento de websites e blogs para que seu negócio seja muito bem visto e acompanhado por seus clientes.',
            'id_tipo_conteudo' => 1
        ]);

        DB::table('conteudos')->insert([
            'imagem' => 'uploads/servicos/web-design.png',
            'titulo' => 'Web Design',
            'slug' => 'web-design',
            'conteudo' => 'Design moderno para deixar o seu site muito mais agradável para que o seu cliente se sinta a vontade sempre.',
            'id_tipo_conteudo' => 1
        ]);

        DB::table('pagina_seos')->insert([
            'url' => 'servicos',
            'seo_title' => 'Nossos Serviços'
        ]);

        DB::table('pagina_seos')->insert([
            'url' => 'blog',
            'seo_title' => 'Nosso Blog'
        ]);

        DB::table('pagina_seos')->insert([
            'url' => 'nossos-cursos',
            'seo_title' => 'Nossos Cursos'
        ]);

        DB::table('pagina_seos')->insert([
            'url' => 'contato',
            'seo_title' => 'Fale Conosco'
        ]);
    }
}
