<?php
    class Livro{
        private $l_id_livro;
        private $l_titulo;
        private $l_ano_publicacao;
        private $l_isdn;
        private $l_preco;

        
        public function __construct($id, $titulo, $ano, $isdn, $preco){
            
            $this->setId($id);
            $this->setTitulo($titulo);
            $this->setAno($ano);
            $this->setIsdn($isdn);
            $this->setPreco($preco);
        }

        public function getId(){ return $this->l_id_livro; }
        public function setId($id){ return $this->l_id_livro = $id; }

        public function getTitulo(){ return $this->l_titulo; }
        public function setTitulo($titulo){ return $this->l_titulo = $titulo; }

        public function getAno(){ return $this->l_ano_publicacao; }
        public function setAno($ano){ return $this->l_ano_publicacao = $ano; }

        public function getIsdn(){return $this->l_isdn; }
        public function setIsdn($isdn){ return $this->l_isdn = $isdn; }
        
        public function getPreco(){return $this->l_preco; }
        public function setPreco($preco){ return $this->l_preco = $preco; }
        
        public function insere(){
            $pdo = Conexao::getInstance();
            $stmt = $pdo->prepare('INSERT INTO livro (l_titulo, l_ano_publicacao, l_isdn, l_preco) 
            VALUES(:l_titulo, :l_ano_publicacao, :l_isdn, :l_preco)');

            $stmt->bindValue(':l_titulo', $this->getTitulo());
            $stmt->bindValue(':l_ano_publicacao', $this->getAno());
            $stmt->bindValue(':l_isdn', $this->getIsdn());
            $stmt->bindValue(':l_preco', $this->getPreco());

    
            return $stmt->execute();
            
        }

        public function editar($l_id_livro){
                $pdo = Conexao::getInstance();
                $stmt = $pdo->prepare('UPDATE livro SET l_titulo = :l_titulo, l_ano_publicacao = :l_ano_publicacao, l_isdn = :l_isdn, l_preco = :l_preco
                WHERE l_id_livro = :l_id_livro');

                $stmt->bindValue(':l_id_livro', $this->setId($this->l_id_livro));
                $stmt->bindValue(':l_titulo', $this->setTitulo($this->l_titulo));
                $stmt->bindValue(':l_ano_publicacao', $this->setAno($this->l_ano_publicacao));
                $stmt->bindValue(':l_isdn', $this->setIsdn($this->l_isdn));
                $stmt->bindValue(':l_preco', $this->setPreco($this->l_preco));

                return $stmt->execute();
            }

        function excluir($l_id_livro){
            $pdo = Conexao::getInstance();
            $stmt = $pdo ->prepare('DELETE FROM livro WHERE l_id_livro = :l_id_livro');
            $stmt->bindValue(':l_id_livro', $l_id_livro);
            
            return $stmt->execute();
        }

        public function buscar($id){
            require_once("conf/Conexao.php");

            $conexao = Conexao::getInstance();

            $query = 'SELECT * FROM livro';
            if($id > 0){
                $query .= ' WHERE l_id_livro = :Id';
                $stmt->bindParam(':Id', $id);
            }
                $stmt = $conexao->prepare($query);
                if($stmt->execute())
                    return $stmt->fetchAll();
        
                return false;
        }
    }
?>