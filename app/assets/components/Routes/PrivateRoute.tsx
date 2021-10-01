import {Redirect, Route, RouteProps} from "react-router-dom";
import React, {Component} from "react";
import {token} from '../../config/tokenConstant';

interface PrivateRouteProps extends RouteProps {
    component: any;
}

const PrivateRoute: React.FC<PrivateRouteProps> = (
    props: PrivateRouteProps
) => {
    const {component: Component, ...rest} = props;

    return (
        <Route
            {...rest}
            render={(props) =>
                localStorage.getItem(token) ? (
                    <Component {...props} />
                ) : (
                    <Redirect to='/signin'/>
                )
            }
        />
    );
};

export default PrivateRoute;
