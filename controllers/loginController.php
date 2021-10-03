<?php
class loginController extends controller
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $dados = array();

        $this->loadView('login', $dados);
    }

    public function cadastro()
    {
        $dados = array('aviso'=>'');

        if (isset($_POST['nome']) && !empty($_POST['nome'])) {

            $nome = addslashes($_POST['nome']);
            $email = addslashes($_POST['email']);
            $senha = md5($_POST['senha']);

            if (!empty($nome) && !empty($email) && !empty($senha)) {
                $u = new usuarios();

                if(!$u->usuarioExiste($email)) {
                    $_SESSION['twlg'] = $u->inserirUsuario($nome, $email, $senha);
                    header('Location: /twitter');
                } else {
                    $dados['aviso'] = "Usuário com o mesmo E-mail já cadastrado!";
                }
            } else {
                $dados['aviso'] = 'Preenncha todos os campos!';
            }
        }

        $this->loadView('cadastro', $dados);
    }
}
