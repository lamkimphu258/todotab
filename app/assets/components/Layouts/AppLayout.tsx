import React from 'react';
import HeaderContainer from "../Partials/HeaderContainer";
import Navbar from "../Partials/Navbar";
import ContentContainer from "./ContentContainer";
import FooterContainer from "../Partials/FooterContainer";
import Footer from "../Partials/Footer";

const AppLayout: React.FC = ({children}) => {
    return (
        <>
            <>
                <HeaderContainer>
                    <Navbar/>
                </HeaderContainer>
                <>
                    <ContentContainer>
                        {children}
                    </ContentContainer>
                </>
                <FooterContainer>
                    <Footer/>
                </FooterContainer>
            </>
        </>
    )
}

export default AppLayout;
