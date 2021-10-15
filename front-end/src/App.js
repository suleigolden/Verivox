import logo from './logo.svg';
import './App.css';
import '../node_modules/bootstrap/dist/css/bootstrap.min.css';
import { BrowserRouter as Router, Route } from "react-router-dom";
import Home from './component/Home';

function App() {
  return (
    <Router>
        <Route exact path="/" component={Home}></Route>
    </Router>
  );
}

export default App;
