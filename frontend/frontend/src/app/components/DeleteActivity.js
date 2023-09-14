import React, { useEffect } from 'react';

function DeleteActivity({ match, history }) {
  useEffect(() => {
    // Chamada à API para excluir a atividade
    fetch(`/atividades/destroy/${match.params.id}`, {
      method: 'DELETE',
    })
      .then(response => response.json())
      .then(data => {
        console.log('Atividade excluída com sucesso:', data);
        // Você pode redirecionar ou atualizar a lista de atividades após excluir
        history.push('/listagem'); // Exemplo de redirecionamento para a lista de atividades
      })
      .catch(error => {
        console.error('Erro ao excluir atividade:', error);
      });
  }, [match.params.id, history]);

  return (
    <div>
      <h2>Excluindo Atividade...</h2>
      {/* Você pode exibir uma mensagem de carregamento ou redirecionar o usuário */}
    </div>
  );
}

export default DeleteActivity;
