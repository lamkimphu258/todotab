import React from 'react';
import {
    Switch,
    Route
} from 'react-router-dom';
import About from "../Pages/About";
import Home from "../Pages/Home/Home";

const AppRouter: React.FC = () => {
    return (
        <>
            <Switch>
                <Route exact path={'/'} component={Home}/>
                <Route path={'/about'} component={About}/>
            </Switch>
        </>
    )
}

export default AppRouter;
