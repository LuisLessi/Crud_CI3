import React, { useEffect, useState } from 'react';

function ListActivities() {
  const [activities, setActivities] = useState([]);

  useEffect(() => {
    // Chamada à API para buscar atividades
    fetch('/atividades')
      .then(response => response.json())
      .then(data => {
        setActivities(data); // Atualiza o estado com os dados das atividades
      })
      .catch(error => {
        console.error('Erro ao buscar atividades:', error);
      });
  }, []);

  return (
    <div>
      <h2>Listagem de Atividades</h2>
      <ul>
        {activities.map(activity => (
          <li key={activity.id}>
            {activity.descricao} {/* Exibir outros campos, se necessário */}
          </li>
        ))}
      </ul>
    </div>
  );
}

export default ListActivities;
