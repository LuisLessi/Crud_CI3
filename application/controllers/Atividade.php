<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Atividade extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        header('Content-Type: application/json');
        $this->load->library('doctrine');
        // Carregue a entidade "Atividade" do Doctrine, se necessário.
    }

    public function index()
    {
        $data = [];
        $this->doctrine->em->initialize($atividade->getIdProjeto()); // Carrega o objeto Projeto

        foreach ($atividades as $atividade) {
            $projeto = $atividade->getIdProjeto(); // Carrega o objeto Projeto

            $data[] = [
                "id" => $atividade->getId(),
                "descricao" => $atividade->getDescricao(),
                "idProjeto" => $projeto->getNome(), // Acesse o nome do projeto a partir do objeto Projeto carregado
            ];
        }

        $this->load->view('principal_view', ["atividades" => $data]);
    }


    public function search()
    {
        $this->load->helper('url');
        $id = $this->input->get('id'); // Get the ID from the GET request

        // Check if an ID was provided in the search
        if (!empty($id)) {
            // Perform the search query here using the $id
            // You can use the ID to retrieve the activity from the database or perform any other search logic

            // Example query:
            $atividade = $this->doctrine->em->find("Entity\Atividade", $id);

            if ($atividade) {
                // Activity found, you can display it or redirect to a specific view
                $data['atividades'] = [$atividade]; // Put the found activity in an array for consistency with the rest of the code
                $this->output->set_content_type('text/html');
                $this->load->view('principal_view', $data); // Display the view with the single activity
            } else {
                // Activity not found, you can display an error message or redirect
                echo json_encode(["error" => "Atividade não encontrada"]);
                redirect(base_url('principal/povoar'));
            }
        } else {
            $this->output->set_content_type('text/html');
            redirect(base_url('principal/povoar'));
        }
    }


    public function show($id)
    {
        $data = [];
        $atividade = $this->doctrine->em->find("Entity\Atividade", $id);

        if ($atividade) {
            $data[] = [
                "id" => $atividade->getId(),
                "descricao" => $atividade->getDescricao(),
                "idProjeto" => $atividade->getIdProjeto(),

            ];
        }

        echo json_encode($data);
    }

    public function store()
    {
        $this->load->helper('url');

        // Captura a descrição do formulário
        $descricao = $this->input->post('descricao');

        // Captura o ID do projeto selecionado no formulário
        $projetoId = $this->input->post('projeto');

        // Verifique se a descrição não está vazia
        if (empty($descricao)) {
            echo json_encode(["error" => "A descrição não pode estar vazia"]);
            return;
        }

        // Crie uma nova instância da entidade Atividade
        $atividade = new Entity\Atividade();

        // Defina a descrição da atividade
        $atividade->setDescricao($descricao);

        // Obtém o objeto do projeto com base no ID
        $projeto = $this->doctrine->em->find('Entity\Projeto', $projetoId);

        // Verifica se o projeto foi encontrado
        if (!$projeto) {
            echo json_encode(["error" => "Projeto não encontrado"]);
            return;
        }

        // Vincula a atividade ao projeto
        $atividade->setIdProjeto($projeto);

        // Defina a hora do salvamento (você pode usar a hora atual do servidor)
        $dataHoraSalvamento = new \DateTime();

        // Formate o objeto DateTime como uma string no formato desejado
        $dataCadastroFormatada = $dataHoraSalvamento->format('Y-m-d H:i:s');
        $atividade->setDataCadastro($dataCadastroFormatada);

        // Salve a atividade no banco de dados usando o Doctrine
        $this->doctrine->em->persist($atividade);
        $this->doctrine->em->flush();

        redirect(base_url('principal/povoar'));
        echo json_encode(["message" => "Atividade cadastrada com sucesso"]);
    }



    public function edit($id)
    {
        $this->load->helper('url');
        $atividade = $this->doctrine->em->find("Entity\Atividade", $id);
        $projetos = $this->doctrine->em->getRepository('Entity\Projeto')->findAll();

        if ($atividade) {
            $data['atividade'] = $atividade;
            $data['projetos'] = $projetos;

            $this->output->set_content_type('text/html');
            $this->load->view('editar_atividade_view', $data); // Carrega a view de edição com os dados da atividade
        } else {
            echo json_encode(["error" => "Atividade não encontrada"]);
        }
    }


    public function update($id)
    {
        $this->load->helper('url');
        $descricao = $this->input->post('descricao');
        $projetoId = $this->input->post('projeto');
        

        $atividade = $this->doctrine->em->find("Entity\Atividade", $id);

          // Obtém o objeto do projeto com base no ID
          $projeto = $this->doctrine->em->find('Entity\Projeto', $projetoId);

          // Verifica se o projeto foi encontrado
          if (!$projeto) {
              echo json_encode(["error" => "Projeto não encontrado"]);
              return;
          }
  
          // Vincula a atividade ao projeto
          $atividade->setIdProjeto($projeto);

        if ($atividade) {
            $this->load->helper('url');
            $atividade->setDescricao($descricao);

            $this->doctrine->em->merge($atividade);
            $this->doctrine->em->flush();

            redirect(base_url('principal/povoar'));
            echo json_encode(["message" => "Atividade atualizada com sucesso"]);
        } else {
            echo json_encode(["error" => "Atividade não encontrada"]);
        }
    }


    public function destroy($id)
    {
        $this->load->helper('url');
        $atividade = $this->doctrine->em->find("Entity\Atividade", $id);

        if ($atividade) {
            $this->doctrine->em->remove($atividade);
            $this->doctrine->em->flush();

            echo json_encode(["message" => "Atividade excluída com sucesso"]);
            redirect(base_url('principal/povoar'));
        } else {
            echo json_encode(["error" => "Atividade não encontrada"]);
        }
    }
}
