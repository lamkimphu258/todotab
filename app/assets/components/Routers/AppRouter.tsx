import React from 'react';
import {Route, Switch} from 'react-router-dom';
import About from "../Pages/About/About";
import Home from "../Pages/Home/Home";
import SignUp from "../Pages/SignUp/SignUp";

const AppRouter: React.FC = () => {
    return (
        <>
            <Switch>
                <Route exact path={'/'} component={Home}/>
                <Route path={'/about'} component={About}/>
                <Route exact path={'/signup'} component={SignUp}/>
            </Switch>
        </>
    )
}

export default AppRouter;
