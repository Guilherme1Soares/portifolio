@extends('layouts.site')

@section('title','TERMOS | Oeste - Comercial de Ferro e Aço Viga, chapa e produtos siderúrgicos')

@section('content')



<!-- style.css -->

<link rel="stylesheet" href="{{ URL::to('public/css/LGPD/style.css') }}">



<!-- BOOTSTRAP CSS -->

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.4.1/css/bootstrap.min.css">



<!-- JQUERY -->

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.js" integrity="sha512-WNLxfP/8cVYL9sj8Jnp6et0BkubLP31jhTG9vhL/F5uEZmg5wEzKoXp1kJslzPQWwPT1eyMiSxlKCgzHLOTOTQ==" crossorigin="anonymous"></script>



<style>

    .fixo{top:208px !important;}

    .privacy-terms-area{margin-top:50px !important;}

</style>



@if($success = Session::get('success'))

<div class="fixed-bottom">

    <div id="success" class="alert alert-success" style="text-align:center;">

        <ul>

            <li style="list-style: none;">{{ $success }}</li>

        </ul>

    </div>  

</div>



<script>

    setTimeout(function(){

      $('#success').fadeOut(2000);

    },5000);

</script>



@endif



@if($error = Session::get('error'))

<div class="fixed-bottom">

    <div id="success" class="alert alert-danger" style="text-align:center;">

        <ul>

            <li style="list-style: none;">{{ $error }}</li>

        </ul>

    </div>  

</div>



<script>

    setTimeout(function(){

      $('#success').fadeOut(2000);

    },5000);

</script>



@endif



@if($errors->any())

    <div class="fixed-bottom">

        <div id="error" class="alert alert-danger" style="text-align:center;">

            <ul>

                @foreach ($errors->all() as $error)

                    <li style="list-style: none;">{{ $error }}</li>

                 @endforeach

            </ul>

        </div>  

    </div>



    <script>

        setTimeout(function(){

          $('#error').fadeOut(2000);

        },3000);

    </script>



@endif

    <main>

        <div class="container-full">

            <div class="container-static">

                <div class="privacy-terms-area">

                    <aside>

                        <div class="aside-content">

                            <ul>

                                <li class="ativo" data-section="section_1"><a href="javascript:;">Política de privacidade</a></li>

                                <li data-section="section_2"><a href="javascript:;">Termos de uso</a></li>

                                <li data-section="section_3"><a href="javascript:;">Cookies</a></li>

                                <li data-section="section_4"><a href="javascript:;">Cancelar cadastro</a></li>

                            </ul>

                        </div>

                    </aside>

                    <section class="content-wrapper">

                        <article class="political-privacity section" id="section_1">

                            <h1>Política de privacidade</h1>

                            <div class="text-wrapper">

                                <p>A sua privacidade é importante para nós. É política da <strong>OESTEFER</strong> respeitar a sua privacidade em relação a qualquer informação sua que possamos coletar em nosso site e outros sites que possuímos e operamos.</p>

                                <p>Solicitamos informações pessoais apenas quando realmente precisamos delas para lhe fornecer um serviço. Fazemos por meios justos e legais, com o seu conhecimento e consentimento. Também informamos por que estamos coletando e como será usado.

                                <p>Apenas retemos as informações coletadas pelo tempo necessário para fornecer o serviço solicitado. Quando armazenamos dados, protegemos dentro de meios comercialmente aceitáveis para evitar perdas e roubos, bem como acesso, divulgação, cópia, uso ou modificação não autorizados.

                                <p>Não compartilhamos informações de identificação pessoal publicamente ou com terceiros, exceto quando exigido por lei.

                                <p>O nosso site pode ter links para sites externos que não são operados por nós. Esteja ciente de que não temos controle sobre o conteúdo e práticas desses sites e não podemos aceitar responsabilidade por suas respectivas políticas de privacidade.

                                <p>Você é livre para recusar a nossa solicitação de informações pessoais, entendendo que talvez não possamos fornecer alguns dos serviços desejados.

                                <p>O uso continuado de nosso site será considerado como aceitação de nossas práticas em torno de privacidade e informações pessoais. Se você tiver alguma dúvida sobre como lidamos com dados do usuário e informações pessoais, <a href="mailto:{{ Helper::getItem("email-client") }}">entre em contato conosco</a>.

                            </div>

                        </article>

                        <article class="termos-uso section" id="section_2">

                            <h1>Termos de uso</h1>

                            <div class="text-wrapper">

                                <h2>1. Termos</h2>

                                <p>Ao acessar ao site <strong>OESTEFER</strong>, concorda em cumprir estes termos de serviço, todas as leis e regulamentos aplicáveis e concorda que é responsável pelo cumprimento de todas as leis locais aplicáveis. Se você não concordar com algum desses termos, está proibido de usar ou acessar este site. Os materiais contidos neste site são protegidos pelas leis de direitos autorais e marcas comerciais aplicáveis.</p>

                                <br>

                                <h2>2. Uso de licença</h2>

                                <p>É concedida permissão para baixar temporariamente uma cópia dos materiais (informações ou software) no site <strong>OESTEFER</strong>, apenas para visualização transitória pessoal e não comercial. Esta é a concessão de uma licença, não uma transferência de título e, sob esta licença, você não pode:

                                    <ul>

                                        <li>Modificar ou copiar os materiais;</li>

                                        <li>Usar os materiais para qualquer finalidade comercial ou para exibição pública (comercial ou não comercial); </li>

                                        <li>Tentar descompilar ou fazer engenharia reversa de qualquer software contido no site <strong>OESTEFER</strong>;</li>

                                        <li>Remover quaisquer direitos autorais ou outras notações de propriedade dos materiais;</li>

                                        <li>Transferir os materiais para outra pessoa ou 'espelhe' os materiais em qualquer outro servidor.</li>

                                        <li>Esta licença será automaticamente rescindida se você violar alguma dessas restrições e a qualquer momento pela <strong>OESTEFER</strong>. Ao encerrar a visualização desses materiais ou após o término desta licença, você deve apagar todos os materiais baixados em sua posse, seja em formato eletrônico ou impresso.</li>

                                    </ul>

                                </p>

                                <br>

                                <h2>3. Isenção de responsabilidade</h2>

                                <p>Os materiais no site da <strong>OESTEFER</strong> são fornecidos 'como estão'. Nós não oferecemos garantias, expressas ou implícitas, e, por este meio, isenta e nega todas as outras garantias, incluindo, sem limitação, garantias implícitas ou condições de comercialização, adequação a um fim específico ou não violação de propriedade intelectual ou outra violação de direitos. Além disso, a <strong>OESTEFER</strong> não garante ou faz qualquer representação relativa à precisão, aos resultados prováveis ou à confiabilidade do uso dos materiais em seu site ou de outra forma relacionado a esses materiais ou em sites vinculados a este site.</p>

                                <br>

                                <h2>4. Limitações</h2>

                                <p>Em nenhum caso a <strong>OESTEFER</strong> ou seus fornecedores serão responsáveis por quaisquer danos (incluindo, sem limitação, danos por perda de dados ou lucro ou devido a interrupção dos negócios) decorrentes do uso ou da incapacidade de usar os materiais em <strong>OESTEFER</strong>, mesmo que a agência ou um representante autorizado tenha sido notificado oralmente ou por escrito da possibilidade de tais danos. Como algumas jurisdições não permitem limitações em garantias implícitas, ou limitações de responsabilidade por danos consequentes ou incidentais, essas limitações podem não se aplicar a você.</p>

                                <br>

                                <h2>5. Precisão dos materiais</h2>

                                <p>Os materiais exibidos no site da <strong>OESTEFER</strong> podem incluir erros técnicos, tipográficos ou fotográficos. Não garantimos que qualquer material em nosso site seja preciso, completo ou atual. Podemos fazer alterações nos materiais contidos em nosso site a qualquer momento, sem aviso prévio. No entanto, a <strong>OESTEFER</strong> não se compromete a atualizar os materiais.</p>

                                <br>

                                <h2>6. Links</h2>

                                <p>A <strong>OESTEFER</strong> não analisou todos os sites vinculados ao seu site e não é responsável pelo conteúdo de nenhum site vinculado. A inclusão de qualquer link não implica endosso por nós do site. O uso de qualquer site vinculado é por conta e risco do usuário.</p>

                                <br>

                                <h2>7. Modificações</h2>

                                <p>A <strong>OESTEFER</strong> pode revisar estes termos de serviço do site a qualquer momento, sem aviso prévio. Ao usar este site, você concorda em ficar vinculado à versão atual desses termos de serviço.</p>

                                <br>

                                <h2>8. Lei aplicável</h2>

                                <p>Estes termos e condições são regidos e interpretados de acordo com as leis da <strong>OESTEFER</strong> e você se submete irrevogavelmente à jurisdição exclusiva dos tribunais naquele estado ou localidade.</p>

                            </div>

                        </article>

                        <article class="cookies section" id="section_3">

                            <h1>Cookies</h1>

                            <div class="text-wrapper">

                                <h2>O que são cookies?</h2>

                                <p>Como é prática comum em quase todos os sites profissionais, este site usa cookies, que são pequenos arquivos baixados no seu computador para melhorar sua experiência. Esta página descreve quais informações eles coletam, como as usamos e por que às vezes precisamos armazenar esses cookies. Também compartilharemos como você pode impedir que esses cookies sejam armazenados, no entanto, isso pode fazer o downgrade ou 'quebrar' certos elementos da funcionalidade do site.</p>

                                <br>

                                <h2>Como usamos os cookies?</h2>

                                <p>Utilizamos cookies por vários motivos, detalhados abaixo. Infelizmente, na maioria dos casos, não existem opções padrão do setor para desativar os cookies sem desativar completamente a funcionalidade e os recursos que eles adicionam a este site. É recomendável que você deixe todos os cookies se não tiver certeza se precisa ou não deles, caso sejam usados para fornecer um serviço que você usa.</p>

                                <br>

                                <h2>Desativar cookies</h2>

                                <p>Você pode impedir a configuração de cookies ajustando as configurações do seu navegador (consulte a ajuda do navegador para saber como fazer isso). Esteja ciente de que a desativação de cookies afetará a funcionalidade deste e de muitos outros sites que você visita. A desativação de cookies geralmente resultará na desativação de determinadas funcionalidades e recursos deste site. Portanto, é recomendável que você não desative os cookies.</p>

                                <br>

                                <h2>Cookies que definimos</h2>

                                <br>

                                <p><strong>1. Cookies relacionados a boletins por e-mail ou whatsApp</strong></p>

                                <p>Este site oferece serviços de boletins informativos via e-mail ou whatsApp e os cookies podem ser usados para lembrar se você já está registrado e se deve mostrar determinadas notificações válidas apenas para usuários cadastrados/não cadastrados.</p>

                                <br>

                                <p><strong>2. Cookies relacionados a formulários</strong></p>

                                <p>Quando você envia dados por meio de um formulário como os encontrados nas páginas deste site, os cookies podem ser configurados para lembrar os detalhes do usuário para correspondência futura.</p>

                                <br>

                                <p><strong>3. Cookies de preferências do site</strong></p>

                                <p>Para proporcionar uma ótima experiência neste site, fornecemos a funcionalidade para definir suas preferências de como esse site é executado quando você o usa. Para lembrar suas preferências, precisamos definir cookies para que essas informações possam ser chamadas sempre que você interagir com uma página for afetada por suas preferências.</p>

                                <br>

                                <p><strong>4. Cookies de terceiros</strong></p>

                                <p>Em alguns casos especiais, também usamos cookies fornecidos por terceiros confiáveis. Por exemplo, este site usa o Google Analytics, que é uma das soluções de análise mais difundidas e confiáveis da Web para nos ajudar a entender como você usa o site e como podemos melhorar sua experiência. Esses cookies podem rastrear itens como quanto tempo você gasta no site e as páginas visitadas para que possamos continuar produzindo conteúdo atraente. Periodicamente, testamos novos recursos e fazemos alterações sutis na maneira como o site se apresenta. Quando ainda estamos testando novos recursos, esses cookies podem ser usados para garantir que você receba uma experiência consistente enquanto estiver no site, entendendo quais otimizações os nossos usuários mais apreciam. Para mais informações sobre cookies do Google Analytics, consulte a página oficial, <a href="https://developers.google.com/analytics/devguides/collection/analyticsjs/cookie-usage?hl=pt-br" title="Clique para mais informações">clicando aqui</a>.</p>

                                <br>

                                <p><strong>Compromisso do  usuário</strong></p>

                                <p>O usuário se compromete a fazer uso adequado dos conteúdos e da informação que a <strong>OESTEFER</strong> oferece no site e com caráter enunciativo, mas não limitativo:

                                    <br>

                                    <ol>

                                        <li style=" font-size: 16px; margin: 10px 0; font-family: var(--font-default); color: #464646;">Não se envolver em atividades que sejam ilegais ou contrárias à boa fé a à ordem pública;</li>

                                        <li style=" font-size: 16px; margin: 10px 0; font-family: var(--font-default); color: #464646;">Não divulgar conteúdo ou propaganda de natureza racista, xenofóbica, apostas desportivas, pornografia ilegal, de apologia ao terrorismo ou contra os direitos humanos;</li>

                                        <li style=" font-size: 16px; margin: 10px 0; font-family: var(--font-default); color: #464646;">Não causar danos aos sistemas físicos (hardwares) e lógicos (softwares) da <strong style=" font-size: 18px; margin: 10px 0; font-family: var(--font-default);">OESTEFER</strong style=" font-size: 18px; font-family: var(--font-default);">, de seus fornecedores ou terceiros para introduzir ou disseminar vírus informáticos ou quaisquer outros sistemas de hardware ou software que sejam capazes de causar danos anteriormente mencionados.</li>

                                    </ol>

                                </p>

                                <br>

                                <br>

                                <p><strong>Mais informações</strong></p>

                                <p>Esperemos que esteja esclarecido e, como mencionado anteriormente, se houver algo que você não tem certeza se precisa ou não, geralmente é mais seguro deixar os cookies ativados, caso interaja com um dos recursos que você usa em nosso site.</p>

                                <p><i>Última atualização destes termos de uso e política de privacidade foram em 18/01/2021.</i></p>

                            </div>

                        </article>

                        <article class="cancelar-inscricao section" id="section_4">

                            <h1>Cancelar cadastro</h1>

                            <p>Preencha os campos abaixo para cancelar o cadastro:</p>

                            <form action="{{ route("termos-submit") }}" method="post">

                                @csrf

                                <div class="row-privacy">

                                    <div class="nome">

                                        <label for="nome">Nome</label>

                                        <input placeholder="Nome" type="text" name="nome" id="nome">

                                    </div>

                                    <div class="whats">

                                        <label for="nome">WhatsApp</label>

                                        <input placeholder="(xx) xxxxx-xxxx" type="text" name="whatsapp" id="whatsapp"  maxlength="15">

                                    </div>

                                </div>

                                <div class="row-privacy">

                                    <div class="email">

                                        <label for="email">E-mail</label>

                                        <input placeholder="Endereço de e-mail" type="email" name="email" id="email">

                                    </div>

                                </div>

                                <div class="row-privacy">

                                    <div class="btn-area">

                                        <button type="submit" name="submit">enviar</button>

                                    </div>

                                </div>

                            </form>

                        </article>

                    </section>

                </div>

            </div>

        </div>

    </main><br><br><br>

    <div class="backToTop" id="top"></div>



        <!-- SCRIPTS AND LIBS JS -->

            <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.4.1/js/bootstrap.min.js.map"></script>

            <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.4.1/js/bootstrap.bundle.min.js"></script>

        <!-- END SCRIPTS AND LIBS JS -->


        <script src="{{ URL::to('public/js/LGPD/js.js') }}"></script>

     @endsection