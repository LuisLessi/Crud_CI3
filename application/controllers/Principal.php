<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Principal extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->library('doctrine');
		$this->load->helper('url');
    }

    public function povoar()
    {

        // Listar todas as atividades
        $atividades = $this->doctrine->em->getRepository("Entity\Atividade")->findAll();
        $projetos = $this->doctrine->em->getRepository('Entity\Projeto')->findAll();


        // Carregue a view principal_view.php e passe os dados das atividades como um array
        $data['atividades'] = $atividades;
        $data['projetos'] = $projetos;

        $this->load->view('principal_view', $data);
    }
}
