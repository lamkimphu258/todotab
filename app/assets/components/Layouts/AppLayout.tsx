import React from 'react';
import HeaderContainer from "../Partials/HeaderContainer";
import Navbar from "../Partials/Navbar";
import ContentContainer from "./ContentContainer";
import FooterContainer from "../Partials/FooterContainer";
import Footer from "../Partials/Footer";


type Props = {
    token: string;
    setToken: (token: string) => void;
}

const AppLayout: React.FC<Props> = ({token, setToken, children}) => {
    return (
        <>
            <HeaderContainer>
                <Navbar userToken={token}/>
            </HeaderContainer>
            <ContentContainer>
                {children}
            </ContentContainer>
            <FooterContainer>
                <Footer/>
            </FooterContainer>
        </>
    )
}

export default AppLayout;
