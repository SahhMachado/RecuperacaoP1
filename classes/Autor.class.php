<?php
    class Autor{
        private $a_idAutor;
        private $a_nome;
        private $a_sobrenome;

        
        public function __construct($id, $nome, $snome){
            
            $this->setId($id);
            $this->setNome($nome);
            $this->setSnome($snome);
        }

        public function getId(){ return $this->a_idAutor; }
        public function setId($id){ return $this->a_idAutor = $id; }

        public function getNome(){ return $this->a_nome; }
        public function setNome($nome){ return $this->a_nome = $nome; }

        public function getSnome(){ return $this->a_sobrenome; }
        public function setSnome($snome){ return $this->a_sobrenome = $snome; }

        
        public function insere(){
            $pdo = Conexao::getInstance();
            $stmt = $pdo->prepare('INSERT INTO autor (a_nome, a_sobrenome) 
            VALUES(:a_nome, :a_sobrenome)');

            $stmt->bindValue(':a_nome', $this->getNome());
            $stmt->bindValue(':a_sobrenome', $this->getSnome());

            return $stmt->execute();
            
        }

        public function editar($a_idAutor){
                $pdo = Conexao::getInstance();
                $stmt = $pdo->prepare('UPDATE autor SET a_nome = :a_nome, a_sobrenome = :a_sobrenome
                WHERE a_idAutor = :a_idAutor');

                $stmt->bindValue(':a_idAutor', $this->setId($this->a_idAutor));
                $stmt->bindValue(':a_nome', $this->setNome($this->a_nome));
                $stmt->bindValue(':a_sobrenome', $this->setSnome($this->a_sobrenome));

                return $stmt->execute();
            }

        function excluir($a_idAutor){
            $pdo = Conexao::getInstance();
            $stmt = $pdo ->prepare('DELETE FROM autor WHERE a_idAutor = :a_idAutor');
            $stmt->bindValue(':a_idAutor', $a_idAutor);
            
            return $stmt->execute();
        }

        public function buscar($id){
            require_once("conf/Conexao.php");

            $conexao = Conexao::getInstance();

            $query = 'SELECT * FROM autor';
            if($id > 0){
                $query .= ' WHERE a_idAutor = :Id';
                $stmt->bindParam(':Id', $id);
            }
                $stmt = $conexao->prepare($query);
                if($stmt->execute())
                    return $stmt->fetchAll();
        
                return false;
        }
    }
?>