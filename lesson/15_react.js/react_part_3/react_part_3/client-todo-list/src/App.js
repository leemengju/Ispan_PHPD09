import React, { Component } from 'react';
import { BrowserRouter, Switch, Route} from 'react-router-dom';
import 'bootstrap/dist/css/bootstrap.min.css';

import TodoIndex from "./components/TodoIndex";
import TodoEdit from "./components/TodoEdit";

class App extends Component {
  state = {  } 
  render() { 
    return (
      <BrowserRouter>
        <Switch>
          <Route path="/" component={TodoIndex} exact />
          <Route path="/Todo/Index" component={TodoIndex} exact />
          <Route path="/Todo/Edit/:id" component={TodoEdit} />
        </Switch>
      </BrowserRouter>   
    );
  }
}

export default App;

