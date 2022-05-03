<?php
    class Cliente{
        private $c_idCliente;
        private $c_nome;
        private $c_cpf;
        private $c_dt_nascimento;

        
        public function __construct($id, $nome, $cpf, $data){
            
            $this->setId($id);
            $this->setNome($nome);
            $this->setCpf($cpf);
            $this->setData($data);
        }

        public function getId(){ return $this->c_idCliente; }
        public function setId($id){ return $this->c_idCliente = $id; }

        public function getNome(){ return $this->c_nome; }
        public function setNome($nome){ return $this->c_nome = $nome; }

        public function getCpf(){ return $this->c_cpf; }
        public function setCpf($cpf){ return $this->c_cpf = $cpf; }

        public function getData(){ return $this->c_dt_nascimento; }
        public function setData($data){ return $this->c_dt_nascimento = $data; }

        
        public function insere(){
            $pdo = Conexao::getInstance();
            $stmt = $pdo->prepare('INSERT INTO cliente (c_nome, c_cpf, c_dt_nascimento) 
            VALUES(:c_nome, :c_cpf, :c_dt_nascimento)');

            $stmt->bindValue(':c_nome', $this->getNome());
            $stmt->bindValue(':c_cpf', $this->getCpf());
            $stmt->bindValue(':c_dt_nascimento', $this->getData());

            return $stmt->execute();
            
        }

        public function editar($c_idCliente){
                $pdo = Conexao::getInstance();
                $stmt = $pdo->prepare('UPDATE cliente SET c_nome = :c_nome, c_cpf = :c_cpf, c_dt_nascimento = :c_dt_nascimento
                WHERE c_idCliente = :c_idCliente');

                $stmt->bindValue(':c_idCliente', $this->setId($this->c_idCliente));
                $stmt->bindValue(':c_nome', $this->setNome($this->c_nome));
                $stmt->bindValue(':c_cpf', $this->setCpf($this->c_cpf));
                $stmt->bindValue(':c_dt_nascimento', $this->setData($this->c_dt_nascimento));

                return $stmt->execute();
            }

        function excluir($c_idCliente){
            $pdo = Conexao::getInstance();
            $stmt = $pdo ->prepare('DELETE FROM cliente WHERE c_idCliente = :c_idCliente');
            $stmt->bindValue(':c_idCliente', $c_idCliente);
            
            return $stmt->execute();
        }

        public function buscar($id){
            require_once("conf/Conexao.php");

            $conexao = Conexao::getInstance();

            $query = 'SELECT * FROM cliente';
            if($id > 0){
                $query .= ' WHERE c_idCliente = :Id';
                $stmt->bindParam(':Id', $id);
            }
                $stmt = $conexao->prepare($query);
                if($stmt->execute())
                    return $stmt->fetchAll();
        
                return false;
        }
    }
?>