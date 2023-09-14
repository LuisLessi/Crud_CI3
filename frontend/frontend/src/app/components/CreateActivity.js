// CreateActivity.js
import React, { useState, useEffect } from 'react';
import { useClient } from 'react-router-dom'; // Importe useClient

function CreateActivity() {
  const [descricao, setDescricao] = useState('');

  const handleSubmit = e => {
    e.preventDefault();

    // Enviar os dados do formulário para a API para criar uma nova atividade
    fetch('/atividades/store', {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json',
      },
      body: JSON.stringify({ descricao }),
    })
      .then(response => response.json())
      .then(data => {
        console.log('Atividade criada com sucesso:', data);
        // Você pode redirecionar ou atualizar a lista de atividades após criar
      })
      .catch(error => {
        console.error('Erro ao criar atividade:', error);
      });
  };

  useEffect(() => {
    // Coloque seu código useEffect aqui, se necessário.
  }, []); // Certifique-se de que useEffect não tenha dependências

  return (
    <div>
      <h2>Criar Nova Atividade</h2>
      <form onSubmit={handleSubmit}>
        <div>
          <label>Descrição:</label>
          <input
            type="text"
            value={descricao}
            onChange={e => setDescricao(e.target.value)}
          />
        </div>
        <button type="submit">Criar</button>
      </form>
    </div>
  );
}

export default CreateActivity;
