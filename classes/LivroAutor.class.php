<?php
    class LivroA{
        private $la_livro_l_id_livro;
        private $la_autor_a_idAutor;

        
        public function __construct($idL, $idA){
            
            $this->setIdL($idL);
            $this->setIdA($idA);
        }

        public function getIdL(){ return $this->la_livro_l_id_livro; }
        public function setIdL($idL){ return $this->la_livro_l_id_livro = $idL; }

        public function getIdA(){ return $this->la_autor_a_idAutor; }
        public function setIdA($idA){ return $this->la_autor_a_idAutor = $idA; }

        public function insere(){
            $pdo = Conexao::getInstance();
            $stmt = $pdo->prepare('INSERT INTO livro_autor (la_livro_l_id_livro, la_autor_a_idAutor) 
            VALUES(:la_livro_l_id_livro, :la_autor_a_idAutor)');

            $stmt->bindValue(':la_livro_l_id_autor', $this->getIdL());
            $stmt->bindValue(':la_autor_a_idAutor', $this->getIdA());
    
            return $stmt->execute();
        }

        public function editar($la_autor_a_idAutor){
            $pdo = Conexao::getInstance();
            $stmt = $pdo->prepare('UPDATE livro_autor SET la_livro_l_id_livro = :la_livro_l_id_livro, 
            la_autor_a_idAutor = :la_autor_a_idAutor
            WHERE la_livro_l_id_livro = :la_livro_l_id_livro');

            $stmt->bindValue(':la_livro_l_id_livro', $this->setIdL($this->la_livro_l_id_livro));
            $stmt->bindValue(':la_autor_a_idAutor', $this->setIdA($this->la_autor_a_idAutor));
            
            return $stmt->execute();
        }

        function excluir($la_livro_l_id_livro){
            $pdo = Conexao::getInstance();
            $stmt = $pdo ->prepare('DELETE FROM livro_autor WHERE la_livro_l_id_livro = :la_livro_l_id_livro');
            $stmt->bindValue(':la_livro_l_id_livro', $la_livro_l_id_livro);
            
            return $stmt->execute();
        }

        public function buscar($idL, $idA){
            require_once("conf/Conexao.php");

            $conexao = Conexao::getInstance();

            $query = 'SELECT * FROM livro_autor';
            if($idL > 0){
                $query .= ' WHERE la_livro_l_id_livro = :IdL AND la_autor_a_idAutor = :IdA';
                $stmt->bindParam(':IdL', $idL);
                $stmt->bindParam(':IdA', $idA);
            }
                $stmt = $conexao->prepare($query);
                if($stmt->execute())
                    return $stmt->fetchAll();
        
                return false;
        }
    }
?>