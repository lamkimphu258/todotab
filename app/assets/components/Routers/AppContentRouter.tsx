import React from 'react';
import {Route, Switch} from "react-router-dom";
import TodoIndexPage from "../Pages/Todos/TodoIndexPage";

const AppContentRouter = () => {
    return (
        <Switch>
            <Route exact path={'/todos'} component={TodoIndexPage}/>
        </Switch>
    )
}

export default AppContentRouter;
