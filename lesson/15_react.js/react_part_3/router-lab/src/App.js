//BrowserRouter：React Router 提供的一個組件，用於實現基於瀏覽器 URL 的路由功能。
// Switch：用於包裹多個 Route，確保只渲染第一個匹配的路由。
// Route：用於定義 URL 路徑與組件的對應關係。 



import React, { Component } from 'react';
import {BrowserRouter, Switch, Route} from 'react-router-dom';
// HomeIndex 和 MemberLogin 是自定義的 React 組件，分別對應首頁和會員登錄頁面。
// 這些組件位於 ./components/ 目錄下，並以 .jsx 文件的形式存在。



import HomeIndex from './components/HomeIndex.jsx';
import MemberLogin from './components/MemberLogin.jsx';
import MemberEdit from './components/MemberEdit.jsx';
import TodoIndex from './components/TodoIndex.jsx';
// import "bootstrap/dist/css/bootstrap.min.css";


class App extends Component {
  state={   }
  render(){
    return(
      <BrowserRouter>
      <Switch> 
      {/* exact 表示路徑必須完全匹配 /，否則 /member/login 也會匹配到 / */} 
        <Route path="/" component={HomeIndex} exact/>
        <Route path="/member/login" component={MemberLogin} />
        <Route path="/member/edit/:who" component={MemberEdit} />
        <Route path="/member/todoIndex" component={TodoIndex} />
      </Switch> 
      </BrowserRouter>
    );
  }
}


// 將 App 組件導出，使其可以在其他文件中被導入和使用。
export default App;