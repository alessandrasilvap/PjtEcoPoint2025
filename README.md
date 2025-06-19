Usuário cadastra um ponto e vai para o banco de dados, o que devo colocar no sql para aprovar:

		UPDATE pontos_coleta SET situacao = 'aprovado' WHERE id = 5;

O que devo colocar no sql para reprovar:

		UPDATE pontos_coleta SET situacao = 'reprovado' WHERE id = 5;

O que deve colocar no sql para adicionar uma pergunta: 

		INSERT INTO perguntas (texto) VALUES ('');

O que deve colocar no sql para adicionar perguntas:

		INSERT INTO alternativas (pergunta_id, texto, correta) VALUES
		(1, '', 0),
		(1, '', 0),
		(1, '', 1),
		(1, '', 0);





ecoPoint/DAO/conexao.php:

Este arquivo PHP é responsável por estabelecer e gerenciar a conexão com o banco de dados MySQL para a aplicação EcoPoint. Ele utiliza o padrão de design Singleton para garantir que exista apenas uma instância da conexão com o banco de dados em toda a aplicação, o que otimiza recursos e evita problemas de múltiplas conexões.

    • class Conexao{: Declara uma classe chamada Conexao. Esta classe encapsulará toda a lógica para a conexão com o banco de dados. 

    • private static $instancia;: Declara uma propriedade estática e privada chamada $instancia. 
          - private: Significa que $instancia só pode ser acessada de dentro da própria classe Conexao. Isso garante o encapsulamento. 
          - static: Significa que $instancia pertence à classe Conexao em si, e não a uma instância específica da classe. Existe apenas uma cópia de $instancia para todas as chamadas da classe. 
          Esta propriedade será usada para armazenar a única instância da conexão PDO (PHP Data Objects). 

    • private function __construct(){}: Declara um construtor privado.
      - private: Impede que a classe Conexao seja instanciada diretamente de fora da classe (por exemplo, com new Conexao()). Isso é crucial para o padrão Singleton, garantindo que a única forma de obter uma instância seja através do método getConexao(). 

    • public static function getConexao() {: Declara um método público e estático.
          - public: Permite que este método seja chamado de qualquer lugar na aplicação. 
          - static: Significa que você pode chamar este método diretamente da classe, sem precisar criar uma instância dela (ex: Conexao::getConexao()). Este é o ponto de entrada principal para obter a conexão com o banco de dados. 

    • if (!isset(self::$instancia)) {: Verifica se a $instancia da conexão já foi criada. 
          - $dbname = "ecopoint";: Nome do banco de dados ao qual a aplicação irá se conectar. 
          - $host = "localhost";: Endereço do servidor onde o banco de dados está rodando. localhost geralmente se refere ao próprio computador onde o script PHP está sendo executado. 
          $user = "root";: Nome de usuário para acessar o banco de dados. root é o usuário padrão sem senha em muitas instalações de desenvolvimento MySQL. 
          $senha = "";: Senha para o usuário do banco de dados. 


    • Bloco try...catch para Conexão PDO: 
          - try { ... }: Tenta executar o código dentro deste bloco. Se ocorrer um erro (uma exceção), o controle é passado para o bloco catch. 
          - self::$instancia = new PDO("mysql:dbname=" . $dbname . ";host=" . $host, $user, $senha);: Esta é a linha que efetivamente cria a conexão com o banco de dados usando a classe PDO. 
              - PDO (PHP Data Objects) é uma extensão do PHP que fornece uma interface leve e consistente para acessar bancos de dados. 
          - catch (Exception $e) { ... }: Captura qualquer Exception (erro) que possa ocorrer durante a tentativa de conexão. 
          - echo 'O Erro é: ' . $e;: Se a conexão falhar, este echo exibirá a mensagem de erro da exceção. Em um ambiente de produção, seria mais apropriado registrar o erro em um log, em vez de exibi-lo diretamente para o usuário, por segurança. 

    • return self::$instancia;: Retorna a instância da conexão PDO. Se a conexão foi criada neste if, ela será retornada. Se já existia, a instância existente é retornada. 


ecoPoint/DAO/pontoColetaDAO.php:

Este arquivo PHP define a classe PontoColeta, que atua como um Data Access Object (DAO) para a entidade "pontos de coleta" no seu banco de dados. O objetivo principal de um DAO é separar a lógica de acesso a dados da lógica de negócios, tornando o código mais organizado, modular e fácil de manter.
Esta classe contém métodos para realizar operações CRUD (Create, Read, Update, Delete) básicas, ou nesse caso, mais especificamente, para cadastrar novos pontos de coleta e verificar a duplicidade de um ponto de coleta antes do cadastro.

    • class PontoColeta {: Declara uma classe chamada PontoColeta. Esta classe encapsulará as operações relacionadas aos pontos de coleta no banco de dados. 

    • private $conn;: Declara uma propriedade privada chamada $conn. Esta propriedade armazenará a instância da conexão com o banco de dados (o objeto PDO) que será usada pelos métodos da classe para interagir com o DB. Ser private significa que só pode ser acessada de dentro da própria classe. 

    • public function __construct() {: Este é o construtor da classe PontoColeta. Ele é executado automaticamente sempre que um novo objeto PontoColeta é criado (ex: new PontoColeta()).
       
        ◦ $this->conn = Conexao::getConexao();: Dentro do construtor, esta linha é crucial. Ela obtém a instância da conexão com o banco de dados. 
          - Conexao::getConexao(): Chama o método estático getConexao() da classe Conexao (que analisamos anteriormente). Este método retorna a única instância da conexão PDO com o banco de dados, seguindo o padrão Singleton. 
              
    • public function cadastrar($dados) {: Declara um método público chamado cadastrar que recebe um array $dados como argumento. Este método é responsável por inserir um novo registro de ponto de coleta no banco de dados. 

        ◦ $sql = "INSERT INTO ... VALUES (...)";: Define a string SQL para a instrução INSERT. 
              - pontos_coleta: É o nome da tabela no banco de dados onde os pontos de coleta serão armazenados. 
              - As colunas listadas (e.g., usuario_id, nome, observacao, etc.) correspondem aos campos da tabela. 
              - :usuario_id, :nome, etc.: São placeholders nomeados. Esta é uma prática recomendada (e segura) ao usar PDO para evitar ataques de injeção SQL. Os valores reais serão ligados a esses placeholders posteriormente. 

        ◦ $stmt = $this->conn->prepare($sql);: Serve para preparar uma instrução SQL antes de executá-la no banco de dados, utilizando PDO (PHP Data Objects). 
          - prepare(): Prepara a instrução SQL para execução. Isso otimiza o desempenho para instruções que serão executadas várias vezes e, mais importante, ajuda a prevenir injeção SQL, permitindo que os valores sejam passados separadamente. 

        ◦ return $stmt->execute([...]);: Executa a instrução SQL preparada. 
          - O método execute() recebe um array associativo onde as chaves correspondem aos placeholders nomeados na instrução SQL (ex: ':usuario_id') e os valores correspondem aos dados a serem inseridos (ex: $dados['usuario_id']). 
              - O método execute() retorna true em caso de sucesso e false em caso de falha. Este valor booleano é retornado pelo método cadastrar. 

    • public function verificarDuplicidade($dados) {: Declara um método público chamado verificarDuplicidade que recebe um array $dados como argumento. Este método é usado para verificar se um ponto de coleta com o mesmo nome, CEP e número já existe no banco de dados. 

        ◦ $sql = "SELECT COUNT(*) FROM pontos_coleta WHERE nome = :nome AND cep = :cep AND numero = :numero";: Define a string SQL para contar o número de registros que correspondem ao nome, cep e numero fornecidos. 
              - COUNT(*): Retorna o número de linhas que satisfazem a condição WHERE. 

        ◦ $stmt->execute([...]);: Executa a consulta, ligando os valores dos dados aos placeholders.

        ◦ return $stmt->fetchColumn() > 0;: Retorna um valor booleano (true ou false). 
              - fetchColumn(): Recupera uma única coluna do próximo conjunto de resultados da consulta. Neste caso, ele pegará o resultado do COUNT(*). 
              - > 0: Se o COUNT(*) for maior que zero, significa que um registro duplicado foi encontrado, e o método retornará true. Caso contrário, retornará false. 


ecoPoint/DAO/quizDAO.php:

Este arquivo PHP define a classe Quiz, que atua como um Data Access Object (DAO) específico para gerenciar as perguntas e alternativas de um quiz, interagindo com o banco de dados. Seu objetivo é buscar perguntas aleatórias e suas respectivas alternativas para montar um quiz dinamicamente.

    • require_once(__DIR__ . '/conexao.php');: Esta linha é fundamental. Ela inclui (e exige) o arquivo conexao.php (que já analisamos) dentro deste script. O __DIR__ garante que o caminho seja absoluto, independentemente de onde este arquivo quizDAO.php seja executado, assegurando que a classe Conexao esteja disponível. 

    • class Quiz {: Declara a classe Quiz. 

    • private $conexao;: Declara uma propriedade privada $conexao, que armazenará a instância da conexão PDO com o banco de dados. 

    • public function __construct() {: O construtor da classe Quiz. 

    • $this->conexao = Conexao::getConexao();: Assim como nas classes DAO anteriores, o construtor obtém a instância da conexão PDO do banco de dados através do método estático getConexao() da classe Conexao. Isso garante que a classe Quiz tenha acesso ao banco de dados para realizar suas operações. 

    • Método buscarPerguntasQuiz este é o método principal da classe, responsável por buscar as perguntas e suas alternativas do banco de dados e formatá-las de uma maneira utilizável para a aplicação.
    • public function buscarPerguntasQuiz($limite = 5): Declara um método público que busca perguntas para o quiz. Ele aceita um parâmetro opcional $limite, que define o número máximo de perguntas a serem retornadas (o padrão é 5). 

    • $sqlPerguntas = "SELECT id FROM perguntas ORDER BY RAND() LIMIT :limite";: Esta consulta seleciona os ids de perguntas de forma aleatória (ORDER BY RAND()) e limita o número de resultados (LIMIT :limite). É uma técnica comum para obter um subconjunto aleatório de dados. 
      
        ◦ $stmtPerguntas = $this->conexao->prepare($sqlPerguntas);: Prepara a consulta SQL. 

        ◦ $stmtPerguntas->bindParam(':limite', $limite, PDO::PARAM_INT);: Liga o valor da variável $limite ao placeholder :limite na consulta. PDO::PARAM_INT indica que o valor é um inteiro, o que é importante para segurança e tipo correto. 

        ◦ $stmtPerguntas->execute();: Executa a consulta. 

        ◦ $idsPerguntas = $stmtPerguntas->fetchAll(PDO::FETCH_COLUMN);: Recupera todos os IDs das perguntas selecionadas. PDO::FETCH_COLUMN garante que você obtenha um array simples contendo apenas os valores da primeira coluna (que são os IDs). 

        ◦ if (empty($idsPerguntas)) { return []; }: Se nenhum ID de pergunta for encontrado (ou seja, a tabela perguntas está vazia ou o limite resultou em zero), o método retorna um array vazio, evitando erros posteriores. 
       
        ◦ $idsString = implode(',', array_fill(0, count($idsPerguntas), '?'));: Esta linha cria uma string de placeholders (?, ?, ?...) para ser usada na cláusula IN da próxima consulta. array_fill cria um array com ? repetidos, e implode os une com vírgulas. 
          
            ▪ $sql = "SELECT ... FROM perguntas p JOIN alternativas a ON p.id = a.pergunta_id WHERE p.id IN ({$idsString}) ORDER BY FIELD(p.id, " . implode(',', $idsPerguntas) . ")";: Esta é uma consulta JOIN que conecta as tabelas perguntas (p) e alternativas (a) para buscar todos os dados necessários. 
                  - SELECT p.id AS pergunta_id, p.texto AS pergunta_texto, a.id AS alternativa_id, a.texto AS alternativa_texto, a.correta: Seleciona as colunas relevantes das duas tabelas, usando aliases (AS) para renomeá-las para maior clareza nos resultados. 
                  - JOIN alternativas a ON p.id = a.pergunta_id: Junta as tabelas onde o id da pergunta corresponde ao pergunta_id na tabela de alternativas. 
                  - WHERE p.id IN ({$idsString}): Filtra os resultados para incluir apenas as perguntas cujos IDs foram selecionados aleatoriamente na primeira consulta. O uso de {$idsString} (interpolação de string) aqui é aceitável porque os placeholders ? serão preenchidos de forma segura com bindValue.
                  - ORDER BY FIELD(p.id, " . implode(',', $idsPerguntas) . "): Esta cláusula é inteligente! Ela garante que as perguntas retornadas mantenham a ordem aleatória original definida pelo ORDER BY RAND() na primeira consulta, em vez de serem ordenadas pelo ID padrão do banco de dados. Isso é feito listando os IDs na ordem desejada. 

        ◦ $stmt = $this->conexao->prepare($sql);: Prepara a segunda consulta SQL. 
          
            ▪ foreach ($idsPerguntas as $k => $id) { $stmt->bindValue(($k+1), $id, PDO::PARAM_INT); }: Itera sobre o array de IDs e liga cada ID aos placeholders ? na instrução SQL. Isso é crucial para a segurança, prevenindo injeção SQL, mesmo que os IDs sejam inteiros. ($k+1) é usado porque bindValue espera parâmetros baseados em 1 (ou seja, 1 para o primeiro ?, 2 para o segundo, e assim por diante). 

        ◦ $stmt->execute();: Executa a segunda consulta. 

        ◦ $resultados = $stmt->fetchAll(PDO::FETCH_ASSOC);: Recupera todos os resultados da consulta como um array de arrays associativos (onde as chaves são os nomes das colunas). 

        ◦ $perguntasFormatadas = [];: Inicializa um array vazio que armazenará as perguntas e suas alternativas em um formato mais estruturado, ideal para ser consumido por uma aplicação.

        ◦ foreach ($resultados as $row) { ... }: Itera sobre cada linha de resultado obtida do banco de dados.
           
        ◦ $perguntaId = $row['pergunta_id'];: Obtém o ID da pergunta da linha atual. 

        ◦ if (!isset($perguntasFormatadas[$perguntaId])) { ... }: Verifica se esta pergunta já foi adicionada ao array $perguntasFormatadas. Se não foi, ela é adicionada como um novo item, com o question (texto da pergunta) e um array answers vazio. A chave é o perguntaId, o que permite agrupar todas as alternativas da mesma pergunta. 

        ◦ $perguntasFormatadas[$perguntaId]['answers'][] = [ ... ];: Adiciona a alternativa atual ao array answers da pergunta correspondente. 

            ▪ 'text' => $row['alternativa_texto']: O texto da alternativa. 

            ▪ 'correct' => (bool)$row['correta']: Converte o valor de correta (que provavelmente é 0 ou 1 no banco de dados) para um booleano (false ou true), que é mais semanticamente correto para uma aplicação. 
        
        ◦ return array_values($perguntasFormatadas);: Antes de retornar, array_values() é usado para "reindexar" o array $perguntasFormatadas. Ele remove as chaves associativas (os pergunta_ids) e retorna um array numérico sequencial de objetos de pergunta, o que é um formato mais limpo e comum para listas de dados em muitas aplicações. 


ecoPoint/DAO/tokenRecuperacaoDAO.php:

Este arquivo PHP define a classe TokenRecuperacaoDAO, que funciona como um Data Access Object (DAO) dedicado a gerenciar os tokens de recuperação de senha no banco de dados. Ele é essencial para a funcionalidade de "esqueci minha senha", permitindo que a aplicação salve, busque e marque como usados os tokens temporários gerados para os usuários.

    • require_once(__DIR__ . '/conexao.php');: Inclui o arquivo conexao.php (que fornece a conexão com o banco de dados) para que a classe TokenRecuperacaoDAO possa utilizá-lo. 

    • class TokenRecuperacaoDAO {: Declara a classe TokenRecuperacaoDAO. 

    • private $conn;: Declara uma propriedade privada $conn, que armazenará a instância da conexão PDO com o banco de dados. 

    • public function __construct() {: O construtor da classe. 

    • $this->conn = Conexao::getConexao();: Dentro do construtor, ele obtém a instância da conexão PDO do banco de dados através do método estático getConexao() da classe Conexao. Isso garante que esta classe DAO tenha acesso ao banco de dados para todas as suas operações. 

    • public function salvar($usuarioId, $email, $token, $expiracao) {: Este método é responsável por salvar um novo token de recuperação no banco de dados. Ele recebe o ID do usuário, o email associado, o próprio token gerado e a data/hora de expiração do token. 

    • try { ... } catch (PDOException $e) { ... }: Um bloco try-catch é usado para lidar com possíveis erros (exceções) que podem ocorrer durante a interação com o banco de dados. 

        ◦ $stmt = $this->conn->prepare("INSERT INTO tokens_recuperacao (usuario_id, email, token, expiracao) VALUES (?, ?, ?, ?)");: Prepara uma instrução SQL INSERT para a tabela tokens_recuperacao. Note o uso de placeholders posicionais (?), uma prática segura para evitar injeção SQL.
           
        ◦ $stmt->execute([$usuarioId, $email, $token, $expiracao]);: Executa a instrução SQL preparada, passando os valores como um array. O PDO automaticamente os liga aos placeholders na ordem em que aparecem. 

        ◦ die("Erro ao salvar o token: " . $e->getMessage());: Se ocorrer uma PDOException (erro de banco de dados), o script é encerrado (die()) e uma mensagem de erro é exibida. 
      
    • public function buscarPorToken($token) {: Este método busca um token de recuperação no banco de dados pelo seu valor. 

    • SELECT * FROM tokens_recuperacao WHERE token = ? AND expiracao >= NOW() AND usado = 0: A consulta SQL busca todas as colunas de um token que corresponda ao valor fornecido (token = ?). Além disso, ela inclui duas condições cruciais para a segurança e validade do token: 
          - expiracao >= NOW(): Garante que o token ainda não expirou (a data de expiração deve ser maior ou igual à data e hora atuais do servidor). 
          - usado = 0: Garante que o token ainda não foi utilizado. 

    • $stmt->execute([$token]);: Executa a consulta, passando o valor do token. 

    • return $stmt->fetch(PDO::FETCH_ASSOC);: Recupera a primeira linha de resultado da consulta como um array associativo. Se nenhum token válido for encontrado, ele retornará false. 

    • public function marcarComoUsado($token) {: Este método é chamado após um token de recuperação ter sido usado com sucesso para redefinir uma senha. 

    • UPDATE tokens_recuperacao SET usado = 1 WHERE token = ?: A instrução SQL UPDATE define a coluna usado para 1 (verdadeiro) para o token específico. Isso impede que o mesmo token seja reutilizado. 

    • $stmt->execute([$token]);: Executa a atualização, passando o valor do token. 

    • O bloco try-catch novamente lida com possíveis erros durante a atualização. 

A classe TokenRecuperacaoDAO é um componente vital para a funcionalidade de recuperação de senha da sua aplicação EcoPoint. Ela gerencia o ciclo de vida dos tokens de recuperação.


ecoPoint/DAO/usuarioDAO.php:

Este arquivo PHP define a classe UsuarioDAO, que serve como um Data Access Object (DAO) para a entidade Usuario (usuário) no seu banco de dados. Sua principal função é encapsular todas as operações de banco de dados relacionadas a usuários, como inserção, busca (por login, CPF, email, ID) e atualização (de senha, nome/email).

    • require_once(__DIR__ . '/conexao.php');: Inclui o arquivo conexao.php, garantindo que a classe Conexao esteja disponível para estabelecer a conexão com o banco de dados. 

    • class UsuarioDAO {: Declara a classe UsuarioDAO. 

    • private $conn;: Declara uma propriedade privada $conn que armazenará a instância da conexão PDO com o banco de dados. 

    • public function __construct() {: O construtor da classe UsuarioDAO. 

    • $this->conn = Conexao::getConexao();: Obtém a instância da conexão PDO do banco de dados utilizando o método estático getConexao() da classe Conexao. Isso faz com que a conexão esteja disponível para todos os métodos desta classe. 

    • public function inserir(Usuario $usuario) {: Este método insere um novo usuário na tabela usuario. Ele recebe um objeto do tipo Usuario (presume-se que existe uma classe Usuario que contém os dados do usuário e métodos get para acessá-los). 

    • $sql = "INSERT INTO ... VALUES (?, ?, ?, ...)";: Define a instrução SQL INSERT. Note o uso de placeholders posicionais (?) para cada valor a ser inserido. Isso é fundamental para a segurança, prevenindo injeção de SQL. 

    • $stmt = $this->conn->prepare($sql);: Prepara a instrução SQL para execução.
       
    • $senhaHash = password_hash($usuario->getSenha(), PASSWORD_DEFAULT);: Muito importante para segurança! Antes de inserir a senha no banco de dados, ela é transformada em um hash seguro usando password_hash(). PASSWORD_DEFAULT usa o algoritmo de hash mais forte disponível e recomendado pelo PHP. Isso significa que a senha original do usuário nunca é armazenada em texto puro, protegendo-a contra vazamentos. 

    • return $stmt->execute([...]);: Executa a instrução SQL preparada, passando um array com os valores obtidos do objeto $usuario (incluindo a senha já em hash). Os valores são ligados aos placeholders ? na ordem em que aparecem. O método retorna true em caso de sucesso e false em caso de falha. 

    • public function buscarPorLogin($login) {: Este método busca um usuário no banco de dados pelo seu login. 

    • $sql = "SELECT * FROM usuario WHERE login = :login";: Utiliza um placeholder nomeado (:login). 

    • $stmt = $this->conn->prepare($sql);: Prepara a consulta SQL. 

    • $stmt->bindParam(':login', $login);: Liga o valor da variável $login ao placeholder :login. Este é outro método seguro para passar dados para consultas, evitando injeção de SQL. 

    • $stmt->execute();: Executa a consulta. 

    • return $stmt->fetch(PDO::FETCH_ASSOC);: Recupera a primeira linha de resultado da consulta como um array associativo (onde as chaves são os nomes das colunas). Se nenhum usuário for encontrado, ele retornará false. 

    • public function buscarPorCPF($cpf) {: Semelhante a buscarPorLogin, este método busca um usuário pelo seu CPF. A lógica de preparação, binding e execução é a mesma, utilizando placeholders nomeados para segurança. 

    • public function buscarPorEmail($email) {: Busca um usuário pelo seu email. 

    • $sql = "SELECT * FROM usuario WHERE email = ?";: A consulta usa um placeholder posicional (?). 

    • $stmt->execute([$email]);: A execução passa o $email como um array para um placeholder posicional, o que funciona corretamente e preenche o ?. 

    • O bloco try-catch lida com possíveis PDOExceptions. 

    • public function atualizarSenha($usuarioId, $novaSenhaHash) {: Atualiza a senha de um usuário específico. 

    • $sql = "UPDATE usuario SET senha = ? WHERE id = ?";: A instrução UPDATE define a nova senha para o usuário cujo id corresponde ao $usuarioId. 

    • $stmt->execute([$novaSenhaHash, $usuarioId]);: Executa a atualização. É crucial que $novaSenhaHash já seja o hash da senha (e não a senha em texto puro) antes de ser passada para este método, o que a funcionalidade de recuperação de senha ou a lógica de alteração de senha do usuário deveriam garantir.
       
    • O bloco try-catch lida com erros de banco de dados. 

    • public function buscarPorId($id) {: Um método padrão para buscar um usuário pelo seu ID. A lógica é a mesma dos outros métodos de busca, usando placeholder nomeado. 

    • public function atualizarNomeEmail($usuarioId, $login, $email) {: Atualiza o login e o email de um usuário. 

    • $sql = "UPDATE usuario SET login = ?, email = ? WHERE id = ?";: Atualiza as colunas login e email para o usuário com o id fornecido. 

    • return $stmt->execute([$login, $email, $usuarioId]);: Executa a atualização, passando os novos valores e o ID. 

    • public function excluirConta($id) {: Exclui um usuário do banco de dados com base no seu ID. 

    • $sql = "DELETE FROM usuario WHERE id = :id";: A instrução DELETE remove a linha correspondente ao ID fornecido. 

    • $stmt->bindParam(':id', $id, PDO::PARAM_INT);: Liga o ID ao placeholder, especificando PDO::PARAM_INT para garantir que o ID seja tratado como um inteiro, o que é uma boa prática de segurança e tipo. 

    • if ($stmt->execute()) { return true; } else { return false; }: Executa a exclusão e retorna true se a operação foi bem-sucedida, false caso contrário. 

A classe UsuarioDAO é um componente central para o gerenciamento de usuários na aplicação EcoPoint. Ela fornece uma camada de abstração para todas as interações com a tabela usuario no banco de dados, garantindo que as operações sejam seguras, organizadas e abrangentes.


ecoPoint/api/pontosAprovados.php:

Este arquivo PHP atua como um endpoint de API (Application Programming Interface). Sua função principal é fornecer uma lista de pontos de coleta que foram aprovados no sistema, retornando esses dados em formato JSON (JavaScript Object Notation). Isso é comumente usado para que aplicações de frontend (como JavaScript no navegador ou aplicativos móveis) possam consumir esses dados e exibi-los em um mapa ou lista.

    • require_once '../DAO/conexao.php';: Inclui o arquivo conexao.php. O ../ indica que o arquivo conexao.php está um nível acima no diretório, dentro da pasta DAO. Isso garante que a classe Conexao esteja disponível para estabelecer a conexão com o banco de dados.
       
    • $pdo = Conexao::getConexao();: Obtém a instância da conexão PDO com o banco de dados, utilizando o método estático getConexao() da classe Conexao. A variável $pdo agora contém o objeto de conexão, pronto para interagir com o DB.

    • $stmt = $pdo->query("SELECT nome, latitude, longitude FROM pontos_coleta WHERE situacao = 'aprovado'");: Executa uma consulta SQL para selecionar dados específicos da tabela pontos_coleta. 
          - SELECT nome, latitude, longitude: Seleciona apenas as colunas nome, latitude e longitude. É uma boa prática selecionar apenas as colunas necessárias para otimização. 
          - FROM pontos_coleta: Indica a tabela de onde os dados serão buscados. 
          -WHERE situacao = 'aprovado': Filtra os resultados para incluir apenas os pontos de coleta que têm a coluna situacao definida como 'aprovado'. Isso é crucial para exibir apenas os pontos validados pelo sistema. 
          - $pdo->query(...): Para consultas SELECT simples que não contêm dados variáveis (como WHERE nome = ?), o método query() pode ser usado diretamente. Se houvesse variáveis na cláusula WHERE, o uso de prepare() e execute() seria mais seguro (como vimos nos DAOs).

        ◦  $pontos = $stmt->fetchAll(PDO::FETCH_ASSOC);: Recupera todos os resultados da consulta. 
          - fetchAll(): Retorna um array contendo todas as linhas do conjunto de resultados.
          - PDO::FETCH_ASSOC: Garante que cada linha seja retornada como um array associativo, onde as chaves são os nomes das colunas (e.g., ['nome' => 'EcoPonto Central', 'latitude' => -23.5505, 'longitude' => -46.6333]). 

        ◦ header('Content-Type: application/json');: Esta linha define o cabeçalho HTTP Content-Type da resposta. Isso informa ao navegador (ou a qualquer cliente que esteja fazendo a requisição) que o conteúdo que está sendo enviado é do tipo JSON. Isso é fundamental para que o cliente saiba como interpretar os dados recebidos. 

        ◦ echo json_encode($pontos);: Converte o array $pontos (que contém os dados dos pontos de coleta) em uma string no formato JSON e a imprime na saída. Essa string JSON é o corpo da resposta da API.


ecoPoint/app/controllers/CadastroController.php:

Este arquivo PHP define a classe CadastroController, que é uma parte fundamental da arquitetura MVC (Model-View-Controller) da aplicação. Como um controlador, sua responsabilidade principal é intermediar a interação entre o usuário (através do formulário de cadastro), os modelos de dados (Usuario) e as operações de banco de dados (UsuarioDAO), além de gerenciar a exibição das views.
Ele lida com a lógica de exibição do formulário de cadastro e, mais importante, com o processamento e validação dos dados enviados pelo usuário para o registro.
    • require_once __DIR__ . '/../models/usuario.php';: Inclui o arquivo que define a classe Usuario (o modelo). Esta classe deve conter a estrutura dos dados de um usuário e métodos set e get para manipular esses dados. 

    • require_once __DIR__ . '/../../DAO/usuarioDAO.php';: Inclui o arquivo que define a classe UsuarioDAO (o Data Access Object). Esta classe é responsável por todas as interações com o banco de dados relacionadas aos usuários. 

    • class CadastroController extends Controller {: Declara a classe CadastroController. A extensão extends Controller indica que esta classe herda funcionalidades de uma classe Controller base (presume-se que ela exista e forneça métodos comuns, como view() para carregar views). 

    • public function index() {: Este método é o ponto de entrada quando se deseja exibir o formulário de cadastro. 

    • $this->view('cadastro/index');: Chama um método view() (herdado da classe Controller base) para carregar e exibir o arquivo de template (view) localizado em cadastro/index. Este é o formulário HTML que o usuário preenche para se cadastrar. 

Método salvar() este é o método principal que lida com a submissão dos dados do formulário de cadastro.
        ◦ if ($_SERVER['REQUEST_METHOD'] === 'POST') {: Verifica se a requisição HTTP foi feita usando o método POST. Isso é essencial, pois os dados do formulário de cadastro geralmente são enviados via POST para segurança. 

        ◦ $dados = [ ... ];: Coleta todos os dados enviados pelo formulário (disponíveis no array global $_POST) e os armazena em um array $dados. 

        ◦ strip_tags($_POST['campo']): Para cada campo, a função strip_tags() é usada. Esta é uma medida de segurança inicial que remove todas as tags HTML e PHP de uma string. Isso ajuda a prevenir ataques de XSS (Cross-Site Scripting), onde um usuário mal-intencionado pode tentar injetar código HTML ou JavaScript. 
        ◦ Validações: O controlador realiza uma série de validações nos dados de entrada para garantir sua integridade e segurança antes de tentar inseri-los no banco de dados.
      - Validação de Nome: Usa uma expressão regular (preg_match) para verificar se o nome contém apenas letras (incluindo caracteres acentuados \p{L} com o modificador u para UTF-8) e espaços. Se inválido, exibe um alerta e retorna o usuário à página anterior. 
      - Validação de Idade Mínima: Calcula a idade do usuário a partir da data de nascimento fornecida. Se for menor que 10 anos, exibe um alerta e impede o cadastro. 
      - Validação de Comprimento do Login: Verifica se o login tem pelo menos 6 caracteres. 
      - Validação de Comprimento da Senha: Garante que a senha tenha pelo menos 8 caracteres para maior segurança. 
      - Validação de Confirmação de Senha: Compara a senha digitada com o campo de confirmação de senha para garantir que sejam idênticas. 
      - Validação de Número do Endereço: Verifica se o campo numero é um valor numérico. 
      - Validação de Telefone: Primeiro, remove todos os caracteres não numéricos do telefone. Depois, usa uma expressão regular para verificar se o telefone limpo possui 10 ou 11 dígitos (DDD + número). 
      - Validação de E-mail: Utiliza a função filter_var() com FILTER_VALIDATE_EMAIL, que é uma forma robusta e recomendada pelo PHP para validar o formato de um endereço de e-mail. 
      - Validação de CPF: Chama um método privado validarCPF (detalhado abaixo) para realizar uma validação mais complexa do número de CPF, incluindo os dígitos verificadores. 
      
    • Verificação de Duplicidade de CPF: 
           - Cria uma instância de UsuarioDAO. 
           - Chama o método buscarPorCPF() da UsuarioDAO para verificar se já existe um usuário com o CPF fornecido no banco de dados. 
           - Se um usuário com o mesmo CPF for encontrado ($usuarioExistente for verdadeiro), exibe um alerta de que o CPF já está cadastrado e impede o prosseguimento. 

    •  $usuario = new Usuario();: Cria uma nova instância do objeto Usuario.

    • $usuario->setDados($dados);: Passa o array $dados para o objeto Usuario. Presume-se que o método setDados() na classe Usuario é responsável por preencher as propriedades do objeto com base neste array. 

    • if ($usuarioDAO->inserir($usuario)) { ... }: Tenta inserir o novo objeto Usuario no banco de dados, chamando o método inserir() da UsuarioDAO. Se a inserção for bem-sucedida, exibe uma mensagem de sucesso e redireciona o usuário para a página de login (/ecoPoint/login) usando JavaScript. exit garante que nenhum outro código seja executado. Se a inserção falhar (o método inserir() retorna false), exibe uma mensagem de erro genérica. 

    • private function validarDados($dados) {: Este método é privado, sugerindo que ele deveria ser um utilitário interno para validação. 

    • Loop de Validação de Vazio: O primeiro foreach itera sobre os $dados e verifica se algum campo está vazio usando empty(). Se um campo vazio for encontrado, ele retorna uma string de erro. 

    • private function validarCPF($cpf) {: Este método implementa o algoritmo de validação para verificar a autenticidade de um número de CPF. 

    • $cpf = preg_replace('/[^0-9]/', '', $cpf); remove qualquer caractere que não seja dígito (pontos, traços) do CPF, deixando apenas os números. 

        ◦ strlen($cpf) != 11: Verifica se o CPF possui exatamente 11 dígitos. 

        ◦ preg_match('/(\d)\1{10}/', $cpf): Verifica se o CPF tem todos os dígitos iguais (ex: "111.111.111-11"), que são considerados inválidos no algoritmo de validação. 

        ◦ Se qualquer uma dessas condições for verdadeira, retorna false. 

    • Cálculo dos Dígitos Verificadores: O restante do código implementa o algoritmo padrão para calcular os dois dígitos verificadores do CPF e compara-os com os dígitos reais do CPF fornecido. Se houver qualquer divergência, retorna false. 


ecoPoint/app/controllers/HomeController.php:

A HomeController é tipicamente responsável por lidar com as requisições para a página inicial da aplicação. Neste caso específico, a página inicial parece integrar um quiz, pois o controlador se encarrega de carregar as perguntas do quiz do banco de dados e passá-las para a view.
      
    • require_once __DIR__ . '/../../DAO/quizDAO.php';: Inclui o arquivo que define a classe Quiz. Esta classe é o Data Access Object para as perguntas do quiz. 

    • require_once __DIR__ . '/../../DAO/conexao.php';: Inclui o arquivo conexao.php, que fornece a funcionalidade para obter a conexão com o banco de dados. 

    • class HomeController extends Controller {: Declara a classe HomeController. Como outros controladores, ela estende uma classe Controller base, que fornece funcionalidades comuns como o método view(). 

    • public function index() {: Este é o método padrão que é executado quando a rota para a página inicial é acessada. 

    • $pdo = Conexao::getConexao();: Obtém a instância da conexão PDO com o banco de dados usando o método estático getConexao() da classe Conexao. A variável $pdo agora armazena o objeto de conexão. 

    • $quizModel = new Quiz($pdo);: Cria uma nova instância da classe Quiz. 

            ▪ $perguntas = $quizModel->buscarPerguntasQuiz(7);: Chama o método buscarPerguntasQuiz() do objeto $quizModel. Este método (que analisamos no quizDAO.php) é responsável por buscar 7 perguntas aleatórias e suas alternativas do banco de dados e formatá-las. As perguntas formatadas são armazenadas na variável $perguntas. 

            ▪ $this->view('home/index', ['perguntas' => $perguntas]);: Chama o método view() (herdado da classe Controller base) para carregar e exibir o arquivo de template (view) localizado em home/index. Os dados das $perguntas são passados para a view como um array associativo, onde a chave 'perguntas' será o nome da variável que conterá esses dados dentro da view. A view usará esses dados para renderizar a interface do quiz. 


ecoPoint/app/controllers/InformacoesController.php:

Este arquivo PHP define a classe InformacoesController, que é um controlador dentro da sua arquitetura MVC (Model-View-Controller). Como o nome sugere, este controlador é responsável por gerenciar a exibição de páginas de informação. O ponto mais importante e notável desta classe é o uso de um Middleware de Autenticação, indicando que as páginas gerenciadas por este controlador são protegidas e exigem que o usuário esteja logado para acessá-las.
Vamos detalhar cada parte:
    • require_once __DIR__ . '/../middleware/AuthMiddleware.php';: Esta linha é crucial. Ela inclui o arquivo que define a classe AuthMiddleware. Um "middleware" é um software que fica entre a requisição e a resposta, podendo executar lógica antes ou depois de a requisição chegar ao controlador. Neste caso, ele é usado para verificar a autenticação. 

    • class InformacoesController extends Controller {: Declara a classe InformacoesController. Ela estende a classe Controller base, que fornece funcionalidades comuns para todos os controladores (como o método view()). 

    • public function __construct() {: Este é o método construtor da classe InformacoesController. Ele é executado automaticamente sempre que uma nova instância de InformacoesController é criada (ou seja, sempre que uma rota gerenciada por este controlador é acessada). 

    • AuthMiddleware::check();: Esta é a linha que implementa a proteção. Ela chama o método estático check() da classe AuthMiddleware. Presume-se que o método AuthMiddleware::check() contém a lógica para verificar se o usuário está autenticado (por exemplo, verificando uma sessão ativa). Se o usuário não estiver autenticado, este middleware irá interromper a execução do script e redirecionar o usuário para a página de login. 

        ◦ Ao colocar a chamada do middleware no construtor, você garante que qualquer método público (ação) dentro deste controlador (InformacoesController) será protegido por autenticação. O usuário precisará estar logado antes que qualquer lógica de visualização ou processamento possa ser executada por este controlador. 

    • public function index() {: Este é o método padrão (ação) que é executado quando a rota principal para "informacoes" é acessada. 

    • $this->view('informacoes/index');: Chama o método view() (herdado da classe Controller base) para carregar e exibir o arquivo de template (view) localizado em informacoes/index. Este seria o conteúdo da página de informações que só pode ser acessada por usuários logados.


ecoPoint/app/controllers/LoginController.php:
Este arquivo PHP define a classe LoginController, que é um controlador central na sua arquitetura MVC (Model-View-Controller). Sua principal responsabilidade é gerenciar o processo de login dos usuários, desde a exibição do formulário até a autenticação e o gerenciamento da sessão. É importante notar que este controlador parece interagir com o frontend enviando respostas em JSON para a funcionalidade de autenticação, o que sugere um uso de AJAX para o processo de login.
Vamos detalhar cada parte:
    • require_once __DIR__ . '/../../DAO/usuarioDAO.php';: Inclui o arquivo que define a classe UsuarioDAO. Esta classe é essencial, pois o LoginController precisa interagir com o banco de dados para buscar e verificar as credenciais do usuário. 

    • class LoginController extends Controller {: Declara a classe LoginController. Ela estende a classe Controller base, que (como visto em outros controladores) fornece funcionalidades comuns como o método view(). 

    • public function index() {: Este método é o ponto de entrada quando se deseja exibir a página de login. 

    • $this->view('login/index');: Chama o método view() (herdado da classe Controller base) para carregar e exibir o arquivo de template (view) localizado em login/index. Este é o formulário HTML onde o usuário insere seu login e senha. 

    • public function autenticar() {: Este método é chamado quando o formulário de login é submetido (via POST). Este é o método mais crítico da classe, responsável por processar as credenciais submetidas pelo usuário.

    • $login = trim(strip_tags($_POST['login'] ?? ''));: 
      - $_POST['login'] ?? '': Usa o operador null coalesce para obter o valor do campo 'login' do formulário. Se 'login' não estiver definido em $_POST, ele usa uma string vazia para evitar erros. 
- strip_tags(...): Remove qualquer tag HTML ou PHP da string de login, prevenindo ataques de XSS.
- trim(...): Remove espaços em branco do início e do final da string de login.

        ◦ $senha = $_POST['senha'] ?? '';: Obtém a senha do formulário. Note que a senha não é strip_tags aqui, o que é correto, pois tags não devem ser removidas da senha.
       
        ◦ if (empty($login) || empty($senha)) { ... }: Verifica se o login ou a senha estão vazios após o processamento inicial. 

        ◦ Resposta JSON para Erro: Se algum campo estiver vazio, ele gera uma resposta em formato JSON indicando sucesso: false e uma mensagem de erro. Isso é típico para respostas AJAX. 

        ◦ return;: Encerra a execução do método, impedindo que o restante da lógica de autenticação seja processada. 
        
        ◦ $usuarioDAO = new UsuarioDAO();: Cria uma nova instância de UsuarioDAO para interagir com a tabela de usuários no banco de dados. 
        
        ◦ $usuario = $usuarioDAO->buscarPorLogin($login);: Chama o método buscarPorLogin() do UsuarioDAO para tentar encontrar um usuário com o login fornecido no banco de dados. 
        
        ◦ if ($usuario && password_verify($senha, $usuario['senha'])) { ... }: Esta é a lógica central da autenticação. 
              - $usuario: Primeiro, verifica se um usuário foi realmente encontrado ($usuario não é false). 
              - password_verify($senha, $usuario['senha']): Se um usuário foi encontrado, esta função altamente segura verifica se a senha fornecida pelo usuário ($senha) corresponde ao hash da senha armazenado no banco de dados ($usuario['senha']). É crucial usar password_verify() para hashes gerados por password_hash(), pois não é possível "descriptografar" um hash. 
        
        ◦ $_SESSION['usuario'] = [ ... ];: Se a autenticação for bem-sucedida, ele armazena dados essenciais do usuário na variável de sessão $_SESSION. Isso permite que o sistema saiba que o usuário está logado em outras páginas. Para que $_SESSION funcione, session_start() deve ser chamado no início do script.

        ◦ Resposta JSON para Sucesso: Retorna uma resposta JSON com sucesso: true. 
        
        ◦ else { ... }: Se o usuário não for encontrado ou a senha não coincidir. 

        ◦ Resposta JSON para Erro: Retorna uma resposta JSON com sucesso: false e uma mensagem de erro genérica ('Usuário ou senha incorretos.'). É uma boa prática não informar se o erro foi no login ou na senha para evitar ataques de força bruta ou enumeração de usuários. 


ecoPoint/app/controllers/LogoutController.php:

Este arquivo PHP onde sua única responsabilidade é gerenciar o processo de desautenticação (logout) do usuário, encerrando a sessão e redirecionando-o para a página de login.

    • class LogoutController extends Controller {: Declara a classe LogoutController. Ela estende a classe Controller base, que (presumivelmente) fornece funcionalidades comuns, embora para o logout direto, poucas delas sejam usadas diretamente. 

    • public function index() {: Este é o método que é executado quando a rota de logout é acessada. 

    • if (session_status() === PHP_SESSION_NONE) { session_start(); }: 
- session_status(): Retorna o status atual da sessão. Pode ser PHP_SESSION_DISABLED, PHP_SESSION_NONE (se não houver sessão ativa) ou PHP_SESSION_ACTIVE.
- PHP_SESSION_NONE: Indica que nenhuma sessão foi iniciada.
- session_start(): Se a sessão ainda não foi iniciada (o que pode acontecer dependendo de como as rotas são definidas e se a página de logout é a primeira a ser acessada em uma nova requisição), esta linha a inicia. É essencial iniciar a sessão antes de tentar manipulá-la (destruí-la, neste caso).

        ◦ session_destroy();: Esta função PHP é a principal responsável pelo logout. Ela destrói todos os dados registrados em uma sessão. Na prática, isso remove todas as variáveis da sessão e desativa a sessão atual. Os dados da sessão no servidor são apagados. 

        ◦ header('Location: /ecoPoint/login');: Após destruir a sessão, esta linha envia um cabeçalho HTTP Location para o navegador do usuário. Isso faz com que o navegador seja redirecionado para a URL /ecoPoint/login (a página de login). 
        ◦ exit();: É crucial chamar exit() (ou die()) imediatamente após um header('Location: ...'). Sem exit(), o script continuaria a ser executado, e o conteúdo subsequente poderia ser enviado ao navegador antes do redirecionamento, o que poderia levar a comportamentos inesperados ou vulnerabilidades.


ecoPoint/app/controllers/MapaController.php:

Este arquivo PHP define a classe MapaController, que é um controlador central na sua arquitetura MVC (Model-View-Controller). Sua principal responsabilidade é gerenciar a funcionalidade do mapa na aplicação, incluindo a exibição do mapa e o cadastro de novos pontos de coleta pelos usuários.
Ele também incorpora um middleware de autenticação, garantindo que apenas usuários logados possam interagir com a funcionalidade do mapa.
    • require_once __DIR__ . '/../models/usuario.php';: Inclui o modelo Usuario. Embora não seja diretamente usado neste arquivo para operações CRUD de Usuario, pode ser que a classe Usuario tenha definições de tipo ou que seja um include remanescente de refatorações. 

    • require_once __DIR__ . '/../../DAO/usuarioDAO.php';: Inclui o DAO para Usuario. Similar ao anterior, pode não ser diretamente utilizado para operações de usuário CRUD neste controlador, mas é uma dependência comum em aplicações. 

    • require_once __DIR__ . '/../../DAO/pontoColetaDAO.php';: Inclui o DAO para PontoColeta.

    • require_once __DIR__ . '/../middleware/AuthMiddleware.php';: Inclui o middleware de autenticação, que será usado para proteger o acesso às funcionalidades do mapa. 

    • class MapaController extends Controller {: Declara a classe MapaController, estendendo a classe Controller base. 

    • public function __construct() {: O construtor da classe. 

    • AuthMiddleware::check();: Esta linha é executada sempre que uma instância de MapaController é criada. Isso garante que apenas usuários autenticados possam acessar qualquer ação (método público) dentro deste controlador. Se o usuário não estiver logado, o middleware provavelmente o redirecionará para a página de login. 

    • public function index() {: Este método é o ponto de entrada para exibir a página do mapa. 

    • $this->view('mapa/index');: Chama o método view() (herdado da classe Controller base) para carregar e exibir o arquivo de template (view) localizado em mapa/index. Esta view provavelmente contém o HTML e o JavaScript para renderizar o mapa interativo.

    • if ($_SERVER['REQUEST_METHOD'] === 'POST') {: Garante que o código só seja executado se a requisição for do tipo POST (ou seja, um formulário foi submetido). 

    • Coleta de Dados: Coleta os dados do formulário enviados via $_POST. O operador null coalesce (?? '') é usado para fornecer uma string vazia se a chave não existir, evitando avisos. 
    • Validação Básica: Verifica se os campos obrigatórios estão preenchidos. Se não estiverem, exibe uma mensagem de erro simples.

    • Monta Endereço Completo: Concatena as partes do endereço em uma única string para ser usada na API de geocodificação.
       
        ◦ $coordenadas = $this->obterCoordenadas($enderecoCompleto);: Chama o método privado obterCoordenadas para converter o endereço textual em latitude e longitude. 

        ◦ $latitude = $coordenadas['lat'] ?? null; e $longitude = $coordenadas['lon'] ?? null;: Armazena as coordenadas ou null se não forem obtidas.

        ◦ $pdo = Conexao::getConexao();: Obtém a conexão PDO. 

        ◦ $stmt = $pdo->prepare("INSERT INTO ... VALUES (...)");: Prepara a instrução SQL INSERT para a tabela pontos_coleta. O status inicial do ponto de coleta é definido como 'pendente', o que é uma boa prática para um sistema de moderação. 

        ◦ Binding de Valores: bindValue é usado para ligar cada variável do formulário (e as coordenadas) aos placeholders nomeados na consulta. Isso é essencial para prevenir injeção de SQL.
           
            ▪ if ($stmt->execute()) { ... }: Se a inserção for bem-sucedida, exibe uma mensagem de sucesso amigável ao usuário e o retorna à página anterior. 

            ▪ else { ... }: Se a inserção falhar, obtém informações sobre o erro do PDO ($stmt->errorInfo()) e exibe uma mensagem de erro mais detalhada (o que pode ser útil em desenvolvimento, mas deve ser mais genérico em produção). 

            ▪ private function obterCoordenadas($endereco) {: Método privado que interage com a API de geocodificação do OpenStreetMap (Nominatim) para converter um endereço em coordenadas geográficas.
       
        ◦ $url = "https://nominatim.openstreetmap.org/search?" . http_build_query([...]);: Constrói a URL da requisição HTTP para a API Nominatim.
          - q: O endereço a ser pesquisado. 
              - format: Solicita a resposta em JSON. 
              - limit: Limita o resultado a 1 (o mais relevante). 
       
        ◦ $opts = [ "http" => [ "header" => "User-Agent: EcoPoint/1.0" ] ];: Define um cabeçalho User-Agent. Isso é uma boa prática e muitas APIs (incluindo Nominatim) exigem um User-Agent para identificar a aplicação que está fazendo a requisição e evitar bloqueios. 

        ◦ $context = stream_context_create($opts);: Cria um contexto de stream com as opções definidas. 
        
        ◦ $response = file_get_contents($url, false, $context);: Faz a requisição HTTP GET para a URL da API e obtém o conteúdo da resposta. 
        
        ◦ if ($response) { ... }: Verifica se houve uma resposta. 

        ◦ $data = json_decode($response, true);: Decodifica a string JSON da resposta em um array associativo PHP. 

        ◦ if (!empty($data[0])) { return [ 'lat' => $data[0]['lat'], 'lon' => $data[0]['lon'] ]; }: Se a resposta contém resultados (o primeiro resultado não está vazio), retorna um array com a latitude e longitude.


ecoPoint/app/controllers/OngsController.php:

De forma semelhante ao InformacoesController que analisamos anteriormente, este controlador é responsável por gerenciar a exibição de uma página relacionada a ONGs.
O aspecto mais importante e consistente com outros controladores protegidos é o uso do Middleware de Autenticação, indicando que esta página também é restrita a usuários logados.
       
    • require_once __DIR__ . '/../middleware/AuthMiddleware.php';: Inclui o arquivo que define a classe AuthMiddleware. Isso significa que, antes de qualquer ação ser executada neste controlador, a lógica de autenticação definida no middleware será aplicada.

    • class OngsController extends Controller {: Declara a classe OngsController. Como os outros controladores, ela estende a classe Controller base, que (presumivelmente) fornece métodos como view(). 

    • public function __construct() {: Este é o método construtor da classe OngsController. Ele é invocado automaticamente toda vez que uma instância de OngsController é criada (ou seja, quando uma rota associada a este controlador é acessada). 

    • AuthMiddleware::check();: Esta é a linha de segurança. Ela chama o método estático check() da classe AuthMiddleware. Conforme observado em outros controladores, o AuthMiddleware::check() é esperado para verificar se o usuário está autenticado (por exemplo, através de uma sessão ativa). Se o usuário não estiver logado, o middleware deve interromper o fluxo normal e, provavelmente, redirecionar o usuário para a página de login ou exibir uma mensagem de acesso negado. Colocar esta verificação no construtor garante que todas as ações (métodos públicos) dentro de OngsController estarão protegidas por autenticação. 

    • public function index() {: Este é o método padrão (ação) que é executado quando a rota principal para "ongs" é acessada. 

    • $this->view('ongs/index');: Chama o método view() (herdado da classe Controller base) para carregar e exibir o arquivo de template (view) localizado em ongs/index. Esta view provavelmente exibirá informações sobre ONGs relacionadas à reciclagem ou ao meio ambiente. 


ecoPoint/app/controllers/SenhaController.php:

Este arquivo PHP define a classe SenhaController, que é um controlador central para o processo de recuperação e redefinição de senhas na sua aplicação EcoPoint. A principal melhoria nesta versão está na centralização da lógica de validação de tokens dentro do método redefinir(), garantindo uma aderência mais forte ao padrão MVC e aprimorando a segurança.

    • Inclusões (require_once): Importa as classes e arquivos essenciais para o funcionamento do controlador, como o modelo Usuario, os DAOs (UsuarioDAO, TokenRecuperacaoDAO), a classe Controller base e o autoloader do Composer (para PHPMailer). 
       
    • class SenhaController extends Controller {: Declara a classe SenhaController, que herda funcionalidades básicas (como o método view()) da classe Controller. 

    • public function index() { este método é a porta de entrada para a funcionalidade de recuperação de senha. Ele simplesmente carrega a view senha/index.php, que deve conter o formulário onde o usuário insere seu e-mail para iniciar o processo. 

    • Método POST: Garante que a lógica só seja executada se a requisição for um POST (geralmente de um formulário). 

    • Validação de Entrada: O e-mail é validado para garantir que não esteja vazio e que tenha um formato válido. 

    • Busca de Usuário: Tenta encontrar o usuário pelo e-mail no banco de dados. 

    • Geração e Salvamento do Token: Se o usuário for encontrado, um token criptograficamente seguro é gerado (bin2hex(random_bytes(32))) e seu tempo de expiração é definido (1 hora). Este token e a data de expiração são salvos no banco de dados via TokenRecuperacaoDAO. 

    • Envio de E-mail com PHPMailer: 
        ◦ Um link de redefinição, contendo o token, é construído e incorporado a uma mensagem HTML. 

        ◦ O PHPMailer é configurado com as credenciais do Gmail ( jkmicwzoqoxamsxl é a senha de aplicativo para o Gmail, não a senha da conta principal, por motivos de segurança). O e-mail é enviado. Um bloco try-catch é usado para tratar possíveis erros de envio.

    • Feedback de Segurança: A mensagem final "Se o e-mail existir no sistema, você receberá um link." é crucial para a segurança, pois evita que atacantes enumerem e-mails válidos na base de dados. O usuário é sempre redirecionado para a página inicial de recuperação de senha.

    • Obtenção do Token: O token é obtido de forma segura da URL via $_GET['token'] ?? ''.

    • Validação da Presença do Token: empty($token) verifica se o token existe e não está vazio. Se não, um alerta é mostrado e o usuário é redirecionado, com a execução encerrada (exit).

    • Busca e Validação no Banco de Dados: O TokenRecuperacaoDAO é usado para buscar o token. Se !$dadosToken, significa que o token não foi encontrado ou não é mais válido, e o processo é interrompido com um redirecionamento. 

    • Validação de Expiração e Uso: DateTime objetos são usados para verificar se o token ainda é válido ($now < $expiracao) e se ele ainda não foi usado (!$dadosToken['usado']). 

    • Exibição da View: Somente se todas as validações passarem, a view senha/redefinir é carregada, e o $token é passado para ela (para ser usado no campo oculto do formulário de redefinição). 

    • Redirecionamento Consistente: Em qualquer ponto de falha da validação, o usuário é redirecionado para a página de recuperação de senha com uma mensagem de alerta, e a execução do script é encerrada com exit para evitar processamento indesejado. 

    • Método POST: Garante a execução via POST. 

    • Validação de Senhas: Verifica se os campos de nova senha estão preenchidos e se as senhas coincidem. 

    • Revalidação do Token: O token é revalidado no momento da submissão da nova senha. Isso é uma camada de segurança adicional crucial para evitar que um token já usado ou expirado seja explorado caso o usuário tente submeter o formulário novamente após um tempo. 

    • Hashing da Senha: A nova senha é hasheada usando password_hash(PASSWORD_DEFAULT), o que é a maneira recomendada e segura de armazenar senhas em PHP. 

    • Atualização da Senha: O UsuarioDAO é chamado para atualizar a senha do usuário no banco de dados. 

    • Marcação do Token como Usado: O token é marcado como "usado" no TokenRecuperacaoDAO, impedindo sua reutilização. 

    • Feedback e Redirecionamento: Informa o usuário sobre o sucesso ou falha e o redireciona para a página de login ou para a página de recuperação de senha. 


ecoPoint/app/controllers/SobreController.php:

Este arquivo PHP define a classe SobreController, que é um controlador dentro da sua arquitetura MVC (Model-View-Controller). De forma idêntica aos controladores InformacoesController e OngsController, este controlador é responsável por gerenciar a exibição de uma página de "Sobre" a aplicação. O padrão de segurança é mantido: o uso do Middleware de Autenticação garante que esta página também é restrita a usuários logados.

    • require_once __DIR__ . '/../middleware/AuthMiddleware.php';: Inclui o arquivo que define a classe AuthMiddleware. Assim como nos outros controladores protegidos, esta linha assegura que a lógica de autenticação será aplicada antes de qualquer ação neste controlador. 

    • class SobreController extends Controller {: Declara a classe SobreController. Ela estende a classe Controller base, que (presumivelmente) fornece o método view(). 

    • public function __construct() {: Este é o método construtor da classe SobreController. Ele é invocado automaticamente sempre que uma instância de SobreController é criada (ou seja, quando uma rota associada a este controlador é acessada). 

    • AuthMiddleware::check();: Esta linha é a implementação da segurança. Ela chama o método estático check() da classe AuthMiddleware. 

        ◦ Como nos casos anteriores, o AuthMiddleware::check() deve verificar se o usuário está autenticado (por exemplo, checando uma sessão ativa). Se o usuário não estiver logado, o middleware provavelmente interromperá a execução e redirecionará para a página de login ou exibirá uma mensagem de acesso negado.  Ao colocar esta verificação no construtor, você garante que qualquer método público (ação) dentro de SobreController será protegido por autenticação. 

    • public function index() {: Este é o método padrão (ação) que é executado quando a rota principal para "sobre" é acessada. 

    • $this->view('sobre/index');: Chama o método view() (herdado da classe Controller base) para carregar e exibir o arquivo de template (view) localizado em sobre/index. Esta view conterá o conteúdo da página "Sobre" a aplicação EcoPoint.


ecoPoint/app/core/App.php:

Este arquivo PHP define a classe App, que é o coração (ou "core") do seu framework MVC simples. Ele é o responsável por:
       Analisar a URL: Extrair o controlador, o método e os parâmetros da URL. 
       Carregar o Controlador: Incluir e instanciar a classe do controlador apropriado. 
       Chamar o Método (Ação): Executar o método solicitado no controlador, passando os parâmetros. 
É essencialmente o roteador e despachante da sua aplicação.
    • class App {: Declara a classe App. 

    • protected $controller = 'HomeController';: Define o controlador padrão que será usado se nenhum controlador for especificado na URL. O padrão é HomeController. 

    • protected $method = 'index';: Define o método (ação) padrão que será chamado no controlador se nenhum método for especificado na URL. O padrão é index. 

    • protected $params = [];: Um array para armazenar os parâmetros que serão passados para o método do controlador. 

    • public function __construct() {: O construtor da classe App. Ele é executado assim que uma instância de App é criada (normalmente uma vez por requisição). 

    • $url = $this->parseURL();: Chama o método privado parseURL() para obter a URL limpa e dividida em um array de segmentos. 
       
        ◦ if(isset($url[0]) && file_exists('app/controllers/' . $url[0] . 'Controller.php')) { ... }: Verifica se o primeiro segmento da URL ($url[0]) existe e se um arquivo de controlador correspondente ([NomeDoController]Controller.php) existe no diretório app/controllers/. 

        ◦ $this->controller = $url[0] . 'Controller';: Se o controlador é encontrado, seu nome é definido (ex: 'login' se torna 'LoginController'). 

        ◦ unset($url[0]);: Remove o nome do controlador do array $url para que os elementos subsequentes sejam tratados como método e parâmetros. 

        ◦ require_once 'app/controllers/' . $this->controller . '.php';: Inclui o arquivo do controlador identificado. 

        ◦ $this->controller = new $this->controller;: Instancia a classe do controlador. Agora $this->controller é um objeto do controlador (ex: new HomeController()). 

        ◦ if(isset($url[1])) { ... }: Verifica se o segundo segmento da URL ($url[1]) existe. 

        ◦ if(method_exists($this->controller, $url[1])) { ... }: Verifica se o método com o nome do segundo segmento existe na instância do controlador carregado. 

        ◦ $this->method = $url[1];: Se o método é encontrado, seu nome é definido. 

        ◦ unset($url[1]);: Remove o nome do método do array $url. 
       
        ◦ $this->params = $url ? array_values($url) : [];: Quaisquer elementos restantes no array $url (após remover o controlador e o método) são considerados parâmetros. array_values() é usado para reindexar o array numericamente, garantindo que os parâmetros sejam passados corretamente. Se $url estiver vazio, $this->params será um array vazio. 
       
        ◦ call_user_func_array([$this->controller, $this->method], $this->params);: Esta função PHP é usada para chamar um método de uma classe dinamicamente. 

            ▪ [$this->controller, $this->method]: Define o callback como um array onde o primeiro elemento é a instância do controlador e o segundo é o nome do método a ser chamado. 

            ▪ $this->params: Passa todos os elementos do array $this->params como argumentos separados para o método do controlador. 

    • private function parseURL() {: Este é um método privado que processa a string da URL. 

    • if(isset($_GET['url'])) { ... }: Verifica se o parâmetro url está presente na query string (ex: http://localhost/ecoPoint/public/index.php?url=controller/method/param1). 
       
        ◦ rtrim($_GET['url'], '/'): Remove barras finais (/) da URL para evitar problemas com segmentos vazios. 

        ◦ filter_var(..., FILTER_SANITIZE_URL): Sanitiza a string da URL, removendo caracteres que não são válidos em URLs. 

        ◦ explode('/', ...): Divide a string da URL sanitizada em um array de segmentos, usando a barra (/) como delimitador. Ex: controller/method/param1 se torna ['controller', 'method', 'param1']. 
    • O método retorna este array de segmentos da URL. Se $_GET['url'] não estiver definido, ele retornará null.


ecoPoint/app/core/Controller.php:

Este arquivo PHP define a classe Controller, que é uma classe base fundamental no seu mini-framework MVC. Ela serve como a superclasse para todos os seus controladores específicos (como HomeController, LoginController, MapaController, etc.).
Seu propósito é fornecer funcionalidades comuns que todos os controladores podem precisar, promovendo a reutilização de código e mantendo a estrutura MVC.
    • class Controller {: Declara a classe Controller. Todas as outras classes de controlador estenderão esta classe. 

    • public function view($view, $dados = []) {: Este método é responsável por carregar e exibir um arquivo de "view" (o template HTML/PHP) e passar dados para ele.
          - $view: Espera uma string como 'home/index', 'login/index', 'mapa/index', etc. que representa o caminho para o arquivo da view dentro da pasta app/views/. 
          - $dados = []: Um array associativo opcional que contém os dados a serem passados para a view. Por padrão, é um array vazio. 

        ◦ extract($dados);: Esta é uma função PHP que importa variáveis de um array para a tabela de símbolos atual. 

        ◦ require_once __DIR__ . '/../views/' . $view . '.php';: Inclui o arquivo da view. 
          - __DIR__: Constante mágica que retorna o diretório do arquivo atual (ecoPoint/app/core/). 
          - '/../views/': Navega para a pasta app/views/ a partir do diretório core. 
          - $view . '.php': Concatena o nome da view (ex: 'home/index') com a extensão .php. O caminho completo resultaria, por exemplo, em ecoPoint/app/views/home/index.php.
           
        ◦ public function model($model) {: Este método é projetado para carregar e instanciar um "modelo" (que em muitos contextos MVC pode ser um objeto de dados, ou um DAO). No seu caso, parece ser usado para carregar classes DAO ou de modelo de domínio. 
          - $model: Espera uma string como 'Usuario' ou 'PontoColeta'.

        ◦ require_once '../app/models/' . $model . '.php';: Inclui o arquivo do modelo/DAO. 
- '../app/models/': Navega para a pasta app/models/ (assumindo que Controller.php está em app/core/).
- $model . '.php': Concatena o nome do modelo (ex: 'Usuario') com a extensão .php. O caminho completo resultaria, por exemplo, em ecoPoint/app/models/Usuario.php.

        ◦ return new $model();: Cria uma nova instância da classe do modelo carregado e a retorna. Isso permite que os controladores façam $usuarioModel = $this->model('Usuario'); para obter uma instância. 

        ◦ public function __construct() {: Este é o construtor da classe Controller. Ele será executado antes do construtor de qualquer subclasse de controlador que o estenda (a menos que a subclasse não chame parent::__construct()). 

        ◦ if (session_status() === PHP_SESSION_NONE) { session_start(); }:
          - session_status(): Retorna o status atual da sessão PHP. 
          - PHP_SESSION_NONE: Indica que nenhuma sessão foi iniciada. 
          - session_start(): Se a sessão ainda não estiver ativa, esta linha a inicia. Isso é crucial. Iniciar a sessão no construtor da classe Controller garante que $_SESSION estará disponível em todos os controladores e suas actions sem a necessidade de chamar session_start() repetidamente em cada um. Isso é um padrão de inicialização muito comum em frameworks PHP. 


ecoPoint/app/middleware/AuthMiddleware.php:

Este arquivo PHP define a classe AuthMiddleware, que é um componente crucial para a segurança e controle de acesso em sua aplicação. Como um "middleware", ele atua como um interceptador, executando lógica de verificação antes que a requisição chegue ao controlador final (que o invocou). Sua única e vital responsabilidade é garantir que um usuário esteja autenticado (logado) antes de permitir o acesso a certas páginas ou funcionalidades.
      
    • class AuthMiddleware {: Declara a classe AuthMiddleware. Ela é uma classe utilitária e não estende Controller ou qualquer outra classe base de MVC, pois seu propósito é ser chamada de forma estática ou injetada em outros componentes. 

    • public static function check() {: Este é o método principal da classe. Ele é static porque pode ser chamado diretamente na classe (ex: AuthMiddleware::check()) sem precisar instanciar um objeto AuthMiddleware. 

        ◦ if (!isset($_SESSION['usuario']) || !isset($_SESSION['usuario']['id'])) { ... }: Esta é a lógica central de segurança. 

            ▪ !isset($_SESSION['usuario']): Verifica se a chave 'usuario' não está definida no array de sessão $_SESSION. 

            ▪ !isset($_SESSION['usuario']['id']): Ou, se a chave 'usuario' existe, verifica se a sub-chave 'id' dentro dela não está definida.  A condição || (OR lógico) significa que se qualquer uma dessas condições for verdadeira, o usuário não é considerado autenticado. Esta é uma verificação sólida, pois o LoginController armazena $_SESSION['usuario'] como um array contendo, entre outras coisas, o id do usuário. 
        
        ◦ header('Location: /ecoPoint/login');: Se o usuário não estiver autenticado, esta linha envia um cabeçalho HTTP Location para o navegador. Isso força o navegador a redirecionar o usuário para a URL /ecoPoint/login, que é a sua página de login. 

        ◦ exit();: Extremamente importante! Após um redirecionamento header('Location: ...'), é crucial chamar exit() (ou die()). Isso encerra imediatamente a execução do script.


ecoPoint/app/models/usuario.php:

Este arquivo PHP define a classe Usuario, que representa o "Modelo" no contexto de um padrão MVC. Em um MVC simples, é comum que a classe do modelo contenha tanto a representação dos dados quanto métodos para persistir/recuperar esses dados do banco.
Esta classe define as propriedades de um usuário e métodos para popular essas propriedades, acessá-las (getters), e interagir com o banco de dados para inserção e busca por e-mail.
    • class Usuario {: Declara a classe Usuario. 

    • Propriedades Privadas: Define as propriedades (atributos) que representam os dados de um usuário. Todas são declaradas como private, o que é uma boa prática de encapsulamento, garantindo que os dados sejam acessados e modificados apenas por meio dos métodos públicos da classe (getters e setters). 

    • public function __construct($dados = []) {: O construtor da classe Usuario. Ele pode receber um array associativo $dados no momento da criação do objeto. 

    • if (!empty($dados)) { $this->setDados($dados); }: Se o array $dados não estiver vazio, ele chama o método setDados() para popular as propriedades do objeto com os valores fornecidos. Isso permite criar instâncias de Usuario já preenchidas com dados. 

    • public function setDados($dados) {: Um método público que permite definir (ou redefinir) todas as propriedades do usuário de uma vez, usando um array associativo. 

    • Atribuição Direta: Ele atribui os valores do array $dados às propriedades privadas correspondentes do objeto. 

    • Uma série de métodos public function get...() que permitem acessar o valor das propriedades privadas do objeto. Isso é o padrão para encapsulamento em POO. 

    • public function inserir($pdo) {: Este método é responsável por persistir os dados do objeto Usuario no banco de dados. Ele recebe um objeto PDO ($pdo) como argumento. 

    • Preparação da Consulta: $stmt = $pdo->prepare("INSERT INTO usuario (...) VALUES (...)"); Prepara uma instrução SQL INSERT para a tabela usuario. 

    • Binding de Valores: Usa bindValue() para ligar os valores das propriedades do objeto aos placeholders nomeados na consulta. Isso é fundamental para prevenir ataques de injeção de SQL. 

    • Execução da Consulta: return $stmt->execute(); Executa a instrução preparada. Retorna true em caso de sucesso ou false em caso de falha (não PDOException). 
        
        ◦ try { ... } catch (PDOException $e) { ... }: O bloco try-catch captura exceções específicas do PDO que podem ocorrer durante a execução da consulta (ex: erro de conexão, violação de chave única). 

        ◦ throw new Exception("Erro ao inserir usuário: " . $e->getMessage());: Em caso de PDOException, ele relança uma Exception genérica com uma mensagem de erro, encapsulando o erro do PDO. Isso permite que o controlador que chamou este método trate o erro de forma mais controlada. 

        ◦ public function buscarPorEmail($email) {: Este método busca um usuário no banco de dados pelo seu endereço de e-mail. 
          
        ◦ $pdo = Conexao::getConexao();: Obtém a conexão PDO.  

        ◦ $stmt = $pdo->prepare("SELECT * FROM usuario WHERE email = :email LIMIT 1");: Prepara a consulta para buscar um usuário pelo e-mail, limitando a 1 resultado. 

        ◦ $stmt->bindParam(':email', $email);: Liga o valor do e-mail ao placeholder. 

        ◦ $stmt->execute();: Executa a consulta. 

        ◦ return $stmt->fetch(PDO::FETCH_ASSOC);: Retorna a primeira linha do resultado como um array associativo, ou false se nenhum resultado for encontrado. 


ecoPoint/app/views/mapa/index.php:

Este arquivo PHP representa a view index do módulo mapa. Ele é responsável por exibir a página do mapa interativo, onde os usuários podem visualizar pontos de coleta de lixo eletrônico e também cadastrar novos.
O código é uma mistura de HTML para a estrutura da página, CSS (incluído via folhas de estilo externas e embutido) para a estilização, e JavaScript para a funcionalidade do mapa e de outros elementos interativos (como o formulário de cadastro de pontos e os menus de acessibilidade/feedback).
    • Leaflet JavaScript: Inclui a biblioteca Leaflet. 

        ◦ Inicialização do Mapa: L.map('map').setView(...) cria o mapa e define a visualização inicial para o Rio de Janeiro. 

        ◦ Camada Base (Tile Layer): Adiciona o mapa OpenStreetMap como camada base. 

        ◦ Geolocalização do Usuário: Tenta obter a localização do usuário via navigator.geolocation. Se bem-sucedido, centraliza o mapa na localização do usuário e adiciona um marcador "Você está aqui". Caso contrário, loga um aviso. 
           
            ▪ fetch('api/pontosAprovados.php'): Faz uma requisição assíncrona (AJAX) para um script PHP localizado em api/pontosAprovados.php. Este script é presumivelmente um endpoint de API que retorna os pontos de coleta aprovados em formato JSON. 

            ▪ .then(response => response.json()): Processa a resposta como JSON. 

            ▪ .then(pontos => { ... }): Itera sobre o array de pontos recebido e adiciona um marcador (L.marker) para cada ponto no mapa, com um popup (bindPopup) mostrando o nome do local. 

            ▪ .catch(error => { ... }): Lida com erros na requisição. 


ecoPoint/index.php:

O arquivo ecoPoint/index.php é o ponto de entrada principal da sua aplicação PHP. Ele age como o controlador frontal (front controller), responsável por inicializar o ambiente da aplicação e direcionar as requisições para os componentes corretos.
      
    • if (session_status() === PHP_SESSION_NONE): Esta condição verifica o status da sessão PHP. 

        ◦ session_status(): Uma função nativa do PHP que retorna o status atual da sessão. 

        ◦ PHP_SESSION_NONE: Uma constante PHP que indica que as sessões estão ativadas, mas nenhuma sessão foi iniciada. 

    • session_start();: Se a condição for verdadeira (ou seja, se nenhuma sessão estiver ativa), esta função inicia ou retoma uma sessão PHP. Isso é fundamental para manter o estado do usuário entre diferentes páginas, como informações de login, carrinho de compras, ou qualquer dado temporário que precise persistir. 

    • require_once 'config/config.php';: Inclui o arquivo config.php do diretório config. Este arquivo é vital para armazenar configurações globais da aplicação, como credenciais de banco de dados, constantes, URLs base, etc. O uso de require_once garante que o arquivo seja incluído apenas uma vez, evitando erros de redefinição. 

    • require_once 'app/core/App.php';: Inclui a classe App.php do diretório app/core. A classe App (ou Router) é tipicamente responsável pelo roteamento das requisições, ou seja, ela analisa a URL da requisição e determina qual controlador e método devem ser executados. 

    • require_once 'app/core/Controller.php';: Inclui a classe Controller.php do diretório app/core. Esta provavelmente é a classe base para todos os seus controladores. Ela pode conter funcionalidades comuns que todos os controladores precisam (ex: carregar models, carregar views, métodos de autenticação, etc.). 
       
    • $app = new App();: Instancia a classe App. No momento em que este objeto é criado (ou dentro do seu construtor __construct()), a lógica de roteamento é iniciada. A classe App provavelmente: Obtém a URL da requisição atual; analisa essa URL para identificar o controlador, método e parâmetros; instancia o controlador apropriado; chama o método correspondente com os parâmetros. 

O index.php é a espinha dorsal de um sistema MVC (Model-View-Controller) simples em PHP. Ele configura o ambiente inicial, carrega as classes essenciais para o funcionamento do framework mínimo que você construiu e, em seguida, inicia o processo de roteamento que irá despachar a requisição para o controlador correto.
