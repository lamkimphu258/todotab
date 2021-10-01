import React from 'react';
import {BrowserRouter as Router, Route, Switch} from 'react-router-dom';
import NotFound from "../ExceptionPages/NotFound";
import AppLayout from "../Layouts/AppLayout";
import useToken from "../CustomHooks/useToken";
import Home from "../Pages/Home/Home";
import About from "../Pages/About/About";
import SignUp from "../Pages/SignUp/SignUp";
import SignIn from "../Pages/SignIn/SignIn";
import Spinner from "../Common/Spinner";

const AppRouter: React.FC = () => {
    const [token, setToken] = useToken();

    return (
        <Router>
            <React.Suspense fallback={<Spinner/>}>
                <AppLayout token={token} setToken={setToken}>
                    <Switch>
                        <Route exact path={'/'}>
                            <Home token={token}/>
                        </Route>
                        <Route exact path={'/about'} component={About}/>
                        <Route exact path={'/signup'} component={SignUp}/>
                        <Route exact path={'/signin'}>
                            <SignIn setToken={setToken}/>
                        </Route>
                        <Route component={NotFound}/>
                    </Switch>
                </AppLayout>
            </React.Suspense>
        </Router>
    )
}

export default AppRouter;
