import React from 'react';
import MasterHead from "./MasterHead";
import TestimonialAside from "./TestimonialAside";
import AppFeature from "./AppFeature";

const Home: React.FC = () => {
    return (
        <>
            <MasterHead/>
            <TestimonialAside/>
            <AppFeature/>
        </>
    )
}

export default Home;
