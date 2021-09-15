import React from 'react';
import {Route, Switch} from 'react-router-dom';
import About from "../Pages/About/About";
import Home from "../Pages/Home/Home";
import SignUp from "../Pages/SignUp/SignUp";
import SignIn from "../Pages/SignIn/SignIn";

type Props = {
    token: string;
    setToken: (token: string) => void;
}

const AppRouter: React.FC<Props> = ({token, setToken}) => {
    return (
        <>
            <Switch>
                <Route exact path={'/'}>
                    <Home token={token}/>
                </Route>
                <Route path={'/about'} component={About}/>
                <Route path={'/signup'} component={SignUp}/>
                <Route path={'/signin'}>
                    <SignIn setToken={setToken}/>
                </Route>
            </Switch>
        </>
    )
}

export default AppRouter;
