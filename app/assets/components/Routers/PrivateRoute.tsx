import React from "react";
import {Redirect, Route, RouteProps} from "react-router-dom";
import useToken from "../CustomHooks/useToken";

interface PrivateRouteProps extends RouteProps {
    component: any;
}

const PrivateRoute: React.FC<PrivateRouteProps> = (props: PrivateRouteProps) => {
    const {component: Component, ...rest} = props;
    const [token] = useToken();

    return (
        <Route
            {...rest}
            render={
                (props) =>
                    token ? (
                        <Component {...props} />
                    ) : (
                        <Redirect to={'/signin'}/>
                    )
            }
        />
    )
}

export default PrivateRoute;
