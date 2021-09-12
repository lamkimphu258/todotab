import React from 'react';
import {
    Switch,
    Route
} from 'react-router-dom';
import About from "../Pages/About";

const AppRouter = () => {
    return (
        <>
            <Switch>
                <Route path={'/about'} component={About}/>
            </Switch>
        </>
    )
}

export default AppRouter;
