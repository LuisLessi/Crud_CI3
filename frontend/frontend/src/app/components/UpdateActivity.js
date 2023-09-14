import React, { useState, useEffect } from 'react';

function UpdateActivity({ match }) {
  const [activity, setActivity] = useState({});
  const [descricao, setDescricao] = useState('');

  useEffect(() => {
    // Chamada à API para buscar os detalhes da atividade a ser atualizada
    fetch(`/atividades/${match.params.id}`)
      .then(response => response.json())
      .then(data => {
        setActivity(data);
        setDescricao(data.descricao); // Preenche o campo de descrição com os dados atuais
      })
      .catch(error => {
        console.error('Erro ao buscar detalhes da atividade:', error);
      });
  }, [match.params.id]);

  const handleSubmit = e => {
    e.preventDefault();

    // Enviar os dados atualizados para a API para atualizar a atividade
    fetch(`/atividades/update/${match.params.id}`, {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json',
      },
      body: JSON.stringify({ descricao }),
    })
      .then(response => response.json())
      .then(data => {
        console.log('Atividade atualizada com sucesso:', data);
        // Você pode redirecionar ou atualizar a lista de atividades após atualizar
      })
      .catch(error => {
        console.error('Erro ao atualizar atividade:', error);
      });
  };

  return (
    <div>
      <h2>Atualizar Atividade</h2>
      <form onSubmit={handleSubmit}>
        <div>
          <label>Descrição:</label>
          <input
            type="text"
            value={descricao}
            onChange={e => setDescricao(e.target.value)}
          />
        </div>
        <button type="submit">Atualizar</button>
      </form>
    </div>
  );
}

export default UpdateActivity;
