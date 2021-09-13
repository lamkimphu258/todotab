import React from 'react';
import HeaderContainer from "../Partials/HeaderContainer";
import Navbar from "../Partials/Navbar";
import ContentContainer from "./ContentContainer";
import FooterContainer from "../Partials/FooterContainer";
import Footer from "../Partials/Footer";
import {
    BrowserRouter as Router,
} from 'react-router-dom';
import AppRouter from "../Routers/AppRouter";

const AppLayout: React.FC = () => {
    return (
        <Router>
            <HeaderContainer>
                <Navbar/>
            </HeaderContainer>
            <ContentContainer>
                <AppRouter/>
            </ContentContainer>
            <FooterContainer>
                <Footer/>
            </FooterContainer>
        </Router>
    )
}

export default AppLayout;
