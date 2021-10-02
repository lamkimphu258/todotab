import React, {useEffect, useState} from 'react';
import {useHistory} from "react-router-dom";
import axios from "axios";
import jwtDecode from "jwt-decode";
import AppLayout from "./AppLayout";
import AppContentRouter from "../Routers/AppContentRouter";

type User = {
    username: string,
    roles: string[],
}

const initialUser = {
    username: '',
    roles: [],
}

const AppContentLayout = () => {
    const history = useHistory();
    const [user, setUser] = useState<User>(initialUser);

    useEffect(() => {
        axios.post(
            '/api/rest/v1/token/refresh',
            {
                token: localStorage.getItem('token')
            }
        ).then((response) => {
            localStorage.setItem('token', response.data.refresh_token);
            const decodedJwt: User = jwtDecode(response.data.refresh_token);

            setUser({
                ...user,
                username: decodedJwt.username,
                roles: decodedJwt.roles,
            });
        }).catch(error => {
            console.error(error.detail);
            localStorage.removeItem('token');
            history.push('/signin');
        })
    }, [])

    return (
        <AppLayout>
            {user.username && <AppContentRouter/>}
        </AppLayout>
    )
}

export default AppContentLayout;
