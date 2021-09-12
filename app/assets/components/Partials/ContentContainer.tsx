import React from 'react';

const ContentContainer: React.FC = ({children}) => {
    return (
        <div className={'container'}>
            {children}
        </div>
    )
}

export default ContentContainer;
