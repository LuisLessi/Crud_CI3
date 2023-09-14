// page.js
import React from 'react';
import { BrowserRouter as Router, Switch, Route, useClient } from 'react-router-dom';
import ListActivities from './components/ListActivities';
import CreateActivity from './components/CreateActivity';
import UpdateActivity from './components/UpdateActivity';
import DeleteActivity from './components/DeleteActivity';

function Page() {
  useClient(); // Marque este componente como um "Client Component"

  return (
    <Router>
      <div>
        <Switch>
          <Route exact path="/" component={ListActivities} />
          <Route path="/criar" component={CreateActivity} />
          <Route path="/atualizar/:id" component={UpdateActivity} />
          <Route path="/excluir/:id" component={DeleteActivity} />
        </Switch>
      </div>
    </Router>
  );
}

export default Page;
