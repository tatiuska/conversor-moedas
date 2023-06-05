<!-- Processamento da conversão de modedas escolhidas pelo usuário -->
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Conversão de Moedas</title>
    <!-- Link para carregamento do sytle.css -->
    <link rel="stylesheet" href="./css/style.css">
</head>
<body>
    <header>
        <h1>Resultado</h1>
    </header>
    <main>
        <div class="resultado">
            <?php 
                //Cotação da API do BC
                $inicio = date("m-d-Y", strtotime("-7 days")); //dia atual -7 dias
                $fim = date("m-d-Y"); //dia atual
                $moeda1 = $_POST["moeda1"]; //uso do método POST para pegar a primeira opção escolhida pelo usuário
                $moeda2 = $_POST["moeda2"]; //Uso do método POST para pegar a segunda opção escolhida pelo usuário

                //Switch/Case para opções de conversão do menu inicial
                switch ($moeda1) {
                    //Real
                    case '1':
                        //Switch/Case aninhado para as opções de moeda2
                        switch ($moeda2) {
                            //Dólar Americano
                            case '5':
                                $url = 'https://olinda.bcb.gov.br/olinda/servico/PTAX/versao/v1/odata/CotacaoMoedaPeriodo(moeda=@moeda,dataInicial=@dataInicial,dataFinalCotacao=@dataFinalCotacao)?@moeda=\'USD\'&@dataInicial=\''. $inicio .'\'&@dataFinalCotacao=\''. $fim .'\'&$top=1&$orderby=dataHoraCotacao%20desc&$format=json&$select=cotacaoCompra,dataHoraCotacao';

                                $dados = json_decode(file_get_contents($url), true);
            
                                $cotacao = $dados["value"][0]["cotacaoCompra"];
        
                                //Valor informado
                                $real = $_POST["valor"] ?? 0;
        
                                //Equivalência em Dólares Americanos
                                $dolar = $real / $cotacao;
        
                                //Mostrar o resultado - utlizando a biblioteca intl
                                $padrao = numfmt_create("pt-BR", NumberFormatter::CURRENCY);
                                echo "<p>Seus " . numfmt_format_currency($padrao, $real, "BRL") . " equivalem a <strong>" . numfmt_format_currency($padrao, $dolar, "USD") . "</strong></p>";
                            break;
                        
                            //Dólar Canadense
                            case '4':
                                $url = 'https://olinda.bcb.gov.br/olinda/servico/PTAX/versao/v1/odata/CotacaoMoedaPeriodo(moeda=@moeda,dataInicial=@dataInicial,dataFinalCotacao=@dataFinalCotacao)?@moeda=\'CAD\'&@dataInicial=\''. $inicio .'\'&@dataFinalCotacao=\''. $fim .'\'&$top=1&$orderby=dataHoraCotacao%20desc&$format=json&$select=cotacaoCompra,dataHoraCotacao';

                                $dados = json_decode(file_get_contents($url), true);
        
                                $cotacao = $dados["value"][0]["cotacaoCompra"];
    
                                //Valor informado
                                $real = $_POST["valor"] ?? 0;
    
                                //Equivalência em Dólares Canadenses
                                $dolarc = $real / $cotacao;
    
                                //Mostrar o resultado - utlizando a biblioteca intl
                                $padrao = numfmt_create("pt-BR", NumberFormatter::CURRENCY);
                                echo "<p>Seus " . numfmt_format_currency($padrao, $real, "BRL") . " equivalem a <strong>" . numfmt_format_currency($padrao, $dolarc, "CAD") . "</strong></p>";
                            break;
                        
                            //Euro
                            case '3':
                                $url = 'https://olinda.bcb.gov.br/olinda/servico/PTAX/versao/v1/odata/CotacaoMoedaPeriodo(moeda=@moeda,dataInicial=@dataInicial,dataFinalCotacao=@dataFinalCotacao)?@moeda=\'EUR\'&@dataInicial=\''. $inicio .'\'&@dataFinalCotacao=\''. $fim .'\'&$top=1&$orderby=dataHoraCotacao%20desc&$format=json&$select=cotacaoCompra,dataHoraCotacao';

                                $dados = json_decode(file_get_contents($url), true);
        
                                $cotacao = $dados["value"][0]["cotacaoCompra"];
    
                                //Valor informado
                                $real = $_POST["valor"] ?? 0;
    
                                //Equivalência em Euros
                                $euro = $real / $cotacao;
    
                                //Mostrar o resultado - utlizando a biblioteca intl
                                $padrao = numfmt_create("pt-BR", NumberFormatter::CURRENCY);
                                echo "<p>Seus " . numfmt_format_currency($padrao, $real, "BRL") . " equivalem a <strong>" . numfmt_format_currency($padrao, $euro, "EUR") . "</strong></p>";
                            break;

                            //Iene
                            case '2':
                                $url = 'https://olinda.bcb.gov.br/olinda/servico/PTAX/versao/v1/odata/CotacaoMoedaPeriodo(moeda=@moeda,dataInicial=@dataInicial,dataFinalCotacao=@dataFinalCotacao)?@moeda=\'JPY\'&@dataInicial=\''. $inicio .'\'&@dataFinalCotacao=\''. $fim .'\'&$top=1&$orderby=dataHoraCotacao%20desc&$format=json&$select=cotacaoCompra,dataHoraCotacao';

                                $dados = json_decode(file_get_contents($url), true);
    
                                $cotacao = $dados["value"][0]["cotacaoCompra"];

                                //Valor informado
                                $real = $_POST["valor"] ?? 0;

                                //Equivalência em Ienes
                                $iene = $real / $cotacao;

                                //Mostrar o resultado - utlizando a biblioteca intl
                                $padrao = numfmt_create("pt-BR", NumberFormatter::CURRENCY);
                                echo "<p>Seus " . numfmt_format_currency($padrao, $real, "BRL") . " equivalem a <strong>" . numfmt_format_currency($padrao, $iene, "JPY") . "</strong></p>";
                            break;
                        }
                    break;
                    
                    //Os outros casos ainda serão desenvolvidos.
                }
            ?>
            <button onclick="javascript:history.go(-1)"><< voltar</button>
        </div>
    </main>
</body>
</html>