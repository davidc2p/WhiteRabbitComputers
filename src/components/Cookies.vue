<template>
<div>
    <Wave id="Wave" :titles="titles" />

    <!-- linha sem nada -->
    <div class="row">
        <div class="col">&nbsp;</div>
    </div>

    <div class="row">
        <div class="col"><h3>Utilização de cookies</h3></div>
    </div>

    <div class="row">

        <div class="offset-1 col-10">
            <p>A configuração de uso de cookies para este website está definida como "cookies autorizados" para permitir a melhor experiencia de navegação. Se continuar a utilizar este website sem mudar a configuração do uso de cookies ou se fizer clique no botão "Percebi!" abaixo a direita, estará a consentir a utilizar esta confirguração.</p>
        </div>

    </div>


    <div class="row">

        <div class="offset-1 col-10">
            
            <h3>Que informação é recolhida?</h3>
            <p>Este website recolhe informação relativa à política de cookies exibida mais abaixo, e também armazena o seu endereço de e-mail quando subscreve a nossa newsletter. O seu endereço de e-mail é armazenado durante  tempo ilimitado, e ele é usado para fazer chegar a respetiva newsletter.</p>

            <p>Para remover o e-mail da newsletter deve enviar um e-mail para account[at]whiterabbitcomputers[dot]com, ou fazer unsubscribe num dos nossos e-mails. Será informado quando o seu e-mail for eliminado.</p>

            
            <h3>O que são cookies?</h3>
            <p>Este website usa cookies para recolher informações acerca da sua navegação. A “cookie” é uma pequena quantidade de texto armazenado pelo navegador no disco rígido do seu computador ou no dispositivo portátil. Elas são usadas para “lembrar” quando o seu computador ou dispositivo acede a este website. Quando você navega de uma página para outra, o nosso website diz-nos que você é o mesmo utilizador, embora não nos informe acerca da sua identidade. As cookies são essenciais para o funcionamento eficaz deste website.</p>

            <h3>Que tipos de cookies usamos?</h3>
            <p>Existem dois grupos de cookies que podem ser utilizados:</p>

            <p><strong>Cookies permanentes:</strong> são cookies que ficam armazenadas ao nível do browser nos seus equipamentos de acesso (PC, mobile e tablet) e que são utilizadas sempre que faz uma nova visita ao nosso website. São utilizadas, geralmente, para direcionar a navegação aos interesses do utilizador, permitindo-nos prestar um serviço mais personalizado.</p>

            <p><strong>Cookies de sessão:</strong> são cookies temporárias que permanecem no arquivo de cookies do seu browser até sair do website. A informação obtida por estas cookies serve para analisar padrões de tráfego na web, permitindo-nos identificar problemas e fornecer uma melhor experiencia de navegação.</p>

            <h3>Para que fins utilizamos cookies?</h3>
            <p>Cookies estritamente necessárias: Permitem que navegue no website e utilize as aplicações, bem como aceder a áreas seguras do website. Sem estas cookies, os serviços podem funcionar de forma deficiente.</p>

            <p>Cookies Analíticos: São utilizadas anonimamente para efeitos de criação e análise de estatísticas, no sentido de melhorar o funcionamento do website.</p>

            <p>Cookies de Funcionalidade: Guardam as preferências do utilizador relativamente à utilização do website, para que não seja necessário voltar a configurar o website cada vez que o visita.</p>

            <p>Cookies de Terceiros: Medem o sucesso de aplicações e a eficácia da publicidade de terceiros. Podem também ser utilizadas no sentido de personalizar um widget com dados do utilizador.</p>

            <p>Cookies de Publicidade: Direcionam a publicidade em função dos interesses de cada utilizador, por forma a direcionar as campanhas publicitárias tendo em conta os gostos dos utilizadores, sendo que, além disso, limitam a quantidade de vezes que vê o anúncio, ajudando a medir a eficácia da publicidade e o sucesso da organização do website.</p>

            <h3>Como pode gerir as cookies?</h3>
            <p>Todos os browsers permitem ao utilizador aceitar, recusar ou apagar cookies, nomeadamente através da seleção das definições apropriadas no respetivo navegador. Pode configurar as cookies no menu “opções” ou “preferências” do seu browser.</p>

            <p>Note-se, no entanto, que, ao desativar cookies, pode impedir que alguns serviços da web funcionem corretamente, afetando, parcial ou totalmente, a navegação no website.</p>

            <h3>Quem define as cookies?</h3>
            <p>As cookies são definidas por terceiros que participam no aprimoramento da experiência do utilizador no nosso website.</p>

            <h3>Outras cookies de terceiros</h3>
            <p>Em algumas páginas do www.whiterabbitcomputers.com, terceiros também podem definir as suas próprias cookies anónimas, com o objetivo de acompanhar o sucesso de  aplicação ou personalizá-la para você. Por causa de como os cookies funcionam, o www.seguranca-informatica.pt não pode aceder essas cookies, nem os terceiros podem aceder os dados das cookies usadas por: www.whiterabbitcomputers.com.</p>

            <p>Por exemplo, quando você partilha um artigo usando um botão de partilha de social media (ou seja, o Facebook), a rede social que criou o botão regista que você fez isso.</p>

            <h3>Como desabilitar o uso de cookies?</h3>
            <p>Se você deseja desativar as cookies, é necessário alterar as configurações do navegador do website para rejeitar as cookies. Como isso depende do navegador que você usa, fornecemos mais detalhes abaixo sobre como desativar as cookies para os navegadores mais populares.</p>

            <h3>O que acontece se desabilitar as cookies?</h3>
            <p>Isso depende de quais cookies você desabilita, mas, em geral, o website pode não funcionar corretamente se as cookies estiverem desligadas. Se você desabilitar todas as cookies, poderá navegar com alguns erros no nosso website.</p>

        </div>

    </div>
</div>
</template>

<script>
    //Components
    import Wave from './Wave.vue'

export default {
    name: 'Cookies',
     components: {
        Wave
    },
    head: {
        title: {
            inner: 'Venda de computadores desktop - Política de uso de cookies',
            separator: ' ',
            complement: ''
        },
        // Meta tags
        meta: [
            { name: 'application-name', content: 'WhiteRabbit Computers' },
            { name: 'description', content: 'Este website usa cookies para recolher informações acerca da sua navegação. ', id: 'desc' }
        ]
    }, 
    data: function() {
        return {
            titles: {
                head: 'Utilização de cookies',
                desc: 'Descrição da informação utilizada'
            },
            count: 1
        }
    },
    methods: {
        
    },
    watch: {

    },
    mounted: function() {
                
    } 
}
</script>