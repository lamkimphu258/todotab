import React from 'react';
import MasterHead from "./MasterHead";
import TestimonialAside from "./TestimonialAside";
import AppFeature from "./AppFeature";

type Props = {
    token: string
}

const Home: React.FC<Props> = ({token}) => {
    return (
        <>
            {!token && (
                <>
                    <MasterHead/>
                    <TestimonialAside/>
                    <AppFeature/>
                </>
            )}
            {token && (
                <>
                    <h1>Todo list</h1>
                </>
            )}
        </>
    )
}

export default Home;
