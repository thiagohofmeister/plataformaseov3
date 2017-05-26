<!DOCTYPE html>
<html lang="pt-br">
    <head>
        @if (!empty($Seo->tags_head))
            {!! $Seo->tags_head !!}
        @endif

        @if (!empty($Seo->meta_tags))
            @foreach ($Seo->meta_tags as $meta)
                {!! $meta !!}
            @endforeach
        @endif
        
        <!--[if lt IE 9]>
            <script src="../../_cdn/html5.js"></script>
         <![endif]-->
        <link href='https://fonts.googleapis.com/css?family=Montserrat' rel='stylesheet' type='text/css'>
        <link rel="stylesheet/less" href="{{ asset(ASSET . 'css/main.less?v=32') }}" type="text/css">
        <script src="//cdnjs.cloudflare.com/ajax/libs/less.js/2.5.3/less.min.js"></script>
    </head>
    <body>
        <header class="topo">
            <div class="center">
                <div class="logotipo">
                    <a href="{{ url('/') }}"></a>
                </div>

                <div class="menu">
                    <nav>
                        <ul>
                            <li><a href="{{ url('a-empresa') }}">Mago</a></li>
                            <li><a href="{{ url('servicos') }}">Serviços</a></li>
                            <?php /* ?><li><a href="{{ url('portfolio') }}">Portf?io</a></li><? */ ?>
                            <li><a href="{{ url('blog') }}">Blog</a></li>
                            <li><a href="{{ url('contato') }}">Contato</a></li>
                        </ul>
                    </nav>
                </div>
            </div>
        </header>
        
        @yield('conteudo')

        <footer class="rodape">
            <div class="center">
                <div class="esquerda">
                    <nav>
                        <ul>
                            <li><a href="{{ url('a-empresa') }}">Mago</a></li>
                            <li><a href="{{ url('servicos') }}">Serviços</a></li>
                            <?php /* ?><li><a href="{{ url('portfolio') }}">Portf?io</a></li><?php */ ?>
                            <li><a href="{{ url('blog') }}">Blog</a></li>
                            <li><a href="{{ url('contato') }}">Contato</a></li>
                        </ul>
                    </nav>

                    <span>&copy; 2015 - <?= date('Y'); ?> O Mago da Web. Todos os direitos reservados.</span>
                </div>

                <div class="direita">
                    <nav>
                        <ul>
                            @if (!empty($Seo->facebook))
                            <li><a href="https://facebook.com/{{ $Seo->facebook }}" target="_blank"><span class="ico-fb"></span></a></li>
                            @endif

                            <?php /* ?><li><a href="#"><span class="ico-linkedin" target="_blank"></span></a></li><?php */ ?>

                            @if (!empty($Seo->twitter))
                            <li><a href="https://twitter.com/{{ $Seo->twitter }}" target="_blank"><span class="ico-twitter"></span></a></li>
                            @endif

                            @if (!empty($Seo->youtube))
                            <li><a href="{{ $Seo->youtube }}" target="_blank"><span class="ico-youtube"></span></a></li>
                            @endif

                            @if (!empty($Seo->googleplus))
                            <li><a href="{{ $Seo->googleplus }}" target="_blank"><span class="ico-google-plus"></span></a></li>
                            @endif
                        </ul>
                    </nav>
                </div>

                <div class="clear"></div>

                <div class="texto">
                </div>
            </div>
        </footer>

        <!-- jQuery -->
        <script type="text/javascript" src="{{ asset(ASSET . 'bower_components/jquery/dist/jquery.min.js') }}"></script>
        <script type="text/javascript" src="{{ asset(ASSET . 'js/plugins/jquery.maskedinput.min.js') }}"></script>
        <script type="text/javascript" src="{{ asset(ASSET . 'js/geral.js') }}"></script>
        @yield('js')
        
        @if (!empty($Seo->tags_body))
            {!! $Seo->tags_body !!}
        @endif
    </body>
    @if (!empty($Seo->tags_foot))
       {!! $Seo->tags_foot !!}
    @endif
</html>