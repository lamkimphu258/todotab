import React from 'react';
import {Route, Switch} from "react-router-dom";
import SignInPage from "./Pages/SignIn/SignInPage";
import SignUpPage from "./Pages/SignUp/SignUpPage";
import Homepage from "./Pages/Home/Homepage";
import AboutPage from "./Pages/About/AboutPage";
import PrivateRoute from "./Routers/PrivateRoute";
import AppContentLayout from "./Layouts/AppContentLayout";

const App: React.FC = () => {
    return (
        <Switch>
            <Route exact path={'/'} component={Homepage}/>
            <Route exact path={'/about'} component={AboutPage}/>
            <Route exact path={'/signin'} component={SignInPage}/>
            <Route exact path={'/signup'} component={SignUpPage}/>
            <PrivateRoute path={'/'} component={AppContentLayout}/>
        </Switch>
    )
}

export default App;
