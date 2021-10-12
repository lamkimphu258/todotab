import React from 'react';
import {Route, Switch} from "react-router-dom";
import TodoHomePage from "../Pages/Todos/TodoHomePage";

const AppContentRouter = () => {
    return (
        <Switch>
            <Route path={'/:username/todos'} component={TodoHomePage}/>
        </Switch>
    )
}

export default AppContentRouter;
