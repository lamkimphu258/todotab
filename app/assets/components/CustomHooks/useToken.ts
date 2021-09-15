import {useState} from "react";

const useToken = () => {
    const getToken = () => {
        return sessionStorage.getItem('token');
    }

    const [token, setToken] = useState<string>(getToken() || '');

    const saveToken = (token: string) => {
        sessionStorage.setItem('token', token);
        setToken(token);
    }

    return [token, saveToken] as const;
}

export default useToken;
