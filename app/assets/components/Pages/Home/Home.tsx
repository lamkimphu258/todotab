import React from 'react';
import MasterHead from "./MasterHead";
import TestimonialAside from "./TestimonialAside";
import AppFeature from "./AppFeature";
import TodoIndexPage from "../Todos/TodoIndexPage";

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
                    <TodoIndexPage/>
                </>
            )}
        </>
    )
}

export default Home;
