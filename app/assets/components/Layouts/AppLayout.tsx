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
import useToken from "../CustomHooks/useToken";

const AppLayout: React.FC = () => {
    const [token, setToken] = useToken();

    return (
        <Router>
            <HeaderContainer>
                <Navbar userToken={token}/>
            </HeaderContainer>
            <ContentContainer>
                <AppRouter token={token} setToken={setToken}/>
            </ContentContainer>
            <FooterContainer>
                <Footer/>
            </FooterContainer>
        </Router>
    )
}

export default AppLayout;
