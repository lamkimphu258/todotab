import React from 'react';
import MasterHead from "./MasterHead";
import TestimonialAside from "./TestimonialAside";
import AppFeature from "./AppFeature";
import useToken from "../../CustomHooks/useToken";
import {Redirect} from "react-router-dom";

const Home: React.FC = () => {
    const [token,] = useToken();

    if (token) {
        <Redirect to={'/todos'}/>
    }

    return (
        <>
            <MasterHead/>
            <TestimonialAside/>
            <AppFeature/>
        </>
    )
}

export default Home;
