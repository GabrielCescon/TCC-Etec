<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
    <meta name="viewport" content="width=device-width">
	<title>Termos de Uso</title>
	<link rel="stylesheet" href="css/estilo.css">
    <script type="text/javascript" src="js/funcoes.js"></script>
<?php
session_start();
require_once ('classes/usuario.class.php');
require_once ('classes/administrador.class.php');
?>
</head>
<body>
    <div class="bugfix-menu">
        <?php include "design/menu-half.php"; ?>
        <?php $menu=999; include "design/menu-full.php"; ?>
    </div>
    <div class="top-img">
        <div>TERMOS DE USO</div>
    </div>
    <div class="conteudo1">
        <p>Este site se destina a oferecer aos usuários da internet o atendimento psicológico online breve e pontual, voltado para a orientação ou aconselhamento psicológico, com no máximo 20 sessões, de acordo com a Resolução 011/2012 do Conselho Federal de Psicologia.<br><br>
        Cada sessão tem a duração de 50 minutos, e será agendada previamente, via formulário específico do site.</p>
        <h2>Política de Privacidade</h2>
        <p>Não nos responsabilizamos pela destinação que os usuários fazem das informações coletadas no presente site, bem como pelos danos e prejuízos de qualquer natureza que possam advir da utilização indevida destas informações. </p>
        <h2>Do Usuário</h2>
        <p>O atendimento à distância se destina a pessoas maiores de 18 anos, que necessitam de orientação e aconselhamento psicológico pontual e breve, visando suprir a necessidade circunstancial do paciente.<br>
        O atendimento às crianças, adolescentes e interditos realizados por meios tecnológicos de comunicação a distância deverá obedecer aos critérios do Estatuto da Criança e do Adolescente, ao Código de Ética da(o) psicóloga(o) e aos dispositivos legais cabíveis. Orientações à adolescentes precisam de prévia autorização por escrito dos pais ou responsáveis.<br><br>
        Constitui obrigação do usuário fornecer informações verdadeiras, precisas, atualizadas, e completas, no ato do seu eventual cadastramento para ter acesso ao serviço.
        </p>
        <h2>Informação</h2>
        <p>O atendimento online não deve em hipótese alguma violar o Código de Ética Profissional do Psicólogo.<br><br>
        A psicoterapia é um tratamento psicológico, que implica num processo de longo prazo, presencial, realizado em consultório, onde são trabalhados questões profundas do adoecimento psicológico. A psicoterapia não pode ser substituída pelo atendimento online em casos de persistência de sintomas emocionais. O atendimento Online é eficaz em casos de orientações e aconselhamentos pontuais. De acordo com a RESOLUÇÃO CFP Nº 012/2005, que regulamenta o atendimento psicoterapêutico e outros serviços psicológicos mediados por computador:<br><br>
        “São reconhecidos os serviços psicológicos mediados por computador, desde que não psicoterapêuticos, tais como orientação psicológica e afetivo-sexual, orientação profissional, orientação de aprendizagem e Psicologia escolar, orientação ergonômica, consultorias a empresas, reabilitação cognitiva, ideomotora e comunicativa, processos prévios de seleção de pessoal, utilização de testes psicológicos informatizados com avaliação favorável de acordo com Resolução CFP N° 002/03, utilização de softwares informativos e educativos com resposta automatizada, e outros, desde que pontuais e informativos e que não firam o disposto no Código de Ética Profissional do Psicólogo”.<br><br>
        O atendimento psicoterápico presencial deve ser procurado pelo paciente que perceber que suas necessidades emocionais não foram sanadas com o atendimento online.
        </p>
        <h2>Sigilo e código de ética</h2>
        <p>O Atendimento Online segue as mesmas regras e obrigações éticas e profissionais do atendimento tradicional em consultório, preservando o sigilo e o respeito pelo paciente. Sua identidade e informações são confidenciais. O profissional está obrigado a todas as leis estabelecidas no Código de Ética Profissional do Psicólogo ficando assim garantidos o sigilo, a qualidade, a ética, a responsabilidade e a segurança do serviço oferecido ao paciente. Perante a lei não haverá diferença entre os atendimentos prestados via online e os fornecidos no consultório. Diante desse fato, é de crucial importância que ambos, psicólogo e paciente, estejam guardados sob forte proteção virtual. Faz-se necessária a existência de anti-vírus, firewalls e sistemas operacionais atualizados. Não se recomenda o uso de computadores públicos. É de obrigação do paciente prover tais meios de segurança para o computador do qual ele, paciente, fará uso. Em si tratando de internet, vale lembrar que sempre haverá o risco de vulnerabilidade dos dados expostos, considerando que a internet não é um meio totalmente seguro. Para melhor preservar o sigilo dos atendimentos, além das recomendações já citadas, recomenda-se fazer a exclusão do histórico do Messenger, Skype, etc.</p>
        <h2>Do Pagamento</h2>
        <p>O pagamento deverá ser realizado via PagSeguro ou Depósito Bancário.</p>
    </div>
    <?php include "design/rodape.php" ?>
    